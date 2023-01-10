@extends('user.dashboard');
@section('content')

<div class="content-wrapper ">
    <div class="container-fluid">
            <div class="row">
                <div class="col-7 mt-2">
                    <form class="form-group">
                        <div class="input-group input-group-lg">
                            <input type="search" name="search" class="form-control form-control-lg"
                                placeholder="{{ __('Search') }}">
                            <div class="input-group-append">
                                <button  type="submit" class="btn btn-lg btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Product') }}</h1>
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
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                        aria-expanded="false">
                        {{ __('Download file') }}
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('product.exportcsv')}}">CSV</a>
                        <a class="dropdown-item" href="{{route('product.exportpdf')}}">PDF</a>
                    </div>
                </div>
                <div class="card-tools">
                    <a class="btn btn-info btn-sm" href="{{route ('product.create')}}">
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
                            <th>{{ __('Sku') }}</th>
                            <th>{{ __('Stock') }}</th>
                            <th>{{ __('Avatar') }}</th>
                            <th>{{ __('Category ID') }} </th>

                        </tr>
                    </thead>
                    @foreach($product as $row)
                    <tbody>
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->sku }}</td>
                            <td>{{ $row->stock }}</td>

                            <td>
                                <img src="{{asset ('upload/product/' .$row->avatar)}}" alt="Ảnh không tồn tại"
                                    width="100px" height="100px">
                            </td>
                            <td>{{ $row->product_category->name }}</td>

                            <td class="project-actions text-right">
                                <button class="trigger btn-primary btn-sm" data-modal-trigger="trigger-1{{$row->id}}">
                                    <i class="fas fa-folder"></i>{{ __('View') }} </button>
                                <div class="modal" data-modal="trigger-1{{$row->id}}">
                                    <article class="content-wrapper">
                                        <button class="close"></button>
                                        <header class="modal-header">
                                            <h2 style="text-align:center;"><b>{{$row->name}}</b></h2>
                                        </header>
                                        <div class="content">
                                            <h5>{{ __('Sku') }}: <b>{{$row->sku}}</b></h5>
                                            <h5>{{ __('Stock') }}: <b>{{$row->stock}}</b></h5>
                                            <h5>{{ __('Category ID') }}: <b>{{$row->category_id}}</b></h5>
                                            <h5>{{ __('Expired at') }}: <b>{{$row->expired_at}}</b></h5>
                                            <h5>{{ __('Price') }}: <b>{{$row->price}}</b></h5>
                                        </div>
                                        <footer class="modal-footer">
                                            <img src="{{asset('upload/product/' .$row->avatar)}}" width="350px"
                                                height="300px">
                                        </footer>
                                    </article>
                                </div>
                                <a class="btn btn-info btn-sm" href="{{route ('product.edit',$row->id)}}">
                                    <i class="fas fa-pencil-alt"></i>
                                    {{ __('Edit') }}
                                </a>
                                <a onclick="destroy(this)" data-id="{{route('product.destroy',$row->id)}}"
                                     class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
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
                                            window.location.reload();
                                        },
                                        error: function(response) {
                                            // alert
                                            swal("Opps! Something wrong!", {
                                                icon: "error",
                                            });
                                            window.location.reload();
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
        {{$product->appends(request()->all())->links()}}
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
@endsection
