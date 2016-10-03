        </div>
        <div class="cont-ft">
            <div class="copyright" style="float:left;">
				&copy; <a href="#" target="_blank">bluepay.com </a> 2016
            </div>
        </div>
    </div>
    <!-- /内容区 -->

    <script type="text/javascript" src="{$_STATIC_}/js/common.js"></script>

    <script type="text/javascript" >
        +function(){
            var $window = $(window), $subnav = $("#subnav"), url;
            $window.resize(function(){
                $("#main").css("min-height", $window.height() - 130);
            }).resize();

            /* 左边菜单高亮 */
            url = window.location.pathname + window.location.search;
            url = url.replace(/(\/(p)\/\d+)|(&p=\d+)|(\/(id)\/\d+)|(&id=\d+)|(\/(group)\/\d+)|(&group=\d+)/, "");
            $subnav.find("a[href='" + url + "']").parent().addClass("current");

            /* 左边菜单显示收起 */
            $("#subnav").on("click", "h3", function(){
                var $this = $(this);
                $this.find(".icon").toggleClass("icon-fold");
                $this.next().slideToggle("fast").siblings(".side-sub-menu:visible").
                      prev("h3").find("i").addClass("icon-fold").end().end().hide();
            });

            $("#subnav h3 a").click(function(e){ e.stopPropagation() });

            /* 头部管理员菜单 */
            $(".user-bar").mouseenter(function(){
                var userMenu = $(this).children(".user-menu ");
                userMenu.removeClass("hidden");
                clearTimeout(userMenu.data("timeout"));
            }).mouseleave(function(){
                var userMenu = $(this).children(".user-menu");
                userMenu.data("timeout") && clearTimeout(userMenu.data("timeout"));
                userMenu.data("timeout", setTimeout(function(){ userMenu.addClass("hidden") }, 100));
            });

	        /* 表单获取焦点变色 */
	        $("form").on("focus", "input", function(){
		        $(this).addClass('focus');
	        }).on("blur","input",function(){
				        $(this).removeClass('focus');
			        });
		    $("form").on("focus", "textarea", function(){
			    $(this).closest('label').addClass('focus');
		    }).on("blur","textarea",function(){
			    $(this).closest('label').removeClass('focus');
		    });


        }();

        function preview(title,content){
            //alert(content);
            $.dialog({
                padding: 0,
                title: title,
                content: content,
                lock: true
            });
            return false;
        }

        /*
        * 检查文件格式
        */
        function checkExt(obj) {
            var v = obj.val();
            var ext = v.substring(v.lastIndexOf("."));
            if(ext != ".jpg" && ext != ".png" && ext != ".gif") {
                alert(JS_LANG['js.file.upload.file_ext']);
                obj.val("");
                return false;
            }
            return true;
        }

          //上传
        $("body").on("change","#img-upload",function(){
            var cur = $(this);
            if(checkExt(cur)) {
                cur.wrap('<form enctype="multipart/form-data"/>');
                var options = {
                    url : "/admin/index/uploadImg",
                    type : "post",
                    dataType : "json",
                    success : function(data) {
                        if(data.state !='SUCCESS'){
                            return modal.alert(data.state);
                        }
                        // 清理旧图片
                        $(".img_file").remove();
                        $("#img_url").val(data.url);
                        $("#img_show").attr('src',data.url);
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


</body></html>
