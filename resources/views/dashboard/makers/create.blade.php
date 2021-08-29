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
                            <form method="POST" action="{{ route('makers.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.code winery')}}</label>
                                        <input id = "foreign_maker_id" class="@error('foreign_maker_id') is-invalid @enderror form-control mb-1" type="number" placeholder="" name="foreign_maker_id" require autofocus>
                                        @error('foreign_maker_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.jp winery')}}</label>
                                        <input  id = "jp_name" class="form-control" type="text" placeholder="" name="jp_name" >
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.en winery')}}</label>
                                        <input  id = "en_name" class="form-control" type="text" placeholder="" name="en_name">
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.E-Mail Address')}}</label>
                                        <input  id = "maker_email" class="form-control" type="text" placeholder="" name="maker_email" >
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.address')}}</label>
                                        <input  id = "maker_address" class="form-control" type="text" placeholder="" name="maker_address">
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.fax')}}</label>
                                        <input  id = "maker_fax" class="form-control" type="text" placeholder="" name="maker_fax">
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.tel')}}</label>
                                        <input  id = "maker_phone" class="form-control" type="text" placeholder="" name="maker_phone">
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('URL')}}</label>
                                        <input  id = "maker_url" class="form-control" type="text" placeholder="" name="maker_url" >
                                    </div>
                                </div>

                                <button class="btn btn-block btn-success" type="submit">{{ __('wine.Add') }}</button>
                                <a href="{{ route('makers.index') }}" class="btn btn-block btn-primary">{{ __('wine.return') }}</a>
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
