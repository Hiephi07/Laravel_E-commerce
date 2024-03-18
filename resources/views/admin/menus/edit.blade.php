@extends('layouts.admin')

@section('title')
<title>Sửa tên Menu</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @include('includes.content-header', ["name" => "Sửa tên Menu", "key" => ""])

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('menus.update', ['id' => $menu->id])}}" method="POST">
                  @csrf
                    <div class="mb-3">
                      <label class="form-label">Tên Menu</label>
                      <input type="text" class="form-control" name="name" value="{{$menu->name}}" placeholder="Nhập tên Menu">
                    </div>
                    <div class="mb-3">
                      <select class="form-control" name="parent_id">
                        <option value="0">Vui lòng chọn menu cha</option>
                        {!! $optionSelected !!}
                      </select>
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