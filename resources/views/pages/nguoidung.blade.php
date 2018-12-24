@section('title')
    Quản lý Thông tin Người Dùng
@endsection

 @extends('layout.index')
 @section('content')   
<!-- Page Content -->
<script src="admin_asset/dist/js/extra.js"></script>
<!-- Page Content -->
<div class="container">

    <!-- slider -->
    <div class="row carousel-holder">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Thông tin tài khoản</h4></div>
                <div class="panel-body">
                    @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                        <strong>{{ $err }}</strong><br/>                          
                        @endforeach
                    </div>
                    @endif

                    @if(session('message'))
                    <div class="alert alert-success">
                        <strong>{{ session('message') }}</strong>
                    </div>
                    @endif
                    <form action="nguoidung" method="POST">
                        {{ csrf_field() }}
                        <div>
                            <label>Tên Người Dùng</label>
                            <input type="text" class="form-control" name="username" aria-describedby="basic-addon1" value="{{ $user->name }}">
                        </div>
                        <br>
                        <div>
                            <label>Địa Chỉ Email</label>
                            <input type="email" class="form-control" name="email" aria-describedby="basic-addon1" value="{{ $user->email }}" 
                            readonly
                            >
                        </div>
                        <br>    
                        <div class="form-group">
                            <p>
                                <input type="checkbox" id="yourBox" />
                                <label>Đổi mật khẩu</label>
                            </p>

                                <input class="form-control input-width disabled-field" type="password" name="password" placeholder="Nhập mật khẩu" id="yourText" disabled="" />
                                </div>

                                <div class="form-group">
                                    <p><label>Xác nhận Mật khẩu</label></p>
                                    <input class="form-control input-width disabled-field" type="password" name="repassword" placeholder="Nhập lại mật khẩu" id="retypeYourText" disabled="" />
                                </div>

                                <script>
                                document.getElementById('yourBox').onchange = function() {
                                    document.getElementById('yourText').disabled = !this.checked;
                                    document.getElementById('retypeYourText').disabled = !this.checked;
                                };
                                </script>


                        <br>
                        <button type="submit" class="btn btn-primary">Cập nhật
                        </button>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
    <!-- end slide -->
</div>
    <!-- end Page Content -->
@endsection