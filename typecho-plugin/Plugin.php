<?php
/**
 * Chinese
 *
 * @package Typecho Chinese Plugin
 * @author Kokororin
 * @version 1.0
 * @link https://kotori.love
 */

class Chinese_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件
     */
    public static function activate()
    {
        Typecho_Plugin::factory('Widget_Archive')->beforeRender = array('Chinese_Plugin', 'before');
        Typecho_Plugin::factory('Widget_Archive')->footer       = array('Chinese_Plugin', 'insertScript');
    }

    /**
     * 禁用插件
     */
    public static function deactivate()
    {
    }

    /**
     * 插件设置
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
    }

    public static function personalConfig(Typecho_Widget_Helper_Form $form)
    {
    }

    public static function before($archive)
    {
        require_once dirname(__FILE__) . '/chinese.php';
        ob_start('chinese_convert');
    }

    public static function insertScript($widget)
    {
        $json = json_encode(array(
            'remember_author' => Typecho_Cookie::get('__typecho_remember_author'),
            'remember_mail'   => Typecho_Cookie::get('__typecho_remember_mail'),
            'remember_url'    => Typecho_Cookie::get('__typecho_remember_url')));
        $script = "<script id=\"typecho-chinese-plugin\" type=\"text/javascript\">
//<![CDATA[
var chinese = {$json};
!function() {
    var author = document.getElementById('author');
    var mail = document.getElementById('mail');
    var url = document.getElementById('url');
    if (author) author.value = chinese.remember_author;
    if (mail) mail.value = chinese.remember_mail;
    if (url) url.value = chinese.remember_url;
}();
//]]>
</script>";
        echo $script;
    }

}
