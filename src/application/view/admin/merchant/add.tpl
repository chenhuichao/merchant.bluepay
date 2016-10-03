{include file="header.tpl"}
<!-- 标题栏 -->
	<div class="main-title">
		<h2>{$_LANG_['merchant.index.add_merchant']}</h2>
	</div>
	{$info}
	<!-- 表单内容 -->
	<div class="tab-wrap">
		<div class="tab-content">
			<form  class="form-horizontal" action="/merchant/add/?action=do" method="post">
				{include file="merchant/_data.tpl"}
			</form>
		</div>
	</div>

{literal}
{/literal}
{include file="footer.tpl"}
