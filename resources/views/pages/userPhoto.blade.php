	@extends('layout.index')

	@section('content')
	  <!-- Page Content -->    
	    <div class="container">

	    	@include('layout.slide')

	        <div class="space20"></div>


	        <div class="row">
	        <div class="col-md-3 ">
                <ul class="list-group" id="menu">
                    <li href="#" class="list-group-item menu1 active">
                        Thể Loại
                    </li>


                    @foreach($theloai as $tl)
                    <li href="#" class="list-group-item menu1">
                        <a href="photo/{{Auth::user()->id}}/{{Auth::user()->name}}/{{$tl->id}}.html">{{$tl->Ten}}</a>
                    </li>
                    @endforeach

                </ul>
            </div>

	             <div class="col-md-9 ">
	                <div class="panel panel-default">
	                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
	                        <h4><b>Ảnh của {{Auth::user()->name}}</b></h4>
	                    </div>
	                                        @if(session('message'))
                        <div class="alert alert-success">
                            <strong>{{session('message')}}</strong>
                        </div>
                    @endif  

	                    <div class="">
	                        <div class="col-md-15">
	                            <div class="row-item row">
	                            	@foreach($hinhanh as $ha)
	                                <div class="col-md-4">
	                                    <h3 width="200px" style="width: 200px;  white-space: nowrap;  overflow: hidden;  text-overflow: ellipsis; font-weight: bold;">{{$ha->TieuDe}}</h3>
	                                    <a href="hinhanh/chitiet/{{$ha->id}}/{{$ha->TieuDeKhongDau}}.html" >
	                                    <img style="object-fit: cover;" width="200px" height="200px" class="" src="upload/hinhanh/{{$ha->Hinh}}" alt="">
	                                    </a>
	                                    <a class="btn btn-primary btn-sm" href="sua/photo/{{$ha->id}}" style="margin-top: 20px">Sửa <span class="glyphicon glyphicon-chevron-right"></span></a>
									<a class="btn btn-info btn-sm" href="xoa/photo/{{$ha->id}}" style="margin-top: 20px">Xóa <span class="glyphicon glyphicon-trash"></span></a>
	                                </div>
	                                @endforeach

	                            </div>
	                            
	                        </div>
	                        <div class="break"></div>
	                    </div>






	               {{$hinhanh->links()}}

	                </div>
	            </div> 
	        </div>

	    </div>
	    <!-- end Page Content -->
	@endsection