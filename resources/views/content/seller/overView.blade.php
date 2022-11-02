@extends('template.admin')

@section('css')
    {{-- Css code --}}
@stop

@section('title')
    Tổng quan
@stop

@section('content')

    {{-- Bắt đầu cục tổng quan --}}
    <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="{{ asset('img/circle.svg') }}" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">Tổng thu nhập <i
                        class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">
                        {{ number_format($course->total_price, 0, '', ',') }} đ
                    </h2>
                    <h6 class="card-text">Tăng khoảng 5%</h6>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="{{ asset('img/circle.svg') }}" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">Khóa học đã bán<i
                            class="mdi mdi-cart-outline mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">{{ $course->number_order }} Khóa</h2>
                    <h6 class="card-text">Tăng khoảng 30%</h6>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                    <img src="{{ asset('img/circle.svg') }}" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">Đánh giá trung bình <i
                        class="mdi mdi-alert-outline mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">
                        {{ round($course->number_rate, 2) }} / 5
                    </h2>
                    <h6 class="card-text">Giảm khoảng 10%</h6>
                </div>
            </div>
        </div>
    </div>
    {{-- Kết thúc cục tổng quan --}}

@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="{{ asset('js/admin/chart_demo_seller.js') }}"></script>
@stop
