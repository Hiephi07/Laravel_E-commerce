@extends('layouts.admin')

@section('title')
    <title>Thêm mới nhân viên</title>
@endsection

@section('select2-css')
    <link href="{{ asset('/vendor/select2/select2.min.css') }}" rel="stylesheet" />
    {{-- <link href="{{ asset('/admins/add/add.css') }}" rel="stylesheet" /> --}}
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('includes.content-header', ['name' => 'Thêm mới nhân viên', 'key' => ''])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="">
                                <div class="mb-3">
                                    <label class="form-label">Nhập tên vai trò</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" placeholder="Nhập tên" value="{{-- $user->name --}}">
                                    @error('name')
                                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Mô tả vai trò</label>
                                    <textarea class="form-control @error('display_name') is-invalid @enderror"
                                        name="display_name" rows="4">
                                        {{ old('display_name') }}
                                    </textarea>
                                    @error('display_name')
                                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="">
                                @foreach ($permissionsParent as $permissionsParentItem)

                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Module {{ $permissionsParentItem->name }}</h5>
                                    </div>

                                    <div class="card-body row">
                                        @foreach ($permissionsParentItem->permissionsChildrent as $permissionsChildrentItem)

                                        <div class="form-check col-3">
                                            <input class="form-check-input" type="checkbox" 
                                                name="permission_id[]"
                                                value="{{ $permissionsChildrentItem->id }}" 
                                            >
                                            <label class="form-check-label">
                                                {{ $permissionsChildrentItem->name }}
                                            </label>
                                        </div>

                                        @endforeach
                                        
                                    </div>
                                </div>

                                @endforeach
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
    <script src="{{ asset('/vendor/select2/select2.min.js') }}"></script>
    <script>
        // select2
        $("#roles_select2").select2({
            allowClear: true,
            placeholder: "Chọn vai trò"
        });
    </script>
    <script>

    </script>
@endsection
