<html>
	<head>
		<title>Eventshare.net</title>
	</head>	
	<body>
		<h1>All Events</h1>		
		<?php 
			$ex = $event->result();
			foreach($ex as $row)
			{
				echo '<li><a href="'.base_url().'index.php/event/index/'.$row->event_id.'">'.$row->event_title.'</a></li>';
			}
		?>
	</body>
</html>