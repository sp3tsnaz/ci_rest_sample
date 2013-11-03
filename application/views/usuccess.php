<html>
<head>
<title>Upload Form</title>
</head>
<body>

<h3>Your file was successfully uploaded!</h3>

<ul>
<?php echo $upload_data['file_name']; ?>
</ul>

<p><?php echo anchor('profile/upload/'.$tid, 'Upload Another File!'); echo '<br/>'; 
		 echo anchor('login','Back To Profile');?></p>

</body>
</html>