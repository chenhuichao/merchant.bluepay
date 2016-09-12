<body>
    <!-- 头部 -->
    <div class="header">
        <!-- Logo -->
        <span class="logo">代码部署系统</span>
        <!-- /Logo -->

        <!-- 主导航 -->
        <ul class="main-nav">
            <li class="current"><a href="">内容</a></li>
        </ul>


        <!-- 用户栏 -->
        <div class="user-bar">
            <a href="javascript:;" class="user-entrance"><i class="icon-user"></i></a>
            <ul class="nav-list user-menu hidden">
                <li class="manager">您好，<em title="{$session.name}">{$session.name}</em></li>
                <li><a href="/userinfo">修改密码</a></li>
                <li><a href="/login/?type=logout">退出</a></li>
            </ul>
        </div>
    </div>
    <!-- /头部 -->

    <!-- 边栏 -->
    <div class="sidebar">
        <div id="subnav" class="subnav">
        <!-- 子导航 -->
        {foreach from=$menu item=v1}
			<li>
				<h3><i class="icon icon-unfold"></i>{$v1.title}</h3>    
				<ul class="side-sub-menu">
				{foreach $v1.childen item=v2}
					<li {if isset($v1.menu) && isset($v2.menu)}class="{$v2.menu}"{/if}><a href="/{$v2.name}/{$v2.action}" class="item">{$v2.title}</a></li>
				{/foreach}
				</ul>
			</li>
		{/foreach}
        <!-- /子导航 -->
        </div>
    </div>
    <!-- /边栏 -->

    <!-- 内容区 -->
    <div id="main-content">
        <div id="top-alert" class="fixed alert alert-error" style="display: none;">
            <button class="close fixed" style="margin-top: 4px;">&times;</button>
            <div class="alert-content">这是内容</div>
        </div>
        <div id="main" class="main">