{include file="header.tpl"}
<!-- 标题栏 -->
	<div class="main-title">
		<h2>{$_LANG_['admin_user.user.modify_password']}</h2>
	</div>

	{$info}
	<!-- 表单内容 -->
	<div class="tab-wrap">
		<div class="tab-content">
			<form class="form-horizontal" action="/userinfo/?action=save" method="post">
			<input type="hidden" name="id" value="{$uid}" />
				<div class="form-item">
		            <label class="item-label">{$_LANG_['admin_user.user.real_name']}</label>
					<div class="controls">
								<input class="text input-large" type="text" value="{$session.name}" disabled="disabled"/>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">{$_LANG_['admin_user.user.login_account']}</label>
					<div class="controls">
								<input class="text input-large" type="text" value="{$session.email}" disabled="disabled"/>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">{$_LANG_['admin_user.user.old_password']}</label>
					<div class="controls">
								<input class="text input-large"  type="password" name="oldpass" id="oldpass" value="{if isset($oldpass)}{$oldpass}{/if}"/>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">{$_LANG_['admin_user.user.new_password']}</label>
					<div class="controls">
								<input class="text input-large" type="password" name="newpass" id="newpass"/>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">{$_LANG_['admin_user.user.confirm_password']}</label>
					<div class="controls">
								<input class="text input-large" type="password" name="renewpass" id="renewpass"/>
				     </div>
		        </div>
				<div class="form-item">
					<button type="submit" class="btn">{$_LANG_['framework.public.submit']}</button>
					<button class="btn btn-info" onclick="javascript:history.back(-1);return false;">{$_LANG_['framework.public.return']}</button>
				</div>
			</form>
		</div>
	</div>
{include file="footer.tpl"}
