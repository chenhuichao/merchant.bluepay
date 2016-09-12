{include file="header.tpl"}
<style>
    .table .th{ width:200px;text-align:right;line-height:2;}
    .table-responsive { border:1px; }
</style>
<div class="main-title">
    <h2>服务器组列表</h2>
</div>

<div class="cf">
    <div class="fl">
        <a class="btn" href="/servergroup/add/">新建</a>
    </div>
</div>

    <div class="data-table table-striped">
	    <table class="table table-striped table-bordered bootstrap-datatable">
		  <thead>
			<tr role="row">
			  <th style="width:20px;" colspan="1" rowspan="1">编号</th>
			  <th style="width:45px;" colspan="1" rowspan="1">服务器组名称</th>
              <th style="width:45px;" colspan="1" rowspan="1">状态</th>
              <th style="width:45px;" colspan="1" rowspan="1">描述</th>
			  <th style="width:50px;" colspan="1" rowspan="1">操作</th>
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
                {$item.sname}
            </td>
            <td class="center">
                {$item.remark}
            </td>

			<td class="center">
                {if $item.status == 1}
                    <a class="btn update" href="/servergroup/add/?edit_id={$item.id}">编辑</a>
                    <a class="btn btn-danger" href="javascript:delById('{$item.id}',0)">移除</a>
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
				url: "/servergroup/index/",
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
		window.location.href = '/servergroup/?p='+p;
	}
</script>
{include file="footer.tpl"}