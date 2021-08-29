@extends('dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> {{ __('wine.edit') }}: {{ $product->product_code }}</div>
                        <div class="card-body">
                            <form method="POST" action="/admin/products/{{ $product->product_code }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('海外生産者名')}}</label>
                                        <input disabled class="form-control" type="text" placeholder="" name="maker_japanese" value="@php echo mb_convert_kana($product->maker_name,'KVC')@endphp" required autofocus>
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('英字海外生産者名')}}</label>
                                        <input disabled class="form-control" type="text" placeholder="" name="maker_english" value="{{ $product->maker_en_name }}"  autofocus>
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('海外生産者コード')}}</label>
                                        <input class="form-control" type="text" placeholder="" name="foreign_maker_code" value="{{ $product->foreign_maker_code }}"  autofocus>
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.product code')}}</label>
                                        <input class="form-control" type="number" placeholder="" name="product_code" value="{{ $product->product_code }}"  autofocus>
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.full product name')}}(half)</label>
                                        <input class="form-control" type="text" placeholder="" name="full_product_name" value="{{ $product->full_product_name }}" >
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.full english name')}}</label>
                                        <input class="form-control" type="text" placeholder="" name="full_english_name" value="{{ $product->full_english_name }}" >
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.comment')}}</label>
                                        <textarea rows = "4" cols = "50" class="form-control" name="description" style="padding: 0px !important; margin: 0px !important;text-align: left;">
                                            {{ $product->description }}
                                        </textarea>
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.vintage')}}</label>
                                        <input class="form-control" type="number" placeholder="" name="vintage_year" value="{{ $product->vintage_year }}"  >
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.jancode')}}</label>
                                        <input class="form-control" type="text" placeholder="" name="jan_code" value="{{ $product->jan_code }}"  >
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.amount')}}</label>
                                        <input class="form-control" type="number" placeholder="" name="amount" value="{{ $product->amount }}"  >
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.bottles_per_case')}}</label>
                                        <input class="form-control" type="number" placeholder="" name="bottles_per_case" value="{{ $product->bottles_per_case }}"  >
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.case price')}}</label>
                                        <input class="form-control" type="number" placeholder="" name="case_price" value="{{ intval($product->case_price) }}"  >
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.Retail Price')}}</label>
                                        <input class="form-control" type="number" placeholder="" name="shop_price" value="{{ intval($product->shop_price) }}"  >
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.Taste')}}</label>
                                        <select class="form-control" name="type_id" value="{{ $product->type_name }}">
                                            <option value = ""></option>
                                            @foreach($taste as $row)
                                                @if($product->type_name == $row->type_name)
                                                    <option value={{$row->id}} selected>{{$row->type_name}}</option>
                                                @else <option value={{$row->id}} >{{$row->type_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.stock')}}</label>
                                        <input class="form-control" type="number" placeholder="" name="current_stock" value="{{ $product->current_stock }}"  >
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.cap specification')}}</label>
                                        <input class="form-control" type="text" placeholder="" name="cap" value="{{ $product->cap }}"  >
                                    </div>

                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.Type')}}</label>
                                        <select class="form-control" name="wine_type">
                                            <option value = ""></option>
                                            @if($product->wine_type=='スティル') <option value="スティル" selected>スティル</option>
                                            @else <option value="スティル" >スティル</option>
                                            @endif

                                            @if($product->wine_type=='スパークリング') <option value="スパークリング" selected>スパークリング</option>
                                            @else <option value="スパークリング" >スパークリング</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.Color')}}</label>
                                        <select class="form-control" name="color">
                                            <option value = "0"></option>
                                            @if($product->color==1) <option value="1" selected>赤</option>
                                            @else <option value="1" >赤</option>
                                            @endif

                                            @if($product->color==2) <option value="2" selected>白</option>
                                            @else <option value="2" >白</option>
                                            @endif

                                            @if($product->color==3) <option value="3" selected>ﾛｾﾞ</option>
                                            @else <option value="3" >ﾛｾﾞ</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.country list')}}</label>
                                        <!-- <input class="form-control" type="text" placeholder="" name="country" disabled value="{{ $row->country_jp_name }}"  > -->
                                        <select class="form-control" name="country" disabled>
                                            <option value =""></option>
                                            @foreach($country as $row)
                                                @if($product->country_jp_name == $row->country_jp_name)
                                                    <option value={{$row->country_en_name}} selected>{{$row->country_jp_name}}</option>
                                                @else <option value={{$row->country_en_name}} >{{$row->country_jp_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.Area name')}}</label>
                                        <input class="form-control" type="text" placeholder="" name="region" value="{{ $product->region }}"  >
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.Local name')}}</label>
                                        <input class="form-control" type="text" placeholder="" name="local_area" value="{{ $product->local_area }}"  >
                                    </div>

                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.village name')}}</label>
                                        <input class="form-control" type="text" placeholder="" name="village" value="{{ $product->village }}"  >
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.Rating')}}</label>
                                        <input class="form-control" type="text" placeholder="" name="certification" value="{{ $product->certification }}"  >
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.variety')}}</label>
                                        <input class="form-control" type="text" placeholder="" name="variety" value="{{ $product->variety }}"  >
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.Evalution')}}</label>
                                        <input class="form-control" type="text" placeholder="" name="rate   " value="{{ $product->rate }}"  >
                                    </div>
                                    <div class = "col-md-6">

                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <h5>{{__('wine.Upload product image')}}</h5>
                                        @if(isset($product->image_name)&&$product->image_name!='')
                                            <img src="{{asset("images/products/".$product->image_name)}}" id="upfile1" style="border:6px solid #e6d2d2; cursor:pointer;height:240px;width:59px" />
                                        @else
                                            @if($product->color == 1 && $product->wine_type =='スパークリング') <img src="{{asset("images/admindefault/default_red.png")}}" id="upfile1" style="border:6px solid #e6d2d2; cursor:pointer;height:240px;width:59px" />
                                            @elseif($product->color != 1 && $product->wine_type =='スパークリング') <img src="{{asset("images/admindefault/default_sparkling.png")}}" id="upfile1" style="border:6px solid #e6d2d2; cursor:pointer;height:240px;width:59px" />
                                            @elseif($product->color == 1) <img src="{{asset("images/admindefault/default_red.png")}}" id="upfile1" style="border:6px solid #e6d2d2; cursor:pointer;height:240px;width:59px" />
                                            @elseif($product->color == 2) <img src="{{asset("images/admindefault/default_white.png")}}" id="upfile1" style="border:6px solid #e6d2d2; cursor:pointer;height:240px;width:59px" />
                                            @elseif($product->color == 3) <img src="{{asset("images/admindefault/default_rose.png")}}" id="upfile1" style="border:6px solid #e6d2d2; cursor:pointer;height:240px;width:59px" />
                                            @elseif($product->color == 0) <img src="{{asset("images/admindefault/default_sparkling.png")}}" id="upfile1" style="border:6px solid #e6d2d2; cursor:pointer;height:240px;width:59px" />
                                            @endif
                                        @endif
{{--                                        @if(isset($product->image_name)&&$product->image_name!=''))--}}
{{--                                        <img src="{{(isset($product->image_name)&&$product->image_name!='')?asset("images/products/".$product->image_name):asset('images/120x240.png')}}" id="upfile1" style="border:6px solid #e6d2d2; cursor:pointer;height:300px;width:150px" />--}}
                                        <input type="file" style = "display: none" name="image" class="image">
                                        <input type = "hidden" name = "product_image" class = "product_image">
                                        <input type = "hidden" name = "image_name" value = {{$product->image_name}}>
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <h5>{{__('wine.Upload product big image')}}</h5>

                                        @if(isset($product->big_image_name)&&$product->big_image_name!='')
                                            <img src="{{asset("images/bigproducts/".$product->big_image_name)}}" id="upfile2" style="border:6px solid #e6d2d2; cursor:pointer;height:300px;width:75px" />
                                        @else
                                            @if($product->color == 1 && $product->wine_type =='スパークリング') <img src="{{asset("images/admindefault/default_red_large.png")}}" id="upfile2" style="border:6px solid #e6d2d2; cursor:pointer;height:300px;width:75px" />
                                            @elseif($product->color != 1 && $product->wine_type =='スパークリング') <img src="{{asset("images/admindefault/default_sparkling_large.png")}}" id="upfile2" style="border:6px solid #e6d2d2; cursor:pointer;height:300px;width:120px" />
                                            @elseif($product->color == 1) <img src="{{asset("images/admindefault/default_red_large.png")}}" id="upfile2" style="border:6px solid #e6d2d2; cursor:pointer;height:300px;width:75px" />
                                            @elseif($product->color == 2) <img src="{{asset("images/admindefault/default_white_large.png")}}" id="upfile2" style="border:6px solid #e6d2d2; cursor:pointer;height:300px;width:75px" />
                                            @elseif($product->color == 3) <img src="{{asset("images/admindefault/default_rose_large.png")}}" id="upfile2" style="border:6px solid #e6d2d2; cursor:pointer;height:300px;width:75px" />
                                            @elseif($product->color == 0) <img src="{{asset("images/admindefault/default_sparkling_large.png")}}" id="upfile2" style="border:6px solid #e6d2d2; cursor:pointer;height:300px;width:75px" />

                                            @endif
                                        @endif
                                        <input type="file" style = "display: none" name="big_image" class="big_image">
                                        <input type = "hidden" name = "big_product_image" class = "big_product_image">
                                            <input type = "hidden" name = "big_image_name" value = {{$product->big_image_name}}>
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <h5>{{__('wine.Upload product big image')}}(PDF)</h5>

                                        @if(isset($product->pdf_image_name)&&$product->pdf_image_name!='')
                                            <img src="{{asset("images/pdfproducts/".$product->pdf_image_name)}}" id="upfile3" style="border:6px solid #e6d2d2; cursor:pointer;height:300px;width:75px" />
                                        @else
                                            @if($product->color == 1 && $product->wine_type =='スパークリング') <img src="{{asset("images/admindefault/default_red_large.png")}}" id="upfile3" style="border:6px solid #e6d2d2; cursor:pointer;height:300px;width:75px" />
                                            @elseif($product->color != 1 && $product->wine_type =='スパークリング') <img src="{{asset("images/admindefault/default_sparkling_large.png")}}" id="upfile3" style="border:6px solid #e6d2d2; cursor:pointer;height:300px;width:75px" />
                                            @elseif($product->color == 1) <img src="{{asset("images/admindefault/default_red_large.png")}}" id="upfile3" style="border:6px solid #e6d2d2; cursor:pointer;height:300px;width:75px" />
                                            @elseif($product->color == 2) <img src="{{asset("images/admindefault/default_white_large.png")}}" id="upfile3" style="border:6px solid #e6d2d2; cursor:pointer;height:300px;width:75px" />
                                            @elseif($product->color == 3) <img src="{{asset("images/admindefault/default_rose_large.png")}}" id="upfile3" style="border:6px solid #e6d2d2; cursor:pointer;height:300px;width:75px" />
                                            @elseif($product->color == 0) <img src="{{asset("images/admindefault/default_sparkling_large.png")}}" id="upfile3" style="border:6px solid #e6d2d2; cursor:pointer;height:300px;width:75px" />

                                            @endif
                                        @endif
                                        <input type="file" style = "display: none" name="pdf_image" class="pdf_image">
                                        <input type = "hidden" name = "pdf_product_image" class = "pdf_product_image">
                                        <input type = "hidden" name = "pdf_image_name" value = {{$product->pdf_image_name}}>
                                    </div>
                                </div>




                                <button class="btn btn-block btn-success" type="submit">{{ __('wine.save') }}</button>
                                <a href="{{ route('products.index') }}" class="btn btn-block btn-primary">{{ __('wine.return') }}</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">{{__('wine.crop image')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="">
                        <div class="row">
                            <div class="col-md-8">
                                <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('wine.return')}}</button>
                    <button type="button" class="btn btn-primary" id="crop">{{__('wine.crop')}}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="big_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">{{__('wine.crop image')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="">
                        <div class="row">
                            <div class="col-md-8">
                                <img id="big_image" src="https://avatars0.githubusercontent.com/u/3456749">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('wine.return')}}</button>
                    <button type="button" class="btn btn-primary" id="big_crop">{{__('wine.crop')}}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="pdf_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">{{__('wine.crop image')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="">
                        <div class="row">
                            <div class="col-md-8">
                                <img id="pdf_image" src="https://avatars0.githubusercontent.com/u/3456749">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('wine.return')}}</button>
                    <button type="button" class="btn btn-primary" id="pdf_crop">{{__('wine.crop')}}</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('document').ready(function (){
            $('.description').html($('.description').html().trim());
        })
    </script>
@endsection

@section('javascript')
    <script>


        var $modal = $('#modal');
        var $big_modal = $('#big_modal');
        var $pdf_modal = $('#pdf_modal');
        var image = document.getElementById('image');
        var cropper;
        var big_cropper;
        var pdf_cropper;
        var big_image = document.getElementById('big_image');
        var pdf_image = document.getElementById('pdf_image');
        $("#upfile1").click(function () {
            $(".image").trigger('click');
        });

        $("#upfile2").click(function () {
            $(".big_image").trigger('click');
        });

        $("#upfile3").click(function () {
            $(".pdf_image").trigger('click');
        });
        $("body").on("change", ".big_image", function(e){
            var files = e.target.files;
            var done = function (url) {
                big_image.src = url;
                $big_modal.modal('show');
            };
            var reader;
            var file;
            var url;

            if (files && files.length > 0) {
                file = files[0];
                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        $("body").on("change", ".pdf_image", function(e){
            var files = e.target.files;
            var done = function (url) {
                pdf_image.src = url;
                $pdf_modal.modal('show');
            };
            var reader;
            var file;
            var url;

            if (files && files.length > 0) {
                file = files[0];
                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        $("body").on("change", ".image", function(e){
            var files = e.target.files;
            var done = function (url) {
                image.src = url;
                $modal.modal('show');
            };
            var reader;
            var file;
            var url;

            if (files && files.length > 0) {
                file = files[0];
                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        $modal.on('shown.bs.modal', function () {
            cropper = new Cropper(image, {
                aspectRatio: 0.2458,
                viewMode: 1,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function () {
            cropper.destroy();
            cropper = null;
        });

        $big_modal.on('shown.bs.modal', function () {
            big_cropper = new Cropper(big_image, {
                aspectRatio: 0.2458,
                viewMode: 1,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function () {
            big_cropper.destroy();
            big_cropper = null;
        });

        $pdf_modal.on('shown.bs.modal', function () {
            pdf_cropper = new Cropper(pdf_image, {
                aspectRatio: 0.2458,
                viewMode: 1,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function () {
            pdf_cropper.destroy();
            pdf_cropper = null;
        });

        $("#crop").click(function(){
            canvas = cropper.getCroppedCanvas({
                width: 240,
                height: 240,
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    console.log($('#upfile1'));
                    $('#upfile1').attr('src',base64data);
                    $('.product_image').val(base64data);
                    $modal.modal('hide');

                    // $.ajax({
                    //     type: "POST",
                    //     dataType: "json",
                    //     url: "image-cropper/upload",
                    //     data: {'_token': $('meta[name="_token"]').attr('content'), 'image': base64data},
                    //     success: function(data){
                    //         $modal.modal('hide');
                    //         alert("success upload image");
                    //     }
                    // });
                }
            });
        })

        $("#big_crop").click(function(){
            canvas = big_cropper.getCroppedCanvas({
                width: 1024,
                height: 1024,
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $('#upfile2').attr('src',base64data);
                    $('.big_product_image').val(base64data);
                    $big_modal.modal('hide');

                    // $.ajax({
                    //     type: "POST",
                    //     dataType: "json",
                    //     url: "image-cropper/upload",
                    //     data: {'_token': $('meta[name="_token"]').attr('content'), 'image': base64data},
                    //     success: function(data){
                    //         $modal.modal('hide');
                    //         alert("success upload image");
                    //     }
                    // });
                }
            });
        })

        $("#pdf_crop").click(function(){
            canvas = pdf_cropper.getCroppedCanvas({
                width: 1024,
                height: 1024,
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $('#upfile3').attr('src',base64data);
                    $('.pdf_product_image').val(base64data);
                    $pdf_modal.modal('hide');

                    // $.ajax({
                    //     type: "POST",
                    //     dataType: "json",
                    //     url: "image-cropper/upload",
                    //     data: {'_token': $('meta[name="_token"]').attr('content'), 'image': base64data},
                    //     success: function(data){
                    //         $modal.modal('hide');
                    //         alert("success upload image");
                    //     }
                    // });
                }
            });
        })

    </script>
@endsection
