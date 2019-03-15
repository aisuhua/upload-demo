local upload = require "resty.upload"
local resty_sha1 = require "resty.sha1"
local resty_str = require "resty.string"

local chunk_size = 65535
local form = upload:new(chunk_size)
local sha1 = resty_sha1:new()
local file, file_name
local file_size = 0
local uploads_dir = "/www/web/upload-demo/lua-resty-upload/uploads/"

while true do
    local typ, res, err = form:read()

    if not typ then
        ngx.say("failed to read: ", err)
        return
    end

    if typ == "header" then
        local m = string.match(res[2], ";%s*filename=\"([^\"]+)\"")
        if m then
            file_name = m
            file = io.open(uploads_dir .. file_name, "w+")
            if not file then
                ngx.say("failed to open file ", file_name)
                return
            end
        end

    elseif typ == "body" then
        if file then
            file:write(res)
            sha1:update(res) -- Incrementing hash
            file_size = file_size + string.len(res)
        end

    elseif typ == "part_end" then
        file:close()
        file = nil
        local sha1_sum = sha1:final() -- Binary type
        local sha1_hex = resty_str.to_hex(sha1_sum)
        sha1:reset()

        -- Print test data
        -- ngx.say("file_path: ", uploads_dir .. file_name, "<br>")
        -- ngx.say("sha1: ", sha1_hex, "<br>")
        -- ngx.say("file_size: ", file_size, "<br>")

        -- Dispatcher data
        local result = {}
        result.file_name = file_name
        result.sha1 = sha1_hex
        result.file_size = file_size

        ngx.req.set_method(ngx.HTTP_GET)
        ngx.exec('/lua-resty-upload/upload.php', result)

    elseif typ == "eof" then
        break

    else
        -- do nothing
    end
end

