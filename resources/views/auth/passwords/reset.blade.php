@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        {{ Form::open(['route' => 'password.request']) }}

                            {{ Form::hidden('token', $token) }}

                            <div class="form-group row">
                                {{ Form::label('email', __('E-Mail address'), ['class' => 'col-md-4 col-form-label
                                text-md-right']) }}

                                <div class="col-md-6">
                                    <div class="input-group">
                                        {{ Form::email('email', ($email ?? old('email')), ['class' => 'form-control'
                                        . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' =>
                                        __('Enter your E-Mail address'), 'minlength' => '3', 'maxlength' => '255',
                                        'required', 'autofocus']) }}

                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-envelope-o"></i></span>
                                        </div>
                                    </div>

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
                                    <div class="input-group">
                                        {{ Form::password('password', ['class' => 'form-control' . ($errors->has
                                        ('password') ? ' is-invalid' : ''), 'placeholder' =>
                                        __('Enter your password'), 'minlength' => '6', 'maxlength' => '30',
                                        'required']) }}

                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-key"></i></span>
                                        </div>
                                    </div>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('password-confirmation', __('Confirm password'), ['class' => 'col-md-4
                                col-form-label text-md-right']) }}

                                <div class="col-md-6">
                                    <div class="input-group">
                                        {{ Form::password('password-confirmation', ['class' => 'form-control',
                                        'placeholder' => __('Confirm your password'), 'minlength' => '6', 'maxlength'
                                         => '30', 'required']) }}

                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-key"></i></span>
                                        </div>
                                    </div>

                                    @if ($errors->has('password-confirmation'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password-confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    {{ Form::submit(__('Reset Password'), ['class' => 'btn btn-primary']) }}
                                </div>
                            </div>

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
