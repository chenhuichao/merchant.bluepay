{include file="header.tpl"}
<!-- 标题栏 -->
	<div class="main-title">
		<h2>用户列表</h2>
	</div>
			{$info}
	<!-- 表单内容 -->
	<div class="tab-wrap">
		<div class="tab-content">
			<form  class="form-horizontal" action="/admin-user/add/?type=save" method="post">
			<input type="hidden" name="id" value="{$record->id}" />
				<div class="form-item">
		            <label class="item-label">真实姓名</label>
					<div class="controls">
								<input type="text" autofocus="true" value=""  class="text input-large" name="name" id="name">
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">英文或拼音名称</label>
					<div class="controls">
								<input type="text" autofocus="true" value="" class="text input-large" name="ename" id="ename">
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">登陆账号(email)</label>
					<div class="controls">
								<input type="text" autofocus="true" value="" class="text input-large" name="email" id="email">
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">登录密码</label>
					<div class="controls">
								<input type="text" autofocus="true" value="" class="text input-large" name="passwd" id="passwd">
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">部门</label>
					<div class="controls">
								<input type="text" autofocus="true" value="" class="text input-large" name="depart" id="depart">
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">职务</label>
					<div class="controls">
								<input type="text" autofocus="true" value="" class="text input-large" name="position" id="position">
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">状态</label>
					<div class="controls">
								<select id="status" name="status" class=" input-large">
									<option selected="selected" value="1">启用</option>
									<option value="0">禁用</option>
								</select>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">所属角色</label>
					<div class="controls">
								<select id="rid" name="rid" class="input-large">
									<option value="0">角色未划分</option>
									{foreach from=$request.RID_CONF key=k item=item}
									{if $k eq $request.RID_STV.RID_ROOT}
										{if $rid eq $request.RID_STV.RID_ROOT}
											<option value="{$k}">{$item.NAME}</option>
										{/if}
									{else}
										<option value="{$k}">{$item.NAME}</option>
									{/if}
									{/foreach}
								</select>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">描述</label>
					<div class="controls">
								<textarea style="width:400px; height:150px;" id="remark" name="remark"></textarea>
				     </div>
		        </div>
		      
				<div class="form-item">
							<td colspan="2"><div><button type="submit" class="btn">保存</button>
							<a class="btn btn-info" href="/admin-user/index">返回</a>
				     </div>
		        </div>
			</form>
		</div>
		</div>

{include file="footer.tpl"}
