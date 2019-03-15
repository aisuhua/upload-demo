# 基于 Lua + Nginx 的上传示例

该示例演示了使用 [OpenResty][1] 的子模块 [lua-resty-upload][2] 实现文件上传的功能。

该扩展能实现流式读取和处理上传的文件分块，因此理论上能支持上传无限大的文件。以下是项目维护者一些相关描述：

> lua-resty-upload is designed for streaming processing (that is, strictly non-buffered reading huge request bodies received in data chunks)
> This library supports non-buffered uploading (or streaming uploading), which means it can handle infinite upload data streams in a single connection and with constant memory footprint, at least in theory.
> [出处][3]

实际上，如果要上传大的文件，实际上还是会受到 `client_max_body_size` 参数的限制，因此根据业务需求调整该参数大小即可。

## 示例说明

请参考 [INSTALL](INSTALL.md) 先安装好 OpenResty 环境，它自带了一个 Nginx 版本。
接着使用 nginx.conf 配置好环境，其中 upload.lua 是处理上传的主要脚本，它会一点点读取上传的内容，
然后写到 uploads 目录，写入完毕后会计算文件的 sha1 和 file_size，最后会将这些信息传递给的业务处理脚本 upload.php。

自己测试过上传超过 5G 大小的文件其实很轻松，但是也注意到上传进程在处理上传时 CPU 负载也会飙得比较高。

综合来讲，该 lua 扩展在处理上传上还是很不错的选择，其实我们在生产环境也正在使用。

- [1]: http://openresty.org
- [2]: https://github.com/openresty/lua-resty-upload
- [3]: https://github.com/openresty/lua-resty-upload/issues/8


