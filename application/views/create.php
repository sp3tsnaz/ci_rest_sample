<html>
	<head>
		<title>Create Event-Eventshare.net</title>
	</head>	
	<body>
		
		<h1>Create New Event</h1>
		
		<div>
			<?php echo form_open('event/doCreate'); 
			echo '<br>';			
			echo "Title: <input type='text' name='title' maxlength='45'><br/>";
			echo "Location: <input type='text' name='location' maxlength='60'><br/>";
			echo "Date: <input type='text' name='date' maxlength='15'><br/>";
			echo "Starts At: <input type='text' name='start' maxlength='15'><br/>";
			echo "Ends At: <input type='text' name='end' maxlength='15'><br/>";
			echo form_submit('create', 'Create');
			
			echo '</form>';
			?>			
		</div>
	</body>
</html>