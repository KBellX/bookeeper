<body class="res layout-subpage">

     

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

	<!-- //Header Container  -->
	<!-- Main Container  -->
	<div class="main-container container">	
		<div class="row">
			<!--Middle Part Start-->
			<div id="content" class="col-md-12 col-sm-12">
				
				
				
				<!-- Product Tabs -->
				<div class="producttab ">
	<div class="tabsslider  vertical-tabs col-xs-12">
		<div class="tab-content col-lg-10 col-sm-9 col-xs-12">
			<div id="tab-1" class="tab-pane fade active in">
				<div class="products-list row grid">

<?php
if(!empty($data_search)){
foreach($data_search as $data_book){
	// $data_book = $book->findByb_id($cl['b_id']);
?>	

	<div class="product-layout col-md-4 col-sm-6 col-xs-12 ">
		<div class="product-item-container">
			<div class="left-block">
				<div class="product-images-container second_img ">
					<img data-src="" src="<?php echo empty($data_book['img'])?'images/special/none.jpg':$data_book['img'];?>"  alt="Apple Cinema 30&quot;" class="img-responsive" />
				</div>
				<a class="quickview iframe-link visible-lg" data-fancybox-type="iframe"  href="?controller=book&method=info&b_id=<?php echo $data_book['b_id'];?>"> 查看</a>
				<!--end full quick view block-->
			</div>
			<div class="right-block">
				<div class="caption">
					<h4><a href="?controller=book&method=info&b_id=<?php echo $data_book['b_id'];?>"><?php echo $data_book['title'];?></a></h4>		
				</div>
				  <div class="button-group">
<?php if($this->role != 'me'){?>				  
					<button data-id="<?php echo $data_book['b_id'];?>" class="collect wishlist" type="button" data-toggle="tooltip" title="收藏" onclick="wishlist.add('<?php echo $data_book['title'];?>');"><i class="fa fa-heart"></i></button>
<?php }?>
				  </div>
			</div><!-- right block -->

		</div>
	</div>
<?php 
}
}else{?>
?>
<h1 style="text-align: center">没有找到这本书</h1>
<?php }?>



</div>	
				
</div>



	</div>
</div>
				<!-- //Product Tabs -->
				
				<!-- 相关图书 -->
<?php $this->widget('bookRelative');?>
				<!-- end Related  Products-->
</div>


			
				
			</div>
			
			
		</div>
		<!--Middle Part End-->
	</div>
	<!-- //Main Container -->

<script>
$(document).ready(function(){
var borrow = {};
var collect = {};
	$(".borrow").click(function(){
		borrow['id']  = $(this).parents("div").attr("data-id");
		if(1){
			$.post('<?php echo CURRENTURL;?>',{'borrow':borrow},function(response,status){
			if(status = "success"){

				}
			});
		}
	});
	$(".collect").click(function(){
		collect['id']  = $(this).attr("data-id");
		if(1){
			$.post('<?php echo CURRENTURL;?>',{'collect':collect},function(response,status){
			if(status = "success"){

				}
			});
		}
	});	
});	
</script>	