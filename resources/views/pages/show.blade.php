@extends('pages.layout')
@section('content')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                   <!--registerr status-->
                    <article class="post">
                        <div class="post-thumb">
                            <i><img src="{{$post->getImage()}}" alt=""></i>

                        </div>
                        <div class="post-content">
                            <header class="entry-header text-center text-uppercase">
                                @if($post->hasCategory())
                                    <h6><a href="{{route('category.show',$post->category->slug)}}">{{$post->getCategoryTitle()}}</a></h6>
                                @else
                                    <h5>Категорий нет</h5>
                                @endif
                                <h1 class="entry-title">{{$post->title}}</h1>
                            </header>
                            <div class="entry-content">
                                <p>
                                  {!! $post->content !!}
                                </p>
                            </div>

                            <div class="decoration">
                                @foreach($post->tags as $tag)
                                    <a href="{{route('tag.show',$tag->slug)}}" class="btn btn-default">{{$tag->title}}</a>
                                @endforeach
                            </div>

                            <div class="social-share">
							<span
                                    class="social-share-title pull-left text-capitalize">By {{$post->postAuthor()}} On {{$post->getDate()}}</span>
                                <ul class="text-center pull-right">

                                </ul>
                            </div>
                        </div>
                    </article>
                    <div class="top-comment"><!--top comment-->
                        <img src="{{$post->author->getAvatar()}}"
                             class="pull-left img"  style=" height: 100px; width: 100px;"  alt="">
                        <h4>{{$post->postAuthor()}}</h4>

                        <p>{{$post->author->user_title}}</p>
                    </div><!--top comment end-->
                    <div class="row"><!--blog next previous-->
                        <div class="col-md-6">
                            @if($previousPost)
                                <div class="single-blog-box">
                                    <a href="{{route('post.show',$previousPost->slug)}}">
                                        <img src="{{$previousPost->getImage()}}" style="width: 210px; height: 160px;" alt="">

                                        <div class="overlay">

                                            <div class="promo-text">
                                                <p><i class=" pull-left fa fa-angle-left"></i></p>
                                                <h5>{{$previousPost->title}}</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            @if($nextPost)
                            <div class="single-blog-box">
                                <a href="{{route('post.show',$nextPost->slug)}}">
                                    <img src="{{$nextPost->getImage()}}" style="width: 210px; height: 160px;" alt="">
                                    <div class="overlay">
                                        <div class="promo-text">
                                            <p><i class=" pull-right fa fa-angle-right"></i></p>
                                            <h5>{{$nextPost->title}}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                           @endif
                        </div>
                    </div><!--blog next previous end-->
                    <div class="related-post-carousel"><!--related post carousel-->
                        <div class="related-heading">
                            <h4>You might also like</h4>
                        </div>
                        <div class="items">
                            @foreach($post->related() as  $item)
                                <div class="single-item">
                                <a href="{{route('post.show',$item->slug)}}">
                                    <img src="{{$item->getImage()}}" style="width: 210px; height: 160px;" alt="">

                                    <p>{{$item->title}}</p>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div><!--related post carousel-->
                        @unless($post->comment->isEmpty())
                            @foreach($post->getComments() as $comment)
                    <div class="bottom-comment"><!--bottom comment-->

                        <div class="comment-img">
                            <img class="img-circle" src="{{$comment->author->getAvatar()}}" alt="" width="75" height="75">
                        </div>

                        <div class="comment-text">
                            <h5>{{$comment->author->name}}</h5>

                            <p class="comment-date">
                               {{$comment->created_at->diffForHumans()}}
                            </p>


                            <p class="para">{{$comment->text}}</p>
                        </div>

                    </div>
                    <!-- end bottom comment-->
                           @endforeach
                        @endunless
                    @if(Auth::check())
                        @if(Auth::user()->status == 0)

                            <div class="leave-comment"><!--leave comment-->
                                <h4>Leave a reply</h4>
                                <form class="form-horizontal contact-form" role="form" method="POST"
                                      action="{{route('comment.user')}}">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                    <div class="form-group">
                                        <div class="col-md-12">
										<textarea class="form-control" rows="6" name="text"
                                                  placeholder="Write Massage"></textarea>
                                        </div>
                                    </div>
                                    <button class="btn send-btn">Post Comment</button>
                                </form>

                            </div><!--end leave comment-->

                      @endif
                   @endif
                </div>
                @include('pages.sidebar')
            </div>
        </div>
    </div>
    <!-- end main content-->
@endsection