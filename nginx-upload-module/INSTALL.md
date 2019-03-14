# nginx-upload-module 的安装

[该模块](https://github.com/fdintino/nginx-upload-module)是一个 Nginx 的第三方扩展，
可以安装 Nginx 时编译成静态模块，也可以在安装后以动态模块的方式编译并加载使用。

## 编译成静态模块

需要在编译安装 Nginx 时，加入以下参数：

```bash
./configure --add-module=../nginx-upload-module-2.3.0
```

## 编辑成动态模块

此时下载的 Nginx 版本要跟当前已经安装的版本一致，另外编译参数也要与此前一样，可以通过 `nginx -V` 查看，如有问题可[参考这里](https://github.com/fdintino/nginx-upload-module/issues/103)。

```bash
./configure --add-dynamic-module=../nginx-upload-module-2.3.0
make modules
cp objs/ngx_http_upload_module.so /usr/share/nginx/modules/
echo "load_module modules/ngx_http_upload_module.so;" > /etc/nginx/modules-enabled/50-mod-http-upload.conf
```

## 后记

如编译过程中缺少一些扩展，可参考[这篇文章](https://makandracards.com/konjoot/38441-ubuntu-nginx-with-txid-module)解决。