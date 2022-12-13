@extends('admin.dashboard');
@section('title', 'User')
@section('content')
<div class="table-responsive">
    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Birthday</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Password</th>
                <th>Reset Password</th>
                <th>Status</th>
                <th>Flag Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->user_name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->birthday}}</td>
                <td>{{$user->first_name}}</td>
                <td>{{$user->last_name}}</td>
                <td>{{$user->password}}</td>
                <td>{{$user->reset_password}}</td>
                <td>{{$user->status}}</td>
                <td>{{$user->flag_delete}}</td>
                <td><a href="{{url('/category-ve')}}/{{$user->id}}/edit" class="btn btn-warning">Cập nhật</a></td>
                <td><a href="delete-category-ve/{{$user->id}}" class="btn btn-danger">Xóa</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{$users->links()}}

@endsection