@extends('homePage')

@section('content')

@forelse ($array as $item)
    <div class="posts">
        <span><b><a href="#####">{{ $item->name }}</a></b></span>
        <small class="ml-5"><span class="font-weight-light">Ngày đăng :
                {{ $item->created_at }}</span></small><br>
        <a href="{{ route('blogs.show', $item->id) }}">{{ $item->title }}</a>
    </div>
@empty
<p>Không có gì</p>
@endforelse
@endsection