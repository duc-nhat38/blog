@extends('homePage')
@section('title', 'Sửa bài viết')
@section('content')
<div class="form_input">
    <form action="{{ route('blogs.update', $blog->id) }}" method="post">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Tiêu đề :</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="title" rows="1" >{{ $blog->title }}</textarea>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Nội dung</label>
            <textarea class="form-control" id="ckeditor1" name="content" rows="1" >{{ $blog->content }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary mb-2">Sửa</button>
    </form>
</div>
@endsection