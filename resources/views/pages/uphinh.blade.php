@section('title')
    Up hình
@endsection

 @extends('layout.index')
 @section('content')   
 @include('layout.menu')
            <div class="col-md-9 ">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                    </div>

                    <div class="row-item row">


<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Hình Ảnh
                            <small>Thêm</small>
                        </h1>
                    </div>
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                <strong>{{$err}}</strong><br>
                            @endforeach
                        </div>
                    @endif

                    <!-- Thông báo công việc đã được thực hiện -->
                    @if(session('message'))
                        <div class="alert alert-success">
                            <strong>{{session('message')}}</strong>
                        </div>
                    @endif  
                    @if(session('error'))
                        <div class="alert alert-danger">
                            <strong>{{session('error')}}</strong>
                        </div>
                    @endif   
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="uphinh" method="POST" enctype="multipart/form-data">
                        	{{ csrf_field() }}
                            <div class="form-group"> 
                                <label>Thể loại</label>
                                <select class="form-control" name="idtheloai">
                                	@foreach($theloai as $tl)
                                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="txtCateName" placeholder="Please Enter Category Name" />
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <input type="file" class="form-control" name="hinh">
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea name="NoiDung" id="demo" class="form-control ckeditor" rows="3">
                                </textarea>
                            </div>

                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </div>

    </div>
 @endsection