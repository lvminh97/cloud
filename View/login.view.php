<?php if(!defined('__CONTROLLER__')) return; ?>
<?php getTemplate("header", $viewParams); ?>
<body>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('assets/img/login-bg.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="?action=loginAct">
					<img class="login100-form-logo" src="assets/img/books.png" >

					<span class="login100-form-title p-b-34 p-t-27">
						Đăng nhập vào QCloud
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="username" placeholder="Username" autocomplete="off" required>
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password" required>
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Ghi nhớ tôi
						</label>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="button" style="margin-right: 20px;" onclick="location.href='?site=signup'">
							Đăng ký
						</button>
						<button class="login100-form-btn" type="submit" name="loginBtn">
							Đăng nhập
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>