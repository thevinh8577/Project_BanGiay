 @extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thể loại
                            <small>{{$theloai->name}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="" method="POST">
                            
                            <div class="form-group">
                                <label>Tên loại</label>
                                <input class="form-control" name="Ten" placeholder="Nhập tên loại" value="{{$theloai->name}}" />
                                <label>Mô tả</label>
                                <input class="form-control" name="Mota" placeholder="Nhập mô tả" />
                                <label>Hình ảnh</label>
                                <input class="form-control" type="file" name="Hinh"  />
                            </div>
                            
                            <button type="submit" class="btn btn-default">Category Edit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection