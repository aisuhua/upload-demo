# 文件上传示例

该示例的目的是为了学习文件上传，有基于 Nginx、Nginx + Lua、Nginx + PHP 等实现方法。

比较复杂算是分片上传，它要求支持断点续传，这要求客户端和服务端都需要做更多的数据校验和处理。

以下是 3 个普通上传的示例：

- 使用 HTML + PHP 实现的基本上传示例；
- 基于 OpenResty 的子模块 lua-resty-upload 实现的上传示例；
- 基于 Nginx C 扩展 nginx-upload-module 的上传示例；

## TODO

- 分片上传示例（支持断点续传）；

业内已经有相关的指导性文档，比如：[参考1](https://github.com/fdintino/nginx-upload-module/blob/master/upload-protocol.md)、[参考2](https://tus.io/protocols/resumable-upload.html)。

无论是哪一种处理方案，其实现的思路都是先将大文件切成多块，然后逐块上传或者多块并发上传。上传服务负责接收和合并这些小分块，最终合并成完整的文件。
如果上传过程中中断了，那么已上传完成的分块跳过，只需要上传那些没有上传的分块即可。

分片上传暂时不做 demo，只给出实现思路：

- 客户端本地计算文件哈希和大小
- 请求文件调度接口；
    - 判断文件是否可以秒传；
    - 获取上传服务器 IP（根据用户 IP 选择线路出口、根据上传服务器负载状态等信息选择最佳服务器）；
    - 为本次上传生成一个唯一标识（Session-ID）
- 将文件切成多大块。按照每大块为 6M，每个大块又切成 3 个 2M 的小块，如 20M 的文件会分成 4 个大块；
- 按顺序上传每个大块，即将大块所包含的多个小分块并发上传。（大分块必须按顺序上传，小分块可以并发乱序上传）；
- 上传服务将接收每个小分块的内容，并将其合并成大分块。
- 每个大分块上传完成后，上传服务要记录当前已上传完成的位置（offset）。
- 所有大分块上传完成后，文件上传完成。
- 如需续传，客户端会先请求上传服务获取已经上传完成的文件位置（offset），然后从该位置开始继续上传未上传的大分块。

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
