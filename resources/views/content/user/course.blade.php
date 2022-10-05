@extends('template.user')

@section('css')
    {{-- Css code --}}
@stop

@section('title')
    Khóa học
@stop

@section('content')
    <section class="courses">

        <h1 class="heading">Khóa học</h1>
     
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
                    <a href="{{ route('home.viewCourse', $course->id) }}" class="inline-btn">view playlist</a>
                </div>
            @endforeach
        </div>     
        {{ $courses->links() }}
     </section>
@stop

@section('js')
@stop
