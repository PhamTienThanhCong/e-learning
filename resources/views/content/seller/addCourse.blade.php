@extends('template.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/seller/create_course.css') }}">
    <script src="https://cdn.tiny.cloud/1/qft0y7nd2fkpbh6iu02sd4mi8drr27xu3vdx2zvpjl2tjbxj/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@stop

@section('title')
    Thêm khóa học
@stop

@section('content')

    {{-- Nội dung --}}
    <div class="sale-box-all">
        <div class="sales-boxes">
            <div class="recent-sales box" style="width: 100%; display: block">
                <div class="page-title">Tạo khóa học mới</div>
                <form class="new-couse" method="post" action="{{ route('seller.addCourseProcessing') }}" enctype="multipart/form-data">
                    @csrf
                    <label for="">Tên của khóa học</label>
                    <input name="name" type="text" placeholder="Nhập tên của khóa học" onchange="changeTitle(event)" required/>
                    <br />
                    <label for="">Giá của khóa học</label>
                    <input name="price" type="number" placeholder="Nhập giá của khóa học" onchange="ChangePrice(event)" required/>
                    <br />
                    <label for="">Ảnh mô tả</label>
                    <input name="image" style="border: none" type="file" onchange="loadFile(event)" required/>
                    <br />
                    <textarea id="myTextarea"></textarea>
                    <textarea name="description" id="description-preview" style="display: none"></textarea>
                    <button id="btn" type="submit">Tạo khóa học mới</button>
                </form>
            </div>
        </div>
    </div>
    {{-- Nội Dung --}}
    @stop
    
@section('js')
    <script src="{{ asset('js/seller/create_course.js') }}"></script>
@stop
