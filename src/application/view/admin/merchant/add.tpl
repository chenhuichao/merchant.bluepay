{include file="header.tpl"}
<!-- 标题栏 -->
	<div class="main-title">
		<h2>{$_LANG_['merchant.index.add_merchant']}</h2>
	</div>
	{$info}
	<!-- 表单内容 -->
	<div class="tab-wrap">
		<div class="tab-content">
			<form  class="form-horizontal" action="/merchant/add/?type=do" method="post">
				<div class="form-item">
		            <label class="item-label">{$_LANG_['merchant.index.type']}</label>
					<div class="controls">
							<select id="type" name="type" class="input-large">
								<option selected="selected" value="{$request.TYPE_STV.TYPE_COMPANY}">{$_LANG_['merchant.entity.type.company']}</option>
							<option value="{$request.TYPE_STV.TYPE_PERSONAL}">{$_LANG_['merchant.entity.type.personal']}</option>
							</select>
				     </div>
		        </div>

		        <div class="form-item">
		            <label class="item-label">{$_LANG_['framework.public.mobile']}</label>
					<div class="controls">
								<input type="text" autofocus="true" value=""  class="text input-large" name="mobile" id="mobile">
				     </div>
		        </div>
	        	<div class="form-item">
		            <label class="item-label">{$_LANG_['framework.public.email']}</label>
					<div class="controls">
								<input type="text" autofocus="true" value="" class="text input-large" name="email" id="email">
				    </div>
		        </div>
		        <div class="form-item personal-group">
		            <label class="item-label">{$_LANG_['merchant.index.nick_ename']}</label>
					<div class="controls">
								<input type="text" autofocus="true" value=""  class="text input-large" name="nick_name" id="nick_name">
				     </div>
		        </div>
				<div class="form-item personal-group">
		            <label class="item-label">{$_LANG_['merchant.index.real_name']}</label>
					<div class="controls">
								<input type="text" autofocus="true" value=""  class="text input-large" name="real_name" id="real_name">
				     </div>
		        </div>
		        <div class="form-item">
		            <label class="item-label">{$_LANG_['merchant.index.bank_name']}</label>
					<div class="controls">
								<input type="text" autofocus="true" value="" class="text input-large" name="bank_name" id="bank_name">
				     </div>
		        </div>
		        <div class="form-item">
		            <label class="item-label">{$_LANG_['merchant.index.bank_card_no']}</label>
					<div class="controls">
								<input type="text" autofocus="true" value="" class="text input-large" name="bank_card_no" id="bank_card_no">
				     </div>
		        </div>
		        <div class="form-item">
		            <label class="item-label">{$_LANG_['merchant.index.bank_of_deposit']}</label>
					<div class="controls">
								<input type="text" autofocus="true" value="" class="text input-large" name="bank_of_deposit" id="bank_of_deposit">
				     </div>
		        </div>
		         <div class="form-item personal-group">
		            <label class="item-label">{$_LANG_['merchant.index.id_pic']}</label>
		            <input type="hidden" autofocus="true" value="" class="text input-large" name="id_pic" id="id_pic">
					<div class="controls">
						<div>
	                        <input type="button" value="上传文件" class="file"><span>{$err.msg}</span>
	                    </div>

				        <ul>
				        {if strlen($record.id_pic)}
						<li key="{$record.id_pic}" onmouseover="onMouseOver($(this))" onmouseout="onMouseOut($(this))" style="position: relative;"><a href="#" class="btnShow"><img style="width: 150px;height: 100px;" src="/file?key=s_{$record.id_pic}"/></a><div class="delate-image-fuceng" style="display: none" onclick="del($(this))"></div></li>
						{/if}
				        </ul>
				     </div>
		        </div>
		        <div class="form-item personal-group">
		            <label class="item-label">{$_LANG_['merchant.index.id_no']}</label>
					<div class="controls">
								<input type="text" autofocus="true" value="" class="text input-large" name="id_no" id="id_no">
				     </div>
		        </div>
		        <div class="form-item company-group">
		            <label class="item-label">{$_LANG_['merchant.index.company_name']}</label>
					<div class="controls">
								<input type="text" autofocus="true" value="" class="text input-large" name="company_name" id="company_name">
				     </div>
		        </div>
		        <div class="form-item company-group">
		            <label class="item-label">{$_LANG_['merchant.index.contact']}</label>
					<div class="controls">
								<input type="text" autofocus="true" value="" class="text input-large" name="contact" id="contact">
				     </div>
		        </div>
		        <div class="form-item company-group">
		            <label class="item-label">{$_LANG_['merchant.index.business_license_pic']}</label>
					<div class="controls">
								<input type="text" autofocus="true" value="" class="text input-large" name="business_license_pic" id="business_license_pic">
				     </div>

		        </div>
		        <div class="form-item company-group">
		            <label class="item-label">{$_LANG_['merchant.index.business_license_no']}</label>
					<div class="controls">
								<input type="text" autofocus="true" value="" class="text input-large" name="business_license_no" id="business_license_no">
				     </div>
		        </div>
				
				<div class="form-item">
		            <label class="item-label">{$_LANG_['framework.public.state']}</label>
					<div class="controls">
						<select id="state" name="state" class=" input-large">
							<option {if $record->state eq $request.STATE_STV.STATE_VALID}selected="selected"{/if}  value="{$request.STATE_STV.STATE_VALID}">{$_LANG_['merchant.entity.state.valid']}</option>
							<option {if $record->state eq $request.STATE_STV.STATE_INVALID}selected="selected"{/if}   value="{$request.STATE_STV.STATE_INVALID}">{$_LANG_['merchant.entity.state.invalid']}</option>
						</select>
				     </div>
		        </div>

				<div class="form-item">
		            <label class="item-label">{$_LANG_['framework.public.remark']}</label>
					<div class="controls">
								<textarea style="width:400px; height:150px;" id="remark" name="remark"></textarea>
				     </div>
		        </div>
		      
				<div class="form-item">
						<div><button type="submit" class="btn">{$_LANG_['framework.public.submit']}</button>
						<a class="btn btn-info" href="/merchant/index/">{$_LANG_['framework.public.return']}</a>
				     </div>
		        </div>
			</form>
		</div>
		</div>

{literal}
    <script>
        var htmlcontent = '<div id="uploaddiv"  class="uploaddiv-special"><div id="filelist"></div><div id="container"><a id="pickfiles" href="javascript:;">'+JS_LANG['js.file.pick_file']+'</a> <a id="uploadfiles" href="javascript:;">'+JS_LANG['js.file.upload']+'</a></div><pre id="console" style="border: 0;margin: 0;padding: 0;"></pre></div>';
        var obj;
        $(document).ready(function() {
            $(".file").on("click",function() {
                obj=$(this).parent();
                //$(this).next().html("");
                $("#uploaddiv").remove();
                $(this).parent().append(htmlcontent);
                $("#uploaddiv").slideDown();
                var key='';
                var uploader = new plupload.Uploader({
                    resize : {width : 800, height : 800, quality : 90},
                    runtimes : 'html5,flash,silverlight,html4',
                    file_data_name :'Filedata',
                    browse_button : 'pickfiles', // you can pass in id...
                    container: document.getElementById('container'), // ... or DOM Element itself
                    url : "/upload/index",
                    filters : {
                        max_file_size : '10mb',
                        mime_types: [
                            {title : "Image files", extensions : "jpg,gif,png"},
                            {title : "Zip files", extensions : "zip,rar,docx"}
                        ]
                    },
                    flash_swf_url : '{$_STATIC_}/js/plupload/Moxie.cdn.swf',
                    silverlight_xap_url : '{$_STATIC_}/js/plupload/Moxie.cdn.xap',
                    init: {
                        PostInit: function() {
                            document.getElementById('filelist').innerHTML = '';
                            document.getElementById('uploadfiles').onclick = function() {
                                uploader.start();
                                return false;
                            };
                        },
                        FilesAdded: function(up, files) {
                            document.getElementById('console').innerHTML = '';
                            plupload.each(files, function(file) {
                                document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
                            });
                        },
                        UploadComplete: function(up, files) {

                        },
                        UploadProgress: function(up, file) {
                            document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
                            if(file.percent == 100){
                                $("#"+file.id).slideUp(500);
                            }
                        },
                        FileUploaded: function(up, file, response) {
                            var data = $.parseJSON(response.response);

                            key = obj.prev().val();
                            if(key){
                                key += "," +data.key +",";
                            }else{
                                key += data.key +",";
                            }

                            var newkey=key.substring(0,key.length-1);
                            obj.prev().val(newkey);

                            if(data.type == 'img'){
                                var html='<li key="'+data.key+'" onmouseover="onMouseOver($(this))" onmouseout="onMouseOut($(this))" style="position: relative;"><a href="#" class="btnShow"><img style="width: 150px;height: 100px;" src="/file?key=s_'+data.key+'"/></a><div class="delate-image-fuceng" style="display: none" onclick="del($(this))"></div></li>';
                            }else{
                                var html='<li key="'+data.key+'"><a href="/file?key=s_'+data.key+'">'+data.filename+'</a></li>';
                            }

                            //$("#uploaddiv").remove();
                            obj.parent().find("ul").append(html);
                            obj.parent().parent().find("td:eq(0)").find("span").html('');
                        },
                        Error: function(up, err) {
                            document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
                        }
                    }
                });
                uploader.init();
                lnk = document.getElementById("pickfiles");

                lnk.click();
            });

            var type = $("#type").val();
           	if(type == 1){
           		$('.company-group').show();
           		$('.personal-group').hide();
           	}else if(type == 2){
           		$('.company-group').hide();
           		$('.personal-group').show();
           	}

           	$('#type').change(function(){
           		var type = $(this).val();
           		if(type == 1){
	           		$('.company-group').show();
	           		$('.personal-group').hide();
	           	}else if(type == 2){
	           		$('.company-group').hide();
	           		$('.personal-group').show();
	           	}
           	});
        });

        //移入事件
        function onMouseOver(obj){
            obj.find(".delate-image-fuceng").show();
        }
        //移出事件
        function onMouseOut(obj){
            obj.find(".delate-image-fuceng").hide();
        }

        //删除
        function del(obj){
            var key=obj.parent().attr("key");
            var key1=key+",";
            var key2=","+key;
            var h_key=obj.parent().parent().parent().find('[type="hidden"]').val();
            var new_key=h_key.replace(key1,"");
            new_key=new_key.replace(key2,"");
            new_key=new_key.replace(key,"");

            obj.parent().parent().parent().find('[type="hidden"]').val(new_key);
            obj.parent().remove();
        }
    </script>
{/literal}
{include file="footer.tpl"}
