@extends('user.dashboard')
@section('title','Edit Product ')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Edit Product') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Project Add</li> --}}
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form enctype="multipart/form-data" action="{{ route ('product.update',$product->id)}}" method="post">
            @csrf
            @method("PUT")
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" name="name" class="form-control" value="{{$product->name}} ">
                                @error('name')<small class="alert-danger">{{ $message }}</small>@enderror <br>
                            </div>

                            <div class="form-group">
                                <label for="stock">{{ __('Stock') }}</label>
                                <input type="text" name="stock" name="stock" class="form-control"
                                    value="{{$product->stock}} ">
                                @error('stock')<small class="alert-danger">{{ $message }}</small>@enderror <br>
                            </div>

                            <div class="form-group">
                                <label for="expired_at">{{ __('Expired at') }}</label>
                                <input type="date" name="expired_at" class="form-control"
                                    value="{{$product->expired_at}}">
                                @error('expired_at')<small class="alert-danger">{{ $message }}</small>@enderror <br>
                            </div>

                            <div class="form-group">
                                <label for="avatar">{{ __('Avatar') }}</label>
                                <input type="file" name="avatar" class="form-control" value="{{$product->avatar}} ">
                                @error('avatar')<small class="alert-danger">{{ $message }}</small>@enderror <br>
                            </div>

                            <div class="form-group">
                                <label for="sku">{{ __('Sku') }}</label>
                                <input type="sku" name="sku" class="form-control" value="{{$product->sku}} ">
                                @error('sku')<small class="alert-danger">{{ $message }}</small>@enderror <br>
                            </div>

                            <div class="form-group">
                                <label for="category_id">{{ __('Category ID') }}</label>
                                <select class="form-select" name="category_id" aria-label="Default select example">
                                    @foreach($product_category as $category)
                                    <option value="{{$category->id }}">
                                        {{$category->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{route ('product.index')}}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    <input type="submit" value="{{ __('Edit Product') }}" class="btn btn-success">
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
</div>
@endsection
