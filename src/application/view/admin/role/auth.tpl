{include file="header.tpl"}
<!-- 标题栏 -->
<div class="main-title">
	<h2>授权角色</h2>
</div>

<script type="text/javascript" src="{$_STATIC_}/js/public/role-auth.js"></script>
<div class="row-fluid sortable ui-sortable">		
  <div class="box span12">
	<div class="box-content">
	  {if isset($info)}{$info}{/if}
	  <p style="font-size:20px;color:green;">
		<b>角色名称:{$record->name}</b> <span style="margin-left:50px;"><input type="button" onclick="saveAuth({$id});" value="保存修改" class="btn"></span>
	  </p>
	  <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
	    {foreach from=$nodes item=module}
	    <table class="table table-striped table-bordered bootstrap-datatable">
		  <thead>
			<tr><th colspan="3" style="font-size:20px;"><i>{$module.data.title}</i></th></tr>
			<tr role="row">
			  <th style="width:50px;" colspan="1" rowspan="1">全选<input type="checkbox" onclick="checkalla({$module.data.id},this);"/></th>
			  <th style="width:50px;" colspan="1" rowspan="1">编号</th>
			  <th style="width:300px;" colspan="1" rowspan="1">权限名称</th>			  
			</tr>
			
		  </thead>
		  <tbody aria-relevant="all" aria-live="polite" role="alert">
		   {foreach from=$module.record item=item}
		    <tr id="tr_{$item.id}">
		        <td class="center">
		           <input type="checkbox" {if in_array($item.id,$auths)}checked="checked"{/if} class="checkbox-{$module.data.id}" value="{$item.id}"/>
			</td>
		        <td class="center">
		          {$item.id}	         
			</td>
			<td class="center">
		           {$item.title}
			</td>
		    </tr>
		    {/foreach}
		   </tbody>
	     </table>
	     <br>
	     {/foreach}

	  </div>            
	</div>
  </div>
</div>

{include file="footer.tpl"}
