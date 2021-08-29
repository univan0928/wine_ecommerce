@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>{{ trans('wine.users')}}</div>
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class = "form-group m-2 d-flex">
                                <label class = "w-100 mt-2">表示数:</label>
                                <select class = "form-control" onchange ="adminAjax()" id = "count",>
                                    <option value = "10" selected>10</option>
                                    <option value = "25" >25</option>
                                    <option value = "50" >50</option>
                                    <option value = "100" >100</option>
                                </select>
                            </div>
                            <div class="form-group m-2 d-flex">
                                <label for ="searchText" class = "w-25 mt-2">検索:</label>
                                <input type="text" class="form-control" oninput="adminAjax()" id ="searchText" name="searchText" placeholder="">
                            </div>
                        </div>
                        <br>
                        <div id = "resultCustomer">
                            @include('dashboard.admin.modal')
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <script type="text/javascript" src="{{ asset('js/app.js?v='.time()) }}"></script>
        <script>
            function adminAjax(page){
                console.log($('#sort').val());
                $.ajax({

                    url:"/admin/user/search",
                    type: 'POST',
                    data:{
                        searchText:$('#searchText').val(),
                        page:page,
                        count: $('#count').val(),
                        sort:$('#sort').val(),
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        $('#resultCustomer').html(data);
                    }
                });
            }


            $(document).on("click", "#customer_dialog", function () {
                var UserName = $(this).data('id');
                $(".modal-footer #user_name").val( UserName );
            });

            $(document).ready(function() {
                $(document).on('click', '.page-link', function(event){
                    event.preventDefault();
                    var page = $(this).attr('href').split('page=')[1];
                    adminAjax(page);
                });
                $(document).on('click', '.email', function(event){
                    event.preventDefault();
                    if($('#sort').val() == 1 || $('#sort').val() == -1) {
                        $('#sort').val(0);
                    }
                    else {
                        $('#sort').val(1);
                    }
                    adminAjax();
                });
            });
        </script>
@endsection


@section('javascript')

@endsection

