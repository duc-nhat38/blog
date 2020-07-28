@extends('homePage')

@section('title', 'Đổi mật khẩu')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Đổi Mật Khẩu</div>

                <div class="card-body">
                    <form id="form-change-password" role="form" method="POST" action="{{ route('blog.changePassword') }}"
                        novalidate class="form-horizontal">
                        @method('PATCH')
                        <div class="col-md-9">
                            <label for="current-password" class="col-sm-4 control-label">Mật khẩu cũ</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="password" class="form-control" id="current-password"
                                        name="current-password" placeholder="Nhập mật khẩu cũ">
                                </div>
                            </div>
                            <label for="password" class="col-sm-4 control-label">Mật khẩu mới</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Nhập mật khẩu mới">
                                </div>
                            </div>
                            <label for="password_confirmation" class="col-sm-4 control-label">Nhập lại mật khẩu</label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" placeholder="Nhập lại mật khẩu mới">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-5 col-sm-6">
                                <button type="submit" class="btn btn-primary">Xác nhận</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection