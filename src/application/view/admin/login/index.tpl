<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="UTF-8">
        <title>{$_LANG_['system.welcome']}</title>
		<script type="text/javascript" src="{$_STATIC_}/js/cloudflare.min.js"></script>
		<style type="text/css">.cf-hidden { display: none; } .cf-invisible { visibility: hidden; }</style>
		<script  type="text/javascript" src="{$_STATIC_}/js/rocket.js"></script>
		<link rel="stylesheet" type="text/css" href="{$_STATIC_}/css/login.css" media="all">
       	<link rel="stylesheet" type="text/css" href="{$_STATIC_}/css/default_color.css" media="all">
   	    <script type="text/javascript" src="{$_STATIC_}/js/jquery.min.js"></script>
       	<script type="text/javascript" src="{$_STATIC_}/js/rsa/BigInt.js"></script>
		<script type="text/javascript" src="{$_STATIC_}/js/rsa/Barrett.js"></script>
		<script type="text/javascript" src="{$_STATIC_}/js/rsa/RSA_Stripped.js"></script>
		<script type="text/javascript" src="{$_ROOT_URL}/static/js/public/login.js"></script>
    </head>
    <body id="login-page">
        <div id="main-content">

            <!-- 主体 -->
            <div class="login-body">
                <div class="login-main pr">
                    <form action="/login/check/" method="post" id="login-form" class="login-form">
                        <h3 class="welcome">{$_LANG_['system.name']}</h3>
                        <div class="check-tips"></div>
                        <div id="itemBox" class="item-box">
                            <select id="language" style="width:290px;height:20px;margin-bottom:5px;">
							  	<option value="en-US" {if $lang eq 'en-US'}selected="selected"{/if}>English</option>
							  	<option value="zh-CN" {if $lang eq 'zh-CN'}selected="selected"{/if}>中文</option>
							</select>
                            <div class="item">
                                <i class="icon-login-user"></i>
                                <input type="text" name="account" id="account" placeholder="{$_LANG_['login.tips.user']}" autocomplete="off">
                            </div>
                            <span class="placeholder_copy placeholder_un">{$_LANG_['login.tips.user']}</span>
                            <div class="item b0">
                                <i class="icon-login-pwd"></i>
                                <input type="password" id="password" name="password" placeholder="{$_LANG_['login.tips.pass']}" autocomplete="off" >
                            </div>
                            <span class="placeholder_copy placeholder_pwd">{$_LANG_['login.tips.pass']}</span>
                            <div class="item verifycode" style="width: 170px;float: left;">
                                <i class="icon-login-verifycode"></i>
                                <input type="text" style="width: 100px;" name="verify" id="verify" placeholder="{$_LANG_['login.tips.captcha']}" autocomplete="off">
                                
                            </div>
                            <img class="verifyimg reloadverify" alt="{$_LANG_['login.tips.click']}" src="/verify/?{$time}">
                                
                        </div>
                        <div class="login_btn_panel">
                            <button class="login-btn" type="submit">
                                <span class="in"><i class="icon-loading"></i>{$_LANG_['login.tips.loading']}</span>
                                <span class="on">{$_LANG_['login.tips.login']}</span>
                            </button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <script type="text/javascript" data-rocketoptimized="true">
    	/* 登陆表单获取焦点变色 */
    	$(".login-form").on("focus", "input", function(){
            $(this).closest('.item').addClass('focus');
        }).on("blur","input",function(){
            $(this).closest('.item').removeClass('focus');
        });
		
		$('#language').change(function(){
			window.location.href = '/login?lang='+ $(this).val();
		});

		$(function(){
			//初始化选中用户名输入框
			$("#itemBox").find("input[name=username]").focus();
			//刷新验证码
			var verifyimg = $(".verifyimg").attr("src");
            $(".reloadverify").click(function(){
                if( verifyimg.indexOf('?')>0){
                    $(".verifyimg").attr("src", verifyimg+'&random='+Math.random());
                }else{
                    $(".verifyimg").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
                }
            });

            //placeholder兼容性
                //如果支持 
            function isPlaceholer(){
                var input = document.createElement('input');
                return "placeholder" in input;
            }
                //如果不支持
            if(!isPlaceholer()){
                $(".placeholder_copy").css({
                    display:'block'
                })
                $("#itemBox input").keydown(function(){
                    $(this).parents(".item").next(".placeholder_copy").css({
                        display:'none'
                    })                    
                })
                $("#itemBox input").blur(function(){
                    if($(this).val()==""){
                        $(this).parents(".item").next(".placeholder_copy").css({
                            display:'block'
                        })                      
                    }
                })
                
                
            }
		});
    </script>

</body></html>