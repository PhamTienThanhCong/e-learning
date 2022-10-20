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
<link rel="stylesheet" href="{{ asset('css/user/rating.css') }}">
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
    @if ($check == 3)
        <form action="{{ route('home.ratingCourse',$courses->id) }}" method="POST" class="add-comment">
        <h3>Thêm bình luận</h3>
        @csrf
        <fieldset class="rating">
            <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
            <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
            <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
            <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
            <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
        </fieldset>
        <textarea name="comment" placeholder="Bình luận cua bạn" required maxlength="1000" cols="30" rows="10">{{ $my_order['comment'] }}</textarea>
        <input type="submit" value="add comment" class="inline-btn" name="add_comment">
        </form>
    @else
        <form action="#" method="GET" class="add-comment">
            <h3 style="text-align: center">Mua khóa học để đánh giá</h3>
        </form>
    @endif

    
 
    <h1 class="heading">Bình luận</h1>
 
    <div class="box-container">
       
       @foreach ($orders as $order)
         <div class="box">
             <span style="font-size: 16px; display:block; margin-bottom: 10px">{{ $order['created_at'] }}</span>
             <div class="user">
                 <img src="{{ asset("images/avatar") }}/{{ $order['avatar'] }}" alt="">
                 <div>
                 <h3>{{ $order['name_user'] }}</h3>
                 <span>
                    @for ($i = 0 ; $i < $order['rate'] ; $i++)
                        <i class="fa-solid fa-star" style="color: rgb(230, 83, 39);"></i>
                    @endfor
                 </span>
                </div>
            </div>
             <div class="comment-box">{{ $order['comment'] }}</div>
         </div>
        @endforeach
 
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
