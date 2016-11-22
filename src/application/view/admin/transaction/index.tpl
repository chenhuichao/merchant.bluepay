{include file="header.tpl"}
	<style>
	.table .th{ width:200px;text-align:right;line-height:2;}
	.table-responsive { border:1px; }
	</style>
	<div class="main-title">
		<h2>{$_LANG_['transaction.index.title']}</h2>
	</div>

	<div class="table-responsive">
		<form  class="form-horizontal" action="/transaction/index?" method="get">
		<table class="table table-striped table-bordered bootstrap-datatable">
	      <tbody>
	        <tr>
	          <th class="th">{$_LANG_['transaction.index.type']}</th>
	          <td>
                  <select  class="text" name="type">
                      <option {if $request.type eq ""} selected="selected"  {/if} value="">{$_LANG_['framework.public.all']}</option>
                      {foreach from=$request.TYPE_CONF key=key item=val}
                          <option value="{$key}" {if $request.type == $key}selected="selected" {/if}>{$_LANG_[$val.NAME]}</option>
                      {/foreach}
                  </select>
	          </td>

            <th class="th">{$_LANG_['transaction.index.btype']}</th>
            <td>
                  <select  class="text" name="btype">
                      <option {if $request.type eq ""} selected="selected"  {/if} value="">{$_LANG_['framework.public.all']}</option>
                      {foreach from=$request.BTYPE_CONF key=key item=val}
                          <option value="{$key}" {if $request.btype == $key}selected="selected" {/if}>{$_LANG_[$val.NAME]}</option>
                      {/foreach}
                  </select>
            </td>
            <th class="th">{$_LANG_['framework.public.merchant_id}</th>
            <td>
                <input type="text" autofocus="true" class="text" value="{$request.merchant_id}" name="merchant_id" id="merchant_id">
            </td>
  	        </tr>
            <tr>
              <th class="th">{$_LANG_['transaction.index.orderid']}</th>
              <td>
                  <input type="text" autofocus="true"class="text" value="{$request.orderid}" name="orderid" id="orderid">
              </td>
              <th class="th">{$_LANG_['transaction.index.tradeno']}</th>
              <td>
                  <input type="text" autofocus="true" class="text" value="{$request.tradeno}" name="tradeno" id="tradeno">
              </td>
              <th class="th">{$_LANG_['transaction.index.user_id']}</th>
              <td>
                  <input type="text" autofocus="true" class="text" value="{$request.user_id}" name="user_id" id="user_id">
              </td>
            </tr>

            <tr>
              <th class="th">{$_LANG_['framework.public.mobile']}</th>
              <td>
                  <input type="text" autofocus="true" class="text"  value="{$request.mobile}" name="mobile" id="mobile">
              </td>
              <th class="th">{$_LANG_['framework.public.sn']}</th>
              <td>
                  <input type="text" autofocus="true" class="text"  value="{$request.sn}" name="sn" id="sn">
              </td>
  
              <th class="th">{$_LANG_['framework.public.update_datetime']}</th>
              <td>
                <input type="text" class="text  datetime" value="{$request.daystart}" name="daystart"  /> - 
                <input type="text" class="text  datetime" value="{$request.dayend}" name="dayend"  />　
              </td>
            </tr>	          
            <tr>
              <th class="th">{$_LANG_['framework.public.state']}</th>
	          <td>				
                  <select  name="state" class="text">
                           <option {if $request.state eq ""} selected="selected"  {/if} value="">{$_LANG_['framework.public.all']}</option>
                      {foreach from=$request.STATE_CONF key=key item=val}
                          <option value="{$key}" {if $request.state == $key}selected="selected" {/if}>{$_LANG_[$val.NAME]}</option>
                      {/foreach}
                  </select>
	          </td>
	          <td colspan="2">				
	          </td>
  	        </tr>
	        <tr>
	          <th colspan="4"><button type="submit" class="btn btn-info" style="margin-left:200px;">{$_LANG_['framework.public.search']}</button></th>
	        </tr>
	      </tbody>
	    </table>
	    </form>
	</div>
	

  <!-- 数据列表 -->
  <div class="data-table table-striped">
	<table>
    	<thead>
			<tr>
				<th colspan="1" rowspan="1">{$_LANG_['framework.public.id']}</th>
				<th>{$_LANG_['transaction.index.type']}</th>
				<th>{$_LANG_['transaction.index.btype']}</th>
				<th>{$_LANG_['transaction.index.orderid']}</th>
        <th>{$_LANG_['transaction.index.tradeno']}</th>
        <th>{$_LANG_['transaction.index.amount']}</th>
        <th>{$_LANG_['transaction.index.fee']}</th>
        <th>{$_LANG_['framework.public.merchant_id}</td>
        <th>{$_LANG_['transaction.index.user_id']}</th>
        <th>{$_LANG_['framework.public.sn']}</th>
        <th>{$_LANG_['framework.public.state']}</th>
				<th>{$_LANG_['framework.public.create_time']}</th>
				<th>{$_LANG_['framework.public.update_time']}</th>
        <th>{$_LANG_['framework.public.action']}</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$results.record item=item key=key}
			<tr id="tr_{$item.id}">
				<td>{$key+1}</td>
				<td>{$_LANG_[$request.TYPE_CONF[$item.type]['NAME']]}</td>
        <td>{$_LANG_[$request.BTYPE_CONF[$item.btype]['NAME']]}</td>
				<td>{$item.orderid}</td>
				<td>{$item.tradeno}</td>
        <td>{if $item.type eq 1}{$item.tin}{else}{$item.tout}{/if}</td>
        <td>{$item.fee}</td>
        <td>{$item.merchant_id}</td>
        <td>{$item.user_id}</td>
        <td>{$item.sn}</td>
        <td>{$_LANG_[$request.STATE_CONF[$item.state]['NAME']]}</td>
				<td>{$item.ctime}</td>
				<td>{$item.utime}</td>
        <td>-</td>
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
    });
</script>
{include file="footer.tpl"}
    
