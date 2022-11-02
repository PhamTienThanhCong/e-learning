@extends('template.admin')

@section('css')
    {{-- Css code --}}
@stop

@section('title')
    Khóa Học {{ $name_course }} Tạo Bài học mới
@stop

@section('content')

    {{-- Thêm khóa học --}}
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tạo bài học mới</h4>
                {{-- form accept up file --}}
                <form class="forms-sample" method="post" action="{{ route('seller.addLessonProcessing', $course) }} " enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1">Tên bài học</label>
                        <input type="text" name="name" class="form-control" id="inputNameLesson" placeholder="Nhập tên bài học">
                    </div>
                    <div class="form-group">
                        <label for="link-input">Video bài giảng</label>
                        <br>
                        <input name="video" style="border: none" type="file" required/>
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Mô tả bài học</label>
                        <textarea class="form-control" name="description" id="textareaLesson" rows="4"></textarea>
                    </div>

                    <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
    {{-- end Thêm khóa học --}}
@stop

@section('js')
    <script src="{{ asset('js/seller/create_lesson.js') }}"></script>
@stop
