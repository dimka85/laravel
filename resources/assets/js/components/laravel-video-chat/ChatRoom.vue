<template>
    <div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card bg-light">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="fa fa-comment"></i> Чат с <strong>{{ withUser.nickname }}</strong>
    
                            <button class="btn btn-warning btn-sm float-right" @click="startVideoCallToUser(withUser.id)" type="button">
                                <i class="fa fa-video-camera"></i> <span class="d-none d-sm-inline">
                                Видеозвонок</span>
                            </button>
                        </h4>
                    </div>
                    <div class="card-body">
                        <ul class="chat" v-chat-scroll>
                            <li class="clearfix" v-for="message in messages" v-bind:class="{ 'right':
                            check(message.sender.id), 'left': !check(message.sender.id) }">
                            <span class="chat-img" v-bind:class="{ 'float-right': check(message.sender.id),
                            'float-left': !check(message.sender.id) }">
                                <img :src="'//homestead.test/storage/' + message.sender.avatar"
                                     alt="Аватар пользователя" class="rounded-circle" width="40" height="40" />
                            </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <small class="text-muted"><i class="fa fa-clock-o"></i><timeago
                                            :since="message.created_at" :auto-update="10"></timeago></small>
                                        <strong v-bind:class="{ 'float-right': check(message.sender.id),
                                        'float-left': !check(message.sender.id)}" class="primary-font">
                                            {{ message.sender.name }}
                                        </strong>
                                    </div>
                                    <p v-bind:class="{ 'float-right': check(message.sender.id), 'float-left':
                                    !check(message.sender.id)}">
                                        {{ message.text }}
                                    </p>
                                    <div class="row">
                                        <file-preview :file="file" v-for="file in message.files" :key="file.id"></file-preview>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <div class="input-group">
                            <input id="btn-input" type="text" v-model="text" class="form-control input-sm"
                                   aria-label="Введите ваше сообщение" aria-describedby="btn-input-1" placeholder="Введите ваше сообщение..." />
                            <div class="input-group-append" id="btn-input-1">
                                <button class="btn btn-warning btn-sm" type="button" @click.prevent="send()" id="btn-chat">
                                    Отправить
                                </button>
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" multiple class="custom-file-input" aria-label="Отправить файлы"
                                       aria-describedby="btn-input-2" @change="prepareUpload" id="files">
                                <label class="custom-file-label" for="files">Выберите файлы</label>
                            </div>
                            <div class="input-group-append" id="btn-input-2">
                                <button class="btn btn-warning btn-sm" type="button" @click.prevent="sendFiles()">
                                    Отправить файлы
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <video-section></video-section>
            </div>

            <div id="incomingVideoCallModal" class="modal fade" role="dialog" tabindex="-1"
                 aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">

                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">&times;
                            </button>
                            <h4 class="modal-title" id="modalLabel">Входящий звонок</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="answerCallButton" class="btn btn-success" @click="answerCall">Ответить
                            </button>
                            <button type="button" id="denyCallButton" data-dismiss="modal" class="btn btn-danger">Отмена</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <file-preview :file="file" v-for="file in conversation.files" :key="file.id"></file-preview>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['conversation', 'currentUser'],
        data() {
            return {
                localVideo: document.getElementById('localVideo'),
                remoteVideo: document.getElementById('remoteVideo'),
    
                files: null,
                luid: null,
                ruid: null,
                startTime: null,
                localStream: null,
                pc: null,
                offerOptions: {
                    offerToReceiveAudio: 1,
                    offerToReceiveVideo: 1
                },
                isCaller: false,
                peerConnectionDidCreate: false,
                candidateDidReceived: false,
                
                conversationId: this.conversation.conversationId,
                channel: this.conversation.channel_name,
                messages: this.conversation.messages,
                withUser: this.conversation.user,
                text: '',
                constraints: {
                    audio: false,
                    video: true
                }
            }
        },
        methods: {
            startVideoCallToUser (id) {

                Cookies.set('remoteUUID', id);

                window.remoteUUID = id;

                this.luid = Cookies.get('uuid');
                this.ruid = Cookies.get('remoteUUID');
                this.isCaller = true;

                this.start()
            },
            check(id) {
                return id === this.currentUser.id;
            },
            send() {
                axios.post('/chat/message/send', {
                    conversationId: this.conversationId,
                    text: this.text,
                }).then((response) => {
                    this.text = '';
                });
            },
            sendFiles() {
                let data = new FormData();
    
                this.files.forEach(function(key, value) {
                    data.append('files[]', value);
                });

                data.append('conversationId', this.conversationId);

                axios.post('/chat/message/send/file', data);
            },
            listenForNewMessage: function () {
                Echo.join(this.channel)
                    .here((users) => {
                        console.log(users)
                    })
                    .listen('\\PhpJunior\\LaravelVideoChat\\Events\\NewConversationMessage', (data) => {
                        console.log('test');
                        let self = this;
                        if (data.files.length > 0) {
                            data.files.forEach(function(key, value) {
                                self.conversation.files.push(value);
                            });
                        }
                        this.messages.push(data);
                    })
                    .listen('\\PhpJunior\\LaravelVideoChat\\Events\\VideoChatStart', (data) => {

                        if (data.to != this.currentUser.id) {
                            return;
                        }

                        if (data.type === 'signal') {
                            this.onSignalMessage(data);
                        } else if (data.type === 'text') {
                            console.log('received text message from ' + data.from + ', content: ' + data.content);
                        } else {
                            console.log('received unknown message type ' + data.type + ' from ' + data.from);
                        }
                    });
            },
            prepareUpload: function (event) {
                this.files = event.target.files;
            },
            answerCall: function () {
                this.isCaller = false;
                this.luid = Cookies.get('uuid');
                this.ruid = Cookies.get('remoteUUID');
                document.getElementById('#incomingVideoCallModal').classList.remove('show');
                this.start()
            },
            start: function () {
    
                this.trace('Requesting local stream');
            
                navigator.mediaDevices.getUserMedia({
                    audio: true,
                    video: {
                        width: {
                            exact: 320
                        },
                        height: {
                            exact: 240
                        }
                    }
                })
                    .then(this.gotStream)
                    .catch(function(e) {
                        alert('getUserMedia() error: ' + e.name);
                    });
            },
            gotStream: function (stream) {
                this.trace('Received local stream');
                this.localVideo.srcObject = stream;
                this.localStream = stream;
                this.call()
            },
            call: function () {
                this.conversationID = Cookies.get('conversationID');
            
                this.trace('Starting call');
                this.startTime = window.performance.now();
                let videoTracks = this.localStream.getVideoTracks();
                let audioTracks = this.localStream.getAudioTracks();
                if (videoTracks.length > 0) {
                    this.trace('Using video device: ' + videoTracks[0].label);
                }
                if (audioTracks.length > 0) {
                    this.trace('Using audio device: ' + audioTracks[0].label);
                }
            
                let configuration = { "iceServers": [{ "urls": "stun:stun.ideasip.com" }] };
                this.pc = new RTCPeerConnection(configuration);
            
                this.trace('Created local peer connection object pc');
    
                this.pc.onicecandidate = function(e) {
                    this.onIceCandidate(this.pc, e);
                };
            
                this.pc.oniceconnectionstatechange = function (e) {
                    this.onIceStateChange(this.pc, e);
                };
            
                this.pc.onaddstream = this.gotRemoteStream;
            
                this.pc.addStream(this.localStream);
            
                this.trace('Added local stream to pc');
            
                this.peerConnectionDidCreate = true;
            
                if (this.isCaller) {
                    this.trace(' createOffer start');
                    this.trace('pc createOffer start');
                
                    this.pc.createOffer(
                        this.offerOptions
                    ).then(
                        this.onCreateOfferSuccess,
                        this.onCreateSessionDescriptionError
                    );
                } else {
                    this.onAnswer()
                }
            },
            onSignalMessage: function (m) {
                console.log(m.subtype);
                if (m.subtype === 'offer') {
                    console.log('got remote offer from ' + m.from + ', content ' + m.content);
                    Cookies.set('remoteUUID', m.from);
                    this.onSignalOffer(m.content);
                } else if (m.subtype === 'answer') {
                    this.onSignalAnswer(m.content);
                } else if (m.subtype === 'candidate') {
                    this.onSignalCandidate(m.content);
                } else if (m.subtype === 'close') {
                    this.onSignalClose();
                } else {
                    console.log('unknown signal type ' + m.subtype);
                }
            },
            onSignalClose: function () {
                this.trace('Ending call');
                this.pc.close();
                this.pc = null;
            
                this.closeMedia();
                this.clearView();
            },
            closeMedia: function () {
                this.localStream.getTracks().forEach(function (track) {
                    track.stop();
                });
            },
            clearView: function () {
                this.localVideo.srcObject = null;
                this.remoteVideo.srcObject = null;
            },
            onSignalCandidate: function (candidate) {
                this.onRemoteIceCandidate(candidate);
            },
            onRemoteIceCandidate: function (candidate) {
                this.trace('onRemoteIceCandidate : ' + candidate);
                if (this.peerConnectionDidCreate) {
                    this.addRemoteCandidate(candidate);
                } else {
                    //remoteCandidates.push(candidate);
                    let candidates = Cookies.getJSON('candidate');
                    if (this.candidateDidReceived) {
                        candidates.push(candidate);
                    } else {
                        candidates = [candidate];
                        this.candidateDidReceived = true;
                    }
                    Cookies.set('candidate', candidates);
                }
            },
            onSignalAnswer: function (answer) {
                this.onRemoteAnswer(answer);
            },
            onRemoteAnswer: function (answer) {
                this.trace('onRemoteAnswer : ' + answer);
                this.pc.setRemoteDescription(answer).then(function () {
                        this.onSetRemoteSuccess(this.pc)
                    }, this.onSetSessionDescriptionError);
            },
            onSignalOffer: function (offer) {
                Cookies.set('offer', offer);
                document.getElementById('#incomingVideoCallModal').classList.add('show');
            },
            onAnswer: function () {
                let remoteOffer = Cookies.getJSON('offer');
            
                this.pc.setRemoteDescription(remoteOffer).then(function () {
                    this.onSetRemoteSuccess(this.pc)
                    }, this.onSetSessionDescriptionError);
            
                this.pc.createAnswer().then(
                    this.onCreateAnswerSuccess,
                    this.onCreateSessionDescriptionError
                );
            },
            onCreateAnswerSuccess: function (desc) {
                this.trace('Answer from pc:\n' + desc.sdp);
                this.trace('pc setLocalDescription start');
                this.pc.setLocalDescription(desc).then(function () {
                        this.onSetLocalSuccess(this.pc);
                    }, this.onSetSessionDescriptionError
                );
                this.conversationID = Cookies.get('conversationID');
                let message = {from: this.luid, to: this.ruid, type: 'signal', subtype: 'answer', content: desc,
                    time: new Date()};
                axios.post('/trigger/' + this.conversationID , message);
            },
            onSetRemoteSuccess: function (pc) {
                this.trace(pc + ' setRemoteDescription complete');
                this.applyRemoteCandidates();
            },
            applyRemoteCandidates: function () {
                let candidates = Cookies.getJSON('candidate');
                for (let candidate in candidates) {
                    this.addRemoteCandidate(candidates[candidate]);
                }
                Cookies.remove('candidate');
            },
            addRemoteCandidate: function (candidate) {
                this.pc.addIceCandidate(candidate).then(function () {
                        this.onAddIceCandidateSuccess(this.pc);
                    }, function (err) {
                        this.onAddIceCandidateError(this.pc, err);
                    });
            },
            onIceCandidate: function (pc, event) {
                if (event.candidate) {
                    this.trace(pc + ' ICE candidate: \n' + (event.candidate ? event.candidate.candidate : '(null)'));
                    this.conversationID = Cookies.get('conversationID');
                    let message = {from: this.luid, to: this.ruid, type: 'signal', subtype: 'candidate', content:
                        event.candidate, time: new Date()};
                    axios.post('/trigger/' + this.conversationID , message );
                }
            },
            onAddIceCandidateSuccess: function (pc) {
                this.trace(pc + ' addIceCandidate success');
            },
            onAddIceCandidateError: function (pc, error) {
                this.trace(pc + ' failed to add ICE Candidate: ' + error.toString());
            },
            onIceStateChange: function (pc, event) {
                if (pc) {
                    this.trace(pc + ' ICE state: ' + pc.iceConnectionState);
                    console.log('ICE state change event: ', event);
                }
            },
            onCreateSessionDescriptionError: function (error) {
                this.trace('Failed to create session description: ' + error.toString());
            },
            onCreateOfferSuccess: function (desc) {
                this.trace('Offer from pc\n' + desc.sdp);
                this.trace('pc setLocalDescription start');
                this.pc.setLocalDescription(desc).then(function() {
                        this.onSetLocalSuccess(this.pc);
                    }, this.onSetSessionDescriptionError
                );
            
                this.conversationID = Cookies.get('conversationID');
                let message = {from: this.luid, to: this.ruid, type: 'signal', subtype: 'offer', content: desc, 
                    time:new Date()};
                axios.post('/trigger/' + this.conversationID , message );
            },
            onSetLocalSuccess: function (pc) {
                this.trace(pc + ' setLocalDescription complete');
            },
            onSetSessionDescriptionError: function (error) {
                this.trace('Failed to set session description: ' + error.toString());
            },
            gotRemoteStream: function (e) {
                if (this.remoteVideo.srcObject !== e.stream) {
                    this.remoteVideo.srcObject = e.stream;
                    this.trace('pc received remote stream');
                }
            },
            trace: function (arg) {
                let now = (window.performance.now() / 1000).toFixed(3);
                console.log(now + ': ', arg);
            }
        },
        beforeMount () {
            Cookies.set('uuid', this.currentUser.id);
            Cookies.set('conversationID', this.conversationId);
        },
        mounted() {
            this.listenForNewMessage();
        }
    }
</script>

<style>
    .chat
    {
        list-style: none;
        margin: 0;
        padding: 0;
        overflow-y: scroll;
        height: 300px;
    }

    .chat li
    {
        margin-bottom: 10px;
        padding-bottom: 5px;
        border-bottom: 1px dotted #B3A9A9;
    }

    .chat li.left .chat-body
    {
        margin-left: 60px;
    }

    .chat li.right .chat-body
    {
        margin-right: 60px;
    }
    
    .chat li .chat-body p
    {
        margin: 0;
        color: #777777;
    }

    .chat .fa, .card .slidedown .fa
    {
        margin-right: 5px;
    }

    ::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background-color: #F5F5F5;
    }

    ::-webkit-scrollbar
    {
        width: 12px;
        background-color: #F5F5F5;
    }

    ::-webkit-scrollbar-thumb
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #555;
    }
</style>
