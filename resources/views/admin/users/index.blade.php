@extends('admin.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
               Users
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
                    <h3 class="box-title"></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{route('users.create')}}" class="btn btn-success">Create User</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Avatar</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                       @foreach($users as $user )
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if($user->avatar == null)
                                    <img src="/uploads/no-image.png" alt="" class="img-responsive" width="150"
                                         height="100">
                                @else
                                    <img src="/uploads/{{$user->avatar}}" alt="" class="img-responsive" width="150"
                                         height="100">
                                @endif
                            </td>
                            <td><a href="{{route('users.edit',$user->id)}}" class="fa fa-pencil"></a>

                                @if($user->status == 1)
                                    <a href="{{route('users.toggle',$user->id)}}" class="fa fa-lock"></a>
                                @else

                                    <a href="{{route('users.toggle',$user->id)}}" class="fa fa-thumbs-o-up"></a>
                                @endif
                                <form method="POST" action="{{route('users.destroy',$user->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                </form>
                            </td>
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