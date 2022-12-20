@extends('user.dashboard');
@section('title', 'Product')
@section('content')
<style>
button {
    cursor: pointer;
}


.pdfobject-container {
    height: 30rem;
    border: 1rem solid rgba(0, 0, 0, 0.1);
}

.trigger {
    border: none;
    font-size: 0.875rem;
    font-weight: 300;
}

.trigger i {
    margin-right: 0.3125rem;
}

.trigger:hover {
    box-shadow: 0 0.875rem 1.75rem rgba(0, 0, 0, 0.25), 0 0.625rem 0.625rem rgba(0, 0, 0, 0.22);
}

.modal {
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 0vh;
    background-color: transparent;
    overflow: hidden;
    transition: background-color 0.25s ease;
    z-index: 9999;
}

.modal.open {
    position: fixed;
    width: 100%;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.5);
    transition: background-color 0.25s;
}

.modal.open>.content-wrapper {
    transform: scale(1);
}

.modal .content-wrapper {
    position: relative;
    display: flex;
    flex-direction: column;
    text-align: center;
    align-items: center;
    justify-content: flex-start;
    width: 50%;
    margin: 0;
    padding: 2.5rem;
    background-color: white;

    transform: scale(0);
    transition: transform 0.25s;
    transition-delay: 0.15s;
}

.modal .content-wrapper .close {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 2.5rem;
    height: 2.5rem;
    border: none;
    background-color: transparent;
    font-size: 1.5rem;
    transition: 0.25s linear;
}

.modal .content-wrapper .close:before,
.modal .content-wrapper .close:after {
    position: absolute;
    content: "";
    width: 1.25rem;
    height: 0.125rem;
    background-color: black;
}

.modal .content-wrapper .close:before {
    transform: rotate(-45deg);
}

.modal .content-wrapper .close:after {
    transform: rotate(45deg);
}

.modal .content-wrapper .close:hover {
    transform: rotate(360deg);
}

.modal .content-wrapper .close:hover:before,
.modal .content-wrapper .close:hover:after {
    background-color: tomato;
}

.modal .content-wrapper .modal-header h2 {
    font-size: 1.5rem;
    font-weight: bold;
}

/*  */
.modal .content-wrapper .content p {
    font-size: 0.875rem;
    line-height: 1.75;
}
</style>
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
                    <a class="btn btn-info btn-sm" href="{{route ('product.create')}}">
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
                            <th>Sku</th>
                            <th>Stock</th>
                            <th>Expired at</th>
                            <th>Avatar</th>
                            <th>Category ID</th>

                        </tr>
                    </thead>
                    @foreach($product as $row)
                    <tbody>
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->sku }}</td>
                            <td>{{ $row->stock }}</td>
                            <td>{{ $row->expired_at }}</td>
                            <td>
                                <img src="{{asset ('upload/product/'. $row->avatar)}}" alt="Ảnh không tồn tại"
                                    width="100px" height="100px">
                            </td>
                            <td>{{ $row->category_id }}</td>

                            <td class="project-actions text-right">
                                <button class="trigger btn-primary btn-sm" data-modal-trigger="trigger-1{{$row->id}}">
                                    <i class="fas fa-folder"></i>View </button>
                                <div class="modal" data-modal="trigger-1{{$row->id}}">
                                    <article class="content-wrapper">
                                        <button class="close"></button>
                                        <header class="modal-header">
                                            <h2 style="text-align:center;"><b>{{$row->name}}</b></h2>
                                        </header>
                                        <div class="content">
                                            <h5>Sku: <b>{{$row->sku}}</b></h5>
                                            <h5>Stock: <b>{{$row->stock}}</b></h5>
                                            <h5>Expired at: <b>{{$row->expired_at}}</b></h5>
                                            <h5>Category ID: <b>{{$row->category_id}}</b></h5>
                                        </div>
                                        <footer class="modal-footer">
                                            <img src="{{asset('upload/product')}}/{{$row->avatar}}" width="350px"
                                                height="300px">
                                        </footer>
                                    </article>
                                </div>
                                <a class="btn btn-info btn-sm" href="{{route ('product.edit',$row->id)}}">
                                    <i class="fas fa-pencil-alt"></i>
                                    Edit
                                </a>
                                <a onclick="destroy(this)" data-id="{{$row->id}}" id="user_delete"
                                    class="btn btn-danger btn-sm">
                                    <i class="fas fa-pencil-alt"></i>
                                    Delete
                                </a>

                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        {{$product->links()}}
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<script>
function destroy(e) {
    let id = e.getAttribute('data-id');
    // alert(id);
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
                    url: '{{route('product.destroy',$row->id)}}',
                    data: {
                        id: id,
                        "_token": "{{csrf_token()}}",
                    },
                    success: function(response) {
                        // alert
                        swal("Poof! Your Product file has been deleted!", {
                            icon: "success",
                        });
                        $("#" + id + "").remove(); //remove without refreshing
                    },
                    error: function(response) {
                        // alert
                        swal("Opps! Product has been deleted!", {
                            icon: "error",
                        });
                        window.location.reload(); //remove without refreshing
                    }
                }); // ajax end
            }
        });
}
</script>
@endsection