{include file="header.tpl"}
<!-- 标题栏 -->
	<div class="main-title">
		<h2>编辑用户</h2>
	</div>
			{$info}
	<!-- 表单内容 -->
	<div class="tab-wrap">
		<div class="tab-content">
			<form action="/admin-user/edit/?type=save" method="post">
			<input type="hidden" name="id" value="{$record->id}" />
				<div class="form-item">
		            <label class="item-label">真实姓名</label>
					<div class="controls">
							<td><input type="text" value="{$record->name}" name="name" id="name" class="text input-large"></td>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">英文或拼音名称</label>
					<div class="controls">
							<td><input type="text" value="{$record->ename}" name="ename" id="ename" class="text input-large"></td>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">登陆账号(email)</label>
					<div class="controls">
							<td><input type="text" value="{$record->email}" name="email" id="email" class="text input-large"></td>
		        </div>
				<div class="form-item">
		            <label class="item-label">登录密码</label>
					<div class="controls">
							<td><input type="text" name="passwd" id="passwd" class="text input-large"></td>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">部门</label>
					<div class="controls">
							 <input type="text" value="{$record->depart}" name="depart" id="depart" class="text input-large">
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">职务</label>
					<div class="controls">
								<input type="text" value="{$record->position}" name="position" id="position" class="text input-large">
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">状态</label>
					<div class="controls">
								<select id="status" name="status" class="input-large">
			    					<option {if $record->status == 1}selected="selected"{/if}  value="1">启用</option>
									<option {if $record->status == 0}selected="selected"{/if}  value="0">禁用</option>
								</select>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">所属角色</label>
					<div class="controls">
								<select id="rid" name="rid" class="input-large">
									<option {if $record->rid == 0}selected="selected"{/if}  value="0">角色未划分</option>
									{foreach from=$request.RID_CONF key=k item=item}
										<option {if $k == $record->rid}selected="selected"{/if} value="{$k}">{$item.NAME}</option>
									{/foreach}
								</select>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">描述</label>
					<div class="controls">
								<textarea style="width:600px; height:150px;" id="remark" name="remark">{$record->remark}</textarea>
				     </div>
		        </div>
		       
				<div class="form-item">
							<button type="submit" class="btn">保存</button>
							<a class="btn btn-info" href="/admin-user/index">返回</a>
				</div>
			</form>

		</div>
	</div>
</div>
{include file="footer.tpl"}