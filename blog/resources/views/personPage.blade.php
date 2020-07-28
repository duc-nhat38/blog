@extends('homePage')
@section('title', 'Trang cá nhân')
@section('content')
<div class="btn btn-light" id="hidden" onclick="document.getElementById('hidden').style.display = 'none';
document.getElementById('form_input').style.display = 'block'">
    <span>Bạn muốn viết gì ?</span>
</div>
<div class="form_input" id="form_input" style="display: none">
    <form action="{{ route('blogs.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Tiêu đề :</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="title" rows="1"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Nội dung</label>
            <textarea class="form-control" id="ckeditor1" name="content" rows="1"></textarea>
        </div>
        <div class="form_input_submit">
            <p class="btn btn-primary mb-2" onclick="document.getElementById('hidden').style.display = 'block';
            document.getElementById('form_input').style.display = 'none'">Đóng</p>
            <button type="submit" class="btn btn-primary mb-2">Đăng ngay</button>
        </div>
    </form>
</div>
@forelse ($array as $item)

<div class="posts">
    <span><b><a href="#####">{{ Auth::user()->name }}</a></b></span>
    <small class="ml-5"><span class="font-weight-light">Ngày đăng :
            {{ $item->updated_at ??  $item->created_at  }}</span></small><br>
    <a href="{{ route('blogs.show', $item->id) }}"><span>{{ $item->title }}</span></a>
    <div class="edit-del">
        <a href="{{ route('blogs.edit', $item->id) }}" class="btn btn-link" title="Sửa"><i class="far fa-edit"></i></a>

        <a href="#" class="btn btn-link" title="Xóa" onclick="confirm('Bạn muốn xóa ?');event.preventDefault();
            document.getElementById('destroy-form').submit();">
            <i class="far fa-trash-alt"></i></a>
        <form id="destroy-form" action="{{ route('blogs.destroy', $item->id) }}" method="POST" style="display: none;">
            @method('DELETE')
            @csrf
        </form>
    </div>
</div>

@empty
<div class="posts">
    <span>Bạn chưa đăng gì.</span>
    <span class="btn btn-link" onclick="document.getElementById('hidden').style.display = 'none';
    document.getElementById('form_input').style.display = 'block'">Đăng ngay</span>
</div>
@endforelse
@endsection