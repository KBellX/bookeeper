<body class="common-home res layout-home1">

     


    <div id="wrapper" class="wrapper-full banners-effect-7">
	<!-- Header Container  -->
	<header id="header" class=" variantleft type_1">
<!-- Header Top -->
<?php $this->widget('top1');?>
<!-- //Header Top -->

<!-- Header center -->
<div class="header-center left">
	<div class="container">
		<div class="row fh5co-header">
			<!-- Logo -->
<?php $this->widget('logo');?>
			<!-- //end Logo -->

			<!-- Search -->
<?php $this->widget('search');?>
			<!-- //end Search -->

			<!-- Secondary menu -->
<?php if($this->role != 'tourist') $this->widget('news');?>
		</div>

	</div>
</div>
<!-- //Header center -->

<!-- Header Bottom -->
<div class="header-bottom">
	<div class="container">
		<div class="row">
			
<?php $this->widget('todayRanking');?>
			
			<!-- Main menu -->
<?php if($this->role != 'tourist') $this->widget('menu');?>
			<!-- //end Main menu -->
			
		</div>
	</div>

</div>

<!-- Navbar switcher -->
<!-- //end Navbar switcher -->
	</header>
<div class="products-list row grid">

<?php 
if(!empty($data_search)){
foreach($data_search as $stack){
$data_admin = $account->findByU_id($stack['u_id']);
?>
	<div class="product-layout col-md-3 col-sm-6 col-xs-12 ">
		<div class="product-item-container">
			<div class="left-block">
									<div class="product-images-container second_img ">
										<img style="width:250px;height:120px" src="<?php echo empty($stack['s_img'])?'images/special/f/2.jpg':$stack['s_img']
								;?>""  alt="Apple Cinema 30&quot;" class="img-responsive" />
									</div>
									<!--Sale Label-->
									<span class="label label-sale">公开</span>
									<!--full quick view block-->
									<a class="quickview visible-lg" href="?controller=stacks&method=stack&s_id=<?php echo $stack['s_id'];?>&u_id=<?php echo $stack['u_id'];?>&kind=all"> 查看</a>
									<!--end full quick view block-->
								</div>
								<div class="right-block">
									<div class="caption">
									<div style="height: 30px;overflow: hidden;">
										<h4 style="line-height: 20px;"><a data-id=<?php echo $stack['s_id']?> href="#"><?php echo $stack['name'];?></a></h4>
									</div>	
										<p data-id=<?php echo $data_admin['u_id']?>><?php echo $data_admin['username'];?></p>		
										<div class="ratings">
										</div>	
									</div>									 
								</div><!-- right block -->
		</div>
	</div>
	<div class="clearfix visible-xs-block"></div>

<?php 
}
}else{
?>
<h1 style="text-align: center">没有找到这个图书馆</h1>
<?php }?>


</div>

							

			
<script type="text/javascript"><!--
	var $typeheader = 'header-home1';
	//-->
</script>