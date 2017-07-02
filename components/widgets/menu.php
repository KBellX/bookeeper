			<div class="megamenu-hori header-bottom-right  col-md-9 col-sm-6 col-xs-12 ">
				<div class="responsive so-megamenu ">
	<nav class="navbar-default">
		<div class=" container-megamenu  horizontal">
			<div class="navbar-header">
				<button type="button" id="show-megamenu" data-toggle="collapse" class="navbar-toggle">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				Navigation		
			</div>
			
			<div class="megamenu-wrapper">
				<span id="remove-megamenu" class="fa fa-times"></span>
				<div class="megamenu-pattern">
					<div class="container">
						<ul class="megamenu " data-transition="slide" data-animationtime="250">
<?php 
//暂时先以session有无作判断，完善getrole后换
if(!empty($u_id = ($_SESSION['u_id']))){
	$stacks = M('stacks');
	$data_stack = $stacks->findByU_id($u_id);
	if(!isset($data_stack)){
			$noStack = 1;
			$this->errAlert('noStack','你还没创建书库，赶快去创建吧！');	
	}
	$s_id = $data_stack['s_id'];
}
?>						
							<li class="home hover">					
								<a href="?controller=account&method=index&u_id=<?php echo $u_id;?>">首页</a>	
							</li>
							<li class="with-sub-menu hover">
								<p class="close-menu"></p>
								<a href="?controller=stacks&method=create&u_id=<?php echo $u_id;?>" class="clearfix">
									<strong>创建新的图书馆</strong>	
								</a>
							</li>
							<li class="with-sub-menu hover">
								<p class="close-menu"></p>
<?php if(!isset($noStack)){	?>								
								<a href="?controller=stacks&method=stack&s_id=<?php echo $s_id;?>&u_id=<?php echo $u_id;?>&kind=all" class="clearfix">
									<strong>我的图书馆</strong>	
								</a>
<?php }?>
<?php if(isset($noStack)){?>
								<a href="#" id ="noStack" class="clearfix">
									<strong>我的图书馆</strong>	
								</a> 								
<?php }?>

							</li>
							<li class="with-sub-menu hover">
								<p class="close-menu"></p>
								<a href="?controller=book&method=collection&u_id=<?php echo $u_id;?>" class="clearfix">
									<strong>收藏书单</strong>	
								</a>
							</li>


						</ul>
						
					</div>
				</div>
			</div>
		</div>
	</nav>
</div>
									</div>