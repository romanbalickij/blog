<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- favicon icon -->

    <title>Blog</title>

    <!-- common css -->
    <link rel="stylesheet" href="/css/front.css">
    <style media="screen">
        .active {
            text-decoration: underline;
            color: red;
        }
    </style>

    <!-- HTML5 shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.js"></script>
    <![endif]-->

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/images/favicon.png">

</head>

<body>

<nav class="navbar main-menu navbar-default">
    <div class="container">
        <div class="menu-content">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>


            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav text-uppercase">
                    <li><a href="/">Homepage</a></li>

                </ul>

                <ul class="nav navbar-nav text-uppercase pull-right">
                    @if(Auth::check())
                        <li><a href="{{route('user.profile')}}">My profile</a></li>

                        <li><a href="{{route('users.logout')}}">Logout</a></li>
                    @else
                        <li><a href="{{route('register.form')}}">Register</a></li>

                        <li><a href="{{route('login.form')}}">Login</a></li>

                    @endif

                </ul>
            </div>
            <!-- /.navbar-collapse -->


            <div class="show-search">
                <form role="search" method="get" id="searchform" action="#">
                    <div>
                        <input type="text" placeholder="Search and hit enter..." name="s" id="s">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-12">
        </div>
    </div>
</div>
@yield('content')
<!--footer start-->
<div id="footer">
    <div class="footer-instagram-section">
        <h3 class="footer-instagram-title text-center text-uppercase"></h3>

        <div id="footer-instagram" class="owl-carousel">

            <div class="item">
                <a href="#"><img src="/images/ins-1.jpg" alt=""></a>
            </div>
            <div class="item">
                <a href="#"><img src="images/ins-2.jpg" alt=""></a>
            </div>
            <div class="item">
                <a href="#"><img src="/images/ins-3.jpg" alt=""></a>
            </div>
            <div class="item">
                <a href="#"><img src="/images/ins-4.jpg" alt=""></a>
            </div>
            <div class="item">
                <a href="#"><img src="/images/ins-5.jpg" alt=""></a>
            </div>
            <div class="item">
                <a href="#"><img src="/images/ins-6.jpg" alt=""></a>
            </div>
            <div class="item">
                <a href="#"><img src="/images/ins-7.jpg" alt=""></a>
            </div>
            <div class="item">
                <a href="#"><img src="/images/ins-8.jpg" alt=""></a>
            </div>

        </div>
    </div>
</div>

<footer class="footer-widget-section">
    <div class="container">
        <div class="row">
        </div>
    </div>
</footer>
<!-- js files -->
<script type="text/javascript" src="/js/front.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    $(document).ready(function () {
        $('.like').click(function (e) {
            e.preventDefault();
            console.log(e);
            var isLike = event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this post' : 'Like' : event.target.innerText == 'Dislike' ? 'You dont like this post' : 'Dislike';
            if (isLike) {
               // event.target.nextElementSibling.innerText = 'Dislike';
            } else {
                event.target.previousElementSibling.innerText = 'Like';
            }
            var like = e.target.previousElementSibling == null;
            var postid = e.target.parentNode.dataset['postid'];
            var data = {
                isLike: like,
                post_id: postid,
            };
            axios.post('/like', data).then(response =>{
                e.currentTarget.className = 'fa fa-thumbs-up like active'

            });
        });
    });
    
</script>
</body>
