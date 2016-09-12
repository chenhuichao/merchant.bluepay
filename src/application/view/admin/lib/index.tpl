{include file="header.tpl"}
	<style>
	.table .th{ width:200px;text-align:right;line-height:2;}
	.table-responsive { border:1px; }
	</style>
	<div class="main-title">
		<h2>库列表</h2>
	</div>

	<div class="table-responsive">
		<form  class="form-horizontal" action="/lib?" method="get">
		<table class="table table-striped table-bordered bootstrap-datatable">
	      <tbody>
	        <tr>
	          <th class="th">项目名称</th>
	          <td>
                  <select  class="text" name="pid">
                      <option {if $request.pid eq ""} selected="selected"  {/if} value="">全部</option>
                      {foreach from=$website.record item=val}
                          <option value="{$val.id}" {if $request.pid == $val.id}selected="selected" {/if}>{$val.wname}</option>
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
                  <select  name="state" class="text">
                           <option {if $request.state eq ""} selected="selected"  {/if} value="">全部</option>
                      {foreach from=$status item=val key=key}
                          <option value="{$key}" {if $request.state == $key}selected="selected" {/if}>{$val.NAME}</option>
                      {/foreach}
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
            <a class="btn" href="/lib/pull/{if $request.pid gt 0}?pid={$request.pid}{/if}">获取指定版本代码</a> 
        </div>
    </div>
    <!-- 数据列表 -->
    <div class="data-table table-striped">
	<table>
    	<thead>
			<tr>
				<th colspan="1" rowspan="1">序号</th>
				<th >项目名称</th>
				<th >项目根目录</th>
				<th >状态</th>
				<th >创建时间</th>
				<th >更新时间</th>
                <th >操作</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$results.record item=item key=key}
			<tr id="tr_{$item.id}">
                <input type="hidden" class="lib_id" value="{$item.id}">
				<td>{$key+1}</td>
				<td>{$item.pname}</td>
				<td><a href="#" class="open" alt='1'>{$item.path}</a></td>
				<td>{$item.sname}</td>
				<td>{$item.ctime}</td>
				<td>{$item.utime}</td>
                <td>
                    <a class="btn update" href="#" alt="{$item.pid}">同步</a>
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
    <div class="modal-dialog" role="document" style="width: 800px;">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body" id="CON" style="height: 800px;">

            </div>
            {*<div class="modal-footer">*}
                {*<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>*}
                {*<button type="button" class="btn btn-primary">Save changes</button>*}
            {*</div>*}
        </div>
    </div>
</div>
		
{*<link href="{$_STATIC_}/datetimepicker/css/datetimepicker.css" rel="stylesheet" type="text/css">*}
{*<link href="{$_STATIC_}/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">*}
{*<script type="text/javascript" src="{$_STATIC_}/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>*}
{*<script type="text/javascript" src="{$_STATIC_}/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>*}
<script type="text/javascript">
    $(function () {
        // 时间控件
        $(".datetime").datetimepicker({
                    format: "yyyy-mm-dd",
                    language: "zh-CN",
                    autoclose: true,
                    startView: 2,
                    minView:2
        });

        $('table').on('click', '.open', function(){

            var obj = $(this);
            var now_path = obj.html();
            var path = now_path;
            var superior = obj.attr("superior");
            if(superior){
                 path = superior+"/"+path;
            }
            var alt = obj.attr("alt");
            var old_num = obj.parent().prev().prev().html();
            var p_left = old_num.length*25;
            var style = "padding-left: "+p_left+"px;";
            var children = 'children_'+old_num;
            if(alt == '1'){
                $.ajax({
                    type: "POST",
                    data:{ "path":path},
                    url: "/lib/index",
                    dataType: "json",
                    success: function(data) {
                        if(data.code == 1){
                            var html='';
                            var num=old_num+1;
                            for(var i in data.data){

                                html+='<tr class="'+children+'">'+
                                        '<td>'+num+'</td>'+
                                        '<td></td>'+
                                        '<td style="'+style+'"><a href="#" class="open" alt="1" superior="'+path+'">'+data.data[i]+'</a></td>'+
                                        '<td></td>' +
                                        '<td></td>' +
                                        '<td></td>' +
                                        '<td></td>' +
                                        '</tr>';
                                num++;
                            }

                            obj.parent().parent().after(html);
                            obj.attr("alt","2");

                        }
                        if(data.code == 2){
//                            obj.attr("data-toggle","modal");
//                            obj.attr("data-target","#myModal");
                            $("#myModalLabel").html(now_path);
                            var ifarm = '<iframe width="100%" height="100%" frameborder="0" scrolling="auto" marginheight="0" marginwidth="0" src="/highlight?filepath='+path+'"></iframe>';
                            $("#CON").html(ifarm);
                            //$("#CON").append(data.data);
                            //alert(data.data);
                            $('#myModal').modal('toggle');

                        }
                    },
                    error:function(){
                        //alert("error");
                    }
                });
            }else{                  
                obj.parent().parent().nextAll("."+children).remove();
                obj.attr("alt","1");
            }


        })

        //同步
        $(".update").click(function(){

            var lib_id = $(this).parent().parent().find(".lib_id").val();
            var wid = $(this).attr("alt");
            var path = $(this).parent().parent().find(".open").html();
            $.ajax({
                type: "POST",
                data:{ "lib_id":lib_id,"up_wid":wid,"path":path},
                url: "/liblog/add?action=do",
                dataType: "json",
                success: function(data) {
                    if(data.code == 1){
                        window.location.reload();
                    }else{
                        alert(data.msg);
                    }
                },
                error:function(){
                    //alert("error");
                }
            });

        })

    });

</script>
{include file="footer.tpl"}
    
