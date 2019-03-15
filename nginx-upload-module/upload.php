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
        $tmp_name = $_POST[$key . '_name'];

        if(!copy($tmp_file, "{$uploads_dir}/{$tmp_name}"))
        {
            echo "failed to copy {$tmp_file}...\n";
            continue;
        }

        unlink($tmp_file);
    }
}