@extends('layouts.app')

@section('title')
    @parent - {{ __('Home') }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @include('includes.sessions')

                        <div class="list-group text-center font-weight-bold">
                            {{ Html::linkRoute('game.start', __('Create new game'), null, ['class' => 'list-group-item list-group-item-action bg-success']) }}
                            {{ Html::linkRoute('game.search', __('Find the game'), null, ['class' => 'list-group-item
                            list-group-item-action bg-secondary']) }}
                            {{ Html::linkRoute('game.settings', __('Game settings'), null, ['class' => 'list-group-item list-group-item-action bg-primary']) }}
                            {{ Html::linkRoute('game.statistics', __('Game statistics'), null, ['class' =>
                            'list-group-item list-group-item-action bg-info']) }}
                            {{ Html::linkRoute('home', __('Logout'), null, ['class' => 'list-group-item
                            list-group-item-action bg-danger', 'onclick' => 'event.preventDefault();
                            document.getElementById("logout-form").submit();']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @php $groups = Chat::getAllGroupConversations();$conversations = Chat::getAllConversations();@endphp
        <ul class="list-group">
            @foreach($conversations as $conversation)
                <li class="list-group-item">
                    @if($conversation->message->conversation->is_accepted)
                        <a href="#">
                            <h2>{{$conversation->user->nickname}}</h2>
                            @if(!is_null($conversation->message))
                                <span>{{ substr($conversation->message->text, 0, 20)}}</span>
                            @endif
                        </a>
                    @else
                        <a href="#">
                            <h2>{{$conversation->user->nickname}}</h2>
                            @if($conversation->message->conversation->second_user_id == auth()->user()->id)
                                <a href="accept_request_route" class="btn btn-xs btn-success">
                                    Accept Message Request
                                </a>
                            @endif
                        </a>
                    @endif
                </li>
            @endforeach

            @foreach($groups as $group)
                <li class="list-group-item">
                    <a href="#">
                        <h2>{{$group->name}}</h2>
                        <span>{{ $group->users_count }} Member</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
