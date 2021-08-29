@extends('layouts.appmain')

@section('content')
    <input type="hidden" value = "{{$content}}" id = "content">
    <div id = "totalResult">
        @include('products.totalSearch')
    </div>

    <script>

        $( document ).ready(function() {
            $(document).on('click', '.page-link', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                loadTotalSearch(page);
            });
        });

        function loadTotalSearch(page){
            $.ajax({
                url:"/totalAjaxFind",
                type: 'POST',
                data:{
                    content: $('#content').val(),
                    page:page
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    $('#totalResult').html(data);

                }
            });
        }

        $(".ajax_cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            $.ajax({
                url: '{{ url('addToCart') }}',
                method: "POST",
                data: {id: ele.attr("data-id")},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    // console.log(response);
                    // window.location.reload();
                    $('#cart_dropdown_refresh').html(response);
                }
            });
        });
    </script>
@endsection
