@extends('admin.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Edit Post
                <small></small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <form method="POST" action="{{route('posts.update',$post->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
            <div class="box">
                <div class="box-header with-border">
                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder=""
                                   value="{{$post->title}}">
                        </div>
                        <div class="form-group">
                            <img src="{{$post->getImage()}}" alt="" class="img-responsive" width="200">
                            <label for="exampleInputFile">Image</label>
                            <input type="file"  name="image" id="exampleInputFile">

                            <p class="help-block">@include('admin.errors')</p>
                        </div>
                        <div class="form-group">
                            <label>Категория</label>
                            <select class="form-controle select2" name="category_id" style="width: 100%;">
                               @foreach($categories as $category)
                                <option  value="{{$category->id}}"
                                         {{$category->id == $post->category_id ? 'selected' : ''}} >
                                    {{$category->title}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Теги</label>
                            <select class="form-control select2" name="tags[]" multiple="multiple" data-placeholder="Выберите теги" style="width: 100%;">
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}" {{ $post->hasTag($tag->id) ? 'selected' : ''}}>
                                        {{$tag->title}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Date -->
                        <div class="form-group">
                            <label>Date:</label>

                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="date" class="form-control pull-right" id="datepicker"
                                       value="{{$post->date}}">
                            </div>
                            <!-- /.input group -->
                        </div>

                        <!-- checkbox -->
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="is_featured" class="minimal"
                                       {{$post->is_featured ? 'checked' : ''}}  value="1">
                            </label>
                            <label>
                                Recommend
                            </label>
                        </div>
                        <!-- checkbox -->
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="status" class="minimal"
                                        {{$post->status ? 'checked' : ''}} value="1">
                            </label>
                            <label>
                                Publish
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Text Description</label>
                            <textarea name="description" id="" cols="30" rows="10"
                                      class="form-control">{{$post->description}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Full text</label>
                            <textarea name="content" id="" cols="30" rows="10"
                                      class="form-control">{{$post->content}}</textarea>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <a href="{{route('posts.index')}}" class="btn btn-default">Back</a>
                    <button class="btn btn-warning pull-right">Update</button>
                </div>

                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
            </form>
            <!-- Default box -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection