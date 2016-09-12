{include file="header.tpl"}
<!-- 标题栏 -->
	<div class="main-title">
		<h2>登陆日志</h2>
	</div>

    <!-- 数据列表 -->
    <div class="data-table table-striped">
	<table class="">
    <thead>
					<tr>
						<th style="width: 30px;" colspan="1" rowspan="1">编号</th>
						<th style="width: 80px;" colspan="1" rowspan="1">用户</th>
						<th style="width: 80px;" colspan="1" rowspan="1">IP</th>
						<th style="width: 80px;" colspan="1" rowspan="1">状态</th>
						<th style="width: 30px;" colspan="1" rowspan="1">时间</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$results.record item=item}
					<tr id="tr_{$item.id}">
						<td class="center">{$item.id}</td>
						<td class="center">{if empty($item.realname)}<span
							style="color: red;">ERROR</span>{else}{$item.realname}{/if}
						</td>
						<td class="center">{$item.ip}</td>
						<td class="center">{if $item.state == '1'}Y{else}<span
							style="color: red;">N</span>{/if}
						</td>
						<td class="center">{$item.time}</td>
					</tr>
					{/foreach}
				</tbody>
			</table>
		</div>
		<div class="page">
			<div>  
			{$results.pages} 
			<span class="rows">共 {$results.total} 条记录</span>
			</div>
		</div>
{include file="footer.tpl"}
