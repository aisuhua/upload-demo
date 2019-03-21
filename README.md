# 文件上传示例

该示例的目的是为了学习文件上传，有基于 Nginx、Nginx + Lua、Nginx + PHP 等实现方法。

以下是 3 个普通上传的示例：

- 使用 HTML + PHP 实现的基本上传示例；
- 基于 OpenResty 的子模块 lua-resty-upload 实现的上传示例；
- 基于 Nginx C 扩展 nginx-upload-module 的上传示例；

## TODO

- 分片上传示例（支持断点续传）；

可以参考 [nginx-upload-module](https://github.com/fdintino/nginx-upload-module/blob/master/upload-protocol.md)、[tusd](https://tus.io/protocols/resumable-upload.html)

## Repositories

- [nginx-upload-module](https://github.com/fdintino/nginx-upload-module)
- [lua-resty-upload](https://github.com/openresty/lua-resty-upload)
- [nginx-big-upload](https://github.com/pgaertig/nginx-big-upload)
- [fileUploader](https://github.com/speich/fileUploader)
- [resumable.js](https://github.com/23/resumable.js)
- [tusd](https://github.com/tus/tusd)
- [jQuery-File-Upload](https://github.com/blueimp/jQuery-File-Upload)

## References

- [OpenResty](http://openresty.org)
- [OpenResty Reference](https://openresty-reference.readthedocs.io/en/latest/)
- [nginx 1.5+ file upload — best practices](https://stackoverflow.com/questions/22461341/nginx-1-5-file-upload-best-practices)
