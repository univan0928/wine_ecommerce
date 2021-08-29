@extends('dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8">
                    <div class="card">
                        <div class="card-header justify-content-between d-flex">
                            <div>
                                {{__('wine.estimate_number_detail')}}: {{ $estimate->estimate_number }}
                            </div>
                            <div>
                                <a target='_blank' class='estimate_link' href='/admin/estimate/pdf_{{$estimate->estimate_number}}'><i style = "font-size:25px; color:red;font-weight:bold" class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class = "card-type">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="text-center m-auto">
                                    <h3 class="mt-4">見積書</h3>
                                </div>
                            </div>
                            <div class = "card-body p-4">
                                <div class="row mb-3" style = "font-size:14px">
                                    <div class="col-md-6 col-xl-6 text-left">
                                        <p class = "m-1">{{$customer->name}} 御中</p>
                                        <p class = "m-1">{{$customer->postcode}}</p>
                                        <p class = "m-1">{{$customer->address}}</p>
                                        <p class = "m-1">TEL : {{$customer->tel}}</p>
                                        <p class="m-1">FAX : {{$customer->fax}}</p>
                                    </div>
                                    <div class="col-md-7 col-xl-6 text-left">
                                        <p class = "m-1">発行日 {{$estimate->created_at->format('Y年m月d日')}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                                        <p class = "m-1">〒542-0081 &nbsp;&nbsp;&nbsp;&nbsp;大阪市中央区南船場3丁目5番26号</p>
                                        <p class = "m-1">株式会社徳岡</p>
                                        <p class = "m-1">TEL : 06-4704-3035 FAX : 06-4704-3070</p>
                                        <p class = "m-1">担当者 : {{ $user->name }}</p>
                                    </div>
                                </div>
                                <table id="cart" class="table table-hover table-condensed">
                                    <thead>
                                    <tr>
                                        <th style = "width:10%">品番</th>
                                        <th style = "width:10%"></th>
                                        <th style="width:25%">{{__('wine.Product')}}</th>
                                        <th style="width:20%">{{__('wine.Price')}}</th>
                                        <th style="width:15%">{{__('wine.Quantity')}}</th>
                                        <th style="width:20%" class="text-center1">{{__('wine.Subtotal')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $subtotal = 0 ?>

                                        @foreach($result as $row)
                                            @php
                                                if($row->bottle_case_state == 1)
                                                $subtotal += $row['case_price'] * $row['quantity'];
                                                else $subtotal += $row['shop_price'] * $row['quantity'];

                                                $tax = intval($subtotal *8/100);
                                                $total = $subtotal + $tax;
                                            @endphp
                                            <tr>
                                                <td >
                                                    <p class="mb-2 product-code-font">{{$row['product_id']}}</p>
                                                </td>
                                                <td class =" p-1">
                                                    <div class="hidden-xs">
                                                        @if ($row->image_name )
                                                            <img class = "img-responsive w-50" src="/images/products/{{ $row->image_name }}" />
                                                        @else
{{--                                                            @if($row->color == 1 && $row->wine_type =='スパークリング') <img class = "img-responsive w-100" src="/images/default_red.png" />--}}
{{--                                                            @elseif($row->color != 1 && $row->wine_type =='スパークリング') <img class = "img-responsive w-100" src="/images/default_sparkling.png" />--}}
                                                            @if($row['color'] == 1) <img class = "img-responsive w-100" src="/images/default_red.png" />
                                                            @elseif($row['color'] == 2) <img class = "img-responsive w-100" src="/images/default_white.png" />
                                                            @elseif($row['color'] == 3) <img class = "img-responsive w-100" src="/images/default_rose.png" />
                                                            @elseif($row['color'] == 0) <img class = "img-responsive w-100" src="/images/default_sparkling.png" />
                                                            @endif
                                                        @endif
                                                    </div>
                                                </td>
                                                <td data-th="Product">
                                                    <div class="row align-items-center d-flex">
                                                        <div class="col-sm-12 text-left">
                                                            <p class="font-weight-bold m-0">{{ $row['vintage_year']==0?"NV":$row['vintage_year'] }}</p>

                                                            <p class="m-0 font-weight-bold">{{ $row['full_product_name'] }}</p>

                                                            @if($row['color'] == 1) <span class="text-danger">
                                            @elseif($row['color'] == 2) <span class="text-white-product">
                                            @elseif($row['color'] == 3) <span class="text-rose">
                                            @elseif($row['color'] == 0) <span class ="text-sparkling">
                                            @endif
                                                <i class="fa fa-circle ml-1"></i>
                                            </span>
                                                                        <span>{{$row['taste']}}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td data-th="Price" class = "p-0">¥ {{$row->bottle_case_state == 1?number_format(intval($row['case_price'])):number_format(intval($row['shop_price'])) }}</td>
                                                <td data-th="Quantity">
                                                    {{--                                    <input data-id="{{ $id }}" onchange="" id="product_quantity" type="number" value="{{ $details['quantity'] }}" class="form-control quantity" />--}}
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        {{$row->quantity}}
                                                    </div>

                                                </td>
                                                <td data-th="Subtotal" class="text-center1 p-0">¥ {{ $row->bottle_case_state == 1?number_format(intval($row['case_price'] * $row['quantity'])): number_format(intval($row['shop_price'] * $row['quantity'])) }}</td>
                                                <td class="actions" data-th="">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                    {{--            <tr class="visible-xs">--}}
                                    {{--                <td class="text-center"><strong>Total {{ $total }}</strong></td>--}}
                                    {{--            </tr>--}}
                                    <tr>
                                        <td colspan="2" >

                                        </td>
                                        <td colspan="1" class="hidden-xs"></td>
                                        <td colspan = "3" class="hidden-xs text-center1 justify-content-center w-50">
                                            <div class="justify-content-between d-flex w-100">
                                                <p class="p-0 m-0">{{__('wine.Subtotal')}}:</p>
                                                <p class="p-0 m-0">¥ {{ number_format($subtotal) }}</p>
                                            </div>
                                            <hr>
                                            <div class="justify-content-between d-flex w-100">
                                                <p class="p-0 m-0">{{__('wine.Tax')}}:</p>
                                                <p class="p-0 m-0">¥ {{ number_format($tax ?? '0') }}</p>
                                            </div>
                                            <hr>
                                            <div class="justify-content-between d-flex w-100">
                                                <p class="p-0 m-0">{{__('wine.Total')}}:</p>
                                                <p class="p-0 m-0">¥ {{ number_format($total ?? '0') }}</p>

                                            </div>

                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>

                            </div>
                        </div>

                    </div>
                    <div class = " mb-5">
                        <a href="{{ url('admin/estimates') }}" class="w-50 m-auto btn btn-block btn-primary">{{ __('wine.return') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('javascript')

@endsection
