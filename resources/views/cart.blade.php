@extends('layouts.appmain')

@section('content')
    <div class="container">

        <div class = "d-flex justify-content-between align-items-center mb-3">
            <h2 class="m-0 font-weight-bold">{{__('wine.cart title')}}</h2>
            <a href="{{ url('/cartclear') }}" class="btn but1">{{__('wine.Clear cart')}}</a>
        </div>

        <div class = "card-type">
            <div class="d-flex align-items-center">
                <div class="text-center text-white position-absolute" style="left: Calc(50% - 60px);">
                    <h3 class="mt-4">見積書</h3>
                </div>
                <img class = "cart-image-radius w-100" src="images/cartheader.png">
            </div>
            <div class = "card-body p-5">
                <div class="row" style = "font-size:14px">
                    <div class="col-md-5 col-xl-6 text-left">

                        <label>{{__('wine.Customer search')}}:</label>
                        <input type="text" id="customer_id" list="customernames" class="" onchange = "updateInfo()">
                        <datalist id="customernames" autocomplete="off">
                            @foreach($customers as $customer)
                            <option id="{{$customer->id}}" value="{{$customer->name}}"></option>
                            @endforeach
                        </datalist>

                        <div id = "customer_info">

                        </div>
                    </div>
                    <div class="col-md-7 col-xl-6 text-left">
                        <p class = "m-1">発行日 {{date('Y年m月d日')}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                        <p class = "m-1">〒542-0081 &nbsp;&nbsp;&nbsp;&nbsp;大阪市中央区南船場3丁目5番26号</p>
                        <p class = "m-1">株式会社徳岡</p>
                        <p class = "m-1">TEL : 06-4704-3035 FAX : 06-4704-3070</p>
                        <p class = "m-1">担当者 : {{ Auth::user()->name }}</p>
                    </div>
                </div>

                <table id="cart" class="table table-hover table-condensed">
                    <thead>
                    <tr>
                        <th style = "width:10%"></th>
                        <th style="width:35%">{{__('wine.Product')}}</th>
                        <th style="width:10%">{{__('wine.Price')}}</th>
                        <th style="width:30%">{{__('wine.Quantity')}}</th>
                        <th style="width:10%" class="text-center1">{{__('wine.Subtotal')}}</th>
                        <th style="width:5%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $subtotal = 0 ?>
                    @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                            @php
                                $subtotal += $details['price'] * $details['quantity'];
                                $tax = intval($subtotal *8/100);
                                $total = $subtotal + $tax;
                            @endphp
                            <tr>
                                <td class =" p-md-2 p-xl-3 p-0">
                                    <div class="hidden-xs">
                                        @if ($details['photo'] )
                                        <img class = "img-responsive w-50" src="/images/products/{{ $details['photo'] }}" />
                                        @else
{{--                                            @if($row->color == 1 && $row->wine_type =='スパークリング') <img class = "img-responsive w-100" src="/images/default_red.png" />--}}
{{--                                            @elseif($row->color != 1 && $row->wine_type =='スパークリング') <img class = "img-responsive w-100" src="/images/default_sparkling.png" />--}}
                                            @if($details['color'] == 1) <img class = "img-responsive w-100" src="/images/default_red.png" />
                                            @elseif($details['color'] == 2) <img class = "img-responsive w-100" src="/images/default_white.png" />
                                            @elseif($details['color'] == 3) <img class = "img-responsive w-100" src="/images/default_rose.png" />
                                            @elseif($details['color'] == 0) <img class = "img-responsive w-100" src="/images/default_sparkling.png" />
                                            @endif
                                        @endif
                                        </div>
                                </td>
                                <td data-th="Product">
                                    <div class="row align-items-center d-flex">
                                        <div class="col-sm-12 text-left">
                                            <p class="font-weight-bold m-0">{{ $details['year']==0?"":$details['year'] }}</p>
                                            <p class="mb-2 product-code-font">{{$details['id']}}</p>
                                            <p class="m-0 font-weight-bold">@php echo mb_convert_kana($details['name'],'KVC') @endphp</p>

                                            @if($details['color'] == 1) <span class="text-danger">
                                            @elseif($details['color'] == 2) <span class="text-white-product">
                                            @elseif($details['color'] == 3) <span class="text-rose">
                                            @elseif($details['color'] == 0) <span class ="text-sparkling">
                                            @endif
                                                <i class="fa fa-circle ml-1"></i>
                                            </span>
                                            <span>{{$details['taste']}}</span>
                                        </div>
                                    </div>
                                </td>
                                <td data-th="Price" class = "p-0">¥ {{ number_format(intval($details['price'])) }}</td>
                                <td data-th="Quantity">
{{--                                    <input data-id="{{ $id }}" onchange="" id="product_quantity" type="number" value="{{ $details['quantity'] }}" class="form-control quantity" />--}}
                                    <div class="d-flex align-items-center justify-content-center">
                                        <button data-id="{{ $id }}" type="button" class="plus-button mr-1" data-quantity="minus">
                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                        </button>
                                        <input onchange = "quantityUpdata({{ $id }})" data-id="{{ $id }}" class="p-0 form-control input-group-field text-center update-cart w-50" type="number" name="{{$id}}" value="{{ $details['quantity'] }}">
                                        <button data-id="{{ $id }}" type="button" class="plus-button ml-1" data-quantity="plus">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>

                                </td>
                                <td data-th="Subtotal" class="text-center1 p-0">¥ {{ number_format(intval($details['price'] * $details['quantity'])) }}</td>
                                <td class="actions" data-th="">
{{--                                    <button class="btn button-remove btn-sm update-cart mt-1 mb-1" data-id="{{ $id }}"><i class="fa fa-sync-alt"></i></button>--}}
                                    <button class="btn button-remove btn-sm remove-from-cart mt-1 mb-1" data-id="{{ $id }}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                    <tfoot>
                    {{--            <tr class="visible-xs">--}}
                    {{--                <td class="text-center"><strong>Total {{ $total }}</strong></td>--}}
                    {{--            </tr>--}}
                    <tr>
                        <td colspan="2" >
                            @if(session('cart'))
                                <a href="{{ url('/pdf') }}" id = "pdf" class="d-none d-md-block float-left btn but1 mt-1 mb-1"><i class="fa fa-file-pdf" aria-hidden="true"></i>&nbsp&nbsp{{__('wine.Export to PDF')}}</a>
                            @else
                                <a href="" class="disabled d-none d-md-block float-left btn but1 mt-1 mb-1"><i class="fa fa-file-pdf" aria-hidden="true"></i>&nbsp&nbsp{{__('wine.Export to PDF')}}</a>
                            @endif
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
                            @if(session('cart')) <a href="{{ url('/pdf') }}" id = "pdf" class="d-block d-md-none float-left btn but1 mt-1 mb-1"><i class="fa fa-file-pdf" aria-hidden="true"></i>&nbsp&nbsp{{__('wine.Export to PDF')}}</a>
                            @else <a href="" id = "pdf"  class="disabled d-block d-md-none float-left btn but1 mt-1 mb-1"><i class="fa fa-file-pdf" aria-hidden="true"></i>&nbsp&nbsp{{__('wine.Export to PDF')}}</a>
                            @endif
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
    <script type="text/javascript">

        function updateInfo() {
            var name = $('#customer_id').val();
            if(name){
                var id = $("#customernames option[value='" + name + "']").attr('id');
            }else{
                name= $("#customernames option").eq(0).attr('value');
                var id = $("#customernames option").eq(0).attr('id');
            }


            $.ajax({
                url: '{{ url('customerinfo') }}',
                method: "GET",
                data: {id: name},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('#customer_info').html(data);

                    var tmp = '{{ url('/pdf') }}' + '?id=' + id;

                    $('#pdf').attr('href',tmp);
                }
            });
        }

        function updateList(){
            var name = $('#customer_id').val();
            $.ajax({
                url: '{{ url("getcustomerinfo") }}',
                method: "POST",
                data: {'search_name': name},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if(data){
                        var html="";
                        $.each(data, function(key, value){
                            html = html+ "<option id='"+value.id+"' value='"+value.name+"'></option>";
                            $("#customernames").html(html);
                        });
                    }
                }
            });
        }

        function pdfUrl(){

        }
        $('[data-quantity="plus"]').click(function(e){

            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('data-id');

            // Get its current value
            var currentVal = parseInt($('input[name='+fieldName+']').val());
            // If is not undefined
            if (!isNaN(currentVal)) {
                // Increment
                $('input[name='+fieldName+']').val(currentVal + 1);
            } else {
                // Otherwise put a 0 there
                $('input[name='+fieldName+']').val(0);
            }
            $.ajax({
                url: '{{ url('update-cart') }}',
                method: "patch",
                data: {id: fieldName, quantity: parseInt($('input[name='+fieldName+']').val())},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        });
        // This button will decrement the value till 0
        $('[data-quantity="minus"]').click(function(e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('data-id');
            // Get its current value
            var currentVal = parseInt($('input[name='+fieldName+']').val());
            // If it isn't undefined or its greater than 0
            if (!isNaN(currentVal) && currentVal > 0) {
                // Decrement one
                $('input[name='+fieldName+']').val(currentVal - 1);
            } else {
                // Otherwise put a 0 there
                $('input[name='+fieldName+']').val(0);
            }

            $.ajax({
                url: '{{ url('update-cart') }}',
                method: "patch",
                data: {id: fieldName, quantity: parseInt($('input[name='+fieldName+']').val())},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        });

        function quantityUpdata(fieldName){


            console.log(fieldName);
            var currentVal = parseInt($('input[name='+fieldName+']').val());

            if (!isNaN(currentVal)) {
                // Decrement one
                $('input[name='+fieldName+']').val(currentVal);
            } else {
                // Otherwise put a 0 there
                $('input[name='+fieldName+']').val(1);
            }
            $.ajax({
                url: '{{ url('update-cart') }}',
                method: "patch",
                data: {id: fieldName, quantity: parseInt($('input[name='+fieldName+']').val())},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }

        {{--function refreshCart(tmp) {--}}
        {{--    var ele = tmp;--}}
        {{--    $.ajax({--}}
        {{--        url: '{{ url('update-cart') }}',--}}
        {{--        method: "patch",--}}
        {{--        data: {id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},--}}
        {{--        headers: {--}}
        {{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
        {{--        },--}}
        {{--        success: function (response) {--}}
        {{--            window.location.reload();--}}
        {{--        }--}}
        {{--    });--}}
        {{--}--}}

        $(".remove-from-cart").click(function (e) {
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
                        window.location.reload();
                    }
                });
        });
        $( document ).ready(function() {
            updateInfo();
        });
    </script>

@endsection
