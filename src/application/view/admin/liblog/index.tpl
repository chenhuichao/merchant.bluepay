{include file="header.tpl"}
	<div id="myModal" class="modal fade">
	  <div class="modal-dialog" role="document" style="width: 800px;">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">命令执行结果</h4>
	      </div>
	      <div class="modal-body">
	        <p id="con" style="min-height:300px;">
	        </p>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- 标题栏 -->
	<div class="main-title">
		<h2>日志流水</h2>
	</div>
	
	<div class="table-responsive">
		<style>
			.table .th{ width:150px;text-align:right;line-height:2;}
			.table-responsive { border:1px; }
		</style>
		<form  class="form-horizontal" action="/liblog/index/" method="get">
		<table class="table table-striped table-bordered bootstrap-datatable">
	      <tbody>
	        <tr>
	          <th class="th">任务类型</th>
	          <td>
				<select name="type" class="text">
					<option {if $request.type eq ''}selected="selected"  {/if} value="">全选</option>
							<option {if $request.type eq $request.TYPE_CONF_STV.TYPE_CO}selected="selected"  {/if} value="{$request.TYPE_CONF_STV.TYPE_CO}">检出</option>
	    					<option {if $request.type eq $request.TYPE_CONF_STV.TYPE_UP}selected="selected"  {/if} value="{$request.TYPE_CONF_STV.TYPE_UP}">更新</option>
	    					<option {if $request.type eq $request.TYPE_CONF_STV.TYPE_SSH}selected="selected"  {/if} value="{$request.TYPE_CONF_STV.TYPE_SSH}">部署</option>
	  			</select>
	          </td>

	          <th class="th">更新时间</th>
	          <td><input type="text" class="text  datetime" value="{$request.daystart}" name="daystart"  /> - 
	          	  <input type="text" class="text  datetime" value="{$request.dayend}" name="dayend"  />　
	          </td>
  	        </tr>	          
            <tr>
              <th class="th">状态</th>
	          <td>				
                  <select  name="state" class="text">
                        <option {if $request.state eq ''}selected="selected"  {/if} value="">全选</option>
							<option {if $request.state eq $request.STATE_CONF_STV.STATE_INITIAL}selected="selected"  {/if} value="{$request.STATE_CONF_STV.STATE_INITIAL}">初始</option>
	    					<option {if $request.state eq $request.STATE_CONF_STV.STATE_SUCC}selected="selected"  {/if} value="{$request.STATE_CONF_STV.STATE_SUCC}">成功</option>
	    					<option {if $request.state eq $request.STATE_CONF_STV.STATE_FAIL}selected="selected"  {/if} value="{$request.STATE_CONF_STV.STATE_FAIL}">失败</option>
	    		  </select>
	          </td>
  	        </tr>
	        <tr>
	          <th colspan="4"><button type="submit" class="btn btn-info" style="margin-left:200px;">搜索</button></th>
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
				<th colspan="1" rowspan="1">编号</th>
				<th >项目名称</th>
				<th >CMD</th>
				<th >任务类型</th>
				<th >分类</th>
				<th >添加人</th>
				<th >状态</th>
				<th >执行结果</th>
				<th >更新时间</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$results.record item=item}
			<tr id="tr_{$item.id}">
				<td>{$item.id}</td>
				<td>{$item.wname}</td>
				<td><pre style="background-color:yellow">{$item.cmd}</pre></td>
				<td>{$item.tname}</td>
				<td>{$item.cat}</td>
				<td>{$item.aname}</td>
				<td>{$item.sname}</td>
				<td>
					<a onclick="showResult('{$item.result}')">查看</a>
			    </td>
				<td>{$item['utime']}</td>
			</tr>
			{/foreach}
		</tbody>
	</table>
</div>
<div class="page">
	<div>  
	{$results.pages} 
	<span class="rows">共 {$results.total} 条记录</span>
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
                    language: "zh-CN",
                    autoclose: true,
                    startView: 2,
                    minView:2,
        });
    });

    function showResult(result){
    	$('#con').html(result);
    	$('#myModal').modal('show');
    }
</script>
{include file="footer.tpl"}