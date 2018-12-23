            <div class="col-md-3 ">
                <ul class="list-group" id="menu">
                    <li href="#" class="list-group-item menu1 active">
                        Thể Loại
                    </li>


                    @foreach($theloai as $tl)
                    <li href="#" class="list-group-item menu1">
                        <a href="hinhanh/{{$tl->id}}/{{$tl->TenKhongDau}}.html">{{$tl->Ten}}</a>
                    </li>
                    @endforeach

                </ul>
            </div>