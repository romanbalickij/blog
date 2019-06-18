@extends('admin.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Добавить пользователя
                <small>приятные слова..</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        <form action="{{route('permission.store')}}" method="post">
            @csrf
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Create Permission</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">name</label>
                            <input type="text"  name="name" class="form-control" id="exampleInputEmail1" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <input type="text" name="label" class="form-control" id="exampleInputEmail1" placeholder="">
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-default">Назад</button>
                    <button class="btn btn-success pull-right">Добавить</button>
                </div>
                <!-- /.box-footer-->
            </div>
        </form>
            <!-- Default box -->

            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @endsection