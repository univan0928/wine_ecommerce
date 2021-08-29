@extends('dashboard.base')

@section('content')


<div class="container-fluid">
  <div class="fade-in">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header"><h4>{{ trans('wine.menu') }}</h4></div>
            <div class="card-body">
                <div class="row mb-3 ml-3">
                    <a class="btn btn-lg btn-primary" href="{{ route('menu.menu.create') }}">{{ trans('wine.add_new') }}</a>
                </div>
                <table class="table table-striped table-bordered datatable">
                    <thead>
                        <tr>
                            <th>{{ trans('wine.Name') }}</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>    
                        @foreach($menulist as $menu1)
                            <tr>
                                <td>
                                    {{ $menu1->name }}
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('menu.index', ['menu' => $menu1->id] ) }}">{{ trans('wine.view') }}</a>
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('menu.menu.edit', ['id' => $menu1->id] ) }}">{{ trans('wine.edit') }}</a>
                                </td>
                                <td>
                                    <a class="btn btn-danger" href="{{ route('menu.menu.delete', ['id' => $menu1->id] ) }}">{{ trans('wine.delete') }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('javascript')

@endsection