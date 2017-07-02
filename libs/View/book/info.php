<!DOCTYPE html>
<html>
<head>
	<title>bookinfor</title>
	<meta charset="utf-8">
	<style type="text/css">
		*{
			margin:0;
			padding: 0;
		}
		.name{
			color:black;
			font-family: 微软雅黑;
			font-weight: bolder;
			margin:10px auto;
		}
	</style>
</head>
<body>
		<div class="container" style="height:200px;background-color: #122335;">
			<div style="width: 180px;height: 240px;margin:0 auto"><img src="<?php echo empty($data_book['img'])?'images/special/none.jpg':$data_book['img'];?>" style="width: 180px;height: 240px;margin:20px 0;"></div>
		</div>
		<div style="line-height: 30px;text-align: center;padding-top: 100px;background-color: #FBF8C4;padding-bottom:20px">
			<div class="name">书名：<?php echo $data_book['title'];?></div>
			<div class="name">作者：<?php echo $data_book['author'];?></div>
			<div class="name">页数：<?php echo $data_book['page'];?></div>
			<div class="name">定价: <?php echo $data_book['price'];?></div>
			<div class="name">出版社：<?php echo $data_book['publisher'];?></div>
			<div class="name">出版时间： <?php echo $data_book['timePublish'];?></div>
			<div class="name">ISBN: <?php echo $data_book['isbn'];?></div>
		</div>
</body>
</html>