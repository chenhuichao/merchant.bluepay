{include file="header.tpl"}
<!-- 标题栏 -->
	<div class="main-title">
		<h2>新增节点</h2>
	</div>
			{$info}
	<!-- 表单内容 -->
	<div class="tab-wrap">
		<div class="tab-content">
			<form class="form-horizontal" action="/node/add/?type=save" method="post">
			<input type="hidden" name="id" value="{$record->id}" />
				<div class="form-item">
		            <label class="item-label">权限名</label>
					<div class="controls">
								<input type="text"  class="text input-large" value="{$record->name}" name="name" id="name" class="text input-large">
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">映射对应的Action</label>
					<div class="controls">
								<input type="text"  class="text input-large" value="{$record->action}" name="action" id="action" class="text input-large">
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">子菜单选项type值</label>
					<div class="controls">
								<input type="text"  class="text input-large" value="{$record->type}" name="type" id="type" class="text input-large">
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">权限描述</label>
					<div class="controls">
								<input type="text"  class="text input-large" value="{$record->title}" name="title" id="title" class="text input-large">
				     </div>
		        </div>
		        <div class="form-item">
		            <label class="item-label">权限描述(英文)</label>
					<div class="controls">
								<input type="text"  class="text input-large" value="{$record->title_en}" name="title_en" id="title_en" class="text input-large">
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">状态</label>
					<div class="controls">
							<select id="status" name="status" class="input-large">
								<option {if $record->status == '1'}selected="selected"{/if} value="1">启用</option>
								<option {if $record->status == '0'}selected="selected"{/if} value="0">禁用</option>
							</select>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">排序</label>
					<div class="controls">
								<input type="text"  class="text input-large"value="{$record->sort}" id="sort" name="sort" class="text input-large">
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">所属模块</label>
					<div class="controls">
								<select id="pid" name="pid" class="input-large">
									<option {if $record->pid == '0'}selected="selected"{/if} value="0">《模块》</option>
									{foreach from=$result item=item}
										<option  {if $record->pid == $item.id}selected="selected"{/if}  value="{$item.id}">{$item.title}</option>
									{/foreach}
								</select>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">是否显示在主菜单</label>
					<div class="controls">
								<select id="ismenu" name="ismenu" class="input-large">
									<option {if $record->ismenu == '1'}selected="selected"{/if} value="1">是</option>
									<option {if $record->ismenu == '0'}selected="selected"{/if} value="0">否</option>
								</select>
				     </div>
		        </div>
				<div class="form-item">
		            <label class="item-label">备注</label>
					<div class="controls">
								<textarea style="width:400px; height:150px;" id="remark" name="remark">{$record->remark}</textarea>
				     </div>
		        </div>
				<div class="form-item">
					<button type="submit" class="btn">保存</button>
					<a class="btn btn-info" href="/node/index">返回</a>
				</div>

			</form>

		</div>
	</div>
</div>

{include file="footer.tpl"}