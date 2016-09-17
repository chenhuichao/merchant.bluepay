{include file="header.tpl"}
<!-- 标题栏 -->
	<div class="main-title">
		<h2>{$_LANG_['merchant.user.add']}</h2>
	</div>
	{$info}
	<!-- 表单内容 -->
	<div class="tab-wrap">
		<div class="tab-content">
			<form  class="form-horizontal" action="/merchant/add-user/?action=do" method="post">
				<div class="form-item">
		            <label class="item-label">{$_LANG_['framework.public.mobile']}</label>
					<div class="controls">
								<input type="text" autofocus="true" value=""  class="text input-large" name="mobile" id="mobile">
				     </div>
		        </div>

				<div class="form-item">
		            <label class="item-label">{$_LANG_['framework.public.email']}</label>
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
		            <label class="item-label">{$_LANG_['framework.public.pay_passwd']}</label>
					<div class="controls">
								<input type="text" autofocus="true" value="" class="text input-large" name="pay_passwd" id="pay_passwd">
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">{$_LANG_['framework.public.merchant_id']}</label>
					<div class="controls">
							<input type="text" autofocus="true" value="" class="text input-large" name="merchant_id" id="merchant_id">
				    </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">{$_LANG_['framework.public.state']}</label>
					<div class="controls">
						<select id="state" name="state" class=" input-large">
							<option selected="selected" value="1">{$_LANG_['framework.public.enable']}</option>
							<option value="0">{$_LANG_['framework.public.disable']}</option>
						</select>
				     </div>
		        </div>
		      
				<div class="form-item">
							<td colspan="2"><div><button type="submit" class="btn">{$_LANG_['framework.public.submit']}</button>
							<a class="btn btn-info" href="merchantß/add-user/">{$_LANG_['framework.public.return']}</a>
				     </div>
		        </div>
			</form>
		</div>
		</div>

{include file="footer.tpl"}
