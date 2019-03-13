# 上传示例

## Basic

`basic` 是使用 HTML 表单 和 PHP 完成的最基本的上传示例。

默认情况下，Nginx 和 PHP 都会对上传文件的大小有所限制，Nginx 限制了 request body size 最大为 1M，PHP 限制了最大可上传文件为 2M。
所以，如果在不修改配置的情况下，该示例最大只能上传不能超过 1M 大小的文件。当然我们可以做一些修改，让其可以上传更大的文件。

将 Nginx 调整为支持更大的 request body：

```nginx
server{
    # ...
    client_max_body_size 128m;
}
```

修改 php.ini，让其能上传更大的文件：

```ini
# http://php.net/manual/en/ini.core.php#ini.post-max-size
post_max_size 128M
# http://php.net/manual/en/ini.core.php#ini.sect.file-uploads
upload_max_filesize 100M
```

经过这些调整后，此时可以上传 100M 以内的文件了。如果你想了解这些配置参数的意思，可以参考[这篇博客](https://blog.csdn.net/webnoties/article/details/17266651)。

### 问题

如果我要上传 50G 的文件怎么办？如果仅仅通过这些配置的调整，显然是不可行的。接下来我们将想办法解决这个问题。

