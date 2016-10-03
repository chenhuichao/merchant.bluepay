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
    <script src="{$_STATIC_}/js/jQuery/jquery-form.js"></script>
</head>

<script>
var JS_LANG = [];
JS_LANG['tips.confirm.delete'] = "{$_LANG_['js.tips.confrim.delete']}"; 
JS_LANG['tips.alert.title'] = "{$_LANG_['js.tips.alert.title']}"; 
JS_LANG['tips.alert.status'] = "{$_LANG_['js.tips.alert.status']}"; 
JS_LANG['js.tips.error.exec'] = "{$_LANG_['js.tips.error.exec']}"; 
JS_LANG['js.file.pick_file'] = "{$_LANG_['framework.public.pick_file']}"; 
JS_LANG['js.file.upload'] = "{$_LANG_['framework.public.upload']}"; 
JS_LANG['js.file.upload.file_ext'] = "{$_LANG_['framework.public.upload.file_ext']}";
JS_LANG['js.image.preview'] = "{$_LANG_['framework.public.image.preview']}";
</script>
{include file="menu.tpl"}