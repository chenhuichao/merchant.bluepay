{include file="header.tpl"}

<div class="main-title">
    <h2>添加项目</h2>
</div>

<div class="tab-wrap">
    <div class="tab-content">
	     <form  class="form-horizontal" action="/website/add/?action=save" method="post">
             <input type="hidden" name="save_id" value="{$request.id}">
		<fieldset>
            {$info}
            <div class="control-group">
                <label class="control-label" for="name">项目名称</label>
                <div class="controls">
                    <input type="text" autofocus="true" value="{$request.wname}" class="text input-large" name="wname" id="wname">
                </div>
            </div>
		  <div class="control-group">
			<label class="control-label" for="name">版本控制系统</label>
			<div class="controls">
                <select name="control" id="control" class="text input-large">
                    <option value="SVN" {if $request.control == "SVN"}selected="selected"{/if}>SVN</option>
                    <option value="GIT" {if $request.control == "GIT"}selected="selected"{/if}>GIT</option>
                </select>

			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="name">版本库路径</label>
			<div class="controls">
			  <input type="text" autofocus="true" value="{$request.cpath}" class="text input-large" name="cpath" id="cpath">
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="name">开发语言</label>
			<div class="controls">
			  <input type="text" autofocus="true" value="{$request.language}" class="text input-large" name="language" id="language">
			</div>
		  </div>

		  <div class="form-actions">
			<button type="submit" class="btn btn-primary">保存</button>
			<button onclick="window.location.href='/website/'" type="reset" class="btn">返回</button>
		  </div>
		</fieldset>
	   </form>
	</div>
  </div>     

{include file="footer.tpl"}
