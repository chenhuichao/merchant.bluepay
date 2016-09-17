<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{$_LANG_['system.name']}</title>
    <link rel="stylesheet" type="text/css" href="{$_STATIC_}/css/bootstrap.css" media="all">
    <link rel="stylesheet" type="text/css" href="{$_STATIC_}/css/bootstrap-theme.css" media="all">
    <link rel="stylesheet" type="text/css" href="{$_STATIC_}/css/base.css" media="all">
    <link rel="stylesheet" type="text/css" href="{$_STATIC_}/css/common.css" media="all">
    <link rel="stylesheet" type="text/css" href="{$_STATIC_}/css/module.css">
    <link rel="stylesheet" type="text/css" href="{$_STATIC_}/css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="{$_STATIC_}/css/default_color.css" media="all">
    <link href="{$_STATIC_}/datetimepicker/css/datetimepicker.css" rel="stylesheet" type="text/css">
    <link href="{$_STATIC_}/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">
    <link href="{$_STATIC_}/css/artDialog/skins/default.css" rel="stylesheet" />

	<script src="{$_STATIC_}/js/jquery.min.js"></script>
    <script type="text/rocketscript" src="{$_STATIC_}/js/jquery.mousewheel.js"></script>
    <script src="{$_STATIC_}/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{$_STATIC_}/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="{$_STATIC_}/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
    <script type="text/javascript" src="{$_STATIC_}/js/artDialog/jquery.artDialog.js"></script>
    <script type="text/javascript" src="{$_STATIC_}/js/plupload/plupload.js"></script>
</head>
<style>
        /*上传删除浮层*/
    .delate-image-fuceng{
        width: 20px;height: 22px;background-image:url("{$_STATIC_}/images/opa-icons-red32.png");  position: absolute;top: -3px;right:-1px;cursor: pointer;filter:alpha(opacity=70);
        -moz-opacity:0.7;
        -khtml-opacity: 0.7;
        opacity: 0.7;z-index: 1;
        background-position: -390px -36px;
        display: none}
    .delate-image-fuceng span{
        color: #ff0000;display: block;width: 5px;float: left;margin-top:-1px; margin-right: -1px;}
</style>
<script>
var JS_LANG = [];
JS_LANG['tips.confirm.delete'] = "{$_LANG_['js.tips.confrim.delete']}"; 
JS_LANG['js.tips.error.exec'] = "{$_LANG_['js.tips.error.exec']}"; 
JS_LANG['js.file.pick_file'] = "{$_LANG_['framework.public.pick_file']}"; 
JS_LANG['js.file.upload'] = "{$_LANG_['framework.public.upload']}"; 
</script>
{include file="menu.tpl"}