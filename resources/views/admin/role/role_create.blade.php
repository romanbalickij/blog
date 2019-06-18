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
            <form action="{{route('role.store')}}" method="POST">
            @csrf


            <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Role Create</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="" value="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Label</label>
                                <input type="text" name="label" class="form-control" id="exampleInputEmail1" placeholder="" value="">
                            </div>
                            @foreach($permissions as $permission)
                                <div class="form-check">
                                    <input class="form-check-input" name="permission[]" type="checkbox"
                                           value="{{$permission->id}}" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        {{$permission->name}}
                                    </label>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button class="btn btn-default">Назад</button>
                        <button class="btn btn-warning pull-right">Изменить</button>
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
