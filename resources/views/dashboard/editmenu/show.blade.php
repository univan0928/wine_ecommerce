@extends('dashboard.base')

@section('content')


<div class="container-fluid">
  <div class="fade-in">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header"><h4>Show menu element</h4></div>
            <div class="card-body">
                @if(Session::has('message'))
                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                @endif

                    <table class="table table-striped table-bordered datatable">
                        <tbody>
                            <tr>
                                <th>
                                    {{ trans('wine.menu') }}
                                </th>
                                <td>
                                    @foreach($menulist as $menu1)
                                        @if($menu1->id == $menuElement->menu_id  )
                                            {{ $menu1->name }}
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('wine.role') }}
                                </th>
                                <td>
                                    <?php
                                        $first = true;
                                        foreach($menuroles as $menurole){
                                            if($first === true){
                                                $first = false;
                                            }else{
                                                echo ', ';
                                            }
                                            echo $menurole->role_name;
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('wine.Type') }}
                                </th>
                                <td>
                                    {{ $menuElement->slug }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('wine.href') }}:
                                </th>
                                <td>
                                    {{ $menuElement->href }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('wine.select_dropdown') }}:
                                </th>
                                <td>
                                    <?php
                                        if(isset($menuElement->parent_name)){
                                            echo $menuElement->parent_name;
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Icon
                                </th>
                                <td>
                                    <i class="{{ $menuElement->icon }}"></i>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    {{ $menuElement->icon }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <a class="btn btn-primary" href="{{ route('menu.index', ['menu' => $menuElement->menu_id]) }}">Return</a>
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