@extends('admin.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
             Теги
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
                    <h3 class="box-title">Теги</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{route('tags.create')}}" class="btn btn-success">Добавити</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Імя</th>
                            <th>Дія</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($tags as $tag)
                                <td> {{$tag->id}}</td>
                                <td>{{$tag->title}}</td>
                                <td><a href="{{route('tags.edit',$tag->id)}}" class="fa fa-pencil"></a>
                                    <form  method="post" action="{{route('tags.destroy',$tag->id)}}">
                                        @method('delete')
                                        @csrf
                                        <button  type="submit" class="delete">
                                            <i class="fa fa-remove" ></i>
                                        </button>
                                    </form>
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