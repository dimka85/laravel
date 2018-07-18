<template>
    <div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card bg-light">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="fa fa-comment"></i> Чат "{{ conversation.group_conversation.name }}"
    
                            <button class="btn btn-danger btn-sm float-right" @click="leaveFromGroup" type="button">
                                Покинуть чат
                            </button>
                        </h4>
                    </div>
                    <div class="card-body">
                        <ul class="chat" v-chat-scroll>
                            <li class="clearfix" v-for="message in messages" v-bind:class="{ 'right': check(message.sender.id), 'left': !check(message.sender.id) }">
                            <span class="chat-img" v-bind:class="{ 'float-right' : check(message.sender.id) , 'float-left' : !check(message.sender.id) }">
                                <img :src="'//homestead.test/storage/' + message.sender.avatar" alt="Аватар пользователя" class="rounded-circle" width="40" height="40" />
                            </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <small class=" text-muted"><i class="fa fa-clock-o"></i><timeago
                                            :since="message.created_at" :auto-update="10"></timeago></small>
                                        <strong v-bind:class="{ 'float-right' : check(message.sender.id) ,
                                        'float-left' : !check(message.sender.id)}" class="primary-font">
                                            {{ message.sender.name }}
                                        </strong>
                                    </div>
                                    <p v-bind:class="{ 'float-right' : check(message.sender.id) , 'float-left' :
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
        </div>

        <div class="row">
            <file-preview :file="file" v-for="file in conversation.files" :key="file.id"></file-preview>
        </div>

    </div>
</template>
<script>
    export default {
        props: ['conversation' , 'currentUser'],
        data() {
            return {
                files: null,
                groupConversationId: this.conversation.group_conversation.id,
                channel: this.conversation.channel_name,
                messages: this.conversation.messages,
                text: '',
            }
        },
        methods: {
            check(id) {
                return id === this.currentUser.id;
            },
            send() {
                axios.post('/group/chat/message/send',{
                    groupConversationId: this.groupConversationId,
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

                data.append('groupConversationId', this.groupConversationId);

                axios.post('/group/chat/message/send/file', data);
            },
            leaveFromGroup() {
                axios.post('/group/chat/leave/' + this.groupConversationId ).then((response) => {
                    window.location = '/'
                });
            },
            listenForNewMessage: function () {
                Echo.join(this.channel)
                    .here((users) => {
                        console.log(users)
                    })
                    .listen('\\PhpJunior\\LaravelVideoChat\\Events\\NewGroupConversationMessage', (data) => {
                        let self = this;
                        if (data.files.length > 0) {
                            data.files.forEach(function(key, value) {
                                self.conversation.files.push(value);
                            });
                        }
                        this.messages.push(data);
                    });
            },
            prepareUpload: function (event) {
                this.files = event.target.files;
            }
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
        height: 250px;
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
