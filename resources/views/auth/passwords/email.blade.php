@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ Form::open(['route' => 'password.email']) }}

                        <div class="form-group row">
                            {{ Form::label('email', __('E-Mail address'), ['class' => 'col-md-4 col-form-label
                            text-md-right']) }}

                            <div class="col-md-6">
                                {{ Form::email('email', old('email'), ['class' => 'form-control' . ($errors->has
                                ('email') ? ' is-invalid' : ''), 'placeholder' => __('Enter your E-Mail address'),
                                'min' => '3', 'max' => '255', 'required', 'autofocus']) }}

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                {{ Form::submit(__('Send Password Reset Link'), ['class' => 'btn btn-primary']) }}
                            </div>
                        </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
