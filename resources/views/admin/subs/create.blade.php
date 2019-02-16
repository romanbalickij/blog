@extends('admin.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Create Subscriber
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        <form action="{{route('subscribers.store')}}" method="POST">
            @csrf

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    @include('admin.errors')
                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="">
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{route('subscribers.index')}}" class="btn btn-default">Back</a>
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
