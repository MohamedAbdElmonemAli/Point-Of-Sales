<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Point Of Sales</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('bower_components/morris/morris.css') }}">

    <!-- Theme style -->
    @if(direction() == 'ltr')
        <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
    @else
        <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
        <link rel="stylesheet" href="{{ asset('dist/css/rtl/AdminLTE.min.css')}}">
        <link rel="stylesheet" href="{{ asset('dist/css/rtl/bootstrap-rtl.min.css')}}">
        <link rel="stylesheet" href="{{ asset('dist/css/rtl/rtl.css')}}">
    @endif
    <link rel="stylesheet" href="{{asset('noty/lib/noty.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{url('admin/home')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>P</b>OS</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Point</b> Of Sales</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-language"></i></a>
                        <ul class="dropdown-menu">
                            <li>
                                {{--<!-- inner menu: contains the actual data -->--}}
                                <ul class="menu">
                                    <li><a href="{{ url('admin/lang/ar') }}" style="color: black;"><i class="fa fa-flag"
                                                                                                      style="color: black;"></i>
                                            عربى</a></li>
                                    <li><a href="{{ url('admin/lang/en') }}" style="color: red;"><i class="fa fa-flag"
                                                                                                       style="color: red;"></i>
                                            English</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>




                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->

                            <li class="user-body">
                                <div class="center-block">
                                    <a href="{{ route('logout') }}" style="color: white"
                                       onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <i class="btn btn-danger btn-flat">تسجيل الخروج</i>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                </ul>
            </div>
        </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{auth()->user()->first_name}} {{auth()->user()->last_name}}</p>
                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header"><i class="fa fa-dashboard"></i>{{trans('admin.dashboard')}}</li>

                @if(auth()->user()->hasPermission('read_categories'))
                    <li><a href="{{url(route('categories.index'))}}"><i class="fa fa-bars"></i>
                            <span>{{trans('admin.categories')}}</span></a></li>
                @endif

                @if(auth()->user()->hasPermission('read_products'))
                    <li><a href="{{url(route('products.index'))}}"><i class="fa fa-list"></i>
                            <span>{{trans('admin.products')}}</span></a></li>
                @endif

                @if(auth()->user()->hasPermission('read_clients'))
                    <li><a href="{{url(route('clients.index'))}}"><i class="fa fa-user-plus"></i>
                            <span>{{trans('admin.clients')}}</span></a></li>
                @endif

                @if(auth()->user()->hasPermission('read_orders'))
                    <li><a href="{{url(route('orders.index'))}}"><i class="fa fa-flag"></i>
                            <span>{{trans('admin.orders')}}</span></a></li>
                @endif

                @if(auth()->user()->hasPermission('read_users'))
                    <li><a href="{{url(route('users.index'))}}"><i class="fa fa-users"></i>
                            <span>{{trans('admin.users')}}</span></a></li>
                @endif
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @yield('content')
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.18
        </div>
        <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Control Sidebar -->

    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
<script type="text/javascript" src="{{asset('noty/lib/noty.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<script src="{{asset('js/custom/order.js')}}"></script>
<script src="{{asset('js/custom/image-preview.js')}}"></script>
<script src="{{asset('js/printThis.js')}}"></script>
<script src="{{asset('js/jquery.number.min.js')}}"></script>
<script src="{{asset('plugins/ckeditor/ckeditor.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('bower_components/morris/morris.min.js') }}"></script>

<script>

    $(document).ready(function () {
        $('.sidebar-menu').tree()

        $('.delete').click(function (e) {

            var that = $(this)

            e.preventDefault();

            var n = new Noty({
                text: "{{trans('admin.delete_confirm')}}",
                type: "warning",
                killer: true,
                buttons: [
                    Noty.button('{{trans('admin.yes')}}', 'btn btn-success mt-2 mr-2 ', function () {
                        that.closest('form').submit();
                    }),

                    Noty.button('{{trans('admin.no')}}', 'btn btn-danger mt-2 mr-2', function () {
                        n.close();
                    })
                ]


            })

            n.show();

        });



        CKEDITOR.config.language = "{{ app()->getLocale() }}";

    });


</script>
@stack('scripts')
</body>
</html>
