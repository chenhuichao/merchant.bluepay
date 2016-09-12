{include file="header.tpl"}
	<!-- 标题栏 -->
	<div class="main-title">
		<h2>获取指定分支版本代码</h2>
	</div>
	{$info}
	<!-- 表单内容 -->
	<div class="tab-wrap">
		<div class="tab-content">
			<form  class="form-horizontal" action="/liblog/add/?action=do" method="post">

				 <div class="form-item" >
		            <label class="item-label">项目名称</label>
					<div class="controls">
								<select id="wid" name="wid" class="input-large">
									{*<option value="0">角色未划分</option>*}
									{*{foreach from=$request.RID_CONF key=k item=item}*}
									{*{if $k eq $request.RID_STV.RID_ROOT}*}
										{*{if $rid eq $request.RID_STV.RID_ROOT}*}

											{*<option value="{$k}">{$item.NAME}</option>*}
										{*{/if}*}
									{*{else}*}
										{*<option value="{$k}">{$item.NAME}</option>*}
									{*{/if}*}
									{*{/foreach}*}
                                    {foreach from=$web.record item=val}
                                        <option value="{$val.id}">{$val.wname}</option>
                                    {/foreach}
								</select>
				     </div>
		        </div>
		        <div class="form-item">
		            <label class="item-label">分支</label>
					<div class="controls">
							<input type="text" value="" name="branch" class="text input-large"/>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">版本</label>
					<div class="controls">
								<input type="text" value="" name="version" class="text input-large"/>
				     </div>
		        </div>
		      
				<div class="form-item">
					<div class="controls">
							<button type="submit" class="btn">检出</button>
							<a class="btn btn-info" href="/lib/index">返回</a>
					</div>
		        </div>
			</form>
		</div>
	</div>
{include file="footer.tpl"}
	 