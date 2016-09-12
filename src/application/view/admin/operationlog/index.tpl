{include file="header.tpl"}
<script type="text/javascript" src="{$_STATIC_}/js/public/operationlog-index.js"></script>
<!-- 标题栏 -->
	<div class="main-title">
		<h2>操作日志</h2>
	</div>
    <!-- 数据列表 -->
    <div class="data-table table-striped">
	<table class="">
    <thead>
					<tr>
						<th style="width: 30px;" colspan="1" rowspan="1">编号</th>
						<th style="width: 60px;" colspan="1" rowspan="1">用户</th>
							<th colspan="1" rowspan="1">实体</th>
							<th colspan="1" rowspan="1">动作</th>
							<th colspan="1" rowspan="1">结果</th>
							<th colspan="1" rowspan="1">主键</th>
							<th style="width: 500px;" colspan="1" rowspan="1">备注</th>
							<th colspan="1" rowspan="1">IP</th>
							<th colspan="1" rowspan="1">时间</th>
							<th colspan="1" rowspan="1">操作</th>
						</tr>
				</thead>
				<tbody>
				{foreach from=$results.record item=item}
					<tr id="tr_{$item.id}">
						<td>{$item.id}</td>
							<td>{$item.realname}</td>
							<td>{$item.entity}</td>
							<td>{$item.action}</td>
							<td>{$item.status}</td>
							<td>{$item.pkid}</td>
							<td>{$item.desc}</td>

							<td>{$item.ip}</td>
							<td>{$item.time}</td>
							<td>
								<a class="btn btn-danger" title="" data-rel="tooltip" href="javascript:delById({$item.id});" data-method="delete" class="ajax-action">
									移除
								</a>
							</td>
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
