<?php

$uploads_dir = 'uploads';
$prefix = "picture";
$count = 2;

for ($i = 1; $i <= $count; $i++)
{
    $key = $prefix . $i;

    if ((array_key_exists($key. '_name', $_POST) &&
        array_key_exists($key . '_path', $_POST))
    )
    {
        $tmp_file = $_POST[$key . '_path'];
        $file_name = $_POST[$key . '_name'];

        if(!copy($tmp_file, "{$uploads_dir}/{$file_name}"))
        {
            echo "failed to copy {$tmp_file}...\n";
            continue;
        }

        unlink($tmp_file);
    }
}

var_dump($_POST);

/*/www/web/upload-demo/nginx-upload-module/upload.php:28:
array (size=10)
  'picture1_name' => string '1.png' (length=5)
  'picture1_content_type' => string 'image/png' (length=9)
  'picture1_path' => string '/www/web/upload-demo/nginx-upload-module/tmp/1/0000000001' (length=57)
  'picture1_md5' => string '764615c079cbb9a80a21c2ba81791cd0' (length=32)
  'picture1_size' => string '6781' (length=4)
  'picture2_name' => string '2.png' (length=5)
  'picture2_content_type' => string 'image/png' (length=9)
  'picture2_path' => string '/www/web/upload-demo/nginx-upload-module/tmp/2/0000000002' (length=57)
  'picture2_md5' => string '8abec7bc6c9caeecc869fcd94ee1b53a' (length=32)
  'picture2_size' => string '9274' (length=4)*/