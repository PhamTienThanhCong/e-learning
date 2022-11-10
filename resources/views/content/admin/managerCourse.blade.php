@extends('template.admin')

@section('css')
    {{-- Css code --}}
@stop

@section('title')
    Quản lý khóa học
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <form class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="height: 100%">Tìm kiếm theo tên</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Tìm kiếm theo tên..." aria-label="Username"
                        aria-describedby="basic-addon1" name='search' value="{{ $search }}">
                    <div class="input-group-append">
                        <button class="btn btn-sm btn-gradient-primary" style="height: 100%" type="submit">Search</button>
                    </div>
                </div>
            </form>
            @if (Session::get('lever') == '1')
                <h4 class="card-title">Khóa học của tôi: {{ $data->total() }} Khóa</h4>
            @else
                <h4 class="card-title">Tất cả khóa học: {{ $data->total() }} Khóa</h4>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th> Tên khóa </th>
                        <th> Giá </th>
                        <th> Tác giả </th>
                        <th> Đã bán </th>
                        <th> Cập nhập lần cuối </th>
                        <th> Xem </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $course)
                        <tr>
                            <td> {{ $course->name }} </td>
                            <td> {{ number_format($course->price, 0, '', ',') }} VND</td> 
                            <th>
                                {{ $course->name_admin }} 
                            </th>                                                                                                        
                            <td>
                                {{ $course->number_buy }}
                            </td>
                            <td>
                                {{ date('d-m-Y', strtotime($course->updated_at)) }}
                            </td>
                            <th>
                                @if (Session::get('lever') == '1')
                                    <a href="{{ route('seller.detailCourse', $course->id) }}">Xem </a>
                                @else
                                    <a href="{{ route('admin.mamagerDetailCourses', [$course->name_admin, $course->id]) }}">Xem </a> 
                                @endif
                            </th>
                        </tr> 
                    @endforeach

                </tbody>
            </table>
            <br>
            {{ $data->links() }}
        </div>
    </div>
    
@stop

@section('js')
    {{-- js code --}}
@stop