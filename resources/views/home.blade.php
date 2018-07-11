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
                            {{ Html::linkRoute('game.start', __('Start the game'), null, ['class' => 'list-group-item
                            list-group-item-action bg-success']) }}
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
    </div>
@endsection
