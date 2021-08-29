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
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group">
                                <div class="input-container">
                                    <input id="name" oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('{{ __('wine.The name field is required') }}')" title="This is the text of the tooltip"  type="text" class="text-dark @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    <label for="name" class="text-dark">{{ __('wine.Name') }}</label>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-container">
                                    <input id="email" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('{{ __('wine.The email field is required') }}')" type="email" class="text-dark @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    <label for="email" class="text-dark">{{ __('wine.E-Mail Address') }}</label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ __("wine.".$message) }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-container">
                                    <input id="password" oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('{{ __('wine.The password field is required') }}')" type="password" class="text-dark @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    <label for="password" class="text-dark">{{ __('wine.Password') }}</label>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ __("wine.".$message) }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-container">
                                    <input id="password-confirm" oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('{{ __('wine.The password field is required') }}')" type="password" class="text-dark" name="password_confirmation" required autocomplete="new-password">
                                    <label for="password-confirm" class="text-dark">{{ __('wine.Confirm Password') }}</label>
                                </div>
                            </div>
                            <div class = "form-group">
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="login-button">
                                        {{ __('wine.Register') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="text-center text-dark pb-3"></div>
                        <div class="d-flex justify-content-center">
                            <div class="twitter rounded-circle-1 mr-4"><i class="fa fa-twitter"></i></div>
                            <div class="facebook rounded-circle-1"><i class="fa fa-facebook-f"></i></div>
                            <div class="apple rounded-circle-1 ml-4"><i class="fa fa-apple"></i></div>
                        </div>
                        <div class="text-center text-dark pt-3">
                            <a class = "text-dark" href="{{ route('login') }}">{{ __('wine.Login') }}</a>
                        </div>
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
