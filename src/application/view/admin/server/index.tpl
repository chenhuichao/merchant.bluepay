{include file="header.tpl"}
<style>
    .table .th{ width:200px;text-align:right;line-height:2;}
    .table-responsive { border:1px; }
</style>
<div class="main-title">
    <h2>服务器列表</h2>
</div>

<div class="table-responsive">
    <form  class="form-horizontal" action="/server?" method="get">
        <table class="table table-striped table-bordered bootstrap-datatable">
            <tbody>
            <tr>
                <th class="th">所属服务器组</th>
                <td>
                    <select  name="sgid" class="text">
                        <option value="">全部</option>
                        {foreach from=$group.record item=val}
                            <option value="{$val.id}" {if $request.sgid eq $val.id} selected="selected"  {/if}>{$val.sgname}</option>
                        {/foreach}

                    </select>
                </td>

                <th class="th">更新日期</th>
                <td>
                    <input type="text" class="text  datetime" value="{$request.startime}" name="startime"  /> -
                    <input type="text" class="text  datetime" value="{$request.endtime}" name="endtime"  />　
                </td>
            </tr>
            <tr>
                <th class="th">状态</th>
                <td>
                    <select  name="status" class="text">
                        <option {if $request.status eq ""} selected="selected"  {/if} value="">全部</option>
                        <option {if $request.status eq 1} selected="selected"{/if} value="1">启用</option>
                        <option {if $request.status eq 2} selected="selected"{/if} value="2">禁用</option>
                    </select>
                </td>
                <td colspan="2">
                </td>
            </tr>
            <tr>
                <th colspan="4"><button type="submit" class="btn btn-info" style="margin-left:200px;">搜索</button></th>
            </tr>
            </tbody>
        </table>
    </form>
</div>

<div class="cf">
    <div class="fl">
        <a class="btn" href="/server/add/">新建</a>
    </div>
</div>

<div class="data-table table-striped">

	    <table class="table table-striped table-bordered bootstrap-datatable">
		  <thead>
			<tr role="row">
			  <th style="width:20px;" colspan="1" rowspan="1">编号</th>
			  <th style="width:45px;" colspan="1" rowspan="1">所属服务器组</th>
              <th style="width:45px;" colspan="1" rowspan="1">IP地址</th>
              <th style="width:45px;" colspan="1" rowspan="1">同步路径</th>
              <th style="width:45px;" colspan="1" rowspan="1">同步工具类型</th>
              <th style="width:45px;" colspan="1" rowspan="1">端口</th>
              <th style="width:45px;" colspan="1" rowspan="1">同步用户</th>
              <th style="width:45px;" colspan="1" rowspan="1">状态</th>
			  <th style="width:150px;" colspan="1" rowspan="1">操作</th>
			</tr>
		  </thead>
		  <tbody aria-relevant="all" aria-live="polite" role="alert">
		   {foreach from=$results.record item=item key=key}
		    <tr id="tr_{$item.id}">
		        <td class="center">
		          {$key+1}
			</td>

			<td class="center">
		           {$item.sgname}
			</td>
            <td class="center">
                {$item.ip}
            </td>
            <td class="center">
                {$item.spath}
            </td>
            <td class="center">
                {$item.stype}
            </td>
            <td class="center">
                {$item.port}
            </td>
            <td class="center">
                {$item.sname}
            </td>
            <td class="center">
                {$item.stname}
            </td>
			<td class="center">
                {if $item.status == 1}
                    <a class="btn update" href="/server/add/?edit_id={$item.id}">编辑</a>
                    <a class="btn btn-danger" href="javascript:delById('{$item.id}',0);">移除</a>
                    <a class="btn btn-warning" href="javascript:delById('{$item.id}',1);">禁用</a>
                {else}
                    <a class="btn btn-danger" href="javascript:delById('{$item.id}',0);">移除</a>
                    <a class="btn btn-warning" href="javascript:delById('{$item.id}',2);">启用</a>
                {/if}
			</td>
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

<script type="text/javascript">

    // 时间控件
    $(".datetime").datetimepicker({
        format: "yyyy-mm-dd",
        language: "zh-CN",
        autoclose: true,
        startView: 2,
        minView:2
    });

	  function delById(id,type){
          if(type == 0){
              var r = confirm("确定要删除该数据吗？");
          }else if(type == 1){
              var r = confirm("确定要禁用该数据吗？");
          }else {
              var r = confirm("确定要启用该数据吗？");
          }
		 if(r == true){
			 var tr = $("#tr_"+id);
			 $.ajax({
				type: "POST",
				data:{
					"del_id":id,"type":type
				},	
				url: "/server/index",
				dataType: "json",
				success: function(data) {
					//alert(data);
					if(data.code == "0"){
                        if(type == 0){
                            tr.remove();
                        }else{
                            window.location.reload();
                        }
					}else{
						alert(data.msg);
					}
				},
				error:function(){
					//alert("error");
				}
			});
		}
	}

	function preview(title,content){
		$.dialog({
			padding: 0,
			title: title,
			content: content,
			lock: true
		});
	}
	function goto(){
		var p = $("#p").val();
		p = p>0?p:1;
		window.location.href = '/server/?p='+p;
	}
</script>
{include file="footer.tpl"}