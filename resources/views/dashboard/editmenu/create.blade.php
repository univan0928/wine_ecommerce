@extends('dashboard.base')

@section('content')


<div class="container-fluid">
  <div class="fade-in">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header"><h4>{{ trans('wine.add_new') }}</h4></div>
            <div class="card-body">
                @if(Session::has('message'))
                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('menu.store') }}" method="POST">
                    @csrf
                    <table class="table table-striped table-bordered datatable">
                        <tbody>
                            <tr>
                                <th>
                                    {{ trans('wine.menu') }}
                                </th>
                                <td>
                                    <select class="form-control" name="menu" id="menu">
                                        @foreach($menulist as $menu1)
                                            <option value="{{ $menu1->id }}">{{ $menu1->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('wine.role') }}
                                </th>
                                <td>
                                    <table class="table">
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="role[]" value="{{ $role }}" class="form-control"/>
                                            </td>
                                            <td>
                                                {{ $role }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('wine.Name') }}
                                </th>
                                <td>
                                    <input class="form-control" type="text" name="name" placeholder="{{ trans('wine.Name') }}" required/>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('wine.Type') }}
                                </th>
                                <td>
                                    <select class="form-control" name="type" id="type">
                                        <option value="link">Link</option>
                                        <option value="title">Title</option>
                                        <option value="dropdown">Dropdown</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('wine.other') }}
                                </th>
                                <td>
                                    <div id="div-href">
                                        {{ trans('wine.href') }}:
                                        <input type="text" name="href" class="form-control" placeholder=" {{ trans('wine.href') }}"/>
                                    </div>
                                    <br><br>
                                    <div id="div-dropdown-parent">
                                        {{ trans('wine.select_dropdown') }}:
                                        <select class="form-control" name="parent" id="parent">

                                        </select>
                                    </div>
                                    <br><br>
                                    <div id="div-icon">
                                        {{ trans('wine.find_icon') }} : 
                                        <a 
                                            href="https://coreui.io/docs/icons/icons-list/#coreui-icons-free-502-icons"
                                            target="_blank"
                                        >
                                            CoreUI icons documentation
                                        </a>
                                        <br>
                                        <input class="form-control" name="icon" type="text" placeholder="CoreUI Icon class - example: cil-bell">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-primary" type="submit">{{ trans('wine.save') }}</button>
                    <a class="btn btn-primary" href="{{ route('menu.index') }}">{{ trans('wine.return') }}</a>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('javascript')
<script src="{{ asset('js/axios.min.js') }}"></script> 
<script src="{{ asset('js/menu-create.js') }}"></script>


@endsection