            @extends('layout.index')

      @section('content')
  <!-- Page Content -->       
    <div class="container">

        @include('layout.slide')

     <div class="space20"></div>
        <!-- end slide -->      
      @include('layout.menu')
            <div class="col-md-9">
	            <div class="panel panel-default">            
	            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;">Bài tập lớn thực hành lập trình web</h2>
	            	</div>

	            	<div class="panel-body">
	            		<!-- item -->
                        <h3><span class="glyphicon glyphicon-align-left"></span>Website chia sẻ ảnh</h3>
					    
                        <div class="break"></div>
					   	<h4><span class= "glyphicon glyphicon-user "></span> Thành viên nhóm : </h4>
                        <p>Phạm Quốc Anh </p>
                        <p>Lê Hoàng Anh </p>
                        <p>Trần Ngọc Bảo Chung </p>
                        <p>Trần Anh Tú </p>
                        <p>Nguyễn Hoàng Hà </p>



                        <br><br>
                        <h3><span class="glyphicon glyphicon-globe"></span> Bản đồ</h3>
                        <div class="break"></div><br>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.6942187899604!2d105.84477069018511!3d21.004891052194615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ad5569f4fbf1%3A0x5bf30cadcd91e2c3!2zxJDhuqBJIEjhu4xDIELDgUNIIEtIT0EgQ-G7lE5HIFRS4bqmTiDEkOG6oEkgTkdIxKhB!5e0!3m2!1svi!2s!4v1545079250555" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

					</div>
	            </div>
        	</div>
            @section('content')