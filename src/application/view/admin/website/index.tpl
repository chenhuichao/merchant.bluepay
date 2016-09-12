{include file="header.tpl"}
<style>
    .table .th{ width:200px;text-align:right;line-height:2;}
    .table-responsive { border:1px; }
</style>
<div class="main-title">
    <h2>项目列表</h2>
</div>

<div class="table-responsive">
    <form  class="form-horizontal" action="/website?" method="get">
        <table class="table table-striped table-bordered bootstrap-datatable">
            <tbody>
            <tr>
                <th class="th">项目名称</th>
                <td>
                    <input type="text" class="text" value="{$request.wname}" name="wname">
                </td>

                <th class="th">更新日期</th>
                <td>
                    <input type="text" class="text  datetime" value="{$request.startime}" name="startime"  /> -
                    <input type="text" class="text  datetime" value="{$request.endtime}" name="endtime"  />　
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
        <a class="btn" href="/website/add/">新建</a>
    </div>
</div>

    <div class="data-table table-striped">
	    <table class="table table-striped table-bordered bootstrap-datatable">
		  <thead>
			<tr role="row">
			  <th style="width:20px;" colspan="1" rowspan="1">编号</th>
			  <th style="width:45px;" colspan="1" rowspan="1">项目名称</th>
              <th style="width:45px;" colspan="1" rowspan="1">版本控制系统</th>
              <th style="width:50px;" colspan="1" rowspan="1">版本库路径</th>
              <th style="width:50px;" colspan="1" rowspan="1">开发语言</th>
              <th style="width:50px;" colspan="1" rowspan="1">更新时间</th>
			  <th style="width:50px;" colspan="1" rowspan="1">操作</th>
			</tr>
		  </thead>
		  <tbody aria-relevant="all" aria-live="polite" role="alert">
		   {foreach from=$results.record item=item key=key}
		    <tr id="tr_{$item.id}">
		        <td class="center">
		          {$key + 1}
			</td>

			<td class="center">
		           {$item.wname}
			</td>

            <td class="center">
                {$item.control}
            </td>
            <td class="center">
                {$item.cpath}
            </td>
            <td class="center">
                {$item.language}
            </td>
            <td class="center">
                {$item.utime}
            </td>
			<td class="center">
                <a class="btn update" href="/website/add/?edit_id={$item.id}">编辑</a>
                <a class="btn btn-danger" href="javascript:delById({$item.id});">移除</a>
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

	  function delById(id){
	     var r = confirm("确定要删除该数据吗？")
		 if(r == true){
			 var tr = $("#tr_"+id);
			 $.ajax({
				type: "POST",
				data:{
					"del_id":id
				},	
				url: "/website/index",
				dataType: "json",
				success: function(data) {
					//alert(data);
					if(data.code == "0"){
						 tr.remove();
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
		window.location.href = '/project/?p='+p;
	}
</script>
{include file="footer.tpl"}