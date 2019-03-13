<?php
// Uploading multiple files
// http://php.net/manual/en/function.move-uploaded-file.php#refsect1-function.move-uploaded-file-examples

// print_r($_FILES);

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