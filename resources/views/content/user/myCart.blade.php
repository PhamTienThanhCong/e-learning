@extends('template.user')

@section('css')
    {{-- Css code --}}
    <style>
        .page{
            font-size: 18px;
            margin-bottom: 20px;
        }
        #table_gio_hang{
            width: 100%;
            border-collapse: collapse;
        }
        #table_gio_hang, tr, td, th{
            border: 1px solid #ccc;
            padding: 10px;
        }
    </style>
@stop

@section('title')
    Giỏ hàng của tôi
@stop

@section('content')

<section class="watch-video">
    <div class="video-container">
        <div class="video">

        <h3 class="title">Giỏ hàng của bạn</h3>
        <div class="info">
           <p class="date"><i class="fas fa-calendar"></i><span>22-10-2022</span></p>
           <p class="date"><i class="fas fa-heart"></i><span>44 likes</span></p>
        </div>
        <div class="page">
            <div class="content">
            </div>
            @if (Session::has('id_course'))
            <table id="table_gio_hang">
                <tr class="header-table">
                    <th>#</th>
                    <th class="header_ten"> Tên </th>
                    <th class="header_tacgia"> Tác Giả </th>

                    <th class="header_gia"> Giá </th>
                    <th class="header_tuong_tac"> Huỷ</th>
                </tr>
                @php
                    $total = 0;
                @endphp
                @for ($i = 0; $i < count(Session::get('id_course')); $i++)
                    <tr>
                        <th> {{ $i + 1 }} </th>
                        <th> 
                            <a style="color: black; text-decoration: none" href="{{ route('home.viewCourse', Session::get('id_course')[$i]) }}">{{ Session::get('name_course')[$i] }}</a>
                        </th>
                        <th> {{ Session::get('author_course')[$i] }} </th>
                        <th> {{ number_format(Session::get('price_course')[$i], 0, ',', ' ') }} VND</th>
                        <th><a href="{{ route('home.unOrderCourse', Session::get('id_course')[$i]) }}">xoá</a></th>
                    </tr>
                    @php
                        $total += Session::get('price_course')[$i];
                    @endphp
                @endfor
            </table>
            <br>
            <h3>Tổng tiền: <span id="price-total">{{ number_format($total, 0, ',', ' ') }}</span>VND</h3>   
            @else
                <div class="content_mid_table">
                    <p>Bạn ơi giỏ hàng của bạn đang trống kìa hãy lụm thêm vài sản phẩm vào nào !!!</p>
                    <p>Bạn có thể xem sản phẩm <a href="{{ route('home.course') }}">Tại đây</a> </p>
                </div>
            @endif
        </div>
        <form class="flex" id="mua" method="post" action="{{ route('home.buyCourse') }}">
           @csrf
           <input name="id-buy" id="id-buy" type="hidden">
                <button id="btn-buy"
                @if (!Session::has('id'))
                    type="button" onclick="alert('Ban Phai Dang Nhap')"
                    style="cursor: not-allowed"
                @else
                    type="submit"
                @endif
            ><span>Mua khóa học</span></button>
        </form>
        <p class="description">

        </p>
     </div>
</section>
@stop

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    let id = [
        @if (Session::has('id_course'))
            @for ($i = 0; $i < count(Session::get('id_course')); $i++)
                {{ Session::get('id_course')[$i] }},
            @endfor
        @endif
    ];
    // Lưu id vào input
    $(document).ready(function () {
        document.getElementById("id-buy").value = id;
    });
</script>
@stop
