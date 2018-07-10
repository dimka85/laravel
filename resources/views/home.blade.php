@extends('layouts.app')

@section('title')
    @parent - {{ __('Home') }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @include('includes.sessions')

                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
