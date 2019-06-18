@extends('admin.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
               Posts
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                    @include('admin.errors')
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @can('edit_forum')
                        <div class="form-group">
                            <a href="{{route('posts.create')}}" class="btn btn-success">Create post</a>
                        </div>
                    @endcan
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>title</th>
                            <th>Categories</th>
                            <th>Tags</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($posts as $post)
                                <td>{{$post->id}}</td>
                                <td>{{$post->title}}</td>
                                <td>{{$post->getCategoryTitle()}}</td>
                                <td>{{$post->tagsTitle()}}</td>
                                <td>
                                    <img src="{{$post->getImage()}}" alt="" class="img-responsive" width="150"
                                         height="150">
                                </td>
                                <td><a href="{{route('posts.edit',$post->id)}}" class="fa fa-pencil"></a>
                                    <form method="POST" action="{{route('posts.destroy',$post->id)}}">
                                        @method('DELETE')
                                        @csrf
                                        <button  type="submit" class="delete">
                                            <i class="fa fa-remove"></i>
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