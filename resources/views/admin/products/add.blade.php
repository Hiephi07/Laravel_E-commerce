@extends('layouts.admin')

@section('title')
    <title>Thêm mới sản phẩm</title>
@endsection

@section('select2-css')
    <link href="{{ asset('/vendor/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/admins/add/add.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('includes.content-header', ['name' => 'Thêm mới sản phẩm', 'key' => ''])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Tên sản phẩm</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" placeholder="Nhập tên sản phẩm" value="{{ old('name') }}">
                                @error('name')
                                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Giá sản phẩm</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                name="price" placeholder="Nhập giá sản phẩm" value="{{ old('price') }}">
                                @error('price')
                                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Ảnh đại diện sản phẩm</label>
                                <input class="form-control-file @error('product_images') is-invalid @enderror" 
                                type="file" id="formFile" name="product_images">
                                @error('product_images')
                                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label">Ảnh sản phẩm</label>
                                <input class="form-control-file" type="file" id="formFileMultiple" multiple
                                    name="pro_img_path[]">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Chọn danh mục</label>
                                <select class="form-control @error('category_id') is-invalid @enderror" 
                                name="category_id" id="menu_select2">
                                    <option selected disabled>Vui lòng chọn danh mục</option>
                                    {!! $optionSelect !!}
                                </select>
                                @error('category_id')
                                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nhập Tags</label>
                                <select class="form-control" id="tags_select2" multiple="multiple" name="tags[]"></select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mô tả sản phẩm</label>
                                <textarea class="form-control my-editor @error('product_content') is-invalid @enderror" 
                                rows="4" name="product_content" id="ckEditor">
                                    {{ old('product_content') }}
                                </textarea>
                                @error('product_content')
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
    <script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    {{-- <script src="{{ asset('/vendor/ckeditor/ckeditor.js') }}"></script> --}}
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{ csrf_token() }}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{ csrf_token() }}'
        }
    </script>
    <script defer>
        CKEDITOR.replace('ckEditor', options);
    </script>
    <script src="{{ asset('/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('/admins/add/add.js') }}"></script>
@endsection
