@extends('template.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/seller/my_account.css') }}">
@stop

@section('title')
    Quản lý Nhân viên
@stop

@section('content')

{{-- Show thonong tin tài khoản --}}
<div class="col-12 grid-margin stretch-card" id="change-my_account">
    <div class="card">
        <div class="card-body">
            @if(Session::has('error'))
                <h4 class="text-danger">{{ Session::get('error') }}</h4>
            @endif
            @if(Session::has('success'))
                <h4 class="text-success">{{ Session::get('success') }}</h4>
            @endif
            <p class="card-description"> Tài khoản của {{ $admin->name }} </p>
            <br>
            <div class="avatar-preview">
                <img width="100%" height="100%" src="{{ asset("images/avatar/".$admin->image) }}" alt="">
            </div>
            <div class="name-preview">
                <h3>
                    {{ $admin->name }}
                </h3>
            </div>
            <div class="infor-preview">
                <div class="email-preview">
                    <i class="mdi mdi-email-outline" style="font-size: 18px"></i>
                    Email: {{ $admin->email }}
                </div>
                <br>
                <div class="description-preview">
                    - Mô tả bản thân: {{ $admin->description }}
                    <br><br>
                    - Tổng thu nhập
                    {{ number_format($course->total_price, 0, '', ',') }} VND
                </div>
            </div>
            <div class="result-account">
                <div class="box-result"> 
                    <a href="{{ route('admin.managerCourse', $admin->name) }}" style="text-decoration: none; color: #343A40;">
                        <h1>
                            {{ $admin->number_courses }}
                        </h1>
                        <p>
                            khóa học
                        </p>
                    </a>
                </div>
                <div class="box-result"> 
                    <h1>
                        {{ $course->number_order }}
                    </h1>
                    <p>
                        đã bán
                    </p>
                </div>
                <div class="box-result"> 
                    <h1>
                        {{ round($course->number_rate,2) }}
                    </h1>
                    <p>
                        đánh giá
                    </p>
                </div>
            </div>
            <div class="change-info-btn">
                <button class="btn btn-gradient-info btn-fw" style="margin: auto;" onclick="contacts()">
                    Liên hệ ngay
                </button>
            </div>
        </div>
    </div>
</div>
{{-- Show thông tin tài khoản --}}

@stop

@section('js')
<script>
    function contacts(){
        alert('Nhân viên {{ $admin->name }} xin nghe')
    }
</script>
@stop
