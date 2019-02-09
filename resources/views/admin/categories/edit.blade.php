@extends('admin.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Поміняти категорію
                <small></small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <form method="POST" action="{{route('categories.update',$category->id)}}">
            @csrf
            @method('PATCH')
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                        @include('admin.errors')
                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Імя</label>
                            <input type="text" class="form-control" id="exampleInputEmail1"
                                 name="title"  placeholder="" value="{{$category->title}}">
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{route('categories.index')}}" class="btn btn-default">Назад</a>
                    <button class="btn btn-warning pull-right">Поміняти</button>
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