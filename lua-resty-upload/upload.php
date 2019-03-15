<?php

$file_name = $_GET['file_name'];
$sha1 = $_GET['sha1'];
$file_size = $_GET['file_size'];

var_dump($_GET);

/*/www/web/upload-demo/lua-resty-upload/upload.php:7:
array (size=3)
  'sha1' => string '60fde9c2310b0d4cad4dab8d126b04387efba289' (length=40)
  'file_name' => string '1.txt' (length=5)
  'file_size' => string '14' (length=2)*/