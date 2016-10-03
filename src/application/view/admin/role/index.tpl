{include file="header.tpl"}
<script type="text/javascript" src="{$_STATIC_}/js/public/role-index.js"></script>
<!-- 标题栏 -->
<div class="main-title">
	<h2>{$_LANG_['role.index.title']}</h2>
</div>
<div class="cf">
	<div class="fl">
        <a class="btn" href="/role/add">{$_LANG_['role.index.add_role']}</a>
    </div>
</div>
<!-- 数据列表 -->
<div class="data-table table-striped">
	<table>
    	<thead>
			<tr>
				<th>{$_LANG_['framework.public.id']}</th>
				<th>{$_LANG_['role.index.role_name']}</th>
				<th>{$_LANG_['framework.public.state']}</th>
				<th>{$_LANG_['role.index.desc']}</th>
				<th>{$_LANG_['framework.public.action']}</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$result item=item name=d}
				<tr id="tr_{$item.id}">
					<td>{$smarty.foreach.d.iteration}</td>
					<td>{if $item.status==$request.STATUS_STV.STATUS_DISABLE}<s style="color:red;">{$item.name}</s>{else}{$item.name}{/if}</td>
					<td>{if $item.status==$request.STATUS_STV.STATUS_ENABLE}{$_LANG_['framework.public.enable']}{else}{$_LANG_['framework.public.disable']}{/if}</td>
					<td>{$item.remark}</td>
					<td>
						<a class="btn" title=""  href="/admin-user/?rid={$item.id}" >{$_LANG_['role.index.list']}</a>
						<a class="btn" title=""  href="/role/auth/?id={$item.id}" >{$_LANG_['role.index.authorization']}</a>
						<a class="btn" title=""  href="/role/edit/?id={$item.id}">{$_LANG_['framework.public.edit']}</a>
						<a class="btn btn-warning" title=""  href="javascript:aduit({$item.id},{$item.status});">{if $item.status==$request.STATUS_STV.STATUS_ENABLE}{$_LANG_['framework.public.disable']} {else}{$_LANG_['framework.public.enable']} {/if}</a>
						{if $item.id gt 0}
						<a class="btn btn-danger" title=""  href="javascript:delById({$item.id});" data-method="delete" >{$_LANG_['framework.public.delete']}</a>
						{/if}
					</td>
				</tr>
				{/foreach}
		</tbody>
	</table>
</div>
{include file="footer.tpl"}
