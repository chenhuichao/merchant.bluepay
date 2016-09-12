{include file="header.tpl"}
<script type="text/javascript" src="{$_STATIC_}/js/public/admin-user-index.js"></script>
<!-- 标题栏 -->
	<div class="main-title">
		<h2>用户列表</h2>
	</div>
	
	<div class="table-responsive">
		<style>
			.table .th{ width:200px;text-align:right;line-height:2;}
			.table-responsive { border:1px; }
		</style>
		<form  class="form-horizontal" action="/admin-user/index" method="post">
		<table class="table table-striped table-bordered bootstrap-datatable">
		
	      <tbody>
	        <tr>
	          <th class="th">名字</th>
	          <td><input type="text" class="text input-large" placeholder="姓名" name="name" value="{$request.name}"></td>
	        </tr>
	
	        <tr>
	          <th colspan="2"><button type="submit" class="btn btn-info" style="margin-left:200px;">搜索</button></th>
	        </tr>
	      </tbody>
	    </table>
	    </form>
	</div>
	
	<div class="cf">
		<div class="fl">
            <a class="btn" href="/admin-user/add/">新 增</a>
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
				<th  colspan="1" rowspan="1">名称</th>
				<th  colspan="1" rowspan="1">邮件</th>
				<th  rowspan="1">部门</th>
				<th  rowspan="1">职务</th>
				<th  rowspan="1">状态</th>
				<th >描述</th>
				<th >角色</th>
				<th >操作</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$results.record item=item}
			<tr id="tr_{$item.id}">
				<td>{$item.id}</td>

				<td>
					{if $item.status==$request.STATUS_STV.STATUS_DISABLE}<s style="color:red;">{$item.name}</s>{else}{$item.name}{/if}
				</td>

				<td style="text-align:left;">{$item.email}</td>
				<td>{$item.depart}</td>
				<td>{$item.position}</td>

				<td>{if $item.status==$request.STATUS_STV.STATUS_ENABLE}启用{else}禁用{/if}</td>
				<td>{$item.remark}</td>
				<td>{$item.role}</td>
				<td>
				<a  class="btn" title="编辑" href="/admin-user/edit/?id={$item.id}" class="load-page"> 编辑</a>
				{if $rid eq $request.RID_STV.RID_ROOT}
				<a class="btn btn-warning" href="javascript:aduit({$item.id},{$item.status});"> {if $item.status==$request.STATUS_STV.STATUS_ENABLE}禁用{else}启用{/if}</a>
				<a title="移除" class="btn btn-danger" href="javascript:delById({$item.id});">移除</a>
                <a  class="btn" title="编辑" href="/admin-user/web/?id={$item.id}" class="load-page">授权</a>
				{/if}
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
