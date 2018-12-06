<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>柠檬盒登录</title>

<link rel="shortcut icon" href="/static/images/logo3.png">
<!-- Bootstrap -->
<link href="/static/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="/static/css/font-awesome.min.css" rel="stylesheet">
<!-- NProgress -->
<link href="/static/css/nprogress.css" rel="stylesheet">
<!-- Animate.css -->
<link href="/static/css/animate.min.css" rel="stylesheet">

<!-- Custom Theme Style -->
<link href="/static/css/custom.min.css" rel="stylesheet">
<script src="/static/js/jquery.min.js"></script>
</head>

<body style="background-image: url('https://wl2x7ve3z6yq9r6s.oss-cn-hangzhou.aliyuncs.com/2018-07-26/0e45ce6de4742fe881cbb23994b07aed.jpg');background-size: cover;" class="login"><div>
		<a class="hiddenanchor" id="signup"></a> <a class="hiddenanchor"
			id="signin"></a>

		<div class="login_wrapper">
			<div class="animate form login_form">
				<section class="login_content">
					<form id="loginForm">

						<h1 style="color:#000000 ; font-weight:bold; font-size:32px">柠 檬 盒 后 台 登 录</h1>
						<div>
							<input type="text" class="form-control" placeholder="请输入用户名"
								required="" id="username" name="username" />
						</div>
						<div>
							<input type="password" class="form-control" placeholder="请输入密码"
								required="" id="pwd" name="pwd" />
						</div>
						<div>
							<a class="btn btn-default submit" href="javascript:void(0);"
								style="width: 40%;font-size:20px" id="login">登   录</a>
						</div>
					</form>
		        </section>
        </div>
    </div>
</div>
	<script type="text/javascript">
		$("#login").click(function(){  
		    var username = $("#username").val();  
		    var pwd = $("#pwd").val();  
		    var msg = "";  
		    if(username == "") {
				msg = "用户名不能为空！";
				$("#username").focus();
		    } else if(pwd == "") {
				msg = "密码不能为空！";
				$("#pwd").focus();
		    }
		    if (msg != ""){  
		        alert(msg);  
		    }else{  
		    	var params = $("#loginForm").serialize();
		        // 发送登录的异步请求  
		        $.post("/admin/do_login", params, function(data, status){  
					//登录成功
					if(data.error == 0) {
						window.location.href = "/admin/home";
					} else {
						alert("账号密码错误，请重新登录！");
					}
		        }, "json");  
		    }  
		      
		});
        $(document).keydown(function(event){
            if(event.keyCode == 13){ //绑定回车
                $('#login').click(); //自动/触发登录按钮
            }
        });
    </script>
</body>
</html>