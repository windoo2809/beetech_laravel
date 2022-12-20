@extends('admin.dashboard')
@section('title','Add User')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@yield('title')</hh1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Project Add</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form enctype="multipart/form-data" action="{{ route ('user.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control" value="{{old('email')}} ">
                                @error('email')<small class="alert-danger">{{ $message }}</small>@enderror <br>
                            </div>

                            <div class="form-group">
                                <label for="user_name">Username</label>
                                <input type="text" name="user_name" name="user_name" class="form-control"
                                    value="{{old('user_name')}} ">
                                @error('user_name')<small class="alert-danger">{{ $message }}</small>@enderror <br>
                            </div>

                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" class="form-control"
                                    value="{{old('first_name')}} ">
                                @error('first_name')<small class="alert-danger">{{ $message }}</small>@enderror <br>
                            </div>

                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="{{old('last_name')}} ">
                                @error('last_name')<small class="alert-danger">{{ $message }}</small>@enderror <br>
                            </div>

                            <div class="form-group">
                                <label for="birthday">Birthday</label>
                                <input type="date" name="birthday" class="form-control" value="{{old('birthday')}} ">
                                @error('birthday')<small class="alert-danger">{{ $message }}</small>@enderror <br>
                            </div>

                            <div class="form-group">
                                <label for="birthday">Avatar</label>
                                <input type="file" name="avatar" class="form-control" value="{{old('avatar')}} ">
                                @error('avatar')<small class="alert-danger">{{ $message }}</small>@enderror <br>
                            </div>


                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control"
                                    value="{{old('password')}} ">
                                @error('password')<small class="alert-danger">{{ $message }}</small>@enderror <br>
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{route ('user.index')}}" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Create new User" class="btn btn-success">
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
</div>
@endsection