@extends('layouts.admin')

@section('title')
    <title>Chỉnh sửa nhân viên</title>
@endsection

@section('select2-css')
    <link href="{{ asset('/vendor/select2/select2.min.css') }}" rel="stylesheet" />
    {{-- <link href="{{ asset('/admins/add/add.css') }}" rel="stylesheet" /> --}}
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('includes.content-header', ['name' => 'Chỉnh sửa nhân viên', 'key' => ''])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('users.update', ["id" => $user->id ]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nhập tên</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" placeholder="Nhập tên" value="{{ $user->name }}">
                                @error('name')
                                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nhập Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" placeholder="Nhập email" value="{{ $user->email }}">
                                @error('email')
                                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nhập Password</label>
                                <input type="password" class="form-control"
                                    name="password" placeholder="Nhập password" value="{{ old('password') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Chọn vai trò</label>
                                <select class="form-control" name="roles_id[]" id="roles_select2" multiple >
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ $roleForUser->contains("id", $role->id) ? "selected" : "" }}> 
                                            {{ $role->name }} 
                                        </option>
                                    @endforeach
                                </select>
                                @error('roles_id')
                                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                                @enderror
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

@section('select2-js')
    <script src="{{ asset('/vendor/select2/select2.min.js') }}">
        
    </script>
    <script>
        // select2
        $("#roles_select2").select2({
            allowClear: true,
            placeholder: "Chọn vai trò"
        });
    </script>
@endsection
