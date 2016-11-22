{include file="header.tpl"}
<script type="text/javascript" src="{$_STATIC_}/js/public/sysinfo-index.js"></script>
<!-- 标题栏 -->
	<div class="main-title">
		<h2>日志列表</h2>
	</div>
	
	<style>
		pre{  
			border: 0px solid #ccc;background-color: #f5f5f5;
		}
	</style>
    <!-- 数据列表 -->
    <div class="data-table table-striped">
		<table class="">
		    <thead>
				<tr>
					<th style="width: 5%;" colspan="1" rowspan="1">编号</th>
					<th rowspan="1">描述</th>
					<th style="width: 15%;" colspan="1" rowspan="1">日期</th>
					<th style="width: 5%;" colspan="1" rowspan="1">操作</th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$results.record item=item}
					<tr id="tr_{$item.id}">
						<td class="center">{$item.id}</td>
						<td style="text-align: left;">{$item.desc}</td>
						<td class="center">{$item.uptime}</td>
						<td class="center">
							<a title="" data-rel="tooltip" href="javascript:delById({$item.id});" data-method="delete" class="ajax-action btn btn-danger">移除</a>
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
