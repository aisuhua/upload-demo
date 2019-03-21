<?php
// 断点续传处理逻辑
echo file_get_contents($_POST['_path']);
print_r($_POST);

$uploads_dir = 'uploads';
copy($_POST['_path'], $uploads_dir . '/' . $_POST['_name']);

unlink($_POST['_path']);