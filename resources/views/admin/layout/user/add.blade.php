@extends('admin.dashboard')
@section('title','Add User')
@section('content')
<div class="content-wrapper">
    <div class="content ">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body card-block">
                            <form action="" method="post" enctype="multipart/form-data"
                                class="form-horizontal">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="name" class=" form-control-label">Tên </label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="name" placeholder="........"
                                            class="form-control" value="{{old('name')}} ">
                                        @error('name')<small class="alert-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>            
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="name" class=" form-control-label">Giá </label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="price" placeholder="........"
                                            class="form-control" value="{{old('price')}} ">
                                        @error('price')<small class="alert-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>                                                      
                                <br>
                                <input class="btn btn-success float-right" type="submit" value="Thêm">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection