# 安装 lua-resty-upload

[lua-resty-upload](https://github.com/openresty/lua-resty-upload) 是基于 [OpenResty](http://openresty.org) 开发的一个功能模块，因此需要先安装好 OpenResty。

## 安装 OpenResty 

在安装 OpenResty 前需要先将已有的 nginx 停止掉，因为 OpenResty 有自带一个增强的 nginx 版本。

安装步骤请参考 [Installation](https://openresty.org/en/linux-packages.html)

安装完成后，nginx 位于 `/usr/local/openresty/nginx/` 目录，它的使用方法与官网版本一样，但增加了对 Lua 的支持。
将 nginx 的路径加入到 `path`，让它成为默认使用的版本。

```bash
PATH=/usr/local/openresty/nginx/sbin:$PATH
export PATH
```

## 配置 lua-resty-upload

克隆项目代码

```bash
git clone git@github.com:openresty/lua-resty-upload.git
```

添加 nginx 配置使用该 lua 脚本处理上传

```nginx
lua_package_path "/www/web/lua-resty-upload/lib/?.lua;;";

server {
    listen 80;
    server_name upload.example.com;
    
    location /test {
        default_type text/html;
        content_by_lua '
            ngx.say("<p>hello, world</p>")
        ';
    }
}
```

添加测试表单

```html
<form action="/test" method="POST" enctype="multipart/form-data">
    <input type="file" name="picture1" />
    <input type="submit"/>
</form>
```

自行测试文件上传，观察效果。
