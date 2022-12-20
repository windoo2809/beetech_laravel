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
    <h1>Danh sách sản phẩm</h1>
    <h5>{{$datetime}}</h5>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Stock</th>
                <th scope="col">Expired at</th>
                <th scope="col">Sku</th>
                <th scope="col">Category ID</th>
            </tr>
        </thead>
        <tbody>
            @foreach($product as $row)
            <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->name}}</td>
                <td>{{$row->stock}}</td>
                <td>{{$row->expired_at}}</td>
                <td>{{$row->sku}}</td>
                <td>{{$row->category_id}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>