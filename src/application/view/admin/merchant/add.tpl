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
					<div class="controls">
	                    <img id="id_pic_0" src="/file?key=s_{$record.id_pic_0}" width="200" height="150"/><br/>
						<input type="file" name="Filedata" class="img-upload-0" value="{$_LANG_['framework.public.upload']}"/>
						<input type="hidden" class="form-control" name="id_pic_0"  value="{$record.id_pic_0}" />
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
    //上传
	$("body").on("change",".img-upload-0",function(){
		var cur = $(this);
		if(checkExt(cur)) {
			cur.wrap('<form enctype="multipart/form-data"/>');
			var options = {
				url : "/upload/index",
				type : "post",
				dataType : "json",
				success : function(data) {
					if(data.status != 0){
						preview(JS_LANG['tips.alert.title'],JS_LANG['tips.alert.status'] + data.status);
					}
					// 清理旧图片
					$("input[name=Filedata]").val('');
					$("input[name=id_pic_0]").val(data.key);

					$("#id_pic_0").attr('src','/file?key=s_' + data.key);
					// 取消form包裹
					cur.unwrap();
					// 此处data可以返回文件ID，然后根据ID查询并返回文件即可
				},
				error : function(XMLHttpRequest, textStatus, errorThrown) {
					alert(textStatus + "," + errorThrown);
				}
			};
			cur.parent("form").ajaxSubmit(options);    // 异步提交
		}
	});
</script>
{/literal}
{include file="footer.tpl"}
