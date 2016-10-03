{include file="header.tpl"}
<script type="text/javascript" src="{$_STATIC_}/js/public/admin-user-index.js"></script>
<!-- 标题栏 -->
	<div class="main-title">
		<h2>{$_LANG_['admin_user.index.title']}</h2>
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
	          <th class="th">{$_LANG_['admin_user.user.real_name']}</th>
	          <td><input type="text" class="text input-large" placeholder="{$_LANG_['admin_user.user.real_name']}" name="name" value="{$request.name}"></td>
	        </tr>
	
	        <tr>
	          <th colspan="2"><button type="submit" class="btn btn-info" style="margin-left:200px;">{$_LANG_['framework.public.search']}</button></th>
	        </tr>
	      </tbody>
	    </table>
	    </form>
	</div>
	
	<div class="cf">
		<div class="fl">
            <a class="btn" href="/admin-user/add/">{$_LANG_['admin_user.index.add']}</a>
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
				<th colspan="1" rowspan="1">{$_LANG_['framework.public.id']}</th>
				<th colspan="1" rowspan="1">{$_LANG_['admin_user.user.real_name']}</th>
				<th colspan="1" rowspan="1">{$_LANG_['merchant.index.email']}</th>
				<th rowspan="1">{$_LANG_['admin_user.index.depart']}</th>
				<th rowspan="1">{$_LANG_['admin_user.index.position']}</th>
				<th rowspan="1">{$_LANG_['framework.public.state']}</th>
				<th>{$_LANG_['framework.public.remark']}</th>
				<th>{$_LANG_['role.index.role_name']}</th>
				<th>{$_LANG_['framework.public.action']}</th>
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

				<td>{if $item.status==$request.STATUS_STV.STATUS_ENABLE}{{$_LANG_['framework.public.enable']}}{else}{{$_LANG_['framework.public.disable']}}{/if}</td>
				<td>{$item.remark}</td>
				<td>{$item.role}</td>
				<td>
				<a  class="btn"  href="/admin-user/edit/?id={$item.id}" class="load-page">{{$_LANG_['framework.public.edit']}}</a>
				{if $rid eq $request.RID_STV.RID_ROOT}
				<a class="btn btn-warning" href="javascript:aduit({$item.id},{$item.status});"> {if $item.status==$request.STATUS_STV.STATUS_ENABLE}{$_LANG_['framework.public.disable']}{else}{{$_LANG_['framework.public.enable']}}{/if}</a>
				<a class="btn btn-danger" href="javascript:delById({$item.id});">{$_LANG_['framework.public.delete']}</a>
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
	<span class="rows">{$_LANG_['framework.public.total']} {$results.total} {$_LANG_['framework.public.count']}</span>
	</div>
</div>

{include file="footer.tpl"}
