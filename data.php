<?php
error_reporting(E_ALL & ~E_NOTICE);
include "config.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" href="css/bootstrap.min.css" rel="stylesheet" />
    <link type="text/css" href="css/main.css" rel="stylesheet" />
</head>
<body id="data-body">

<?php
$urls = @file('urls.txt');
$count = count($urls);
$row = $config['row_page'];
$maxPage = ceil($count/$row);
if(isset($_GET['dn'])){
	$dn = $_GET['dn'];
}
if(isset($_GET['p'])) {
    $p = $_GET['p'];
    if ($p < 1) {
        $p = 1;
    }
    if ($p > $maxPage) {
        echo '<div style="color:red; text-align:center">工作完毕！</div>';
        exit;
    } ?>
	<div class="alert alert-warning" role="alert">（<?php echo ($p*$row).'/'.$count;?>）请不要关闭页面，<span id="endtime"><?php echo $config['wait_second'];?></span>秒后跳到下一页!</div>
	<div class="progress">
	  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo round(($p*$row)/$count*100);?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round(($p*$row)/$count*100);?>%;">
		<span><?php echo round(($p*$row)/$count*100)."%";?></span>
	  </div>
	</div>
	<table class="table table-hover table-responsive">
		<thead>
			<tr>
				<th>ID</th>
				<th>外链目标网址</th>
				<th style="width: 88px;">状态</th>
			</tr>
		</thead>
		<tbody>
        <?php
            $ii = ($p*$row) - $row;
            $jj = $p*$row;
            for($i=$ii; $i <$jj; $i++){
                $link = str_replace('***', $dn, $urls[$i]);
                $link = str_replace('\n', '', $link);
                $link = str_replace('\r\n', '', $link);
                $link = str_replace(' ', '', $link);

                echo "<tr><td><span class=\"num\">".($i+1)."</span></td><td><a target='_blank' href=\"".$link."\">".$link."</a></td><td><span class=\"status\"><iframe src='url.htm?".$link."' height='20' width='64' marginwidth='0' marginheight='0' hspace='0' vspace='0' frameborder='0' scrolling='no'></iframe></span></td></tr>";
            }
        }?>
		</tbody>
	</table>

<script language="javascript" type="text/javascript">
    var p = "<?php echo $p+1;?>";
    var dn = "<?php echo $dn;?>";
    var second="<?php echo $config['wait_second'];?>" ,timer;

    timer = setInterval(function () {
        second--;
        if(second > -1) {
            document.getElementById("endtime").innerHTML = second;
        }else {
            clearInterval(timer);
        }
    }, 1000);

    setTimeout(function () {
        location.href='data.php?p='+p+'&dn='+dn;
    }, 1000 * second);
</script>

</body>
</html>