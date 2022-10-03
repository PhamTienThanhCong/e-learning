@extends('template.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/seller/question_lesson.css') }}">
@stop

@section('title')
    Quản lý bài học {{ $my_lesson->name }}
@stop

@section('content')
    {{-- start preview bài học --}}
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Bài học: {{$my_lesson->name}}</h4>
            <iframe width="100%" height="450" src="{{ $my_lesson->link }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
