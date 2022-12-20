@extends('user.dashboard')
@section('title','Add Product')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@yield('title')</hh1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Project Add</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form enctype="multipart/form-data" action="{{ route ('product.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" value="{{old('name')}} ">
                                @error('name')<small class="alert-danger">{{ $message }}</small>@enderror <br>
                            </div>

                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input type="text" name="stock" name="stock" class="form-control"
                                    value="{{old('stock')}} ">
                                @error('stock')<small class="alert-danger">{{ $message }}</small>@enderror <br>
                            </div>

                            <div class="form-group">
                                <label for="expired_at">Expired at</label>
                                <input type="date" name="expired_at" class="form-control"
                                    value="{{old('expired_at')}} ">
                                @error('expired_at')<small class="alert-danger">{{ $message }}</small>@enderror <br>
                            </div>

                            <div class="form-group">
                                <label for="avatar">Avatar</label>
                                <input type="file" name="avatar" class="form-control" value="{{old('avatar')}} ">
                                @error('avatar')<small class="alert-danger">{{ $message }}</small>@enderror <br>
                            </div>

                            <div class="form-group">
                                <label for="sku">Sku</label>
                                <input type="sku" name="sku" class="form-control"
                                    value="{{old('sku')}} ">
                                @error('sku')<small class="alert-danger">{{ $message }}</small>@enderror <br>
                            </div>

                            <div class="form-group">
                                <label for="category_id">Category ID</label>
                                <input type="category_id" name="category_id" class="form-control"
                                    value="{{old('category_id')}} ">
                                @error('category_id')<small class="alert-danger">{{ $message }}</small>@enderror <br>
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{route ('user.index')}}" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Create new Project" class="btn btn-success">
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
</div>
@endsection