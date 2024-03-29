@extends('layouts.admin')

@section('title')
    <title>Sản phẩm</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('includes.content-header', ['name' => 'Sản phẩm', 'key' => ''])

        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href=" {{ route('products.create') }} " class="btn btn-primary float-right mb-3">Thêm mới sản
                            phẩm</a>
                    </div>

                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Danh mục</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <th>{{ $product->id }}</th>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>
                                            <img src="{{ asset($product->image_path) }}" width="80" height="80">
                                        </td>
                                        <td>{{ optional($product->category)->name }}</td>

                                        <td>
                                            <a href="{{ route('products.edit', ['id' => $product->id]) }}"
                                                class="btn btn-warning">Sửa</a>
                                            <a href="{{ route('products.delete', ['id' => $product->id]) }}"
                                                class="btn btn-danger deleteProduct">Xóa</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $products->links() }}
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
        let deleteProduct = document.querySelectorAll('.deleteProduct');
        deleteProduct.forEach(delPro => {
            delPro.addEventListener("click", (e) => {
                e.preventDefault();
                let url = delPro.href;
                Swal.fire({
                    title: "Bạn có chắc chắn không?",
                    text: "Sau khi xóa dữ liệu không thể khôi phục!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(url)
                            .then(res => res.json())
                            .then(data => {
                              delPro.parentElement.parentElement.remove();
                                Swal.fire({
                                        title: "Đã xóa!",
                                        text: "Dữ liệu của bạn được xóa thành công.",
                                        icon: "success"
                                    })
                            })
                            .catch(err => console.log(err))
                    }
                });
            })

        });
    </script>
@endsection
