@extends('admin.dashboard')
@section('title', 'Edit User')
@section('content')

    <div class="content-wrapper">
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
                            <li class="breadcrumb-item active">Project Add</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <form action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">General</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control" value="{{ $user->email }} ">
                                    @error('email')
                                        <small class="alert-danger">{{ $message }}</small>
                                    @enderror <br>
                                </div>

                                <div class="form-group">
                                    <label for="user_name">Username</label>
                                    <input type="text" name="user_name" name="user_name" class="form-control"
                                        value="{{ $user->user_name }} ">
                                    @error('user_name')
                                        <small class="alert-danger">{{ $message }}</small>
                                    @enderror <br>
                                </div>

                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" class="form-control"
                                        value="{{ $user->first_name }} ">
                                    @error('first_name')
                                        <small class="alert-danger">{{ $message }}</small>
                                    @enderror <br>
                                </div>

                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" class="form-control"
                                        value="{{ $user->last_name }}">
                                    @error('last_name')
                                        <small class="alert-danger">{{ $message }}</small>
                                    @enderror <br>
                                </div>

                                <div class="form-group">
                                    <label for="birthday">Birthday</label>
                                    <input type="date" name="birthday" class="form-control"
                                        value="{{ $user->birthday }}">
                                    @error('birthday')
                                        <small class="alert-danger">{{ $message }}</small>
                                    @enderror <br>
                                </div>

                                <div class="form-group">
                                    <label for="avatar">Avatar</label>
                                    <input type="file" name="avatar" class="form-control"
                                        value="{{ old('{$user->avatar') }} ">
                                    @error('avatar')
                                        <small class="alert-danger">{{ $message }}</small>
                                    @enderror <br>
                                </div>

                                <div class="form-group">
                                    <label for="province">Province</label>
                                    <select class="custom-select" name="province_id" id="province">
                                        @if ($user->province_id != null)
                                            @foreach ($province as $data)
                                                <option
                                                    value="{{ $data->id }}"{{ $data->id == $user->province_id ? 'selected' : '' }}>
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        @else
                                            <option value="">Select Province</option>
                                            @foreach ($province as $data)
                                                <option
                                                    value="{{ $data->id }}"{{ $data->id == $user->province_id ? 'selected' : '' }}>
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('province_id')
                                        <small class="alert-danger">{{ $message }}</small>
                                    @enderror <br>
                                </div>

                                <div class="form-group">
                                    <label for="district">District</label>
                                    <select class="custom-select" name="district_id" id="district">
                                        @if($user->district_id != null)
                                            @foreach ($district as $data)
                                                <option
                                                    value="{{ $data->id }}"{{ $data->id == $user->district_id ? 'selected' : '' }}>
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        @else
                                            <option value="">Select District</option>
                                            @foreach ($district as $data)
                                                <option
                                                    value="{{ $data->id }}"{{ $data->id == $user->district_id ? 'selected' : '' }}>
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('district_id')
                                    <small class="alert-danger">{{ $message }}</small>
                                @enderror <br>
                                </div>
                                <div class="form-group">
                                    <label for="commune">Commune</label>
                                    <select class="custom-select" name="commune_id" id="commune">
                                        @if ($user->commune_id != null)
                                            @foreach ($commune as $data)
                                                <option
                                                    value="{{ $data->id }}"{{ $data->id == $user->commune_id ? 'selected' : '' }}>
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        @else
                                            <option value="">Select Commune</option>
                                            @foreach ($commune as $data)
                                                <option
                                                    value="{{ $data->id }}"{{ $data->id == $user->commune_id ? 'selected' : '' }}>
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('commune_id')
                                    <small class="alert-danger">{{ $message }}</small>
                                @enderror <br>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">Cancel</a>
                        <input type="submit" value="Updata User" class="btn btn-success">
                    </div>
                </div>
            </form>
        </section>
        <!-- /.content -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#province').on('change', function() {
                var provinceId = $(this).val();
                $('#district').html('');
                $.ajax({
                    url: '{{ route('user.district') }}',
                    type: 'get',
                    data: {
                        province_id: provinceId
                    },
                    success: function(res) {
                        $('#district').html('<option value="">Select District</option>');
                        $.each(res, function(key, value) {
                            $('#district').append(
                                '<option value="' + value.id + '">' + value.name +
                                '</option>');
                        });
                        $('#commune').html('<option value="">Select Commune</option>');
                    }
                });
            });
            $('#district').on('change', function() {
                var districtId = $(this).val();
                $('#commune').html('');
                $.ajax({
                    url: '{{ route('user.commune') }}',
                    type: 'get',
                    data: {
                        district_id: districtId,
                    },
                    success: function(res) {
                        $('#commune').html('<option value="">Select commune</option>');
                        $.each(res, function(key, value) {
                            $('#commune').append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection
