{include file="header.tpl"}
<!-- 标题栏 -->
<div class="main-title">
    <h2>项目部署</h2>
</div>
{$info}
<!-- 标签页导航 -->
<div class="tab-wrap">
    <div class="tab-content">
        <form  class="form-horizontal" action="/deployment/deploy/?action=save" method="post">

            <div class="form-item">
                <label class="item-label">选择项目：</label>
                <div class="controls">
                    <select class="text input-large wid" name="add_wid">
                        <option value="0">请选择</option>
                        {foreach from=$website.record item=val}
                            <option value="{$val.id}" {if $add_wid == $val.id}selected="selected"{/if}>{$val.wname}</option>
                        {/foreach}
                    </select>
                </div>
            </div>
            <div class="form-item">
                <label class="item-label">选择项目库：</label>
                <div class="controls">
                    <select class="text input-large lib" name="lib" id="lib">

                    </select>
                </div>
            </div>

            <div class="data-table table-striped ser">
                <table>

                    <thead>
                    <tr>
                        <th>编号</th>
                        <th>服务器组</th>
                        <th>服务器</th>
                    </tr>
                    </thead>

                    <tbody class="server">

                    </tbody>
                </table>
            </div>

            <div class="form-item sub">
                <button type="submit" class="btn">提交</button>
                {*<a class="btn btn-info" href="/role/index">返回</a>*}
            </div>
        </form>

    </div>
</div>
{include file="footer.tpl"}

<script type="text/javascript">

    $(".ser").hide();
    $(".sub").hide();
    $(".wid").change(function(){

        var wid = $(this).val();
        $.ajax({
            type: "POST",
            data:{
                "wid":wid
            },
            url: "/deployment/deploy",
            dataType: "json",
            success: function(data) {

                if(data.code == 1){

                    var lib = data.data.lib;
                    var server = data.data.server;
                    var l_html = '';
                    for(var i in lib){

                        l_html+='<option value="'+lib[i]['id']+'">'+lib[i]['path']+'</option>'
                    }
                    $(".lib").html(l_html);

                    var s_html = '';
                    var s_num = 1;
                    for(var j in server){

                        s_html += '<tr>' +
                                '<td>'+s_num+'</td>' +
                                '<td><input type="checkbox" class="group">'+j+'</td>' +
                                '<td>';
                            for(var e in server[j]){
                                s_html += '<input type="checkbox" class="server" name="server[]" value="'+server[j][e]['id']+'">'+server[j][e]['ip']+':'+server[j][e]['spath']+' ';
                            }
                        s_html +='</td>' +
                                '</tr>';
                        s_num++;
                    }
                    $(".ser").show();
                    $(".sub").show();
                    $(".server").html(s_html);

                }else{
                    alert(data.msg);
                }
            },
            error:function(){
                //alert("error");
            }
        });
    })

    $("table").on('click','.group',function(){

        $(this).parent().parent().find(".server").attr("checked",this.checked);
        $(this).attr('checked', this.checked);
    })

    $(".wid").change();
</script>


