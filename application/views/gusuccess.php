<html>
<head>
<title>Upload Form</title>
</head>
<body>

<h3>Your game file was successfully uploaded!</h3>

<ul>
<?php echo $upload_data['file_name']; ?>
</ul>

<p><?php echo anchor('login','Back To Profile');?></p>

</body>
</html>