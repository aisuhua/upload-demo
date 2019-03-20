<?php

$session_id = empty($_SERVER['HTTP_X_SESSION_ID']) ? 0 : $_SERVER['HTTP_X_SESSION_ID'];
$content_range = empty($_SERVER['HTTP_X_CONTENT_RANGE']) ? '' : $_SERVER['HTTP_X_CONTENT_RANGE'];

$pattern = "/(\w+)\s(\d+)-(\d+)\/(\d+)/";
preg_match($pattern, $content_range, $match);

$chunk_unit = $match[1];
$chunk_start = $match[2];
$chunk_end = $match[3];
$file_size = $match[4];

$content = file_get_contents('php://input');

$uploads_dir = 'uploads';
$file_path = $uploads_dir . '/' . $session_id;

file_put_contents($file_path, $content, FILE_APPEND);

if ($file_size == $chunk_end)
{
    http_response_code(200);
    return;
}

http_response_code(201);




