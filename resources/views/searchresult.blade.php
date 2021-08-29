@extends('layouts.appmain')

@section('content')


    <div id = "hiddenInput">
        @php
            foreach($filter as $key => $value){
               echo "<input type='hidden' value = '".$value."'  id = '".$key."'>";
            }
        @endphp
    </div>


    <div id = "rangeResult">
        @include('products.rangeSearch')
    </div>

    <script>
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

        $( document ).ready(function() {
            $(document).on('click', '.page-link', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                loadRangeSearch(page);
            });
        });

        function loadRangeSearch(page){

            var data = {};
            var tmp = $('#hiddenInput > input');
            for(let i = 0;i<tmp.length;i++){
                data[tmp[i].id] = tmp[i].value;
            }
            data["page"] = page;
            console.log(data);
            $.ajax({
                url:"/advancedAjaxResult",
                type: 'POST',
                data:data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    $('#rangeResult').html(data);

                }
            });
        }
    </script>
@endsection
