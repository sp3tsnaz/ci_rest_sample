<html>
	<head>
		<title>Eventshare.net</title>
	</head>
	
	<body>
		
		<div id="content">
			<?php echo form_open('login/checkLogin'); ?>
			<h1>Login</h1>
			
			<?php
			echo '<br>';
			
			echo "Username: <input type='text' name='usr' maxlength='45'>";
			echo "Password: <input type='password' name='pwd' maxlength='15'>";
			echo form_submit('submitpwd', 'Login');
			
			echo '</form>';
			?>
		</div> <!-- div content -->
	</body>
</html>