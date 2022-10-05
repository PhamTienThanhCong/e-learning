@extends('template.user')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/user/my_account.css') }}">
    <style>
        #my-account{
            background-color: rgba(0, 0, 0, .2);
        }
    </style>
@stop

@section('title')
    Tài khoản của tôi
@stop

@section('content')
<section class="user-profile">

    <h1 class="heading">your profile</h1>
 
    <div class="info">
 
       <div class="user">
          <img src="{{ asset("images/avatar/" . Session::get('image')) }}" alt="">
          <h3>{{ Session::get('name') }}</h3>
          <p>student</p>
          <a href="#" class="inline-btn">update profile</a>
       </div>
    
       <div class="box-container">
    
          <div class="box">
             <div class="flex">
                <i class="fas fa-bookmark"></i>
                <div>
                   <span>{{ $user->number_buy }}</span>
                   <p>Đã mua</p>
                </div>
             </div>
             <a href="#" class="inline-btn">view playlists</a>
          </div>
    
          <div class="box">
             <div class="flex">
                <i class="fas fa-heart"></i>
                <div>
                   <span>33</span>
                   <p>Đã Thích</p>
                </div>
             </div>
             <a href="#" class="inline-btn">view liked</a>
          </div>
    
          <div class="box">
             <div class="flex">
                <i class="fas fa-comment"></i>
                <div>
                   <span>2</span>
                   <p>Hoàn thành</p>
                </div>
             </div>
             <a href="#" class="inline-btn">view comments</a>
          </div>
    
       </div>
    </div>
 
 </section>


@stop

@section('js')
@stop
