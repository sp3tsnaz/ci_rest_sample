<html>
	<head>
		<title>Gamedev '11 - Upload</title>
	</head>	
	<body>
		<h1>Upload Your Images</h1>
		<p>
		<?php echo form_open_multipart('profile/do_upload/'.$teamID);?>
			<input type="file" name="userfile" size="20" />
			<br /><br />
			<input type="submit" value="upload" />
		</form>
	</body>
</html>