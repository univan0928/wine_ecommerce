<?php $total = 0; $count = 0 ?>
@foreach((array) session('cart') as $id => $details)
    @php
        $total += $details['price'] * $details['quantity'];
        $count += $details['quantity'];
    @endphp
@endforeach

    <button type="button" class="cart-btn-style" data-toggle="dropdown">
        <i class="fa fa-shopping-cart" aria-hidden="true"></i>  <span class="badge badge-pill badge-danger">{{ $count }}</span>
    </button>
    @if($count > 0)
        <div class="dropdown-menu cart-dropdown p-4 mt-3">
            <div class="row total-header-section mr-0 ml-0 align-items-center d-flex">
    {{--            <div class="col-lg-6 col-sm-6 col-6">--}}
    {{--                <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>--}}
    {{--            </div>--}}
                    <h3 class="mt-0 mb-0 font-weight-bold">{{__('wine.cart title')}}</h3>
            </div>
            <hr class = "mt-1">
            @if(session('cart'))
                @foreach(session('cart') as $id => $details)
                    <div class="row cart-detail pb-1 mr-0 ml-0">
                        <div class="col-2 justify-content-center align-items-center d-flex m-0 p-0">
                            @if ($details['photo'] )
                            <img class = "cart-bottle" src="/images/products/{{ $details['photo'] }}" />
                            @else
{{--                                @if($row->color == 1 && $row->wine_type =='スパークリング') <img class = "cart-bottle" src="/images/default_red.png" />--}}
{{--                                @elseif($row->color != 1 && $row->wine_type =='スパークリング') <img class = "cart-bottle" src="/images/default_sparkling.png" />--}}
                                @if($details['color'] == 1) <img class = "cart-bottle" src="/images/default_red.png" />
                                @elseif($details['color'] == 2) <img class = "cart-bottle" src="/images/default_white.png" />
                                @elseif($details['color'] == 3) <img class = "cart-bottle" src="/images/default_rose.png" />
                                @elseif($details['color'] == 0) <img class = "cart-bottle" src="/images/default_sparkling.png" />
                                @endif
                            @endif
                        </div>
                        <div class="col-8 align-items-center flex-wrap d-flex">
                            <p class = "mb-0 font-weight-bold w-100">{{ $details['year']==0?"":$details['year'] }}</p>
                            <p class = "mb-0 font-weight-bold w-100">{{ $details['name'] }}</p>
                            <span class="text-secondary">{{__('wine.Quantity')}}: {{ $details['quantity']}}({{$details['case']}}) </span>&nbsp;&nbsp;&nbsp;

                            <span class="font-weight-bold text-default"> ¥ {{ number_format(intval($details['price'])) }}</span>
                        </div>
                        <div class = "col-2 text-secondary">
                            <button class = "remove-from-cartdrop d-flex p-2" data-id = {{$id}}>
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <hr class = "mt-1">
                @endforeach
            @endif
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{__('wine.Subtotal')}}</h5>
                <h5 class="text-default">¥ {{ number_format(intval($total)) }}</h5>
            </div>
            <hr class = "mt-1">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{__('wine.Tax')}}</h5>
                <h5 class="text-default">¥ {{number_format(intval($total*8/100))  }}</h5>
            </div>
            <hr class = "mt-1">
            <div class="d-flex justify-content-between align-items-center ">
                <h5 class="mb-0">{{__('wine.Total')}}</h5>
                <h5 class="text-default">¥ {{number_format(intval($total) + intval($total*8/100)) }}</h5>
            </div>
            <hr class = "mt-1">
            <div class="d-flex justify-content-center align-items-center">
{{--                <h4 class="mb-0 font-weight-bold">{{__('wine.Total')}}: <span class="text-default">¥ {{ intval($total) }}</span></h4>--}}
                <a href="{{ url('cart') }}" class="p-2 w-50 but1 text-center">{{__('wine.Cart')}}</a>
            </div>
        </div>
    @else
        <div class="dropdown-menu dropdown-menu-right mt-3" aria-labelledby="navbarDropdown">
            <p class = "p-1 m-0 text-center">{{__('wine.Cart is empty')}}</p>

        </div>
    @endif
<script>
    $(".remove-from-cartdrop").click(function (e) {
        console.log($(this));
        e.preventDefault();
        var ele = $(this);
        $.ajax({
            url: '{{ url('remove-from-cart') }}',
            method: "DELETE",
            data: {id: ele.attr("data-id")},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                // window.location.reload();
                cartRefresh();
            }
        });
    });
</script>
