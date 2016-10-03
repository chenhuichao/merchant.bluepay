{include file="header.tpl"}
<!-- 标题栏 -->
	<div class="main-title">
		<h2>{$_LANG_['admin_user.edit.title']}</h2>
	</div>
			{$info}
	<!-- 表单内容 -->
	<div class="tab-wrap">
		<div class="tab-content">
			<form action="/admin-user/edit/?type=save" method="post">
			<input type="hidden" name="id" value="{$record->id}" />
				<div class="form-item">
		            <label class="item-label">{$_LANG_['admin_user.user.real_name']}</label>
					<div class="controls">
							<td><input type="text" value="{$record->name}" name="name" id="name" class="text input-large"></td>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">{$_LANG_['admin_user.index.ename']}</label>
					<div class="controls">
							<td><input type="text" value="{$record->ename}" name="ename" id="ename" class="text input-large"></td>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">{$_LANG_['admin_user.user.login_account']}</label>
					<div class="controls">
							<td><input type="text" value="{$record->email}" name="email" id="email" class="text input-large"></td>
		        </div>
				<div class="form-item">
		            <label class="item-label">{$_LANG_['framework.public.passwd']}</label>
					<div class="controls">
							<td><input type="text" name="passwd" id="passwd" class="text input-large"></td>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">{$_LANG_['admin_user.index.depart']}</label>
					<div class="controls">
							 <input type="text" value="{$record->depart}" name="depart" id="depart" class="text input-large">
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">{$_LANG_['admin_user.index.position']}</label>
					<div class="controls">
								<input type="text" value="{$record->position}" name="position" id="position" class="text input-large">
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">{$_LANG_['framework.public.state']}</label>
					<div class="controls">
								<select id="status" name="status" class="input-large">
			    					<option {if $record->status == 1}selected="selected"{/if}  value="1">{$_LANG_['framework.public.enable']}</option>
									<option {if $record->status == 0}selected="selected"{/if}  value="0">{$_LANG_['framework.public.disable']}</option>
								</select>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">{$_LANG_['role.index.role_name']}</label>
					<div class="controls">
								<select id="rid" name="rid" class="input-large">
									<option {if $record->rid == 0}selected="selected"{/if}  value="0">{$_LANG_['adminuser.entity.rid.unknown']}</option>
									{foreach from=$request.RID_CONF key=k item=item}
										<option {if $k == $record->rid}selected="selected"{/if} value="{$k}">{$_LANG_[$item.NAME]}</option>
									{/foreach}
								</select>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">{$_LANG_['framework.public.remark']}</label>
					<div class="controls">
								<textarea style="width:600px; height:150px;" id="remark" name="remark">{$record->remark}</textarea>
				     </div>
		        </div>
		       
				<div class="form-item">
						<button type="submit" class="btn">{$_LANG_['framework.public.submit']}</button>
						<a class="btn btn-info" href="/admin-user/index">{$_LANG_['framework.public.return']}</a>
				</div>
			</form>

		</div>
	</div>
</div>
{include file="footer.tpl"}