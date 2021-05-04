<?php if (!defined('__CONTROLLER__')) return; ?>
<?php getTemplate("header", $viewParams); ?>

<body>
	<div class="container-login100" style="background-image: url('assets/img/login-bg.jpg');">
		<div class="wrap-login100">
			<div class="login100-form validate-form">
				<span class="login100-form-title p-b-34 p-t-27">
					Đăng ký tài khoản mới
				</span>
				<div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"> <i class="fa fa-user"></i> </span>
					</div>
					<input name="fullname" class="form-control" placeholder="Họ tên" type="text" required>
				</div>
				<div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
					</div>
					<input name="email" class="form-control" placeholder="Email" type="text">
				</div>
				<div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"> <i class="fa fa-user"></i> </span>
					</div>
					<input name="username" class="form-control" placeholder="Tên đăng nhập" type="text" required>
				</div>
				<div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
					</div>
					<input name="password" class="form-control" placeholder="Mật khẩu" type="password" required>
				</div>
				<div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
					</div>
					<input name="password2" class="form-control" placeholder="Xác nhận mật khẩu" type="password" required>
				</div>
				<div class="form-group input-group">
					<button class="btn btn-block btn-success" style="border-radius: 50px;" onclick="signup()">
						Đăng ký
					</button>
				</div>
			</div>
		</div>
	</div>
</body>

</html>