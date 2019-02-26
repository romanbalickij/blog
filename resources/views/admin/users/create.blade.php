@extends('admin.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
              Create User
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <form method="POST" action="{{route('users.store')}}" enctype="multipart/form-data">
            @csrf
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">

                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="name" class="form-control"
                                   id="exampleInputEmail1" placeholder="" value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">E-mail</label>
                            <input type="text" name="email" class="form-control"
                                   id="exampleInputEmail1" placeholder="" value="{{old('email')}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputEmail1" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="is_admin" class="minimal" value="1">
                            </label>
                            <label>
                                Admin
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Avatar</label>
                            <input type="file" name="avatar" id="exampleInputFile">

                            <p class="help-block">  @include('admin.errors')</p>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{route('users.index')}}" class="btn btn-default">Back</a>
                    <button class="btn btn-success pull-right">Create</button>
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
