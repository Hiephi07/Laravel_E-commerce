@extends('layouts.admin')

@section('title')
    <title>Danh sách vai trò</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('includes.content-header', ['name' => 'Danh sách vai trò', 'key' => ''])

        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href=" {{ route('roles.create') }} " class="btn btn-primary float-right mb-3">Thêm mới vai trò</a>
                    </div>

                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên nhân viên</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <th>{{ $role->id }}</th>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->display_name }}</td>
                                        <td>
                                            <a href="{{ route('roles.edit', ['id' => $role->id]) }}"
                                                class="btn btn-warning">Sửa</a>
                                            <a href="{{ route('roles.delete', ['id' => $role->id]) }}"
                                                class="btn btn-danger deleteRole">Xóa</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $roles->links() }}
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('sweetalert2-js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let deleteRole = document.querySelectorAll('.deleteRole');
        deleteRole.forEach(delRole => {
            delRole.addEventListener("click", (e) => {
            e.preventDefault();
            let url = delRole.href;
            console.log(url);
            Swal.fire({
                title: "Bạn có chắc chắn không?",
                text: "Sau khi xóa dữ liệu không thể khôi phục!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Đồng ý!"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(url)
                        .then(res => res.json())
                        .then(data => {
                            delRole.parentElement.parentElement.remove();
                            Swal.fire({
                                title: "Đã xóa!",
                                text: "Dữ liệu của bạn được xóa thành công.",
                                icon: "success"
                            })
                        })
                        .catch(err => console.log(err))
                }
            });
        })})
    </script>
@endsection
