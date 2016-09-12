{include file="header.tpl"}

<div class="main-title">
    <h2>添加服务器</h2>
</div>

<div class="tab-wrap">
    <div class="tab-content">
	     <form  class="form-horizontal" action="/server/add/?action=save" method="post">
             <input type="hidden" value="{$result.id}" name="save_id">
		<fieldset>
		  {$info}
		  <div class="control-group">
			<label class="control-label" for="name">服务器组</label>
			<div class="controls">
			  <select class="text input-large" name="sgid" id="sgid">
                  {foreach from=$group.record item=val}
                    <option value="{$val.id}" {if $result.sgid == $val.id}selected="selected"{/if}>{$val.sgname}</option>
                  {/foreach}
              </select>
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="name">IP地址</label>
			<div class="controls">
			  <input type="text" autofocus="true" value="{$result.ip}" class="text input-large" name="ip" id="ip">
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="name">同步路径</label>
			<div class="controls">
			  <input type="text" autofocus="true" value="{$result.spath}" class="text input-large" name="spath" id="spath">
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="name">同步工具类型</label>
			<div class="controls">
			  <input type="text" autofocus="true" value="{$result.stype}" class="text input-large" name="stype" id="stype">
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="name">端口</label>
			<div class="controls">
			  <input type="text" autofocus="true" value="{$result.port}" class="text input-large" name="port" id="port">
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="name">同步用户</label>
			<div class="controls">
			  <input type="text" autofocus="true" value="{$result.sname}" class="text input-large" name="sname" id="sname">
			</div>
		  </div>
            <div class="control-group">
                <label class="control-label" for="name">同步用户密码</label>
                <div class="controls">
                    <input type="text" autofocus="true" value="{$result.spass}" class="text input-large" name="spass" id="spass">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="name">exclude文件</label>
                <div class="controls">
                    <textarea name="exclude" class="text input-large">{$result.exclude}</textarea>
                </div>
            </div>
		  <div class="control-group">
			<label class="control-label" for="status">状态</label>
			<div class="controls">
			  <select id="status" name="status" class="text input-large">
			    <option value="1" {if $result.status == 1}selected="selected"{/if}>启用</option>
			    <option value="2" {if $result.status == 2}selected="selected"{/if}>禁用</option>
			  </select>
			</div>
		  </div>

		  <div class="form-actions">
			<button type="submit" class="btn btn-primary">保  存</button>
			<button onclick="window.location.href='/server/'" type="reset" class="btn">返回</button>
		  </div>
		</fieldset>
	   </form>
	</div>
  </div>     

{include file="footer.tpl"}
