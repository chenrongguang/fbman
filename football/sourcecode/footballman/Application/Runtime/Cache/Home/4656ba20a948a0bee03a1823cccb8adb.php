<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Amaze UI Admin index Examples</title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="/assets/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="/assets/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="/assets/css/amazeui.min.css"/>
    <!--注意以下目录的写法，由于目前assets目录放在了和index.php的同级目录下，所以以下的写法是没有问题的-->
    <link rel="stylesheet" href="/assets/css/admin.css">
    <!--该样式表用于分页-->
    <link rel="stylesheet" href="/assets/css/pagination.css">
    <script type="text/javascript" src="/assets/js/jquery-3.0.0.min.js"></script>
    <script type="text/javascript" src="/assets/js/common.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.uploadify.min.js?id=2"></script>
</head>
<body>
<div>
    <!--在模板里边只需要用以下语句就可以了，并且用了冒号的方式，具体的用法可以查询thinkphp对于模板中include的用法-->
    <header class="am-topbar am-topbar-inverse admin-header">
    <div class="am-topbar-brand">
        <strong>XX</strong> <small>后台管理系统</small>
    </div>

    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>
    <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

        <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
            <li><a href="javascript:;"><span class="am-icon-envelope-o"></span> 收件箱 <span class="am-badge am-badge-warning">5</span></a></li>
            <li class="am-dropdown" data-am-dropdown>
                <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
                    <span class="am-icon-users"></span> 管理员 <span class="am-icon-caret-down"></span>
                </a>
                <ul class="am-dropdown-content">
                    <li><a href="#"><span class="am-icon-user"></span> 资料</a></li>
                    <li><a href="#"><span class="am-icon-cog"></span> 设置</a></li>
                    <li><a href="#"><span class="am-icon-power-off"></span> 退出</a></li>
                </ul>
            </li>
            <li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>
        </ul>
    </div>
</header>
</div>
<div class="am-cf admin-main">
    <!-- sidebar start -->
<div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
    <div class="am-offcanvas-bar admin-offcanvas-bar">
        <ul class="am-list admin-sidebar-list">
            <li><a href="/home/index/"><span class="am-icon-home"></span> 首页</a></li>
            <li class="admin-parent">
                <a class="am-cf" data-am-collapse="{target: '#collapse-nav'}"><span class="am-icon-file"></span> 页面模块 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
                <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav">
                    <li><a href="admin-user.html" class="am-cf"><span class="am-icon-check"></span> 个人资料<span class="am-icon-star am-fr am-margin-right admin-icon-yellow"></span></a></li>
                    <li><a href="admin-help.html"><span class="am-icon-puzzle-piece"></span> 帮助页</a></li>
                    <li><a href="admin-gallery.html"><span class="am-icon-th"></span> 相册页面<span class="am-badge am-badge-secondary am-margin-right am-fr">24</span></a></li>
                    <li><a href="admin-log.html"><span class="am-icon-calendar"></span> 系统日志</a></li>
                    <li><a href="admin-404.html"><span class="am-icon-bug"></span> 404</a></li>
                </ul>
            </li>
            <!--注意以下路径的配置，如果最前面加一个/和不加一个/是有区别的，如果加一个/则表示域名之后直接拼上这个就行，如果不加/就表示当前url之后拼上这个配置，两者的结果完全不一样哦-->
            <li><a href="/home/PalertSetting/settinglist"><span class="am-icon-table"></span> 表格</a></li>
            <li><a href="admin-form.html"><span class="am-icon-pencil-square-o"></span> 表单</a></li>
            <li><a href="/home/login/logoutDo"><span class="am-icon-sign-out"></span> 注销</a></li>
            <li><a href="/home/message/messlist"><span class="am-icon-sign-out"></span> 公告管理</a></li>
        </ul>


        <div class="am-panel am-panel-default admin-sidebar-panel">
            <div class="am-panel-bd">
                <p><span class="am-icon-tag"></span> wiki</p>
                <p>Welcome to the Amaze UI wiki!</p>
            </div>
        </div>
    </div>
</div>
<!-- sidebar end -->

    <!-- content start -->
    <div class="admin-content">
        <div class="admin-content-body">
            <div class="am-cf am-padding am-padding-bottom-0">
                <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">公告管理</strong> / <small>公告列表</small></div>
            </div>
            <hr>
        <div class="am-tabs-bd">
            <div class="am-tab-panel am-fade am-in am-active" id="tab1">
                <form class="am-form am-form-horizontal">
                    <div class="am-form-group">
                        <label for="user-name" class="am-u-sm-3 am-form-label">标题</label>
                        <div class="am-u-sm-9">
                            <input type="text" id="title" placeholder="标题" name="title">
                            <small>输入标题。</small>
                        </div>
                    </div>

                    <div class="am-form-group">
                        <p>你可以使用<a href="#">gravatar.com</a>提供的头像或者使用本地上传头像。 </p>
                            <div class="am-u-sm-9">
                                <input type="file" name="image_file" id="image_file" />
                            </div>
                    </div>

                    <div class="am-form-group">
                        <div class="am-u-sm-9 am-u-sm-push-3">
                            <button type="button" class="am-btn am-btn-primary">保存修改</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>>

        <footer class="admin-content-footer">
            <hr>
            <p class="am-padding-left">© 2016 crg.</p>
        </footer>

    </div>
    <!-- content end -->
</div>
</div>

<script type="text/javascript">
    //alert('123');
    //alert('/assets/js/jquery.uploadify.min.js?');

    $(document).ready(function(){
            $("#image_file").uploadify({
                'swf': "/assets/js/uploadify.swf",
                'formData': {SESSION_ID:"<<?php echo session_id();?>>",cid:0},
                'uploader': "/image/upload/tid/"+tid,
                'buttonText': "添加图片",
                'buttonClass':"buttons",
                'width':'110px',
                'fileTypeExts': '*.gif; *.jpg; *.png',
                'fileSizeLimit':"1MB",//正式限制
                'onInit': function () {
                    //$(".uploadify-queue").hide();
                },
                'onUploadSuccess': function (file, data, response) {
                    var jsonData = eval('(' + data + ')');
                    alerts(jsonData['message']);
                   // $("#image_file").uploadify("disable", false);
                },
                'onUploadError':function (file, errorCode, errorMsg, errorString) {
                },
                'onUploadStart': function (file) {
                    //$("#image_file").uploadify("settings", "formData", formData());
                    //在onUploadStart事件中，也就是上传之前，把参数写好传递到后台。
                    //$("#image_file").uploadify("disable", false);
                }
        });
    });

</script>

</body>
</html>