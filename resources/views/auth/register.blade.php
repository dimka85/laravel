@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    {{ Form::open(['route' => 'register']) }}

                        <div class="form-group row">
                            {{ Form::label('name', __('Name'), ['class' => 'col-md-4 col-form-label
                            text-md-right']) }}

                            <div class="col-md-6">
                                {{ Form::text('name', old('name'), ['class' => 'form-control' . ($errors->has
                                ('name') ? ' is-invalid' : ''), 'required', 'autofocus']) }}

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('email', __('E-Mail address'), ['class' => 'col-md-4 col-form-label
                            text-md-right']) }}

                            <div class="col-md-6">
                                {{ Form::email('email', old('email'), ['class' => 'form-control' . ($errors->has
                                ('email') ? ' is-invalid' : ''), 'required']) }}

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('password', __('Password'), ['class' => 'col-md-4 col-form-label
                            text-md-right']) }}

                            <div class="col-md-6">
                                {{ Form::password('password', ['class' => 'form-control' . ($errors->has('password')
                                ? ' is-invalid' : ''), 'required']) }}

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('password-confirm', __('Confirm password'), ['class' => 'col-md-4
                            col-form-label text-md-right']) }}

                            <div class="col-md-6">
                                {{ Form::password('password-confirm', ['class' => 'form-control', 'required']) }}

                                @if ($errors->has('password-confirm'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password-confirm') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                {{ Form::submit(__('Register'), ['class' => 'btn btn-primary']) }}
                            </div>
                        </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
