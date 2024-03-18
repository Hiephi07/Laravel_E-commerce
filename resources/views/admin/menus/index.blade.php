@extends('layouts.admin')

@section('title')
<title>Menu</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('includes.content-header', ["name" => "Menus", "key" => ""])

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a href=" {{ route('menus.create') }} " class="btn btn-primary float-right mb-3">Thêm mới Menu</a>
            </div>

            <div class="col-md-12">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên Menu</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Thao tác</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($menus as $menu)
                      <tr>
                        <th>{{$menu->id}}</th>
                        <td>{{$menu->name}}</td>
                        <td>{{$menu->menu_slugs}}</td>
                        <td>
                          <a href="{{route('menus.edit', ['id' => $menu->id])}}" class="btn btn-warning">Sửa</a>
                          <a href="{{route('menus.delete', ['id' => $menu->id])}}"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" class="btn btn-danger">Xóa</a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
            <div class="col-md-12">
              {{ $menus->links() }}
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection