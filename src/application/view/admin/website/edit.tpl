{include file="header.tpl"}

<style type="text/css">
#system-info .table td { border-bottom:1px solid #DDDDDD; border-top:0; }
#system-info .table tr:last-child td { border-bottom:0; }
</style>

<div>
  <ul class="breadcrumb">
	<li><a href="/" class="load-page">管理中心</a> <span class="divider">/</span></li>
	<li><a href="/project/" class="load-page">管理</a> <span class="divider">/</span></li>
	<li>编辑</li>
  </ul>
</div>

<div id="system-info" class="row-fluid">
  <div class="box span12">
	<div class="box-header well"><h2>编辑</h2></div>
	<div class="box-content">
	    
	     <form  class="form-horizontal" action="/website/edit/?action=save" method="post">
		<fieldset>
		  {if isset($info)}<p style="color:red;">{$info}</p>{/if}
		  <input type="hidden" name="id" value="{$record->id}"/>
		  <div class="control-group">
			<label class="control-label" for="name">真实姓名</label>
			<div class="controls">
			  <input type="text" autofocus="true" value="{$record->name}" class="span2" name="name" id="name">
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="name">英文或拼音名称</label>
			<div class="controls">
			  <input type="text" autofocus="true" value="{$record->ename}" class="span2" name="ename" id="ename">
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="name">登录账号(email)</label>
			<div class="controls">
			  <input type="text" autofocus="true" value="{$record->email}" class="span2" name="email" id="email">
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="name">登录密码</label>
			<div class="controls">
			  <input type="text" autofocus="true" class="span2" name="passwd" id="passwd">
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="name">部门</label>
			<div class="controls">
			  <input type="text" autofocus="true" value="{$record->depart}" class="span2" name="depart" id="depart">
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="name">职务</label>
			<div class="controls">
			  <input type="text" autofocus="true" value="{$record->position}" class="span2" name="position" id="position">
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="status">状态</label>
			<div class="controls">
			  <select id="status" name="status">
			    <option {if $record->status == 1}selected="selected"{/if}  value="1">启用</option>
			    <option {if $record->status == 0}selected="selected"{/if}  value="0">禁用</option>
			  </select>
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="rid">所属角色</label>
			<div class="controls">
			  <select id="rid" name="rid">
			    <option {if $record->rid == 0}selected="selected"{/if}  value="0">角色为划分</option>
			    {foreach from=$results item=item}
				 <option {if $record->rid == $item.id}selected="selected"{/if} value="{$item.id}">{$item.name}</option>
			    {/foreach}
			  </select>
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="remark">描述</label>
			<div class="controls">
			  <textarea style="width:400px; height:150px;" id="remark" name="remark">{$record->remark}</textarea>
			</div>
		  </div> 
		  <div class="form-actions">
			<button type="submit" class="btn btn-primary">保存</button>
			<button onclick="window.location.href='/project/'" type="reset" class="btn">返回</button>
		  </div>
		</fieldset>
	   </form>
	</div>
  </div>     
</div>
{include file="footer.tpl"}
