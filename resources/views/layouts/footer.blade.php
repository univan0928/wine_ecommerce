<div class = "header-layout navbar-background mt-3">
    <div class = "row">
        <div class = "col-md-4 pr-0">
            <img class="footer-logo" src="../../images/Ellipse 1 copy 4.png">
            <p class ="text-white mb-0">株式会社徳岡が取り扱っているワイ</p>
            <p class ="text-white mb-0">ンをもとに、ワインのあるライフス</p>
            <p class ="text-white mb-0">タイルを提案する情報サイトです。</p>
        </div>
        <div class = "col-md-5 ">
            <p class ="text-white mb-3 mt-3">{{__('wine.menu')}}</p>
            <div class = "row">
                <div class = "col-6 pr-0">
                    <div>
                        <a href = "{{route('home')}}" class ="text-white mb-0">{{__('wine.Home')}}</a>
                    </div>
                    <div>
                        <a class ="text-white mb-0" href="{{ route('findWine') }}">{{__('wine.Fnd Wine')}}</a>
                    </div>
                    <div>
                        <a class ="text-white mb-0">{{__('wine.About Wine')}}</a>
                    </div>
                </div>
                <div class = "col-6">
                    <div>
                        <a class ="text-white mb-0" href="{{route('productRanking')}}>{{__('wine.Wine Raking')}}"></a>
                    </div>
                    <div>
                        <a class ="text-white mb-0" href="{{route('makerRanking')}}">{{__('wine.Producer Raking')}}</a>
                    </div>
                    <div>
                        <a class ="text-white mb-0" >{{__('wine.Contact Us')}}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class = "col-md-3">
            <p class ="text-white mb-3 mt-3">{{__('wine.Newsletter')}}</p>
            <div class="d-flex">
                <input class = "form-control mr-1" style = "width:60%">
                <div class = "but-newsletter p-1 d-flex align-items-center">{{__('wine.Send')}}</div>
            </div>
        </div>
    </div>
</div>
<div class = "header-layout footer-under p-3 d-flex justify-content-between">
    <p class="text-white m-0">
        Copyright © Tokuoka Co., Ltd. all right reserved
    </p>
    <div class="d-flex text-white">
        <div class="twitter mr-4"><i class="fa fa-twitter"></i></div>
        <div class="facebook "><i class="fa fa-facebook-f"></i></div>
        <div class="apple ml-4"><i class="fa fa-apple"></i></div>
    </div>
</div>
