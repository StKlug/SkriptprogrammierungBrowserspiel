
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
				<form action="login_post.php">
					<br>
					<input type="text" name="email">
					<br>
					<input type="text" name="password">
					<br>
					<br>
					<br>
					<div align="center">
						<input type="submit" name="loginSub">
					</div>
				</form>
			</div>
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
				<form action="register_post.php">
					<input type="text" name="emailReg">
					<br>
					<input type="text" name="username">
					<br>
					<input type="text" name="passwordReg1">
					<br>
					<input type="text" name="passwordReg2">
					<br>
					<br>
					<div align="center">
						<input type="submit" name="regSub">
					</div>
					
				</form>
			</div>
		</div>
		<br style="clear: left;" />
	</div>