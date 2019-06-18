@extends('admin.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Blank page
                <small>it all starts here</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Blank page</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Листинг сущности</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{route('permission.create')}}" class="btn btn-success">create</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>name</th>
                            <th>descriptions</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                   @foreach($permissions as $permission)
                        <tr>
                            <td>{{$permission->id}}</td>
                            <td>{{$permission->name}}</td>
                            <td>{{$permission->label}}</td>
                            <td><a href="edit.html" class="fa fa-pencil"></a>
                                <a href="#" class="fa fa-remove"></a></td>
                        </tr>
                    @endforeach
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@endsection

