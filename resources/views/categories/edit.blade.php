@extends('layouts.admin')

@section('title')
<title>Sửa danh mục sản phẩm</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @include('includes.content-header', ["name" => "Sửa danh mục", "key" => ""])

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('categories.update', ['id' => $category->id])}}" method="POST">
                  @csrf
                    <div class="mb-3">
                      <label class="form-label">Tên danh mục</label>
                      <input type="text" class="form-control" name="name" value="{{$category->name}}" placeholder="Nhập tên danh mục">
                    </div>

                    <button type="submit" class="btn btn-warning">Sửa</button>
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