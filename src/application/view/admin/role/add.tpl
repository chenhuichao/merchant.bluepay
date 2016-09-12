{include file="header.tpl"}
<!-- 标题栏 -->
<div class="main-title">
	<h2>添加角色</h2>
</div>
	{$info}
	<!-- 标签页导航 -->
	<div class="tab-wrap">
		<div class="tab-content">
			<form  class="form-horizontal" action="/role/add/?type=save" method="post">
			<input type="hidden" name="id" value="{$record->id}" />
				<div class="form-item">
		            <label class="item-label">角色名：</label>
					<div class="controls">
							<input type="text" autofocus="true" value="" name="name" id="name" class="text input-large">
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">状态：</label>
					<div class="controls">
						<select id="status" name="status" class=" input-large">
							<option selected="selected" value="1">启用</option>
							<option value="0">禁用</option>
						</select>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">描述：</label>
					<div class="controls">
							<textarea style="width:400px; height:150px;" id="remark" name="remark"></textarea>
				     </div>
		        </div>
			    <div class="form-item">
			        <button type="submit" class="btn">保存</button>
			        <a class="btn btn-info" href="/role/index">返回</a>
			    </div>
			</form>

		</div>
	</div>
{include file="footer.tpl"}
