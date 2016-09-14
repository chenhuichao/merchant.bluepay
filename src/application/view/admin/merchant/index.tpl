{include file="header.tpl"}
	<style>
	.table .th{ width:200px;text-align:right;line-height:2;}
	.table-responsive { border:1px; }
	</style>
	<div class="main-title">
		<h2>{$_LANG_['merchant.index.title']}</h2>
	</div>

	<div class="table-responsive">
		<form  class="form-horizontal" action="/merchant/index?" method="get">
		<table class="table table-striped table-bordered bootstrap-datatable">
	      <tbody>
	        <tr>
	          <th class="th">{$_LANG_['merchant.index.type']}</th>
	          <td>
                  <select  class="text" name="type">
                      <option {if $request.type eq ""} selected="selected"  {/if} value="">{$_LANG_['framework.public.all']}</option>
                      {foreach from=$request.TYPE_CONF key=key item=val}
                          <option value="{$key}" {if $request.type == $key}selected="selected" {/if}>{$_LANG_[$val.NAME]}</option>
                      {/foreach}
                  </select>
	          </td>

              <th class="th">{$_LANG_['merchant.index.realname']}</th>
              <td>
                  <input type="text" autofocus="true" value=""  class="text" name="real_name" id="real_name">
              </td>
              <th class="th">{$_LANG_['merchant.index.nickname']}</th>
              <td>
                  <input type="text" autofocus="true" value=""  class="text" name="nick_name" id="nick_name">
              </td>
  	        </tr>
            <tr>
              <th class="th">{$_LANG_['merchant.index.idno']}</th>
              <td>
                  <input type="text" autofocus="true" value=""  class="text" name="id_no" id="id_no">
              </td>
              <th class="th">{$_LANG_['merchant.index.company_name']}</th>
              <td>
                  <input type="text" autofocus="true" value=""  class="text" name="company_name" id="company_name">
              </td>
              <th class="th">{$_LANG_['merchant.index.business_license_no']}</th>
              <td>
                  <input type="text" autofocus="true" value=""  class="text" name="business_license_no" id="business_license_no">
              </td>
            </tr>

            <tr>
              <th class="th">{$_LANG_['framework.public.mobile']}</th>
              <td>
                  <input type="text" autofocus="true" value=""  class="text" name="mobile" id="mobile">
              </td>
              <th class="th">{$_LANG_['merchant.index.email']}</th>
              <td>
                  <input type="text" autofocus="true" value=""  class="text" name="email" id="email">
              </td>

              <th class="th">{$_LANG_['framework.public.update_datetime']}</th>
              <td>
                <input type="text" class="text  datetime" value="{$request.startime}" name="startime"  /> - 
                <input type="text" class="text  datetime" value="{$request.endtime}" name="endtime"  />　
              </td>
            </tr>	          
            <tr>
              <th class="th">{$_LANG_['framework.public.state']}</th>
	          <td>				
                  <select  name="state" class="text">
                           <option {if $request.state eq ""} selected="selected"  {/if} value="">{$_LANG_['framework.public.all']}</option>
                      {foreach from=$request.STATE_CONF item=val key=key}
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
	
	<div class="cf">
		 <div class="fl">
            <a class="btn" href="/merchant/add">{$_LANG_['merchant.index.add_merchant']}</a> 
        </div>
    </div>
    <!-- 数据列表 -->
    <div class="data-table table-striped">
	<table>
    	<thead>
			<tr>
				<th colspan="1" rowspan="1">{$_LANG_['framework.public.id']}</th>
				<th>{$_LANG_['merchant.index.type']}</th>
				<th>{$_LANG_['merchant.index.realname']}</th>
				<th>{$_LANG_['merchant.index.nikename']}</th>
                <th>{$_LANG_['merchant.index.idno']}</th>
                <th>{$_LANG_['merchant.index.id_pic']}</th>
                <th>{$_LANG_['merchant.index.company_name']}</th>
                <th>{$_LANG_['merchant.index.email']}</th>
                <th>{$_LANG_['merchant.index.business_license_no']}</th>
                <th>{$_LANG_['merchant.index.business_license_pic']}</th>
                <th>{$_LANG_['merchant.index.bank_name']}</th>
                <th>{$_LANG_['merchant.index.bank_card_no']}</th>
                <th>{$_LANG_['merchant.index.bank_of_deposit']}</th>
                <th>{$_LANG_['merchant.index.contact']}</th>

                <th>POS</th>
                <th>{$_LANG_['merchant.index.user']}</th>
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
				<td>{$_LANG_[$request.TYPE_CONF[$item.type]['NAME']]}</td>
				<td>{$item.real_name}</td>
				<td>{$item.nick_name}</td>
                <td>{$item.idno}</td>
                <td>{$_LANG_['framework.public.view']}</td>

                <td>{$item.company_name}</th>
                <th>{$item.email}</td>
                <td>{$item.business_license_no}</td>
                <td>{$_LANG_['framework.public.view']}</td>
                <td>{$item.bank_name}</td>
                <td>{$item.bank_card_no}</td>
                <td>{$item.bank_of_deposit}</td>
                <td>{$item.contact}</td>
                <td>{$_LANG_['framework.public.view']}</td>
                <td>
                    <a href="/user/inex/?id={$item.id}" title="{$_LANG_['framework.public.view']}"> {$_LANG_['framework.public.view']}</a>
                </td>
				<td>{$item.ctime}</td>
				<td>{$item.utime}</td>
                <td>
                    <a href="/merchant/edit/?id={$item.id}" title="{$_LANG_['framework.public.edit']}" class="btn"> {$_LANG_['framework.public.edit']}</a>
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
<script type="text/javascript">
    $(function () {
        // 时间控件
        $(".datetime").datetimepicker({
                format: "yyyy-mm-dd",
                language: {$lang},
                autoclose: true,
                startView: 2,
                minView:2
        });
    }
</script>
{include file="footer.tpl"}
    
