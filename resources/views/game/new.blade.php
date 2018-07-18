@extends('layouts.app')

@section('title')
    @parent - {{ __('New game') }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-center">{{ __('New game') }}</div>

                    <div class="card-body">
                        @include('includes.sessions')

                        <group-chat-room :conversation="{{ $conversation }}"
                                         :current-user="{{ auth()->user() }}"></group-chat-room>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
