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
                <li class="active"><a href="{{route('businessList.show',\Illuminate\Support\Facades\Auth::user())}}">饿了吧 <span class="sr-only">(current)</span></a></li>
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
                <li><a href="#" data-toggle="modal" data-target=".bs-example-modal-sm">我要开店</a></li>
                {{--style="color: #3471ef"   {{route('business.create')}}--}}
                <li>&emsp;</li>
                <li><a href="{{route('login')}}" >登录</a></li>

                <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{--<h4 class="modal-title" id="mySmallModalLabel">注册店铺</h4>--}}
                            </div>
                            <div class="modal-body">
                                <form action="{{route('business.store')}}" method="post">
                                    <div class="form-group">
                                        <label for="shop_name">店铺名称</label>
                                        <input type="text" name="shop_name" class="form-control" id="shop_name" placeholder="请输入店铺名称">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">电话</label>
                                        <input type="text" name="phone" class="form-control" id="phone" placeholder="请输入电话号码">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">密码</label>
                                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="密码">
                                    </div>
                                    <div class="form-group">
                                        <label >确认密码</label>
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="确认密码">
                                    </div>
                                    <button type="submit" class="btn btn-default btn-block">注册店铺</button>
                                    {{csrf_field()}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                @endguest
                @auth
                <li><a href="{{route('food.index')}}" >食品列表</a></li>
                <li><a href="{{route('foodCategory.index')}}" >食品分类列表</a></li>
                <li class="dropdown">
                    {{--\Illuminate\Support\Facades\Auth::user()->phone   session()->get('name')--}}
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{\Illuminate\Support\Facades\Auth::user()->phone}}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        {{--<li><a href="{{route('food.index')}}">本店食品列表</a></li>--}}
                        {{--<li><a href="{{route('foodCategory.index')}}">食品分类列表</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        <li><a href="{{route('business.edit',['business'=>\Illuminate\Support\Facades\Auth::user()])}}">修改信息</a></li>
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