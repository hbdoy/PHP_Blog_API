# PHP_Blog_API
## 詳細規格請看
https://hackmd.io/s/H1ct7kemW

## 使用須知
### Example
``127.0.0.1/login``

``127.0.0.1/posts``
### But
1. 注意``.htaccess``放的位置。
2. 如果要修改 rewrite 引導規則，須注意切割 URI 出來的陣列索引要調整。

``.htaccess``
```
<IfModule rewrite_module>
    # 轉向 test.php
    RewriteRule ^((?s).*)$ ptml/test.php [nc,qsa]
</IfModule>
```

## 尚未完善
- [x] error 訊息
- [ ] http status code
- [x] 跨域問題
