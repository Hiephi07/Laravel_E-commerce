@extends('layouts.admin')

@section('title')
<title>Thêm mới danh mục sản phẩm</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @include('includes.content-header', ["name" => "Thêm mới danh mục", "key" => ""])

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form>
                    <div class="mb-3">
                      <label class="form-label">Tên danh mục</label>
                      <input type="text" class="form-control" placeholder="Nhập tên danh mục">
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Chọn danh mục cha</label>
                      <select class="form-control">
                        <option value="" disabled selected>Vui lòng chọn danh mục</option>
                        <option value="">Quần áo</option>
                        <option value="">Giày dép</option>
                      </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </form>
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection