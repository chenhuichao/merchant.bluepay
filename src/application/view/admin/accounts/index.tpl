{include file="header.tpl"}
	<style>
	.table .th{ width:200px;text-align:right;line-height:2;}
	.table-responsive { border:1px; }
	</style>
	<div class="main-title">
		<h2>{$_LANG_['accounts.index.title']}</h2>
	</div>

	<div class="table-responsive">
		<form  class="form-horizontal" action="/accounts/index?" method="get">
		<table class="table table-striped table-bordered bootstrap-datatable">
	      <tbody>
	        <tr>
              <th class="th">{$_LANG_['transaction.index.merchant_id']}</th>
              <td>
                  <input type="text" autofocus="true" class="text" value="{$request.merchant_id}" name="merchant_id" id="merchant_id">
              </td>
               <th class="th">{$_LANG_['framework.public.update_datetime']}</th>
              <td>
                <input type="text" class="text  datetime" value="{$request.daystart}" name="daystart"  /> - 
                <input type="text" class="text  datetime" value="{$request.dayend}" name="dayend"  />　
              </td>
           
	            <th><button type="submit" class="btn btn-info" style="margin-left:200px;">{$_LANG_['framework.public.search']}</button></th>
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
				<th>{$_LANG_['accounts.index.merchant_id']}</th>
				<th>{$_LANG_['accounts.index.balance']}</th>

				<th>{$_LANG_['framework.public.create_time']}</th>
				<th>{$_LANG_['framework.public.update_time']}</th>
        <th>{$_LANG_['framework.public.action']}</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$results.record item=item key=key}
			<tr id="tr_{$item.id}">
				<td>{$key+1}</td>
				<td>{$item.merchant_id}</td>
        <td>{$_LANG_[$request.MERCHANT_TYPE_CONF[$item.merchant_type]['NAME']]}</td>
        <td>{$item.company_name}</td>
        <td>{$item.real_name}</td>
				<td>{$item.balance}</td>

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
    
