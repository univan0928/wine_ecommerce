@extends('dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> {{ __('wine.edit') }}: {{ $customer->name }}</div>
                        <div class="card-body">
                            <form method="POST" action="/admin/customer/{{ $customer->id }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <div class="col">
                                        <label>{{ __('wine.customer company') }}</label>
                                        <input disabled class="form-control" type="text" placeholder="" name="name" value="{{ $customer->name }}" required autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <label>{{ __('wine.address') }}</label>
                                        <input disabled class="form-control" type="text" placeholder="" name="address" value="{{ $customer->address }}" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col">
                                        <label>{{__('wine.post code')}}</label>
                                        <input disabled class="form-control" type="text" placeholder="" name="post_code" value="{{ $customer->postcode }}" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col">
                                        <label>{{__('wine.tel')}}</label>
                                        <input disabled class="form-control" type="text" placeholder="" name="tel" value="{{ $customer->tel }}" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col">
                                        <label>{{__('wine.fax')}}</label>
                                        <input disabled class="form-control" type="text" placeholder="" name="fax" value="{{ $customer->fax }}" required autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <label>{{__('wine.E-Mail Address')}}</label>
                                        <input disabled class="form-control" type="text" placeholder="" name="email" value="{{ $customer->email }}" required autofocus>
                                    </div>
                                </div>
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
