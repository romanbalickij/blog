@extends('pages.layout')
@section('content')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    @foreach($posts as $post)
                        <article class="post">
                            <div class="post-thumb">
                                <a href="{{route('post.show',$post->slug)}}"><img src="{{$post->getImage()}}"
                                                                                  alt=""></a>
                                <a href="{{route('post.show',$post->slug)}}" class="post-thumb-overlay text-center">
                                    <div class="text-uppercase text-center">View Post</div>
                                </a>
                            </div>


                            <div class="post-content">
                                <header class="entry-header text-center text-uppercase">
                                    @if($post->hasCategory())
                                       <h6><a href="{{route('category.show',$post->category->slug)}}">{{$post->getCategoryTitle()}}</a></h6>
                                    @else
                                        <h5>No categories</h5>
                                    @endif
                                    <h1 class="entry-title"><a
                                                href="{{route('post.show',$post->slug)}}">{{$post->title}}</a></h1>
                                </header>
                                <div class="entry-content">
                                    <p>
                                        {!! $post->description !!}
                                    </p>

                                    <div class="btn-continue-reading text-center text-uppercase">
                                        <a href="{{route('post.show',$post->slug)}}" class="more-link">Continue
                                            Reading</a>
                                    </div>
                                </div>
                                <div class="social-share">
                                    <span class="social-share-title pull-left text-capitalize">
                                            By <i>{{$post->postAuthor()}}</i>
                                         On {{$post->getDate()}}</span>
                                    <ul class="text-center pull-right">
                                        <div class="post-content mb-50">

                                            <div class="post-meta">
                                                <a href="{{route('post.show',$post->slug)}}">
                                                    <i class="fa fa-eye"></i>{{$post->views}}</a>

                                                <i class="fa fa-comments"></i>{{$post->commentCount()}}
                                            </div>

                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </article>
                    @endforeach
                    {{$posts->links()}}
                </div>
             @include('pages.sidebar')
            </div>
        </div>
    </div>
    <!-- end main content-->
@endsection