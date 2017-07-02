<body>


	<div id="fh5co-page">
	<?php $this->widget('top2');?>
	
	<div class="container">
		
	</div>
	<aside id="fh5co-hero" class="js-fullheight">
		<div class="flexslider js-fullheight">
			<ul class="slides">
		   	<li style="background-image: url(images/images/2.gif);">
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
		   				<div class="slider-text-inner">
		   					<h2><p style="font-family:Orator Std">Bookeeper</p>帮助您舒适管理小规模藏书</h2>

<?php
if($this->role != 'tourist'){
?>
		   					<p><a href="?controller=account&method=index&u_id=<?php echo $_SESSION['u_id']?>" class="btn btn-primary btn-lg">Get started</a></p>
<?php }
else{					
?>	
							<p class="button2"><a href="#" class="btn btn-primary btn-lg">Get started</a></p>
<?php }?>	   					
		   				</div>
		   			</div>
		   		</div>
		   	</li>
		   	<li style="background-image: url(images/images/GIF1.gif);">
		   		<div class="container">
		   			<div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
		   				<div class="slider-text-inner">
		   					<h2>借阅入库一扫即过，图书周转一目了然</h2>
		   					<p><a href="#" class="btn btn-primary btn-lg">Get started</a></p>
		   				</div>
		   			</div>
		   		</div>
		   	</li>
		   	<li style="background-image: url(images/images/3.gif);">
		   		<div class="container">
		   			<div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
		   				<div class="slider-text-inner">
		   					<h2>让图书充满生活，让生活更加简单</h2>
		   					<p><a href="#" class="btn btn-primary btn-lg">Get started</a></p>
		   				</div>
		   			</div>
		   		</div>
		   	</li>
		  	</ul>
	  	</div>
	</aside>
	<div id="fh5co-services-section">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading animate-box">
					<h2>Bookeeper</h2>
					<p>功能介绍 </p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 animate-box">
					<div class="services">
						<i class="icon-laptop"></i>
						<div class="desc">
							<h3>注册登录</h3>
							<p>第一次接触我们就去申请帐号并进行登录，解决管理苦恼，享受图书乐趣吧。</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 animate-box">
					<div class="services">
						<i class="icon-server"></i>
						<div class="desc">
							<h3>完善信息</h3>
							<p>更加充实自己的信息，让更多的人了解你，同时去了解别人；更重要的是图书管理员能更加清楚成员，方便借阅哟。</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 animate-box">
					<div class="services">
						<i class="icon-money"></i>
						<div class="desc">
							<h3>添加书库</h3>
							<p>现在去寻找喜欢的图书馆吧，或者是和早已约好的小伙伴建立图书馆去分享图书的心得。</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 animate-box">
					<div class="services">
						<i class="icon-tablet"></i>
						<div class="desc">
							<h3>扫码借阅</h3>
							<p>扫码即登记，自己录入借书人信息，书本信息，时间信息，反正你能想到的样样都为您通通录入。</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 animate-box">
					<div class="services">
						<i class="icon-line-chart"></i>
						<div class="desc">
							<h3>如实归还</h3>
							<p>借书果然还是得建立在诚信上，如实如期归还也是一定要做到的，有借有还，再借不难。</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 animate-box">
					<div class="services">
						<i class="icon-pie-chart"></i>
						<div class="desc">
							<h3>意见反馈</h3>
							<p>若是你有什么想法，什么建议，什么需要，这都是可以通过意见反馈提呈给管理员的哦</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <div class="copyrights">Collect from <a href="http://www.cssmoban.com/" >企业网站模板</a></div>
	<div id="fh5co-work-section" class="fh5co-light-grey-section">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 text-center fh5co-heading animate-box">
					<h2>图书馆</h2>
					<p style="font-family: 华文仿宋">书本多多少少 书架形形色色 书馆大大小小</p>
				</div>
			</div>
			<div class="row">

<?php
$i = 0; 
foreach($data_stack as $stack){
$i++;
$data_admin = $account->findByU_id($stack['u_id']);
?>

<a href="?controller=stacks&method=stack&s_id=<?php echo $stack['s_id'];?>&kind=all">
				<figure class="test<?php echo $i;?>">
					<img src="<?php echo empty($stack['s_img'])?'images/special/f/2.jpg':$stack['s_img']
								;?>">
					<figcaption>
						<p><span><?php echo $stack['name'];?></span></a><br><?php echo $data_admin['username'];?></p>
					</figcaption>
				</figure>
</a>
<?php }?>








				<div class="col-md-12 text-center animate-box">
					<p><a href="?controller=stacks&method=list" class="btn btn-primary with-arrow">View More<i class="icon-arrow-right"></i></a></p>
				</div>
			</div>
		</div>
	</div>


