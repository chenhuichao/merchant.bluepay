{include file="header.tpl"}
<!-- 标题栏 -->
<div class="main-title">
	<h2>添加服务器组</h2>
</div>
	{$info}
	<!-- 标签页导航 -->
	<div class="tab-wrap">
		<div class="tab-content">
			<form  class="form-horizontal" action="/servergroup/add/?action=save" method="post">
			<input type="hidden" name="save_id" value="{$result.id}" />
				<div class="form-item">
		            <label class="item-label">服务器组名：</label>
					<div class="controls">
							<input type="text" autofocus="true" value="{$result.sgname}" name="sgname" id="sgname" class="text input-large">
				     </div>
		        </div>

                <div class="form-item">
                    <label class="item-label">选择项目：</label>
                    <div class="controls">
                        <select  class="text input-large" name="wid">
                            {foreach from=$website.record item=val}
                                <option value="{$val.id}" {if $result.wid == $val.id}selected="selected" {/if}>{$val.wname}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>

				<div class="form-item">
		            <label class="item-label">状态：</label>
					<div class="controls">
						<select id="status" name="status" class=" input-large">
							<option  value="1" {if $result.status == 1}selected="selected"{/if}>启用</option>
							<option value="2" {if $result.status == 2}selected="selected"{/if}>禁用</option>
						</select>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">描述：</label>
					<div class="controls">
							<textarea style="width:400px; height:150px;" id="remark" name="remark">{$result.remark}</textarea>
				     </div>
		        </div>
			    <div class="form-item">
			        <button type="submit" class="btn">保存</button>
			        <a class="btn btn-info" href="/servergroup/index">返回</a>
			    </div>
			</form>

		</div>
	</div>
{include file="footer.tpl"}
