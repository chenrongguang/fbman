<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>公告管理</title>
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
            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-6">
                    <div class="am-btn-toolbar">
                        <div class="am-btn-group am-btn-group-xs">
                            <button type="button" class="am-btn am-btn-default" onclick="_add();"><span class="am-icon-plus" ></span> 新增</button>
                            <button type="button" class="am-btn am-btn-default" onclick="_richtext();"><span class="am-icon-trash-o"></span> 富文本编辑器</button>
                        </div>
                    </div>
                </div>

                <div class="am-u-sm-12 am-u-md-3">
                    <div class="am-input-group am-input-group-sm">
                        <input type="text" class="am-form-field" id="keywords">
                          <span class="am-input-group-btn">
                            <button class="am-btn am-btn-default" type="button" onclick="_search()" class="searchbtn">搜索</button>
                          </span>
                    </div>
                </div>
            </div>

            <div class="am-g">
                <div class="am-u-sm-12">
                    <form class="am-form">
                        <table class="am-table am-table-striped am-table-hover table-main">
                            <thead>
                            <tr>
                                <th class="table-check"><input type="checkbox" class="checkAll" onclick="clickAll()" /></th>
                                <th class="table-id">ID</th>
                                <th class="table-title">标题</th>
                                <th class="table-date am-hide-sm-only">创建时间</th>
                                <th class="table-set">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="tr_<?php echo ($vo["id"]); ?>">
                                    <td><input type="checkbox"  class="checkOne" onclick="clickOne()" value="<?php echo ($vo["id"]); ?>"/></td>
                                    <td><?php echo ($vo["id"]); ?></td>
                                    <td><a href="/home/message/edit/messid/<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></a></td>
                                    <td><?php echo (date("Y-m-d H:i:s",$vo["create_time"])); ?></td>
                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                                                <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-copy"></span> 复制</button>
                                                <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" onclick="_del('<?php echo ($vo["id"]); ?>')"><span class="am-icon-trash-o"></span> 删除</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            <?php if(empty($list)): ?><tr>
                                    <td colspan="5">目前没有相关信息</td>
                                </tr><?php endif; ?>

                            </tbody>
                        </table>
                        <?php if(!empty($list)): ?><div id="page">
                                <?php echo ($page); ?>
                            </div><?php endif; ?>
                        <hr />
                    </form>
                </div>

            </div>
        </div>

        <footer class="admin-content-footer">
            <hr>
            <p class="am-padding-left">© 2016 crg.</p>
        </footer>

    </div>
    <!-- content end -->
</div>

<script type="text/javascript">
    var CONST_SERACH_STR = "请输入关键字";
    function _search() {
        var keyworks = $.trim($('#keywords').val());
        if (keyworks == CONST_SERACH_STR) {
            keyworks = "";
        }

        window.location.href = "/home/message/messlist?keywords=" + keyworks;
    }

    //新增
    function _add(){
        window.location.href = "/home/message/add";
    }

    //富文本编辑器开发
    function _richtext(){
        window.location.href = "/home/message/richtext";
    }


    function _del(id){
        //alert(id);
        $.ajax({
            type : "post",
            url : '/home/message/delDo',
            data : JSON.stringify({messid:id}),
            async : false,
            success : function(data){
                return_handle(data);
                /*
                if(data.result=='SUCCESS'){
                    location.href= data.return_data.url;
                }else{
                    alert(data.return_msg);
                }
                */
            }
        });

    }

</script>

</body>
</html>