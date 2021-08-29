<input type ="hidden" id = "sort" value = {{$sort}}>
<table class="table table-responsive-sm table-striped">
    <thead>
    <tr>
        <th>{{__('wine.product code')}}</th>
        <th class = "full_product_name" style = "cursor:pointer">{{__('wine.full product name')}}
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
        <th>{{__('wine.country list')}}</th>
        <th>{{__('wine.vintage')}}</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @if(isset($products))
        @foreach($products as $product)
            <tr>
                <td><strong>{{ $product->product_code }}</strong></td>
{{--                <td><strong>{{ $product->full_product_name }}</strong></td>--}}
                <td><strong>@php echo mb_convert_kana($product->full_product_name,'KVC')@endphp</strong></td>

                <td>{{ $product->country_jp_name }}</td>
                <td>{{ $product->vintage_year=='0'?'NV': $product->vintage_year}}</td>
                <td>
                    <a href="{{ url('/admin/products/' . $product->product_code . '/edit') }}" class="btn btn-block btn-primary">{{__('wine.edit')}}</a>
                </td>
                <td>
                    <button id = "customer_dialog" class="btn btn-block btn-danger" data-id="{{$product->product_code}}" data-toggle="modal" data-target="#exampleModal">
                        {{__('wine.delete')}}
                    </button>
                </td>
            </tr>
        @endforeach

    @else

        <tr>
            {{__('wine.no data')}}
        </tr>
    @endif
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
                <form action="{{ route('products.destroy', '1' ) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="user_name" id="user_name" value=""/>
                    <button class="btn btn-block btn-danger">{{__('wine.alert delete')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{ $products->links() }}
