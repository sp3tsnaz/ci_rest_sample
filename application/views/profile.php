<html>
	<head>			
			<title><?php	if($tname->num_rows() > 0 ) 
							{
								$tRow = $tname->row();
								echo $tRow->user_name.' - ' ;
							
					?>Eventshare.net
			</title>			
	</head>	
	<body>
			<h1><?php echo $tRow->user_name;} ?></h1>
			<?php if ($is_auth == '1'){ echo '<a href="'.base_url().'index.php/login/logOut'.'">LogOut</a><br/>';
										echo '<a href="'.base_url().'index.php/event/create/">Create a new event</a><br/>';
									  }?>
			
			<div>
				<h2>Events Posted By User</h2>
				<ul>
					<?php
						$ex = $events->result();
						foreach( $ex as $row ) {					
							echo '<li><a href="'.base_url().'index.php/event/index/'.$row->event_id.'">'.$row->event_title.'</a></li>';
						}
					?>						
				</ul>
			</div>		
	</body>
</html>