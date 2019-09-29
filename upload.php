<?php
session_start();

$message = ''; 
if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Upload')
{
  if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK)
  {
    // get details of the uploaded file
    $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
    $fileName = $_FILES['uploadedFile']['name'];
    $fileSize = $_FILES['uploadedFile']['size'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // sanitize file-name
    //$newFileName = md5(time() . $fileName) . '.' . $fileExtension;

    // check if file has one of the following extensions
    $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc', 'GCode');

    if (in_array($fileExtension, $allowedfileExtensions))
    {
      // directory in which the uploaded file will be moved
      $uploadFileDir = './Archivos/';
      $dest_path = $uploadFileDir . $fileName;

      if(move_uploaded_file($fileTmpPath, $dest_path)) 
      {
        $message ='File is successfully uploaded.';
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
  }
  else
  {
    $message = 'There is some error in the file upload. Please check the following error.<br>';
    $message .= 'Error:' . $_FILES['uploadedFile']['error'];
  }
}
echo $message;
//header("Location: conversion.php");


$nombre = $_FILES['uploadedFile']['name'];

$fp = fopen("Archivos/".$nombre, 'r');
if (!$fp) {
    echo 'ERROR: No se puede abrir el archivo.'; exit;
}   else{
    echo '<br/>'.'Procesando archivo, espere...'.'<br/>';
}

$linea = 0;
$string2 = "G00 Z";

while(!feof($fp)){

    $original[$linea] = fgets($fp);
    $linea++;
    $fp++;

}
fclose($fp);
$lim=0;
$lim=$linea;
$linea=1;
$linea2=0;

while($linea<$lim){
    
    if(strncasecmp($original[$linea], $string2, 5) == 0){
        $auxiliar1 = substr( $original[$linea-1], 4);
        $auxiliar2 = substr( $original[$linea+1], 4);
        //echo $auxiliar1."<br/>";
        //echo $auxiliar2."<br/>";
        if(strcasecmp($auxiliar1, $auxiliar2) == 0){
            $linea+=3;
        }
    }
    $corregido[$linea2] = $original[$linea];
    //echo $corregido[$linea2]."<br/>";
    $linea++;
    $linea2++;
}

$fp = fopen("Archivos/"."Corregido-".$nombre, 'w');

$lim=$linea2;
$linea2=0;

while($linea2<$lim){
    fputs($fp, $corregido[$linea2]);
    $linea2++;
    $fp++;
}

fclose($fp);
echo "Terminado.";