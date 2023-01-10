<style>
    h1 {
        text-align: center;
        color: red;
    }
    h5{
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
        <h1>Danh sách đơn hàng</h1>
        <h5>{{$datetime}}</h5>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Customer ID</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Updated at</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order as $row)
                <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->customer_id}}</td>
                    <td>{{$row->quantity}}</td>
                    <td>{{$row->total}}</td>
                    <td>{{$row->created_at}}</td>
                    <td>{{$row->updated_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
