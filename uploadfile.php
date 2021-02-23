<?php

	$message = ''; 
    $fileTmpPath = $_FILES['userpic']['tmp_name'];
    $fileName = $_FILES['userpic']['name'];
    $fileSize = $_FILES['userpic']['size'];
    $fileType = $_FILES['userpic']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
 
    // sanitize file-name
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
 
    // check if file has one of the following extensions
    $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg', 'svg');
    if (in_array($fileExtension, $allowedfileExtensions))
    {
      // directory in which the uploaded file will be moved
      $uploadFileDir = './uploads/';
      $dest_path = $uploadFileDir . $newFileName;
 
      if(move_uploaded_file($fileTmpPath, $dest_path)) 
      {
        $message ='File is successfully uploaded.';
        echo $newFileName;
      }
      else
      {
        $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
      }
    }
    else
    {
      $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
    }
?>