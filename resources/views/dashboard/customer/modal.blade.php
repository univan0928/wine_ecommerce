
<table class="table table-responsive-sm table-striped">
    <thead>
    <tr>
        <th>{{__('wine.customer company')}}</th>
        <th>{{__('wine.address')}}</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($customers as $customer)
        <tr>
            <td><strong>{{ $customer->name }}</strong></td>
            <td>{{ $customer->address }}</td>
            <td>
                <a href="{{ url('admin/customer/' . $customer->id) }}" class="btn btn-block btn-primary">{{__('wine.show')}}</a>
            </td>
            <td>
                <a href="{{ url('admin/customer/' . $customer->id . '/edit') }}" class="btn btn-block btn-primary">{{__('wine.edit')}}</a>
            </td>
            <td>
                <button id = "customer_dialog" class="btn btn-block btn-danger" data-id="{{$customer->id}}" data-toggle="modal" data-target="#exampleModal">
                    {{__('wine.delete')}}
                </button>

            </td>
        </tr>

    @endforeach
    </tbody>

</table>




<!-- Modal -->
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
                    <form action="{{ route('customer.destroy','1') }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="user_name" id="user_name" value=""/>
                        <button class="btn btn-block btn-danger">{{__('wine.alert delete')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<div>
    {!!$customers->onEachSide(0)->links()!!}
</div>




