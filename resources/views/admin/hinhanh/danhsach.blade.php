        @extends('admin.layout.index')

        @section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">HinhAnh
                            <small>Danh Sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if(session('message'))
                        <div class="alert alert-success">
                            <strong>{{ session('message') }}</strong>
                        </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tiêu Đề</th>
                                <th>Hình</th>>
                                <th>Người đăng</th>
                                <th>Thể Loại</th>
                                <th>Nội Dung</th>
                                <th>Lượt xem</th>
                                <th>Nổi bật</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hinhanh as $ha)
                            <tr class="odd gradeX" align="center">
                                <td>{{$ha->id}}</td>
                                <td>{{$ha->TieuDe}}</td>
                                <td>
                                    <img width="300px" src="upload/hinhanh/{{$ha->Hinh}}">
                                </td>
                                <td>{{$ha->hauser->name}}</td>
                                <td>{{$ha->theloai->Ten}}</td>
                                <td>{{$ha->NoiDung}}</td>
                                <td>{{$ha->SoLuotXem}}</td>
                                <td>
                                @if($ha->NoiBat==0)
                                {{'Không'}}
                                @else
                                {{'Có'}}
                                @endif    
                                </td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/hinhanh/xoa/{{$ha->id}}"> Delete</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
        @endsection