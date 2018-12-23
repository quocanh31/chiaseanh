	@extends('layout.index')

	@section('content')
	  <!-- Page Content -->    
	    <div class="container">

	    	@include('layout.slide')

	        <div class="space20"></div>


	        <div class="row">
	        	@include('layout.menu')

	             <div class="col-md-9 ">
	                <div class="panel panel-default">
	                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
	                        <h4><b>{{$tentl->Ten}}</b></h4>
	                    </div>

	                    <div class="">
	                        <div class="col-md-15">
	                            <div class="row-item row">
	                            	@foreach($hinhanh as $ha)
	                                <div class="col-md-4">
	                                    <h3 style="width: 200px;  white-space: nowrap;  overflow: hidden;  text-overflow: ellipsis; font-weight: bold;">{{$ha->TieuDe}}</h3>
	                                    <a href="detail.html" >
	                                    <img width="200px" height="200px" class="" src="upload/hinhanh/{{$ha->Hinh}}" alt="">
	                                    </a>
	                                    <a class="btn btn-primary" href="detail.html" style="margin-top: 20px">View Project <span class="glyphicon glyphicon-chevron-right"></span></a>
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