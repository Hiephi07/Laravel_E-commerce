@extends('layouts.admin')

@section('title')
<title>Trang chủ</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('includes.content-header', ["name" => "Danh mục sản phẩm", "key" => ""])

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a href=" {{ route('categories.create') }} " class="btn btn-primary float-right mb-3">Thêm mới danh mục sản phẩm</a>
            </div>

            <div class="col-md-12">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên danh mục</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Thao tác</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($categories as $category)
                      <tr>
                        <th>{{$category->id}}</th>
                        <td>{{$category->name}}</td>
                        <td>{{$category->slug}}</td>
                        <td>
                          <a href="{{route('categories.edit', ['id' => $category->id])}}" class="btn btn-warning">Sửa</a>
                          <a href="{{route('categories.delete', ['id' => $category->id])}}"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" class="btn btn-danger">Xóa</a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
            <div class="col-md-12">
              {{ $categories->links() }}
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection