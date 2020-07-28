@extends('homepage')

@section('title', '')

@section('content')
<div class="detail_post">
    <div class="poster_information">
        <span><b><a href="#####">{{ $array[0]->name }}</a></b></span>
        <small class="ml-5"><span class="font-weight-light">Ngày đăng :
                {{ $array[0]->updated_at ??  $array[0]->created_at  }}</span></small>
    </div>
    <div class="post_content">
        <h3>{{ $array[0]->title }}</h3>
        <span>{!! $array[0]->content !!}</span>
    </div>
</div>
@endsection

@push('info-index')
    <script>
        toastr["success"]("Update thành công")
    </script>
@endpush