{include file="header.tpl"}
<script type="text/javascript" src="{$_STATIC_}/js/public/role-index.js"></script>
<!-- 标题栏 -->
<div class="main-title">
	<h2>角色列表</h2>
</div>
<div class="cf">
	<div class="fl">
        <a class="btn" href="/role/add">新 增</a>
    </div>
</div>
<!-- 数据列表 -->
<div class="data-table table-striped">
	<table>
    	<thead>
			<tr>
				<th>编号</th>
				<th>名称</th>
				<th>状态</th>
				<th>描述</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$result item=item name=d}
				<tr id="tr_{$item.id}">
					<td>{$smarty.foreach.d.iteration}</td>
					<td>{if $item.status==$request.STATUS_STV.STATUS_DISABLE}<s style="color:red;">{$item.name}</s>{else}{$item.name}{/if}</td>
					<td>{if $item.status==$request.STATUS_STV.STATUS_ENABLE}启用{else}禁用{/if}</td>
					<td>{$item.remark}</td>
					<td>
						<a class="btn" title=""  href="/admin-user/?rid={$item.id}" >列表</a>
						<a class="btn" title=""  href="/role/auth/?id={$item.id}" >授权</a>
						<a class="btn" title=""  href="/role/edit/?id={$item.id}">编辑</a>
						<a class="btn btn-warning" title=""  href="javascript:aduit({$item.id},{$item.status});">{if $item.status==$request.STATUS_STV.STATUS_ENABLE}禁用 {else}启用 {/if}</a>
						{if $item.id gt 0}
						<a class="btn btn-danger" title=""  href="javascript:delById({$item.id});" data-method="delete" >移除</a>
						{/if}
					</td>
				</tr>
				{/foreach}
		</tbody>
	</table>
</div>
{include file="footer.tpl"}
