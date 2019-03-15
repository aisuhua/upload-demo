<?php
// Uploading multiple files
// http://php.net/manual/en/function.move-uploaded-file.php#refsect1-function.move-uploaded-file-examples

$uploads_dir = 'uploads';
foreach ($_FILES["pictures"]["error"] as $key => $error)
{
    if ($error == UPLOAD_ERR_OK)
    {
        $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
        // basename() may prevent filesystem traversal attacks;
        // further validation/sanitation of the filename may be appropriate
        $name = basename($_FILES["pictures"]["name"][$key]);
        move_uploaded_file($tmp_name, "$uploads_dir/$name");
    }
}

var_dump($_FILES);

/*/www/web/upload-demo/basic/upload.php:18:
array (size=1)
  'pictures' =>
    array (size=5)
      'name' =>
        array (size=2)
          0 => string '1.png' (length=5)
          1 => string '2.png' (length=5)
      'type' =>
        array (size=2)
          0 => string 'image/png' (length=9)
          1 => string 'image/png' (length=9)
      'tmp_name' =>
        array (size=2)
          0 => string '/tmp/phpfQqplG' (length=14)
          1 => string '/tmp/phplRs0MZ' (length=14)
      'error' =>
        array (size=2)
          0 => int 0
          1 => int 0
      'size' =>
        array (size=2)
          0 => int 6781
          1 => int 9274*/
