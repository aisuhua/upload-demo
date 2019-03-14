# Nginx 上传扩展使用示例

要运行该示例，需要先安装好 [nginx-upload-module][1] 扩展，可参考 [INSTALL](INSTALL.md) 完成安装。

该扩展通过 Nginx 扩展的形式完成文件上传，因此它不需要 PHP 做上传处理，但我们会利用 PHP 做文件上传完成后的业务处理。

可以通过一系列指令来控制上传的行为，比如：文件的存储位置、上传后文件信息发送到哪里等等，参考官方文档即可。

## 项目初始化

tmp 目录需要创建 0-9 个子目录用于存放上传后的文件

```bash
mkdir tmp/{1,2,3,4,5,6,7,8,9}
```

Nginx 对 tmp 和 uploads 目录需要有写入权限，可以将它们的所有者修改为 www-data （假设以该用户运行 Nginx）。
 
```bash
chmod -R www-data tmp uploads
```

## Nginx 配置

```nginx
server {
    listen 80;
    server_name upload.example.com;

    client_max_body_size 100m;
    
    root /path/to/upload-demo;
    index index.html index.htm index.php;

    location / {
        try_files $uri $uri/ =404;
    }
    
    location /upload {
        # Pass altered request body to this location
        upload_pass /nginx-upload-module/upload.php;
    
        # Store files to this directory
        # The directory is hashed, subdirectories 0 1 2 3 4 5 6 7 8 9 should exist
        upload_store /path/to/upload-demo/nginx-upload-module/tmp 1;
    
        # Allow uploaded files to be read only by user
        upload_store_access user:r;
    
        # Set specified fields in request body
        upload_set_form_field $upload_field_name.name "$upload_file_name";
        upload_set_form_field $upload_field_name.content_type "$upload_content_type";
        upload_set_form_field $upload_field_name.path "$upload_tmp_path";
    
        # Inform backend about hash and size of a file
        upload_aggregate_form_field "$upload_field_name.md5" "$upload_file_md5";
        upload_aggregate_form_field "$upload_field_name.size" "$upload_file_size";
    
        upload_pass_form_field "^submit$|^description$";
    
        upload_cleanup 400 404 499 500-505;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass 127.0.0.1:9000;
    }
}
```

参数说明

- `upload_pass` 上传完成后转发到的业务处理地址
- `upload_store` 上传后文件的存储地址

## 解析

该扩展理论上来讲比使用 PHP 上传效率要高，因为它在 Nginx 这一层就完成了上传操作。
如果需要上传比较大的文件，只需要调整 `client_max_body_size` 配置即可。

对于如何上传超过 50G 的文件，我们将尝试使用该扩展并结合[断点续传技术][2]来解决。

[1]: https://github.com/fdintino/nginx-upload-module
[2]: https://github.com/fdintino/nginx-upload-module/blob/master/upload-protocol.md