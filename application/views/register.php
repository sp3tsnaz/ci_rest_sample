<html>
	<head>
		<title>Eventshare.net-Register</title>
	</head>
	
	<body>
		
		<div id="content">
			<?php echo form_open('register/sub'); ?>
			<h1>Register To Upload Game</h1>
			
			<?php
			echo '<br>';			
			echo "Title: <input type='text' name='usr' maxlength='15'><br/>";
			echo "Location: <input type='text' name='usr' maxlength='15'><br/>";
			echo "Date: <input type='text' name='usr' maxlength='15'><br/>";
			echo "Starts At: <input type='text' name='usr' maxlength='15'><br/>";
			echo "Ends At: <input type='text' name='usr' maxlength='15'><br/>";
			echo form_submit('create', 'Create');
			
			echo '</form>';
			?>
		</div> <!-- div content -->
	</body>
</html>