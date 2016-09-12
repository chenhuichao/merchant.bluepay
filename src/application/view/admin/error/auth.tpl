{include file="header.tpl"}

<div class="main-title">
	<h2>错误提示</h2>
</div>
<div class="cf">
<h5 style="margin-bottom: 8px;">错误信息<h5>
<p>{$info}</p>
{if isset($_REFER_)}<a href="{$_REFER_}">返回</a>{/if}
</div>
{include file="footer.tpl"}
