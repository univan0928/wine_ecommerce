@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-center pt-5 mt-5">
                <img class="logo" src="../../images/Ellipse 1 copy 4.png">
            </div>
            <div class="d-flex justify-content-center ma-bo">
                <img class="triangle" src="../../images/triangle-1.png">
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-center pb-5">
                        <img class="wine-bottle" src="../../images/wine-bottle.svg">
                    </div>
                    <div class="d-flex justify-content-center">
                        <span class="top-text">{{ __('wine.wine advisor') }}</span>
                    </div>
                </div>


                <div class="card-body card-login">
                    <div class="pb-3 text-left">{{ __('wine.Reset Password') }}</div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">


                            <div class="input-container">

                                <input id="email" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('{{ __('wine.The email field is required') }}')" type="email" class="text-dark @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <label for="email" class="text-dark">{{ __('wine.E-Mail Address') }}</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class = "form-group">
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="login-button">
                                    {{ __('wine.Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-5 mb-4">
                <span class="h4 text-white-50 mr-3 pt-3">{{ __('wine.organizor') }}:</span>
                <img class="logo1" src="../../images/Ellipse 1 copy 4.png">
                <span class="h4 text-white-50 ml-4 pt-3">{{ __('wine.Tokuoka') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
