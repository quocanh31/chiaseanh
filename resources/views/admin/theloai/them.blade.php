       @extends('admin.layout.index')

       @section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thể Loại
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    
                    <div class="col-lg-7" style="padding-bottom:120px">

                        <!-- Check các lỗi nhập liệu như bao nhiêu ký tự, bắt buộc nhập (nếu có) -->
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

                    
                        <form action="admin/theloai/them" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                            <div class="form-group">
                                <label>Tên thể loại</label>
                                <input class="form-control" name="Ten" placeholder="Nhập tên thể loại" />
                            </div>
                            
                            <button type="submit" class="btn btn-default">Thêm</button>

                            <button type="reset" class="btn btn-default btn-mleft">Nhập Lại</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

        @endsection