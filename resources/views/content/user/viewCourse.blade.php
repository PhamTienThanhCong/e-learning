@extends('template.user')

@section('css')
{{-- css ở đây  --}}
<style>
    .btn-action-course {
        margin-bottom: 10px;
    }
    .description-course{
        background: white;
        padding: 10px;
    }
</style>
@stop

@section('title')
    {{ $courses->name }}
@stop

@section('content')

<section class="playlist-details">

    <h1 class="heading">{{ $courses->name }}</h1>
 
    <div class="row">
 
       <div class="column">

        @if ($check == 1)
            <a class="save-playlist" href="{{ route('home.orderCourse', $courses->id) }}">
                <button class="btn-action-course">
                    <span>
                        Đặt khóa học 
                    </span>
                    <i class="fa-solid fa-cart-plus"></i>
                </button>
            </a>
        @elseif ($check == 2)
            <a class="save-playlist" href="{{ route('home.myCart') }}">
                <button class="btn-action-course">
                    <span>
                        Mua khóa học
                    </span>
                    <i class="fa-solid fa-cart-plus"></i>
                </button>
            </a>
        @elseif ($check == 3)
            <a class="save-playlist" href="{{ route('home.learnCourse', [$courses->id,1]) }}">
                <button class="btn-action-course">
                    <span>
                        Học khóa học
                    </span>
                    <i class="fa-solid fa-tv"></i>
                </button>
            </a>
        @endif

          {{-- <form action="" method="post" class="save-playlist">
             <button type="submit"><i class="far fa-bookmark"></i> <span>save playlist</span></button>
          </form> --}}
    
          <div class="thumb">
             <img src="{{ asset("images/" . $courses->image) }}" alt="">
             <span>{{ $courses->number_lesson }} videos</span>
          </div>
       </div>
       <div class="column">
          <div class="tutor">
             <img src="{{ asset("images/avatar/" . $courses->avatar) }}" alt="">
             <div>
                <h3>{{ $courses->name_admin }}</h3>
                <span>21-10-2022</span>
             </div>
          </div>
    
          <div class="details">
             <h3>{{ $courses->name }}</h3>
             <p style="padding: 0.6rem 0">
                <i class="fa-solid fa-person-chalkboard"></i>
                Số lượng bài học: {{ $courses->number_lesson }} bài
            </p>
            <p style="padding: 0.6rem 0">
                <i class="fa-solid fa-money-bill-1-wave"></i>
                Giá tiền: {{ $courses->price }} VND
            </p>
            <p style="padding: 0.6rem 0">
                <i class="fa-solid fa-pen-to-square"></i>
                Ngày Tạo: {{ date('d-m-Y', strtotime($courses->created_at)) }}
            </p>
            <p style="padding: 0.6rem 0">
                <i class="fa-solid fa-pen-to-square"></i>
                Cập nhập lần cuối: {{ date('d-m-Y', strtotime($courses->updated_at)) }}
            </p>
            <p style="padding: 0.6rem 0">
                <i class="fa-solid fa-user-pen"></i>
                Đánh giá: 4.7 <i class="fa-solid fa-star" style="color: rgb(230, 83, 39);"></i>

            </p>
          </div>
       </div>
    </div>
 
 </section>
 
 <section class="playlist-videos">

    <h1 class="heading">Mô tả cái nhẹ</h1>
 
    <div class="description-course" style="font-size: 16px">
        {!! $courses->description !!}
    </div>

 </section>

 <section class="playlist-videos">

    <h1 class="heading">Các bài học của khóa học</h1>
 
    @if ($check != 3)
        <div class="description-course" style="font-size: 16px">
            <ol style="margin-left: 25px">
                @foreach ($lessons as $index => $lesson)
                    <li style="font-size: 20px; margin-top: 10px">
                        {{ $lesson->name }}
                    </li>
                @endforeach
            </ol>
        </div>
    @else
    <div class="box-container">

        @foreach ($lessons as $index => $lesson)
            <a class="box" href="{{ route('home.learnCourse',[$courses->id, $index + 1]) }}">
                <i class="fas fa-play"></i>
                <img src="{{ asset("images/" . $courses->image) }}" alt="">
                <h3>Bài {{ $index+1 }} - {{ $lesson->name }}</h3>
            </a>
        @endforeach
    </div>
 
    @endif
 </section>

 <section class="comments">

    <h1 class="heading">4 Bình luận</h1>
 
    <form action="#" method="GET" class="add-comment">
       <h3>Thêm bình luận</h3>
       <textarea name="comment_box" placeholder="Bình luận cua bạn" required maxlength="1000" cols="30" rows="10"></textarea>
       <input type="buttom" value="add comment" class="inline-btn" name="add_comment">
    </form>
 
    <h1 class="heading">Bình luận</h1>
 
    <div class="box-container">
 
       <div class="box">
          <div class="user">
             <img src="{{ asset("images/avatar/avatar.png") }}" alt="">
             <div>
                <h3>Đặng Hồng Hạnh</h3>
                <span>05-10-2022</span>
             </div>
          </div>
          <div class="comment-box">Em nhớ anh :(</div>
       </div>

         <div class="box">
             <div class="user">
                 <img src="{{ asset("images/avatar/avatar.png") }}" alt="">
                 <div>
                 <h3>Nguyễn Thị Lệ</h3>
                 <span>05-10-2022</span>
                 </div>
             </div>
             <div class="comment-box">Bài học hay</div>
         </div>
         <div class="box">
            <div class="user">
                <img src="{{ asset("images/avatar/avatar.png") }}" alt="">
                <div>
                <h3>Ngô van Phong</h3>
                <span>05-10-2022</span>
                </div>
            </div>
            <div class="comment-box">Đáng để thử</div>
        </div>

        <div class="box">
            <div class="user">
                <img src="{{ asset("images/avatar/avatar.png") }}" alt="">
                <div>
                <h3>Hậu</h3>
                <span>05-10-2022</span>
                </div>
            </div>
            <div class="comment-box">Hay</div>
        </div>
 
    </div>
 
 </section>

@stop

@section('js')
<script>
    @if ($my_order != null)
        document.getElementById("star{{ $my_order->rate }}").checked = true;
    @endif
</script>
@stop
