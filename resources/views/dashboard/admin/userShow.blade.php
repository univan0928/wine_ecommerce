@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-6 col-md-5 col-lg-4 col-xl-3">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> {{ trans('wine.user')}} {{ $user->name }}</div>
                    <div class="card-body">
                        <h4>{{ trans('wine.Name')}}: {{ $user->name }}</h4>
                        <h4>{{ trans('wine.E-Mail Address')}}: {{ $user->email }}</h4>
                        <a href="{{ route('adminusers.index') }}" class="btn btn-block btn-primary">{{ trans('wine.return') }}</a>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection


@section('javascript')

@endsection
