<?php
/*
Plugin Name: Baidu XZH WordPress Plugin
Plugin URI: https://github.com/daoiqi/baidu-xzh-wordpress-plugin
Description: 百度熊掌号插件，改造页面使用。
Version: 1.0
Author: daoiqi
Author URI: https://github.com/daoiqi/baidu-xzh-wordpress-plugin
*/

add_filter('the_content', 'xzh_footer_show_json');
function xzh_footer_show_json($content) {
    if( !(is_single() || is_page()) ) {
        // 不是文章页，退出
        return $content;
    }

    $config = get_option( 'baidu_xzh_wordpress_plugin' );
    $appid = $config['APPID'];

    $str =  '
<script type="application/ld+json">
         {
            "@context": "https://ziyuan.baidu.com/contexts/cambrian.jsonld",
            "@id": "'. get_the_permalink() .'",
            "appid": "'. $appid        .'",
            "title": "'. get_the_title()   .'",
            "images": ["'. get_the_post_thumbnail_url()    .'"],
            "description": "'.  wp_trim_words( get_the_content(), 100, "…" ) .'",
            "pubDate": "'. get_the_time("Y-m-d\\TH:i:s")   .'"
    }
    </script>
';
    return $content. $str;
}


//插件设置菜单
add_action('admin_menu', 'baidu_xzh_wordpress_plugin_menu');
function baidu_xzh_wordpress_plugin_menu() {
    add_submenu_page(
        'options-general.php',
        '百度熊掌号 Baidu XZH WordPress Plugin',
        'Baidu XZH WordPress Plugin',
        'manage_options',
        'baidu_xzh_wordpress_plugin',
        'baidu_xzh_wordpress_plugin_options');
}
//设置页面
function baidu_xzh_wordpress_plugin_options() {
    if(isset($_POST['baidu_xzh_wordpress_plugin'])){
        $APPID		= trim($_POST['APPID']);

        $config = array(
            'APPID'		=> $APPID,
        );
        @update_option('baidu_xzh_wordpress_plugin', $config);

        $updated = '更新成功';
        echo '<div class="updated"><p>'.$updated.'</p></div>';
    }

    $config		= get_option('baidu_xzh_wordpress_plugin');

    echo '<div class="wrap">';
    echo '<h2>百度熊掌号 文章改造插件</h2>';
    echo '<div>github: <a target="_blank" href="https://github.com/daoiqi/baidu-xzh-wordpress-plugin">https://github.com/daoiqi/baidu-xzh-wordpress-plugin</a></div>';
    echo '<form method="post">';
    echo '<table class="form-table">';
    echo '<tr valign="top">';
    echo '<th scope="row">站点域名</th>';
    $site = home_url();
    echo '<td><input class="all-options" type="text" name="site" value="'.$site.'" /></td>';
    echo '</tr>';

    echo '<tr valign="top">';
    echo '<th scope="row">百度熊掌号 APPID</th>';
    echo '<td><input class="all-options" type="text" name="APPID" value="'.$config['APPID'].'" /></td>';
    echo '</tr>';

    echo '</table>';
    echo '<p class="submit">';
    echo '<input type="submit" name="baidu_xzh_wordpress_plugin" id="submit" class="button button-primary" value="保存更改" />';
    echo '</p>';
    echo '</form>';
    echo '<p><strong>使用提示</strong>：<br>
	1. 百度熊掌号 APPID 通过 百度搜索资源平台-熊掌号-提交方式-API提交-推送接口 > 接口调用地址获取；<br>
	2. 其它相关问题提交 <a target="_blank" href="https://github.com/daoiqi/baidu-xzh-wordpress-plugin/issues">Github issue</a><br>
	</p>';
    echo '</div>';
}
