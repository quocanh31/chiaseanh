<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Chi tiết</title>
    <base href="{{asset('')}}">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">
    <script type="text/javascript" language="javascript" src="admin_asset/ckeditor/ckeditor.js" ></script>    
    @yield('css')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    @include('layout.header')
  <!-- Page Content -->
    <div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{$hinhanh->TieuDe}}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">{{$nguoidang->name}}</a>
                </p>

                <!-- Preview Image -->
                <img class="img-responsive" src="upload/hinhanh/{{$hinhanh->Hinh}}" alt="">

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on :{{$hinhanh->created_at}}</p>
                <p> <span class="glyphicon glyphicon-eye-open"></span> Lượt xem :{{$hinhanh->SoLuotXem}}</p>
                <hr>

                <!-- Post Content -->
                <p class="lead">
                	{!! $hinhanh->NoiDung !!}
                </p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                @if(Auth::check())
                <div class="well">
                    <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                    <form action="comment/{{$hinhanh->id}}" method="post" role="form">
                    	{{ csrf_field() }}
                        <div class="form-group">
                            <textarea name="noidung" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi</button>
                    </form>
                </div>
                @endif

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                @foreach($hinhanh->comment as $cmt)
                <div class="media">

                    <div class="media-body">
                        <h4 class="media-heading">{{$cmt->user->name}}
                            <small>{{$cmt->created_at}}</small>
                            @if(Auth::check())
                            @if($cmt->user->name == Auth::user()->name)
                            <small><a href="xoa/cmt/{{$cmt->id}}"><span class='glyphicon glyphicon-trash'></span></a></small>
                            @endif
                            @endif
                        </h4>
                        {{$cmt->NoiDung}}
                    </div>
                </div>
                @endforeach
                <br></br>
                <br></br>
                <br></br>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Hình liên quan</b></div>
                    <div class="panel-body">

                        <!-- item -->
                        @foreach($hinhLienQuan as $lq)
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="hinhanh/chitiet/{{$lq->id}}/{{$lq->TieuDeKhongDau}}.html">
                                    <img class="img-responsive" src="upload/hinhanh/{{$lq->Hinh}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="hinhanh/chitiet/{{$lq->id}}/{{$lq->TieuDeKhongDau}}.html"><b>{{$lq->TieuDe}}</b></a>
                            </div>
                            <p></p>
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                        @endforeach


                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Hình nổi bật</b></div>
                    <div class="panel-body">

                        <!-- item -->
                        @foreach($hinhNoiBat as $nb)
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="hinhanh/chitiet/{{$nb->id}}/{{$nb->TieuDeKhongDau}}.html">
                                    <img class="img-responsive" src="upload/hinhanh/{{$nb->Hinh}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="hinhanh/chitiet/{{$nb->id}}/{{$nb->TieuDeKhongDau}}.html"><b>{{$nb->TieuDe}}</b></a>
                            </div>
                            <p></p>
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                        @endforeach

                </div>
                
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/my.js"></script>


</body>

</html>
