{include file="header.tpl"}

<div class="main-title">
	<h2>{$_LANG_['framework.public.error.title']}</h2>
</div>
<div class="cf">
<h5 style="margin-bottom: 8px;">{$_LANG_['framework.public.error.info']}<h5>
<p>{$info}</p>
{if isset($_REFER_)}<a href="{$_REFER_}">{$_LANG_['framework.public.return']}</a>{/if}
</div>
{include file="footer.tpl"}
