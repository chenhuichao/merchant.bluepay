{include file="header.tpl"}
<!-- 标题栏 -->
<div class="main-title">
	<h2>{$_LANG_['role.add.title']}</h2>
</div>
	{$info}
	<!-- 标签页导航 -->
	<div class="tab-wrap">
		<div class="tab-content">
			<form  class="form-horizontal" action="/role/add/?type=save" method="post">
			<input type="hidden" name="id" value="{$record->id}" />
				<div class="form-item">
		            <label class="item-label">{$_LANG_['role.index.role_name']}</label>
					<div class="controls">
							<input type="text" autofocus="true" value="" name="name" id="name" class="text input-large">
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
		            <label class="item-label">{$_LANG_['role.index.desc']}</label>
					<div class="controls">
							<textarea style="width:400px; height:150px;" id="remark" name="remark"></textarea>
				     </div>
		        </div>
			    <div class="form-item">
			        <button type="submit" class="btn">{$_LANG_['framework.public.submit']}</button>
			        <a class="btn btn-info" href="/role/index">{$_LANG_['framework.public.return']}</a>
			    </div>
			</form>

		</div>
	</div>
{include file="footer.tpl"}
