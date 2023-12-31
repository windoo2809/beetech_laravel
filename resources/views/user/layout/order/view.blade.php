@extends('user.dashboard')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('Order Detail') }}</h1>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                            aria-expanded="false">
                            {{ __('Download file') }}
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ url('user/order-pdf/down/' . $order->id) }}">PDF</a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('Order') }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-sm text-center">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">ID</th>
                                            <th>{{ __('Customer ID') }}</th>
                                            <th>{{ __('Quantity') }}</th>
                                            <th>{{ __('Total') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->customer_id }}</td>
                                            <td>{{ $order->quantity }}</td>
                                            <td>{{ $order->total }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('Customer') }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-sm text-center">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">ID</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Phone') }}</th>
                                            <th>{{ __('Address') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $order->CustomerDetail->id }}</td>
                                            <td>{{ $order->CustomerDetail->email }}</td>
                                            <td>{{ $order->CustomerDetail->phone }}</td>
                                            <td>
                                                {{ $order->CustomerDetail->address }}
                                                {{ $order->CustomerDetail->commune->name }},
                                                {{ $order->CustomerDetail->district->name }},
                                                {{ $order->CustomerDetail->province->name }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('Product') }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-sm text-center">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">ID</th>
                                            <th>{{ __('Order ID') }}</th>
                                            <th>{{ __('Avatar') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Quantity') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Price') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalPrice = 0;
                                        @endphp
                                        @foreach ($order->OrderDetail as $row)
                                            <tr>
                                                <td>{{ $row->id }}</td>
                                                <td>{{ $row->order_id }}</td>
                                                <td>
                                                    <img src="{{ asset('upload/product/' . $row->Product->avatar) }}"
                                                        width="100px" height="100px">
                                                </td>
                                                <td>{{ $row->Product->name }}</td>
                                                <td>{{ $row->quantity }}</td>
                                                <td>
                                                    @if ($row->status == 1)
                                                        <a href=""class="btn btn-sm btn-primary">{{ __('Considering') }}</a>
                                                    @elseif ($row->status == 2)
                                                        <a href=""class="btn btn-sm btn-primary">{{ __('Waiting for delivery') }}</a>
                                                    @elseif ($row->status == 3)
                                                        <a href=""class="btn btn-sm btn-primary">{{ __('Delivering') }}</a>
                                                    @elseif ($row->status == 4)
                                                        <a href=""class="btn btn-sm btn-primary">{{ __('Delivered') }}</a>
                                                    @endif
                                                </td>
                                                <td>{{ $row->price }}</td>
                                                @php
                                                    $totalPrice += $row->quantity * $row->price;
                                                @endphp
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="5" class="font-weight-bold">{{ __('Total Amount') }}</td>
                                            <td colspan="1" class="font-weight-bold">${{ $totalPrice }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
