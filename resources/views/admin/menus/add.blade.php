@extends('layouts.admin')

@section('title')
<title>Thêm mới Menu</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @include('includes.content-header', ["name" => "Thêm mới Menu", "key" => ""])

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('menus.store')}}" method="POST">
                  @csrf
                    <div class="mb-3">
                      <label class="form-label">Tên menu</label>
                      <input type="text" class="form-control" name="name" placeholder="Nhập tên menu">
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Chọn menu cha</label>
                      <select class="form-control" name="parent_id">
                        <option value="0" selected>Vui lòng chọn menu cha</option>
                        {!! $optionSelect !!}
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