{include file="header.tpl"}
	<style>
	.table .th{ width:200px;text-align:right;line-height:2;}
	.table-responsive { border:1px; }
	</style>
	<div class="main-title">
		<h2>{$_LANG_['merchant.user.title']}</h2>
	</div>

	<div class="table-responsive">
		<form  class="form-horizontal" action="/merchant/user?" method="get">
		<table class="table table-striped table-bordered bootstrap-datatable">
	      <tbody>
            <tr>
              <th class="th">{$_LANG_['framework.public.mobile']}</th>
              <td>
                  <input type="text" autofocus="true" value=""  class="text"  value="{$request.mobile}" name="mobile" id="mobile">
              </td>
              <th class="th">{$_LANG_['merchant.index.email']}</th>
              <td>
                  <input type="text" autofocus="true" value=""  class="text" value="{$request.email}" name="email" id="email">
              </td>

              <th class="th">{$_LANG_['framework.public.update_datetime']}</th>
              <td>
                <input type="text" class="text  datetime" value="{$request.startime}" name="startime"  /> - 
                <input type="text" class="text  datetime" value="{$request.endtime}" name="endtime"  />　
              </td>
            </tr>	          
            <tr>
            <th class="th">{$_LANG_['framework.public.merchant_id']}</th>
            <td>
                <input type="text" autofocus="true" value=""  class="text"  value="{$request.merchant_id}" name="merchant_id" id="merchant_id">
            </td>
            <th class="th">{$_LANG_['merchant.user.is_default']}</th>
            <td>        
                  <select  name="state" class="text">
                          <option {if $request.is_default eq ""} selected="selected"  {/if} value="">{$_LANG_['framework.public.all']}</option>
                      {foreach from=$request.IS_DEFAULT_CONF item=val key=key}
                          <option value="{$key}" {if $request.is_default == $key}selected="selected" {/if}>{$_LANG_[$val.NAME]}</option>
                      {/foreach}
                  </select>
            </td>
            <th class="th">{$_LANG_['framework.public.state']}</th>
	          <td>				
                  <select  name="state" class="text">
                           <option {if $request.state eq ""} selected="selected"  {/if} value="">{$_LANG_['framework.public.all']}</option>
                      {foreach from=$request.STATE_CONF item=val key=key}
                          <option value="{$key}" {if $request.state == $key}selected="selected" {/if}>{$_LANG_[$val.NAME]}</option>
                      {/foreach}
                  </select>
	          </td>
  	        </tr>
	        <tr>
	          <th colspan="4"><button type="submit" class="btn btn-info" style="margin-left:200px;">{$_LANG_['framework.public.search']}</button></th>
	        </tr>
	      </tbody>
	    </table>
	    </form>
	</div>
	
	<div class="cf">
		 <div class="fl">
            <a class="btn" href="/merchant/add-user?merchant_id="{$request.merchant_id}>{$_LANG_['merchant.user.add']}</a> 
        </div>
    </div>
    <!-- 数据列表 -->
    <div class="data-table table-striped">
	<table>
    	<thead>
			<tr>
				<th colspan="1" rowspan="1">{$_LANG_['framework.public.id']}</th>
				<th>{$_LANG_['framework.public.user_id']}</th>
        <th>{$_LANG_['framework.public.mobile']}</th>
        <th>{$_LANG_['merchant.index.email']}</th>
        <th>{$_LANG_['merchant.user.is_default']}</th>

        <th>$_LANG_['framework.public.merchant_id']</th>
        <th>{$_LANG_['framework.public.state']}</th>
				<th>{$_LANG_['framework.public.create_time']}</th>
				<th>{$_LANG_['framework.public.update_time']}</th>
        <th>{$_LANG_['framework.public.action']}</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$results.record item=item key=key}
			<tr id="tr_{$item.id}">
        <input type="hidden" class="lib_id" value="{$item.id}">
				<td>{$key+1}</td>
        <td>{$item.id}</td>
        <td>{$item.mobile}</td>
				<td>{$_LANG_[$request.IS_DEFAULT_CONF[$item.is_default]['NAME']]}</td>
				
				
        <td>{$item.merchant_id}</td>
        <td>{$_LANG_[$request.STATE[$item.state]['NAME']]}</td>
				<td>{$item.ctime}</td>
				<td>{$item.utime}</td>
        <td>
            <a href="/merchant/add-user/?id={$item.id}" title="{$_LANG_['framework.public.edit']}" class="btn"> {$_LANG_['framework.public.edit']}</a>
        </td>
			</tr>
			{/foreach}
		</tbody>
	</table>
</div>
<div class="page">
	<div>  
	{$results.pages} 
	<span class="rows">{$_LANG_['framework.public.total']} {$results.total} {$_LANG_['framework.public.count']}</span>
	</div>
</div>
		
<link href="{$_STATIC_}/datetimepicker/css/datetimepicker.css" rel="stylesheet" type="text/css">
<link href="{$_STATIC_}/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{$_STATIC_}/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="{$_STATIC_}/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script type="text/javascript" src="{$_STATIC_}/js/public/merchant-index.js"></script>
<script type="text/javascript">
    $(function () {
        // 时间控件
        $(".datetime").datetimepicker({
            format: "yyyy-mm-dd",
            language: "{$lang}",
            autoclose: true,
            startView: 2,
            minView:2
        });
    }
</script>
{include file="footer.tpl"}
    
