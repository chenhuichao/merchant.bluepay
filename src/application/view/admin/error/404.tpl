<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>404 Not Found</title>
</head>
<body style="background-color: #f0f0f0">
    <div style="text-align: center;margin-top: 300px">
        <div style="font-size: 39px;color: #999">
            页面不存在
        </div>
        <div style="font-size: 22px;color: #999;margin-top: 10px">
             <span id = "span_timer" style="color: #00649d">5</span>秒后自动<a style="color: #00649d" href="/">跳回首页</a>
        </div>
        <div style="background: url('/static/img/404.gif') no-repeat center; height: 300px">

        </div>
    </div>
    <script type="application/javascript">
        var t = 5;
        function countDown(){
            var timeSpan = document.getElementById("span_timer");
            t-- ;
            timeSpan.innerHTML = t;
            if(t <= 0){
                location.href = "/";
                clearInterval(inter);
            }
        };
        var inter = setInterval(countDown,1000);
    </script>
</body>
</html>