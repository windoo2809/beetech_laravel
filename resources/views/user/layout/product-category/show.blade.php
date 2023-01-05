@extends('user.dashboard');
@section('content')

<div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> {{ __('Product Category') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Projects</li> --}}
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
                <div class="card-tools">
                    <a class="btn btn-info btn-sm" href="{{route ('product-category.create')}}">
                        <i class="fas fa-pencil-alt">
                        </i>
                        {{ __('Add') }}
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
                <table class="table table-striped projects text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Parent ID') }}</th>
                            <th>{{ __('Created at') }}</th>
                            <th>{{ __('Updated at') }}</th>
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
                            <td>{{ $row->created_at }}</td>
                            <td>{{ $row->updated_at }}</td>

                            <td class="project-actions text-right">
                                <a class="btn btn-primary btn-sm" href="#">
                                    <i class="fas fa-folder"></i>
                                    {{ __('View') }}
                                </a>
                                <a class="btn btn-info btn-sm" href="{{route ('product-category.edit',$row->id)}}">
                                    <i class="fas fa-pencil-alt"></i>
                                    {{ __('Edit') }}
                                </a>
                                <a onclick="destroy(this)" data-id="{{route('product-category.destroy',$row->id)}}"
                                    class="btn btn-danger btn-sm">
                                   <i class="fas fa-pencil-alt"></i>
                                   {{ __('Delete') }}
                               </a>
                            </td>
                        </tr>
                    </tbody>
                    <script>
                        function destroy(e) {
                            let id = e.getAttribute('data-id');
                            swal({
                                    title: "Are you sure?",
                                    text: "Do you want delete this product!",
                                    icon: "warning",
                                    buttons: true,
                                    dangerMode: true,
                                })
                                .then((willDelete) => {
                                    if (willDelete) {
                                        $.ajax({
                                            type: 'DELETE',
                                            url: id,
                                            data: {
                                                id: id,
                                                "_token": "{{csrf_token()}}",
                                            },
                                            success: function(response) {
                                                // alert
                                                swal("Poof! Your Product has been deleted!", {
                                                    icon: "success",
                                                });
                                                //remove without refreshing
                                            },
                                            error: function(response) {
                                                // alert
                                                swal("Opps! Something wrong!", {
                                                    icon: "error",
                                                });

                                            }
                                        }); // ajax end
                                    }
                                });
                        }
                        </script>

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
