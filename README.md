# Baidu XZH WordPress Plugin

## 安装
下载文件，解压缩到 WordPress 的插件目录下。

路径如下：`wp-content/plugins/baidu_xzh_wordpress_plugin/baidu_xzh_wordpress_plugin.php`


百度熊掌号文章改造插件。

针对单页文章、页面增加熊掌的 JSON_LD 改造。

```
<script type="application/ld+json">
     {
        "@context": "https://ziyuan.baidu.com/contexts/cambrian.jsonld",
        "@id": "https://ziyuan.baidu.com/college/articleinfo?id=1464",
        "appid": "1512321321312312",
        "title": "百度移动搜索落地页体验白皮书——广告篇2.0",
        "images": [""],
        "description": "优质合理的广告作为信息的补充，广受用户喜欢。2017年初百度用户体验部针对用户进行了满意度调研，发现很多恶意低质的广告严重破坏着用户的搜索体验。...",
        "pubDate": "2018-01-07T11:10:50"
    }
    </script>
```
