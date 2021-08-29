<div class="container mb-3">
    <div class="d-flex justify-content-between">
        <div class = "row result-w">
            <div class ="col-sm-6">
                <span class="h4 pr-3">{{__('wine.total count')}} : {{$result['all_count']}}{{__('wine.item')}}</span>
            </div>
            <div class = "col-sm-6">
                <span class="h4"> {{__('wine.search count')}} : <span id = 'searchResult' class = "h4">{{$result['search_count']}}</span>{{__('wine.item')}}</span>
            </div>
        </div>
        {{--            <a class="nav-link advanced-search" href="{{ route('search') }}">{{__('wine.Advanced wine search')}}</a>--}}
    </div>
</div>
<div class="container">
    <div class = "d-flex justify-content-between">
        <div>
        </div>
        {!!$result['all_products']->withQueryString()->onEachSide(0)->links()!!}
    </div>
    <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6 mt-4">
        @foreach($result['all_products'] as $row)
            <div class="col mb-4">
                <div class="card card-product p-2">
                    @if($row->naccs)
                        <img src="/images/flags/{{$row->naccs}}@3x.png" width="26">
                    @else
                        <img src="/images/default_flag.png" width="26">
                    @endif
                    <span style="font-size: 12px;">{{$row->vintage_year?$row->vintage_year:"NV"}}</span>
                    @if($row->color == 1) <span class="text-danger">
                @elseif($row->color == 2) <span class="text-white-product">
                @elseif($row->color == 3) <span class="text-rose">
                @elseif($row->color == 0) <span class ="text-sparkling">
                @endif
                    <i class="fa fa-circle ml-1"></i>
                </span>
                                <div class="d-flex justify-content-center">
                    <a href="/productdetail/{{$row->product_code}}">
                    @if($row->image_name)
                            <img src="/images/products/{{$row->image_name}}" class="card-img-top" alt="...">
                        @else
                            @if($row->color == 1 && $row->wine_type =='スパークリング') <img src="/images/default_red.png" class="card-img-top" alt="...">
                            @elseif($row->color != 1 && $row->wine_type =='スパークリング') <img src="/images/default_sparkling.png" class="card-img-top" alt="...">
                            @elseif($row->color == 1) <img src="/images/default_red.png" class="card-img-top" alt="...">
                            @elseif($row->color == 2) <img src="/images/default_white.png" class="card-img-top" alt="...">
                            @elseif($row->color == 3) <img src="/images/default_rose.png" class="card-img-top" alt="...">
                            @elseif($row->color == 0) <img src="/images/default_sparkling.png" class="card-img-top" alt="...">
                            @endif
                        @endif
                    </a>
                </div>
                                <span class=""></span>
                                <div class="card-body card-position">
                    <div class="card-top">
                        <div class="card-title-name">
                            <div class="card-title mb-1">{{$row->maker_name}}</div>
                            <div class="card-title mb-0"><b>{{$row->full_product_name}}</b></div>
                        </div>
                        <div class = "card-title-amount">
                            <p class="card-text">{{$row->amount * 1000}}ml<br>
                            <span class="text-bold">{{number_format(intval($row->shop_price))}}円</span></p>
                        </div>
                    </div>
                    <div class="card-bottom">
                        @if($row->current_stock > 0) <div class="but1 text-center ajax_cart" data-id = {{$row->product_code}}>{{__('wine.add to cart')}}</div>
                        @elseif($row->is_reserve == 1) <div class="but text-center">{{__('wine.reservation')}}</div>
                        @else <div class="but2 text-center">{{__('wine.coming soon')}}</div>
                        @endif
                    </div>
                </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class = "d-flex justify-content-between">
        <div>
        </div>
        {!!$result['all_products']->withQueryString()->onEachSide(0)->links()!!}
    </div>
</div>
