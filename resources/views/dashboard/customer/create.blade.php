@extends('dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> {{ __('wine.Add Customer') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('customer.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label>{{ __('wine.customer company') }}</label>
                                    <input class="form-control" type="text" placeholder="" name="name" required autofocus>
                                </div>

                                <div class="form-group row">
                                    <label>{{ __('wine.address') }}</label>
                                    <input class="form-control" type="text" placeholder="" name="address" required>
                                </div>

                                <div class="form-group row">
                                    <label>{{__('wine.post code')}}</label>
                                    <input class="form-control" type="text" placeholder="" name="post_code" required>
                                </div>

                                <div class="form-group row">
                                    <label>{{__('wine.tel')}}</label>
                                    <input class="form-control" type="text" placeholder="" name="tel" required>
                                </div>

                                <div class="form-group row">
                                    <label>{{__('wine.fax')}}</label>
                                    <input class="form-control" type="text" placeholder="" name="fax" required>
                                </div>

                                <div class="form-group row">
                                    <label>{{ __('wine.E-Mail Address') }}</label>
                                    <input class="form-control" type="text" placeholder="" name="email" required>
                                </div>

                                <button class="btn btn-block btn-success" type="submit">{{ __('wine.Add') }}</button>
                                <a href="{{ route('customer.index') }}" class="btn btn-block btn-primary">{{ __('wine.return') }}</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')

@endsection
