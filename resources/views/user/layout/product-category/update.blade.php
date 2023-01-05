@extends('user.dashboard')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Update Product Category') }}</h1>
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
        <form enctype="multipart/form-data" action="{{ route ('product-category.update',$product_category->id)}}"
            method="post">
            @csrf
            @method("PUT")
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{$product_category->name}} ">
                                @error('name')<small class="alert-danger">{{ $message }}</small>@enderror <br>
                            </div>

                            <div class="form-group">
                                <label for="parent_id">{{ __('Parent ID') }}</label>
                                <select class="form-select" name=" parent_id" aria-label="Default select example">
                                    @if($product_category->parent_id == null)
                                    <option value="{{$product_category->parent_id }}">
                                        Null
                                    </option>
                                    @else
                                    <option value="{{$product_category->categoryChildren->id}}">
                                        {{$product_category->categoryChildren->name }}
                                    </option>
                                    <option value=""> Null </option>
                                    @endif
                                    @foreach($children as $child)
                                        <option value="{{$child->id }}">
                                            {{$child->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('parent_id')<small class="alert-danger">{{ $message }}</small>@enderror <br>
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{route ('product-category.index')}}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    <input type="submit" value="{{ __('Update') }}" class="btn btn-success">
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
</div>
@endsection
