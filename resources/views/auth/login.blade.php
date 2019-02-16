@extends('pages.layout')
@section('content')
    <!--main content start-->
    <div class="main-content">
        @include('admin.errors')
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    <div class="leave-comment mr0"><!--leave comment-->
                        @if(session('login'))
                            <div class="alert alert-danger">
                                {{session('login')}}
                            </div>
                        @endif
                        <h3 class="text-uppercase">Login</h3>

                        <br>
                        <form class="form-horizontal contact-form" role="form" method="post"
                              action="{{route('login')}}">
                            @csrf
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" id="email" name="email"
                                           placeholder="Email" value="{{old('email')}}"
                                           class="form-control ">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="password" class="form-control "
                                           id="password" name="password" placeholder="password">
                                </div>
                            </div>
                            <button type="submit" class="btn send-btn">Login</button>

                        </form>
                    </div><!--end leave comment-->
                </div>
                    @include('pages.sidebar')
            </div>
        </div>
    </div>
    <!-- end main content-->
@endsection