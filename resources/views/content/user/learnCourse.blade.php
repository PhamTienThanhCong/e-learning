@extends('template.user')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/user/learn_course.css') }}">
    <style>
        #my-course {
            background-color: rgba(0, 0, 0, .2);
        }
    </style>
@stop

@section('title')
    {{ $lessons[$lesson_id]->name }}
@stop

@section('content')

<section class="watch-video">

    <div class="video-container">
       <div class="video">
        <iframe width="100%" height="500px" src="{{ $lessons[$lesson_id]->link }}" ></iframe>
          {{-- <video src="images/vid-1.mp4" controls poster="images/post-1-1.png" id="video"></video> --}}
       </div>
       <h3 class="title">Bài học: {{ $lessons[$lesson_id]->name }}</h3>
       <div class="info">
          <p class="date"><i class="fas fa-calendar"></i><span>22-10-2022</span></p>
          <p class="date"><i class="fas fa-heart"></i><span>44 likes</span></p>
       </div>
       <form action="" method="post" class="flex">
          <a href="{{ route('home.nextLesson',[$course_id,$lesson_id+1]) }}" class="inline-btn">Bài kế tiếp</a>
          <button type="button"><i class="far fa-heart"></i><span>like</span></button>
       </form>
       <p class="description">
        {{ $lessons[$lesson_id]->description }}
       </p>
    </div>
 
 </section>

 <section class="playlist-videos">

    <h1 class="heading">Các bài học của khóa học</h1>
 
    <div class="box-container">

        @for ($i = 0; $i < count($lessons); $i++)
            <a class="box" href="{{ route('home.learnCourse', [$course_id,$i+1]) }}">
                <i class="fas fa-play"></i>
                <img src="https://is1-ssl.mzstatic.com/image/thumb/Purple124/v4/5d/f8/1d/5df81d61-d288-a871-f749-1997811f8790/AppIcon-0-1x_U007emarketing-0-0-GLES2_U002c0-512MB-sRGB-0-0-0-85-220-0-0-0-10.png/1200x630wa.png" alt="">
                <h3>Bài {{$i + 1}}: {{ $lessons[$i]->name }}</h3>
            </a>
        @endfor
    </div>
 
 </section>

@stop

@section('js')
{{-- js here --}}
@stop
