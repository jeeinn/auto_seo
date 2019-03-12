<?php
header("Content-Type:text/html; charset=UTF-8");
error_reporting(E_ALL & ~E_NOTICE);
$d = $_SERVER['QUERY_STRING'];
include "config.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
    <title><?php echo $config['site_title'];?></title>
    <meta name="keywords" content="<?php echo $config['site_keywords'];?>" />
    <meta name="description" content="<?php echo $config['site_description'];?>" />

    <link type="text/css" href="css/bootstrap.min.css" rel="stylesheet" />
    <link type="text/css" href="css/main.css" rel="stylesheet" />
</head>
<body>
<nav class="navbar topbar navbar-tianyu navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <h1 class="navbar-brand topbar-logo">
                <a title="<?php echo $config['page_title'];?>" href="/"><?php echo $config['page_title'];?></a>
            </h1>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="<?php echo $config['nav_link'];?>" target="_blank">
                        <span class="glyphicon glyphicon-home"></span>
                        <?php echo $config['nav_link_text'];?>
                    </a>
                </li>
                <li>
                    <a href="/" class="btn">
                        <span class="glyphicon glyphicon-link"></span>
                        超级外链工具
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container" style="margin-top: 68px;">
	<div class="row" style="margin-top: 28px;">
		<div class="col-md-9">
			<div class="panel panel-tianyu">
				<header class="panel-heading">
					<span class="glyphicon glyphicon-link"></span>
                    <strong><?php echo $config['page_title'];?></strong>
				</header>
				<div class="panel-body">
					<div class="col-md-8" style="border-right: 3px solid #e5e5e5; padding-bottom: 28px;">
						<h3>请输入需要外链推广的网址</h3>
                        <div class="input-group input-group-tianyu">
                            <span class="input-group-addon">http://</span>
                            <input id="dn" type="text" class="form-control" placeholder="<?php echo $config['url_placeholder'];?>" value="" />
                            <span class="input-group-btn">
                                <button id="linkbtn" class="btn" >开始优化</button>
                            </span>
                        </div>
					</div>
					<div class="col-md-4">
					
					</div>
					<div class="col-md-12" id="linkshow" style="<?php if(strlen($d)==0){echo 'display:none';} ?>">
						 <h3>正在访问的链接</h3>
						 <div id="linklist" style="height: <?php echo 66 * $config['row_page']?>px;">
							<?php
							if(strlen($d)>3){
								echo "<iframe src='data.php?p=1&dn=".$d."' height='100%' width='100%' marginwidth='0' marginheight='0' hspace='0' vspace='0' frameborder='0' scrolling='no'></iframe>";
							} ?>
						</div>
					</div>
					<div class="col-md-12">
                        <h3>使用提示</h3>
                        <p style="text-indent: 2em;"><?php echo $config['use_tip'];?></p>
					</div>
				</div>
			</div>
			<div class="panel panel-tianyu">
				<header class="panel-heading">
					<span class="glyphicon glyphicon-question-sign"></span>工具原理
				</header>
				<div class="panel-body">
					<div class="col-md-12">
                        <p style="text-indent: 2em;"><?php echo $config['tool_nature'];?></p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-tianyu">
				<header class="panel-heading">
					<span class="glyphicon glyphicon-wrench"></span>工具介绍
				</header>
				<div class="panel-body">
                    <p style="text-indent: 2em;"><?php echo $config['tool_description'];?></p>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-tianyu">
				<header class="panel-heading">
					<span class="glyphicon glyphicon-wrench"></span>收录推荐
				</header>
				<div class="panel-body">
                    <?php
                    foreach ($config['friend_link'] as $link){
                        echo '<a href="'. $link['link'] .'" title="'. $link['link'] .'" target="_blank"><span class="glyphicon glyphicon-link"></span>'. $link['name'] .'</a><br/>';
                    } ?>
				</div>
			</div>
		</div>
	</div>
</div>

<footer class="container">
    Powered By <a href="<?php echo $config['footer_link'];?>" target="_blank"><?php echo $config['footer_link_text'];?></a>
    <br/> 当前时间：<?php echo date('Y-m-d H:i:s');?>
</footer>

<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/js.cookie.min.js"></script>
<script>

    // 检查所有英文域名
    function checkDomain(domain) {
        return /^([\w-]+\.)+((com)|(net)|(org)|(gov\.cn)|(info)|(cc)|(me)|(asia)|(com\.cn)|(net\.cn)|(org\.cn)|(name)|(biz)|(tv)|(cn)|(la)|(top)|(xyz)|(vip)|(video)|(club)|(site)|(link)|(work)|(co)|(wiki)|(live)|(ren)|(xin)|(art)|(mobi)|(pub)|(ink)|(kim)|(pro)|(red)|(shop)|(wang)|(fun)|(ltd)|(tech)|(store)|(online)|(beer)|(design)|(luxe)|(xyz))$/.test(domain);
    }

    $(document).ready(function(){
        // 先尝试获取本地domain
        $("#dn").val(Cookies.get('local_domain'));

        $("#linkbtn").on('click', function(){
                var domain = $("#dn").val();
                if(domain==""){
                   alert("请输入域名");
                }else if(checkDomain(domain)){
                    Cookies.set('local_domain', domain);
                    $("#linkshow").show();
                    $("#linklist").html("<iframe src='data.php?p=1&dn="+ domain +"' height='100%' width='100%' marginwidth='0' marginheight='0' hspace='0' vspace='0' frameborder='0' scrolling='no'></iframe>");
                }else{
                    alert("请输入正确的域名");
                }
        });
    });
</script>
</body>
</html>