{include file="header.tpl"}
<!-- 标题栏 -->
	<div class="main-title">
		<h2>{$_LANG_['merchant.user.edit']}</h2>
	</div>
	{$info}
	<!-- 表单内容 -->
	<div class="tab-wrap">
		<div class="tab-content">
			<form  class="form-horizontal" action="/merchant/edit-user/?action=do" method="post">
				<input type="hidden" name="id" value="{$record->id}" />
				<div class="form-item">
		            <label class="item-label">{$_LANG_['framework.public.mobile']}</label>
					<div class="controls">
								<input type="text" autofocus="true" value="{$record->mobile}"  class="text input-large" name="mobile" id="mobile">
				     </div>
		        </div>

				<div class="form-item">
		            <label class="item-label">{$_LANG_['framework.public.email']}</label>
					<div class="controls">
								<input type="text" autofocus="true" value="{$record->email}"  class="text input-large" name="email" id="email">
				    </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">{$_LANG_['framework.public.passwd']}</label>
					<div class="controls">
								<input type="text" autofocus="true" value="" class="text input-large" name="passwd" id="passwd">
				     </div>
		        </div>

				<div class="form-item">
		            <label class="item-label">{$_LANG_['framework.public.merchant_id']}</label>
					<div class="controls">
							<input type="text" autofocus="true" value="{if isset($record)}{$record->merchant_id}{else}{$request.merchant_id}{/if}" class="text input-large" name="merchant_id" id="merchant_id">
				    </div>
		        </div>
		        <div class="form-item">
		            <label class="item-label">{$_LANG_['merchant.user.is_default']}</label>
					<div class="controls">
						<select id="is_default" name="is_default" class=" input-large">
							<option {if $record->is_default eq $request.IS_DEFAULT_STV.IS_DEFAULT_YES}selected="selected"{/if} value="{$request.IS_DEFAULT_STV.IS_DEFAULT_YES}">{$_LANG_['framework.public.enable']}</option>
							<option {if $record->is_default eq $request.IS_DEFAULT_STV.IS_DEFAULT_NO}selected="selected"{/if} value="{$request.IS_DEFAULT_STV.IS_DEFAULT_NO}">{$_LANG_['framework.public.disable']}</option>
						</select>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">{$_LANG_['framework.public.state']}</label>
					<div class="controls">
						<select id="state" name="state" class=" input-large">
							<option {if $record->state eq $request.STATE_STV.STATE_ENABLE}selected="selected"{/if}  value="{$request.STATE_STV.STATE_ENABLE}">{$_LANG_['framework.public.enable']}</option>
							<option {if $record->state eq $request.STATE_STV.STATE_DISABLE}selected="selected"{/if}   value="{$request.STATE_STV.STATE_DISABLE}">{$_LANG_['framework.public.disable']}</option>
						</select>
				     </div>
		        </div>
		      
				<div class="form-item">
						<td colspan="2"><div><button type="submit" class="btn">{$_LANG_['framework.public.submit']}</button>
						<a class="btn btn-info" href="/merchant/user/">{$_LANG_['framework.public.return']}</a>
				     </div>
		        </div>
			</form>
		</div>
		</div>

{include file="footer.tpl"}
