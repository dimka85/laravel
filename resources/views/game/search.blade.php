@extends('layouts.app')

@section('title')
    @parent - {{ __('Search new game') }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">{{ __('Search new game') }}</div>

                    <div class="card-body">
                        @include('includes.sessions')

                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
