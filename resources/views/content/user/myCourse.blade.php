@extends('template.user')

@section('css')
    {{-- Css code --}}
    <style>
        #my-course {
            background-color: rgba(0, 0, 0, .2);
        }

    </style>
@stop

@section('title')
    Khóa học đã mua
@stop

@section('content')
    <section class="courses">
    <h1 class="heading">Khóa học đã mua</h1>
    @if (count($courses)>0)

     
        <div class="box-container">
            @foreach ($courses as $course)
                <div class="box">
                    <div class="tutor">
                        <img src="{{ asset("images/" . $course->image)}}" alt="">
                        <div class="info">
                            <h3>{{ $course->name_admin }}</h3>
                            <span>21-10-2022</span>
                        </div>
                    </div>
                    <div class="thumb">
                        <img src="{{ asset("images/" . $course->image) }}" alt="">
                        <span>{{ $course->number_lesson }} videos</span>
                    </div>
                    <h3 class="title">{{ $course->name }}</h3>
                    <a href="{{ route('home.viewCourse', $course->id) }}" class="inline-btn">xem khóa học</a>
                </div>
            @endforeach
        </div>     
        {{ $courses->links() }}
        @else
        <h1 style="font-size: 24px">
            Bạn Chưa mua khóa học nào cả, Mua ngay
            <a href="{{ route('home.course') }}">Tại đây</a>
        </h1>
        @endif
    </section>
    
@stop

@section('js')
@stop
