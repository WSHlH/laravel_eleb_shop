<nav class="navbar navbar-collapse btn-info">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="glyphicon glyphicon-menu-hamburger"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand glyphicon glyphicon-grain" href="#">eleb</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{route('business.index')}}">饿了吧 <span class="sr-only">(current)</span></a></li>
                {{--<li class="active"><a href="">列表 <span class="sr-only">(current)</span></a></li>--}}
                {{--<li><a href="">添加</a></li>--}}
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Link<span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="#">Action</a></li>--}}
                        {{--<li><a href="#">Another action</a></li>--}}
                        {{--<li><a href="#">Something else here</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="#">Separated link</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="#">One more separated link</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            </ul>
            {{--<form class="navbar-form navbar-left">--}}
                {{--<div class="form-group">--}}
                    {{--<input type="text" class="form-control" placeholder="Search">--}}
                {{--</div>--}}
                {{--<button type="submit" class="btn btn-default">Submit</button>--}}
            {{--</form>--}}
            <ul class="nav navbar-nav navbar-right">
                @guest
                <li><a href="{{route('business.create')}}" style="color: #3471ef">注册</a></li>
                <li>&emsp;</li>
                <li><a href="{{route('login')}}" style="color: #3471ef">登录</a></li>
                @endguest
                @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商家名称 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">添加食品</a></li>
                        <li><a href="#">本店食品列表</a></li>
                        <li role="separator" class="divider"></li>
                        {{--{{route('businessList.show',['businessList'=>$businessList])}}--}}
                        <li><a href="">查看详细信息</a></li>
                        {{--{{route('businessList.edit')}}--}}
                        <li><a href="">修改信息</a></li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <form action="{{route('logout')}}" method="post">
                                <input type="submit" class="btn btn-link" value="退出登录">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                            </form>
                        </li>
                    </ul>
                </li>
                @endauth
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>