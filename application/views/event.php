<html>
	<head>
		<title>Eventshare.net</title>
	</head>	
	<body>
		<?php 
			if($event->num_rows() > 0)
			{
				$ex = $event->row();
			}
			if($uname->num_rows() > 0)
			{
				$ux = $uname->row();
			}
		?>
		<h1><?php echo $ex->event_title ; ?></h1>
		
		<div>
			<ul>
				<li><b>Posted By:</b><?php echo $ux->user_name; ?></li>
				<li><b>Location:</b><?php echo $ex->event_location; ?></li>
				<li><b>Hype:</b><?php echo $ex->event_hype; ?></li>
				<li><b>Date:</b><?php echo $ex->event_date; ?></li>
				<li><b>Starts At:</b><?php echo $ex->event_start_time; ?></li>
				<li><b>Ends At:</b><?php echo $ex->event_end_time; ?></li>
			</ul>	
			
			<h3>Upload Pictures</h3>
				<?php
					if ( $id == $ex->user_id )
					{
				?>
				
				<?php echo form_open_multipart('event/do_upload/'.$id.'/'.$ex->event_id);?>
					<input type="file" name="userfile" size="20" />
					<br /><br />
					<input type="submit" value="upload" />
				</form>
				<?php } ?>
			
		</div>
	</body>
</html>