@extends('template.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/seller/question_lesson.css') }}">
    <style>
        #video {
            width: 100%;
            height: 100%;
        }
    </style>
@stop

@section('title')
    Quản lý bài học {{ $my_lesson->name }}
@stop

@section('content')
    {{-- start preview bài học --}}
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Bài học: {{$my_lesson->name}}</h4>
            <video src="{{ asset('videos/') }}/{{ $my_lesson->link }}" controls poster="images/post-1-1.png" id="video"></video>
            <p>
                Mô tả: <br>
                {{ $my_lesson->description }} 
            </p>
        </div>
    </div>
    {{-- end preview bài học --}}

@stop

@section('js')
   
@stop
