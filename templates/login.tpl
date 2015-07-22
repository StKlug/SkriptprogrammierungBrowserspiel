
	<br>
	<br>
	<div style="width: 850px;">
		<div id="Login" style="float: left; width: 250px; margin-left: 250px;">
			<h2>Login</h2>
			<br>
			<div style="float: left;">
				<br>
				<label>EMail:</label>
				<br>
				<label>Password:</label>
			</div>
			<div>
				<form id="loginForm" action="login_post.php">
					<br>
					<input type="email" name="email" id="emailLogin">
					<br>
					<input type="password" name="password" id="passwordLogin">
					<br>
					<br>
					<br>
					<div align="center">
						<input type="submit" name="loginSub">
					</div>
				</form>
			</div>
			<div id="errorLogin"></div>
		</div>
		<div id="Register" style="float: left; width: 350px;">
			<h2>Register</h2>
			<br>
			<div style="float: left;">
				<label>EMail:</label><br>
				<label>Username:</label><br>
				<label>Password:</label><br>
				<label>Password wiederholen:</label>
			</div>
			<div>
				<form id="regForm" action="register_post.php">
					<input type="email" name="emailReg" id="emailReg">
					<br>
					<input type="text" name="usernameReg" id="usernameReg">
					<br>
					<input type="password" name="passwordReg1" id="passwordReg1">
					<br>
					<input type="password" name="passwordReg2" id="passwordReg2">
					<br>
					<br>
					<div align="center">
						<input type="submit" name="regSub">
					</div>
				</form>
				<script src="scripts/regFormCheck.js"></script>
			</div>
			<div id="errorReg"></div>	
		</div>
		<br style="clear: left;" />
	</div>
