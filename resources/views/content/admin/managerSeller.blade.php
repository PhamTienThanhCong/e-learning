@extends('template.admin')

@section('css')
    {{-- Css code --}}
@stop

@section('title')
    Quản lý Nhân viên
@stop

@section('content')

    {{-- Bảng Nhân Viên --}}
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Danh sách nhân viên: {{ $data->total() }} nhân viên</h4>
            <br>
            <form class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="height: 100%">Tìm kiếm theo tên</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username"
                        aria-describedby="basic-addon1" name='search' value="{{ $search }}">
                    <div class="input-group-append">
                        <button class="btn btn-sm btn-gradient-primary" style="height: 100%" type="submit">Search</button>
                    </div>
                </div>
            </form>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th> Avatar </th>
                        <th> Name </th>
                        <th> Khóa học </th>
                        <th> Ngày ra nhập </th>
                        <th> Xem </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $admin)
                        <tr>
                            <td class="py-1">
                                {{-- <img src="{{ asset('img/profile.jpg') }}" alt="image"> --}}
                                <img src="{{ asset("images/avatar/".$admin->image) }}" style="object-fit: cover;object-position: center;" alt="image">
                            </td>
                            <td> {{ $admin->name }} </td>
                            <td> 
                                <a href="{{ route('admin.managerCourse', $admin->name) }}">
                                    {{ $admin->number - 1 }} khóa
                                </a>
                            </td>
                            <td> {{ date('d-m-Y', strtotime($admin->created_at)) }} </td>
                            <td>
                                <a href="{{ route('admin.viewSeller', $admin->id) }}">
                                    Xem
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            {{ $data->links() }}
        </div>
    </div>
    {{-- Kết thúc bảng nhân viên --}}


@stop

@section('js')
@stop
