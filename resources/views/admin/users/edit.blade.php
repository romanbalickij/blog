@extends('admin.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
               Update User
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <form method="POST" action="{{route('users.update', $user->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">

                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text"  name="name" class="form-control" id="exampleInputEmail1"
                                   placeholder="" value="{{$user->name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">E-mail</label>
                            <input type="text" name="email" class="form-control" id="exampleInputEmail1"
                                   placeholder="" value="{{$user->email}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" name="password" class="form-control"
                                   id="exampleInputEmail1" placeholder="" >
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="is_admin" class="minimal"
                                       {{$user->is_admin ? 'checked' : ''}}  value="1">
                            </label>
                            <label>
                                Admin
                            </label>
                        </div>
                        <div class="form-group">
                            @if($user->avatar == null)
                                <img src="/uploads/no-image.png" alt="" class="img-responsive" width="150" height="100">
                            @else
                                <img src="/uploads/{{$user->avatar}}" alt="" class="img-responsive" width="150" height="100">
                            @endif
                            <label for="exampleInputFile">Avatar</label>
                            <input type="file" name="avatar" id="exampleInputFile">

                            <p class="help-block">@include('admin.errors')</p>
                        </div>

                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{route('users.index')}}" class="btn btn-default">Back</a>
                    <button class="btn btn-warning pull-right">Update</button>
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
            </form>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection