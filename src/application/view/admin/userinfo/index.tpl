{include file="header.tpl"}
<!-- 标题栏 -->
	<div class="main-title">
		<h2>修改密码</h2>
	</div>

	{$info}
	<!-- 表单内容 -->
	<div class="tab-wrap">
		<div class="tab-content">
			<form class="form-horizontal" action="/userinfo/?action=save" method="post">
			<input type="hidden" name="id" value="{$uid}" />
				<div class="form-item">
		            <label class="item-label">真实姓名</label>
					<div class="controls">
								<input class="text input-large" type="text" value="{$session.name}" disabled="disabled"/>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">登陆账号</label>
					<div class="controls">
								<input class="text input-large" type="text" value="{$session.email}" disabled="disabled"/>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">原始密码</label>
					<div class="controls">
								<input class="text input-large"  type="password" name="oldpass" id="oldpass" value="{if isset($oldpass)}{$oldpass}{/if}"/>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">新密码</label>
					<div class="controls">
								<input class="text input-large" type="password" name="newpass" id="newpass"/>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">密码确认</label>
					<div class="controls">
								<input class="text input-large" type="password" name="renewpass" id="renewpass"/>
				     </div>
		        </div>
				<div class="form-item">
					<button type="submit" class="btn">保存</button>
					<button class="btn btn-info" onclick="javascript:history.back(-1);return false;">返 回</button>
				</div>
			</form>
		</div>
	</div>
{include file="footer.tpl"}
