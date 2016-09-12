{include file="header.tpl"}
<script type="text/javascript" src="{$_STATIC_}/js/public/node-index.js"></script>
<!-- 标题栏 -->
	<div class="main-title">
		<h2>节点列表</h2>
	</div>
	<div class="cf">
		<div class="fl">
            <a class="btn" href="/node/add">新 增</a>
        </div>

        <!-- 高级搜索 
		<div class="search-form fr cf">
			<div class="sleft">
				<input type="text" name="nickname" class="search-input" value="" placeholder="请输入用户昵称或者ID">
				<a class="sch-btn" href="javascript:;" id="search" url="/admin.php?s=/User/index.html"><i class="btn-search"></i></a>
			</div>
		</div>-->
    </div>
    <!-- 数据列表 -->
    <div class="data-table table-striped">
	<table>
    <thead>
				<tr>
					<th  colspan="1" rowspan="1">编号</th>
					<th  colspan="1" rowspan="1">名称【控制器】</th>
					<th  colspan="1" rowspan="1">【动作】</th>
					<th  colspan="1" rowspan="1">【子菜单Type值】</th>
					<th  colspan="1" rowspan="1">描述</th>
					<th  colspan="1" rowspan="1">状态</th>
					<th  colspan="1" rowspan="1">排序</th>
					<th  colspan="1" rowspan="1">PID</th>
					<th  colspan="1" rowspan="1">所属模块</th>
					<th  colspan="1" rowspan="1">备注</th>
					<th  colspan="1" rowspan="1">操作</th>
				</tr>
				</thead>
				<tbody>
					{foreach from=$result item=item}
						<tr id="tr_{$item.id}">
							<td>{$item.id}</td>
							<td>
								{if $item.status=='1'}{$item.name}{else}<s style="color:red;">{$item.name}</s>{/if}
							</td>
							<td>
								{if $item.status=='1'}{$item.action}{else}<s style="color:red;">{$item.action}</s>{/if}
							</td>
							<td>
								{if $item.status=='1'}{$item.type}{else}<s style="color:red;">{$item.type}</s>{/if}
							</td>
							<td>
								{$item.title}
							</td>
							<td>
								{if $item.status=='1'}启用{else}禁用{/if}  	
							</td>
							<td>
								{$item.sort}	
							</td>
							<td>
								{$item.pid}	         
							</td>
							<td>
								{$item.module}	
							</td>
							<td>
								{$item.remark}	
							</td>
							<td>
								<a title="" class="btn" href="/node/edit/?id={$item.id}">编辑</a>
								<a title=""  class="btn btn-warning"  href="javascript:aduit({$item.id},{$item.status});" data-method="put">
									{if $item.status=='1'}禁用 {else}启用{/if}</i>
								</a>
								<a title=""  class="btn btn-danger" href="javascript:delById({$item.id});">移除</a>
							</td>
						</tr>
						{/foreach}
				</tbody>

			</table>

		</div>

{include file="footer.tpl"}