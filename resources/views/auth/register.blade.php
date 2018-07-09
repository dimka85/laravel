@extends('layouts.app')

@section('title')
    @parent - {{ __('Register') }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        {{ Form::open(['route' => 'register', 'files' => true]) }}

                            <div class="form-group row">
                                {{ Form::label('first_name', __('First name'), ['class' => 'col-md-4 col-form-label
                                text-md-right']) }}

                                <div class="col-md-6">
                                    <div class="input-group">
                                        {{ Form::text('first_name', old('first_name'), ['class' => 'form-control' .
                                        ((count($errors) > 0) ? ($errors->has('first_name') ? ' is-invalid' :
                                        ' is-valid') : ''), 'placeholder' => __('Enter your first name'), 'minlength' => '1', 'maxlength' => '20', 'required', 'autofocus']) }}

                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                        </div>

                                        @if ($errors->has('first_name'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('last_name', __('Last name'), ['class' => 'col-md-4 col-form-label
                                text-md-right']) }}

                                <div class="col-md-6">
                                    <div class="input-group">
                                        {{ Form::text('last_name', old('last_name'), ['class' => 'form-control' .
                                        ((count($errors) > 0) ? ($errors->has('last_name') ? ' is-invalid' :
                                        ' is-valid') : ''), 'placeholder' => __('Enter your last name'), 'minlength' => '1', 'maxlength' => '30', 'required']) }}

                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-user-o"></i></span>
                                        </div>

                                        @if ($errors->has('last_name'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('nickname', __('Nickname'), ['class' => 'col-md-4 col-form-label
                                text-md-right']) }}

                                <div class="col-md-6">
                                    <div class="input-group">
                                        {{ Form::text('nickname', old('nickname'), ['class' => 'form-control' .
                                        ((count($errors) > 0) ? ($errors->has('nickname') ? ' is-invalid' :
                                        ' is-valid') : ''), 'placeholder' => __('Enter your nickname'), 'minlength' => '2', 'maxlength' => '30', 'required']) }}

                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-user-circle"></i></span>
                                        </div>

                                        @if ($errors->has('nickname'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('nickname') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('email', __('E-Mail address'), ['class' => 'col-md-4 col-form-label
                                text-md-right']) }}

                                <div class="col-md-6">
                                    <div class="input-group">
                                        {{ Form::email('email', old('email'), ['class' => 'form-control' .
                                        ((count($errors) > 0) ? ($errors->has('email') ? ' is-invalid' :
                                        ' is-valid') : ''), 'placeholder' => __('Enter your E-Mail address'), 'minlength' => '3', 'maxlength' => '255', 'required']) }}

                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-envelope-o"></i></span>
                                        </div>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('password', __('Password'), ['class' => 'col-md-4 col-form-label
                                text-md-right']) }}

                                <div class="col-md-6">
                                    <div class="input-group">
                                        {{ Form::password('password', ['class' => 'form-control' . ((count($errors) > 0) ? ($errors->has('password') ? ' is-invalid' : ' is-valid') : ''),
                                         'placeholder' => __('Enter your password'), 'minlength' => '6', 'maxlength' => '30', 'required']) }}

                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-key"></i></span>
                                        </div>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('password_confirmation', __('Confirm password'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                                <div class="col-md-6">
                                    <div class="input-group">
                                        {{ Form::password('password_confirmation', ['class' => 'form-control' .
                                        ((count($errors) > 0) ? ($errors->has('password_confirmation') ?
                                        ' is-invalid' : ' is-valid') : ''), 'placeholder' =>
                                        __('Confirm your password'), 'minlength' => '6', 'maxlength' => '30', 'required']) }}

                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-key"></i></span>
                                        </div>

                                        @if ($errors->has('password_confirmation'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('avatar', __('Avatar'), ['class' => 'col-md-4 col-form-label
                                text-md-right']) }}

                                <div class="col-md-6">
                                    <div class="custom-file">
                                        {{ Form::file('avatar', ['class' => 'custom-file-input' .
                                        ((count($errors) > 0) ? ($errors->has('avatar') ? ' is-invalid' :
                                        ' is-valid') : ''), 'required']) }}

                                        {{ Form::label('avatar', __('Choose file'), ['class' => 'custom-file-label',
                                        'lang' => 'ru']) }}

                                        @if ($errors->has('avatar'))
                                            <span class="invalid-feedback pt-2">
                                                <strong>{{ $errors->first('avatar') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="checkbox">
                                        <div class="custom-control custom-checkbox">
                                            {{ Form::checkbox('terms', null, (old('terms') ? true : false),
                                            ['class' => 'custom-control-input' . ((count($errors) > 0) ?
                                            ($errors->has('terms') ? ' is-invalid' : ' is-valid') : ''), 'id' =>
                                            'terms', 'required']) }}

                                            {{ Form::label('terms', __('I agree with terms'), ['class' =>
                                            'custom-control-label']) }}

                                            @if ($errors->has('terms'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('terms') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
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
