<!DOCTYPE html>
<html lang="en">
<head>
<!-- 头部 -->
@include('admin.header')
</head>
<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<!-- 导航栏 -->
			@include('admin.sidebar',['menu'=>'menu'])

			<!-- 头部小工具 -->
			@include('admin.navigation')

			<!-- 主内容 -->
			@section('content') @show

			<!-- 脚本 -->
			@include('admin.footer')
		</div>
	</div>


    <!-- Bootstrap -->
    <script src="/static/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="/static/js/fastclick.js"></script>
    <!-- NProgress -->
    <script src="/static/js/nprogress.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="/static/js/custom.min.js"></script>
    <script src="/static/js/icheck.min.js"></script>
    <script src="/static/js/layer.js"></script>
    <script src="/static/js/jquery.dataTables.min.js"></script>
	<script src="/static/js/template.js"></script>
	<script src="/static/js/laypage.js"></script>

	<!-- tool Scripts -->
	<script type="text/javascript" src="/static/js/tool.js"></script>
</body>
</html>
