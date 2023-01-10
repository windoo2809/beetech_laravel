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
                    <h1>{{ __('Order') }}</h1>
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
                    {{-- <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                        aria-expanded="false">
                        {{ __('Download file') }}
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route ('order.exportpdf')}}">PDF</a>
                    </div> --}}
                </div>
                <div class="card-tools">
                    <a class="btn btn-info btn-sm" href="{{route ('order.create')}}">
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
            @if ($order)
            <div class="card-body p-0">
                <table class="table table-striped projects text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ __('Customer ID') }}</th>
                            <th>{{ __('Quantity') }}</th>
                            <th>{{ __('Total') }}</th>
                        </tr>
                    </thead>
                    @foreach($order as $row)
                    <tbody>
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->customer_id }}</td>
                            <td>{{ $row->quantity }}</td>
                            <td>{{ $row->total}}<td>

                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm" href="{{route ('order.show',$row->id)}}">
                                    <i class="fas fa-eye"></i>
                                    {{ __('View') }}
                                </a>

                                <a class="btn btn-info btn-sm" href="{{route ('order.edit',$row->id)}}">
                                    <i class="fas fa-pencil-alt"></i>
                                    {{ __('Edit') }}
                                </a>
                                <a onclick="destroy(this)" data-id="{{route('order.destroy',$row->id)}}"
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
                                text: "Do you want delete this order!",
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
                                            swal("Poof! Your Order has been deleted!", {
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
            @else
               <p class="text-center"> No order was found.</p>
            @endif
            <!-- /.card-body -->
        </div>
        {{ $order->links()}}
        {{-- {{$order->appends(request()->all())->links()}} --}}
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
@endsection
