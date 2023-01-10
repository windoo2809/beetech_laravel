<style>
    h1 {
        text-align: center;
        color: red;
    }

    h5 {
        text-align: center;
    }

    body {
        font-family: DejaVu Sans, sans-serif;
    }

    table,
    th,
    td {
        text-align: center;
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>

<body>
    <h1>Order Details</h1>
    <h5></h5>
    <hr>
    <div class="row">
        <h4>Customer</h4>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $order->CustomerDetail->id }}</td>
                    <td>{{ $order->CustomerDetail->email }}</td>
                    <td> {{ $order->CustomerDetail->address }}
                        {{ $order->CustomerDetail->commune->name }},
                        {{ $order->CustomerDetail->district->name }},
                        {{ $order->CustomerDetail->province->name }}.
                    </td>
                    <td> {{ $order->CustomerDetail->phone }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row">
        <h4>Order</h4>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Customer ID</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total </th>
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
    <div class="row">
        <h4>Product</h4>
        <table class="table">
            <thead>
                <tr>
                    <th><span>Order ID</span></th>
                    <th><span>Name</span></th>
                    <th><span>Qty</span></th>
                    <th><span>Status</span></th>
                    <th><span>Amount</span></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @php
                    $totalPrice = 0;
                @endphp
                @foreach ($order->OrderDetail as $row)
                    <tr>
                        <td>{{ $row->order_id }}</td>
                        <td>{{ $row->Product->name }}</td>
                        <td>{{ $row->quantity }}</td>
                        <td>{{ $row->status }}</td>
                        <td>{{ $row->price }}</td>
                        @php
                            $totalPrice += $row->quantity * $row->price;
                        @endphp
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="font-weight-bold">Total Amount</td>
                    <td colspan="1" class="font-weight-bold">${{ $totalPrice }}</td>
                </tr>
                </tr>
            </tbody>
        </table>
    </div>
</body>
