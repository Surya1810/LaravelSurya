@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container" style="padding-top: 20px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Select Others Way to Verify Your Account ') }}</div>

                <div class="card-body">
                    {{-- @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
                @endif --}}

                {{ __('If you do not have access to your emails, we provide another way to verify your account via phone number.') }}
                <br>
                <br>
                <form class="d-inline" method="POST" action="{{ route('otp') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Send code</button>
                </form>
                <br>
                <a class="btn btn-link" href="{{ route('have.otp') }}">
                    {{ __('Already have the code?') }}
                </a>
            </div>
        </div>
    </div>
</div>
</div>


@endsection
