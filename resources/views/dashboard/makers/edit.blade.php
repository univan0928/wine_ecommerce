@extends('dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> {{ __('wine.edit') }}: {{ $maker->foreign_maker_id }}</div>
                        <div class="card-body">
                            <form method="POST" action="/admin/makers/{{ $maker->foreign_maker_id }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.code winery')}}</label>
                                        <input id = "foreign_maker_id" class="form-control" type="text" placeholder="" name="foreign_maker_id" value="{{ $maker->foreign_maker_id }}" autofocus>
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.jp winery')}}(half)</label>
                                        <input  id = "jp_name" class="form-control" type="text" placeholder="" name="jp_name" value="{{ $maker->jp_name }}" >
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.en winery')}}</label>
                                        <input  id = "en_name" class="form-control" type="text" placeholder="" name="en_name" value="{{ $maker->en_name }}" >
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.E-Mail Address')}}</label>
                                        <input  id = "maker_email" class="form-control" type="text" placeholder="" name="maker_email" value="{{ $maker->maker_email }}" >
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.address')}}</label>
                                        <input  id = "maker_address" class="form-control" type="text" placeholder="" name="maker_address" value="{{ $maker->maker_address }}" >
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.fax')}}</label>
                                        <input  id = "maker_fax" class="form-control" type="text" placeholder="" name="maker_fax" value="{{ $maker->maker_fax }}" >
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.tel')}}</label>
                                        <input  id = "maker_phone" class="form-control" type="text" placeholder="" name="maker_phone" value="{{ $maker->maker_phone }}" >
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('URL')}}</label>
                                        <input  id = "maker_url" class="form-control" type="text" placeholder="" name="maker_url" value="{{ $maker->maker_url }}" >
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.country list')}}</label>
{{--                                    <input class="form-control" type="text" placeholder="" name="country" value="{{ $maker->maker_country }}">--}}
                                        <select class="form-control" name="country">
                                            <option value =""></option>
                                            @foreach($country as $row)
                                                @if($maker->maker_country == $row->country_en_name)
                                                    <option value={{$row->country_en_name}} selected>{{$row->country_jp_name}}</option>
                                                @else <option value={{$row->country_en_name}} >{{$row->country_jp_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.comment')}}</label>
                                        <textarea rows = "4" cols = "50" class="form-control" name="maker_description" style="padding: 0px !important; margin: 0px !important;text-align: left;">
                                            {{ $maker->maker_description }}
                                        </textarea>
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.Area name')}}</label>
                                        <input  id = "maker_region" class="form-control" type="text" placeholder="" name="maker_region" value="{{ $maker->maker_region }}" >
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label>{{__('wine.Rating')}}</label>
                                        <input  id = "maker_rating" class="form-control" type="text" placeholder="" name="maker_rating" value="{{ $maker->maker_rating }}" >
                                    </div>
{{--                                    <div class="col-md-6 mb-1">--}}
{{--                                        <h5>{{__('wine.Upload maker image(pdf)')}}</h5>--}}
{{--                                        @if(isset($maker->pdf_maker_name)&&$maker->pdf_maker_name!='')--}}
{{--                                            <img src="{{asset("images/maker/".$maker->pdf_maker_name)}}" id="upfile1" style="border:6px solid #e6d2d2; cursor:pointer;height:122px;width:106px" />--}}
{{--                                        @else--}}
{{--                                            <img src="{{asset("images/maker/default.png")}}" id="upfile1" style="border:6px solid #e6d2d2; cursor:pointer;height:122px;width:106px" />--}}
{{--                                        @endif--}}

                                        <input type="file" style = "display: none" name="image" class="image">
                                        <input type = "hidden" name = "pdf_maker_image" class = "pdf_maker_image">
                                        <input type = "hidden" name = "pdf_maker_name" value = {{$maker->pdf_maker_name}}>
{{--                                    </div>--}}

                                    <div class="col-md-6 mb-1">
                                        <h5>{{__('ワイナリー画像（人物）')}}</h5>
                                        @if(isset($maker->maker_name)&&$maker->maker_name!='')
                                            <img src="{{asset("images/detailmaker/".$maker->maker_name)}}" id="upfile2" style="border:6px solid #e6d2d2; cursor:pointer;height:136px;width:210px" />
                                        @else
                                            <img src="{{asset("images/detailmaker/default.png")}}" id="upfile2" style="border:6px solid #e6d2d2; cursor:pointer;height:136px;width:210px" />
                                        @endif

                                        <input type="file" style = "display: none" name="detail_image" class="detail_image">
                                        <input type = "hidden" name = "maker_image" class = "maker_image">
                                        <input type = "hidden" name = "maker_name" value = {{$maker->maker_name}}>
                                    </div>

                                    <div class="col-md-6 mb-1">
                                        <h5>{{__('ワイナリー画像（風景）')}}</h5>
                                        @if(isset($maker->maker_place)&&$maker->maker_place!='')
                                                <img src="{{asset("images/places/".$maker->maker_place)}}" id="upfile3" style="border:6px solid #e6d2d2; cursor:pointer;height:136px;width:210px" />
                                        @else
                                            <img src="{{asset("images/places/place.png")}}" id="upfile3" style="border:6px solid #e6d2d2; cursor:pointer;height:136px;width:210px" />
                                        @endif

                                        <input type="file" style = "display: none" name="place_image" class="place_image">
                                        <input type = "hidden" name = "maker_place_image" class = "maker_place_image">
                                        <input type = "hidden" name = "maker_place_name" value = {{$maker->maker_place}}>
                                    </div>

                                    <div class="col-md-6 mb-1">
                                        <h5>{{__('ワイナリー画像（城）')}}</h5>
                                        @if(isset($maker->pdf_maker_place)&&$maker->pdf_maker_place!='')
                                            <img src="{{asset("images/thumbplaces/".$maker->pdf_maker_place)}}" id="upfile4" style="border:6px solid #e6d2d2; cursor:pointer;height:100px;width:210px" />
                                        @else
                                            <img src="{{asset("images/thumbplaces/default_large.png")}}" id="upfile4" style="border:6px solid #e6d2d2; cursor:pointer;height:100px;width:210px" />
                                        @endif

                                        <input type="file" style = "display: none" name="pdf_image" class="pdf_image">
                                        <input type = "hidden" name = "maker_pdf_image" class = "maker_pdf_image">
                                        <input type = "hidden" name = "maker_pdf_name" value = {{$maker->pdf_maker_place}}>
                                    </div>
                                    <div class = "col-md-6 mb-1"></div>

                                    <div class="col-md-6 mb-1">
                                        <h5>{{__('ワイナリー画像（風景2）')}}</h5>
                                        @if(isset($maker->maker_place_2)&&$maker->maker_place_2!='')
                                            <img src="{{asset("images/places_2/".$maker->maker_place_2)}}" id="upfile5" style="border:6px solid #e6d2d2; cursor:pointer;height:136px;width:210px" />
                                        @else
                                            <img src="{{asset("images/places_2/place.png")}}" id="upfile5" style="border:6px solid #e6d2d2; cursor:pointer;height:136px;width:210px" />
                                        @endif

                                        <input type="file" style = "display: none" name="place_image_2" class="place_image_2">
                                        <input type = "hidden" name = "maker_place_image_2" class = "maker_place_image_2">
                                        <input type = "hidden" name = "maker_place_name_2" value = {{$maker->maker_place_2}}>
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <h5>{{__('ワイナリー画像（風景3）')}}</h5>
                                        @if(isset($maker->maker_place_3)&&$maker->maker_place_3!='')
                                            <img src="{{asset("images/places_3/".$maker->maker_place_3)}}" id="upfile6" style="border:6px solid #e6d2d2; cursor:pointer;height:136px;width:210px" />
                                        @else
                                            <img src="{{asset("images/places_3/place.png")}}" id="upfile6" style="border:6px solid #e6d2d2; cursor:pointer;height:136px;width:210px" />
                                        @endif

                                        <input type="file" style = "display: none" name="place_image_3" class="place_image_3">
                                        <input type = "hidden" name = "maker_place_image_3" class = "maker_place_image_3">
                                        <input type = "hidden" name = "maker_place_name_3" value = {{$maker->maker_place_3}}>
                                    </div>
                                </div>

                                <button class="btn btn-block btn-success" type="submit">{{ __('wine.save') }}</button>
                                <a href="{{ route('makers.index') }}" class="btn btn-block btn-primary">{{ __('wine.return') }}</a>
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

    <div class="modal fade" id="detail_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
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
                                <img id="detail_image" src="https://avatars0.githubusercontent.com/u/3456749">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('wine.return')}}</button>
                    <button type="button" class="btn btn-primary" id="detail_crop">{{__('wine.crop')}}</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="place_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
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
                                <img id="place_image" src="https://avatars0.githubusercontent.com/u/3456749">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('wine.return')}}</button>
                    <button type="button" class="btn btn-primary" id="place_crop">{{__('wine.crop')}}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="place_modal_2" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
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
                                <img id="place_image_2" src="https://avatars0.githubusercontent.com/u/3456749">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('wine.return')}}</button>
                    <button type="button" class="btn btn-primary" id="place_crop_2">{{__('wine.crop')}}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="place_modal_3" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
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
                                <img id="place_image_3" src="https://avatars0.githubusercontent.com/u/3456749">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('wine.return')}}</button>
                    <button type="button" class="btn btn-primary" id="place_crop_3">{{__('wine.crop')}}</button>
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
@endsection

@section('javascript')
    <script>


        var $modal = $('#modal');

        var $detail_modal = $('#detail_modal');
        var $place_modal = $('#place_modal');
        var $place_modal_2 = $('#place_modal_2');
        var $place_modal_3 = $('#place_modal_3');
        var $pdf_modal = $('#pdf_modal');
        var image = document.getElementById('image');
        var detail_image = document.getElementById('detail_image');
        var place_image = document.getElementById('place_image');
        var place_image_2 = document.getElementById('place_image_2');
        var place_image_3 = document.getElementById('place_image_3');
        var pdf_image = document.getElementById('pdf_image');
        var cropper;
        var detail_cropper;
        var place_cropper;
        var place_cropper_2;
        var place_cropper_3;
        var pdf_cropper;
        $("#upfile1").click(function () {
            $(".image").trigger('click');
        });
        $("#upfile2").click(function () {
            $(".detail_image").trigger('click');
        });

        $("#upfile3").click(function () {
            $(".place_image").trigger('click');
        });
        $("#upfile4").click(function () {
            $(".pdf_image").trigger('click');
        });
        $("#upfile5").click(function () {
            $(".place_image_2").trigger('click');
        });
        $("#upfile6").click(function () {
            $(".place_image_3").trigger('click');
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

        $("body").on("change", ".detail_image", function(e){
            var files = e.target.files;
            var done = function (url) {
                detail_image.src = url;
                $detail_modal.modal('show');
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
        $("body").on("change", ".place_image", function(e){
            var files = e.target.files;
            var done = function (url) {
                place_image.src = url;
                $place_modal.modal('show');
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

        $("body").on("change", ".place_image_2", function(e){
            var files = e.target.files;
            var done = function (url) {
                place_image_2.src = url;
                $place_modal_2.modal('show');
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

        $("body").on("change", ".place_image_3", function(e){
            var files = e.target.files;
            var done = function (url) {
                place_image_3.src = url;
                $place_modal_3.modal('show');
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

        $modal.on('shown.bs.modal', function () {
            cropper = new Cropper(image, {
                aspectRatio: 0.87,
                viewMode: 1,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function () {
            cropper.destroy();
            cropper = null;
        });
        $detail_modal.on('shown.bs.modal', function () {
            detail_cropper = new Cropper(detail_image, {
                aspectRatio: 1.544,
                viewMode: 1,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function () {
            detail_cropper.destroy();
            detail_cropper = null;
        });

        $place_modal.on('shown.bs.modal', function () {
            place_cropper = new Cropper(place_image, {
                aspectRatio: 1.544,
                viewMode: 1,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function () {
            place_cropper.destroy();
            place_cropper = null;
        });

        $place_modal_2.on('shown.bs.modal', function () {
            place_cropper_2 = new Cropper(place_image_2, {
                aspectRatio: 1.544,
                viewMode: 1,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function () {
            place_cropper_2.destroy();
            place_cropper_2 = null;
        });

        $place_modal_3.on('shown.bs.modal', function () {
            place_cropper_3 = new Cropper(place_image_3, {
                aspectRatio: 1.544,
                viewMode: 1,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function () {
            place_cropper_3.destroy();
            place_cropper_3 = null;
        });

        $pdf_modal.on('shown.bs.modal', function () {
            pdf_cropper = new Cropper(pdf_image, {
                aspectRatio: 2.2468,
                viewMode: 1,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function () {
            pdf_cropper.destroy();
            pdf_cropper = null;
        });

        $("#crop").click(function(){
            canvas = cropper.getCroppedCanvas({
                width: 488,
                height: 488,
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    console.log($('#upfile1'));
                    $('#upfile1').attr('src',base64data);
                    $('.pdf_maker_image').val(base64data);
                    $modal.modal('hide');
                }
            });
        })

        $("#detail_crop").click(function(){
            canvas = detail_cropper.getCroppedCanvas({
                width: 210,
                height: 210,
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    console.log($('#upfile1'));
                    $('#upfile2').attr('src',base64data);
                    $('.maker_image').val(base64data);
                    $detail_modal.modal('hide');
                }
            });
        })

        $("#place_crop").click(function(){
            canvas = place_cropper.getCroppedCanvas({
                width: 210,
                height: 210,
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    console.log($('#upfile1'));
                    $('#upfile3').attr('src',base64data);
                    $('.maker_place_image').val(base64data);
                    $place_modal.modal('hide');
                }
            });
        })

        $("#place_crop_2").click(function(){
            canvas = place_cropper_2.getCroppedCanvas({
                width: 210,
                height: 210,
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    console.log($('#upfile1'));
                    $('#upfile5').attr('src',base64data);
                    $('.maker_place_image_2').val(base64data);
                    $place_modal_2.modal('hide');
                }
            });
        })

        $("#place_crop_3").click(function(){
            canvas = place_cropper_3.getCroppedCanvas({
                width: 210,
                height: 210,
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    console.log($('#upfile1'));
                    $('#upfile6').attr('src',base64data);
                    $('.maker_place_image_3').val(base64data);
                    $place_modal_3.modal('hide');
                }
            });
        })

        $("#pdf_crop").click(function(){
            canvas = pdf_cropper.getCroppedCanvas({
                width: 879,
                height: 879,
                // width: 1757,
                // height: 1757,
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;

                    $('#upfile4').attr('src',base64data);
                    $('.maker_pdf_image').val(base64data);
                    $pdf_modal.modal('hide');
                }
            });


            canvas = pdf_cropper.getCroppedCanvas({
                width: 136,
                height: 136,
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    console.log($('#upfile1'));
                    $('#upfile4').attr('src',base64data);
                    $('.pdf_maker_image').val(base64data);

                }
            });
        })
    </script>
@endsection
