{include file="header.tpl"}
<!-- 标题栏 -->
	<div class="main-title">
		<h2>{$_LANG_['merchant.index.edit_merchant']}</h2>
	</div>
	{$info}
	<!-- 表单内容 -->
	<div class="tab-wrap">
		<div class="tab-content">
			<form action="/admin-user/edit/?action=do" method="post">
			<input type="hidden" name="id" value="{$record->id}" />
			{include file="merchant/_data.tpl"}
			</form>

		</div>
	</div>
</div>
{include file="footer.tpl"}