@extends('user.dashboard');
@section('title', 'Product Category')
@section('content')

<div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@yield('title')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Projects</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@yield('title')</h3>
                <div class="card-tools">
                    <a class="btn btn-info btn-sm" href="{{route ('product-category.create')}}">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Add
                    </a>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Parent ID</th>
                        </tr>
                    </thead>
                    @foreach($product_category as $row)
                    <tbody>
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->name }}</td>

                            <td>
                               {{ optional($row -> categoryChildren) -> name }}
                            </td>
                            <td class="project-actions text-right">
                                <a class="btn btn-primary btn-sm" href="#">
                                    <i class="fas fa-folder"></i>
                                    View
                                </a>
                                <a class="btn btn-info btn-sm" href="{{route ('product-category.edit',$row->id)}}">
                                    <i class="fas fa-pencil-alt"></i>
                                    Edit
                                </a>
                                <form action="{{route('product-category.destroy',$row->id)}}" method="post">
                                    @method("DELETE")
                                    @csrf
                                    <button class="btn btn-danger btn-sm" type="submit">
                                        <i class="fas fa-trash"></i>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            <!-- /.card-body -->
        </div>
            {{$product_category->links()}}

        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
@endsection
