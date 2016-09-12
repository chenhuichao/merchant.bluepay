function rsaEnc(txt){
	setMaxDigits(1024);
	var key;
	key=new RSAKeyPair("10001","10001","BB36ED3AB400895497BEBC2B64CCAF0FC6743A18805E1DDEA360901262F3FFC7844F95D36AB514D235405408C1B9C4192B228E8123009FEB8688C42D6F06C91A1C52EE9DFA2399E08122E7562E0F4C2B56110E2B2F291619DAAA97250868A230C2927B1982611776E6E3F77A7F4D6BAC82D3EC9ECF2F00A3FF52A7686B9580A464E9B709B00C1280FD66DCEA06FDFDAE0CBF4335A4A4B3A8CB3B8114810E4568C362BB012B25B1B67353FB09B887A0B916884741E424E711EBAB71DCF8A3EA1C10D21F20C6F6D0D31072D5B08FFC439DAE55FA12C2DADA8F5FC0FE92BB208F9C9442DED076B31B162861E28F8DAD4D1E702DC217AC6AA3840D5B137FB936C69D",2048);
	var ctext = encryptedString(key,txt,RSAAPP.PKCS1Padding,RSAAPP.RawEncoding);
	var v = window.btoa(ctext);
	return v;
}

function timestamp(){
	var timestamp = Date.parse(new Date());
	return timestamp;
}

jQuery(function($) {
	var $verifyImg = $('#verifyImg').click(function() {
		$(this).attr('src','/verify/?'+ timestamp());
	});
	
	var error = function(field, info) {
		$('#login-form-error').remove();
		$('<div class="notification information png_bg" id="login-form-error" style="color:red;" ><div>' + info + '</div></div>').insertBefore('.check-tips');
		$('#' + field).focus();
	};
	
	$('#login-form').submit(function(event) {

		event.preventDefault();
		
		var $form = $(this);
		
		var $account = $('#account');
		if($.trim($account.val()) == '') {
			error('account', '用户名必须填写！');
			return ;
		}
		
		var $password = $('#password');
		if($password.val() == '') {
			error('password', '密码必须填写！');
			return ;
		}
		var tmppass = $password.val();
		
		var $verify = $('#verify');
		if($.trim($verify.val()) == '') {
			error('verify', '验证码必须填写！');
			return ;
		}

		var cpasswd = rsaEnc(tmppass);
		$password.val(cpasswd);
				
		$.post($form.attr('action'), $form.serialize(), function(response) {
			if(response.status == '0') {
				location.href = response.url;
			}else{
				$password.val(tmppass);
				error(response.errorField,response.errorInfo);
				$verifyImg.click();
				$verify.val('');
			}
		}, 'JSON');
	});
});