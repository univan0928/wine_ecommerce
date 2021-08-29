<input type ="hidden" id = "sort" value = {{$sort}}>

<table class="table table-responsive-sm table-striped">
    <thead>
    <tr>
        <th>{{ trans('wine.username')}}</th>
        <th class = "email" style = "cursor:pointer">{{ trans('wine.E-Mail Address')}}
            @if($sort == 1)
                <span style = "letter-spacing: -1.9px">
                    <i class="custom-sort-icon-up" style = "opacity: 0.3 !important;" aria-hidden="true"></i>
                    <i class="custom-sort-icon-down" style = "opacity: 1 !important;" aria-hidden="true"></i>
                </span>
            @elseif($sort ==0)
                <span style = "letter-spacing: -1.9px">
                    <i class="custom-sort-icon-up" style = "opacity: 1 !important;" aria-hidden="true"></i>
                    <i class="custom-sort-icon-down" style = "opacity: 0.3 !important;" aria-hidden="true"></i>
                </span>
            @else
                <span style = "letter-spacing: -1.9px">
                    <i class="custom-sort-icon-up" style = "opacity: 0.3 !important;" aria-hidden="true"></i>
                    <i class="custom-sort-icon-down" style = "opacity: 0.3 !important;" aria-hidden="true"></i>
                </span>
            @endif
        </th>
        <th>{{ trans('wine.role')}}</th>
        <th>{{ trans('wine.register_date')}}</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->menuroles == 'admin'?'admin':'user' }}</td>
            <td>{{ $user->email_verified_at }}</td>
            <td>
                <a href="{{ url('/admin/adminusers/' . $user->id) }}" class="btn btn-block btn-primary">{{ trans('wine.show')}}</a>
            </td>
            <td>
                <a href="{{ url('/admin/adminusers/' . $user->id . '/edit') }}" class="btn btn-block btn-primary">{{ trans('wine.edit')}}</a>
            </td>
            <td>
                <button id = "customer_dialog" class="btn btn-block btn-danger" data-id="{{$user->id}}" data-toggle="modal" data-target="#exampleModal">
                    {{__('wine.delete')}}
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('wine.alert')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{__('wine.alert content')}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('wine.alert cancel')}}</button>
                <form action="{{ route('adminusers.destroy', '1' ) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="user_name" id="user_name" value=""/>
                    <button class="btn btn-block btn-danger">{{ trans('wine.delete')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div>
    {!!$users->onEachSide(0)->links()!!}
</div>
