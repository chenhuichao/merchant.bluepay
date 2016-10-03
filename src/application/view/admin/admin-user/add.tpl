{include file="header.tpl"}
<!-- 标题栏 -->
	<div class="main-title">
		<h2>{$_LANG_['admin_user.index.add']}</h2>
	</div>
	{$info}
	<!-- 表单内容 -->
	<div class="tab-wrap">
		<div class="tab-content">
			<form  class="form-horizontal" action="/admin-user/add/?type=save" method="post">
			<input type="hidden" name="id" value="{$record->id}" />
				<div class="form-item">
		            <label class="item-label">{$_LANG_['admin_user.user.real_name']}</label>
					<div class="controls">
								<input type="text" autofocus="true" value=""  class="text input-large" name="name" id="name">
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">{$_LANG_['admin_user.index.ename']}</label>
					<div class="controls">
								<input type="text" autofocus="true" value="" class="text input-large" name="ename" id="ename">
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">{$_LANG_['admin_user.user.login_account']}</label>
					<div class="controls">
								<input type="text" autofocus="true" value="" class="text input-large" name="email" id="email">
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">{$_LANG_['framework.public.passwd']}</label>
					<div class="controls">
								<input type="text" autofocus="true" value="" class="text input-large" name="passwd" id="passwd">
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">{$_LANG_['admin_user.index.depart']}</label>
					<div class="controls">
								<input type="text" autofocus="true" value="" class="text input-large" name="depart" id="depart">
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">{$_LANG_['admin_user.index.position']}</label>
					<div class="controls">
								<input type="text" autofocus="true" value="" class="text input-large" name="position" id="position">
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">{$_LANG_['framework.public.state']}</label>
					<div class="controls">
								<select id="status" name="status" class=" input-large">
									<option selected="selected" value="1">{$_LANG_['framework.public.enable']}</option>
									<option value="0">{$_LANG_['framework.public.disable']}</option>
								</select>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">{$_LANG_['role.index.role_name']}</label>
					<div class="controls">
								<select id="rid" name="rid" class="input-large">
									<option value="0">{$_LANG_['adminuser.entity.rid.unknown']}</option>
									{foreach from=$request.RID_CONF key=k item=item}
									{if $k eq $request.RID_STV.RID_ROOT}
										{if $rid eq $request.RID_STV.RID_ROOT}
											<option value="{$k}">{$_LANG_[$item.NAME]}</option>
										{/if}
									{else}
										<option value="{$k}">{$_LANG_[$item.NAME]}</option>
									{/if}
									{/foreach}
								</select>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">{$_LANG_['framework.public.remark']}</label>
					<div class="controls">
								<textarea style="width:400px; height:150px;" id="remark" name="remark"></textarea>
				     </div>
		        </div>
		      
				<div class="form-item">
							<td colspan="2"><div><button type="submit" class="btn">{$_LANG_['framework.public.submit']}</button>
							<a class="btn btn-info" href="/admin-user/index">{$_LANG_['framework.public.return']}</a>
				     </div>
		        </div>
			</form>
		</div>
		</div>

{include file="footer.tpl"}
