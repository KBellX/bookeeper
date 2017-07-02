<body class="res layout-subpage banners-effect-6">
   <div id="wrapper" class="wrapper-full banners-effect-7">
	<!-- Header Container  -->
	<header id="header" class=" variantleft type_1">
<!-- Header Top -->
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
			<!--Left Part Start -->
			<aside class="col-sm-4 col-md-3" id="column-left">


<?php 
if($this->role == 'me'){
	$this->widget('stackList');		
}else{
	$this->widget('stackOther');
}

?>

<?php $this->widget('bookRecommendLeft');?>
				<div class="module">
					<div class="modcontent clearfix">
						<div class="banners">
							<div>
								<a href="#"><img src="<?php echo empty($data_stacks['s_img'])?'images/special/f/2.jpg':$data_stacks['s_img'];?>" alt="left-images"></a>
							</div>
						</div>
						
					</div>
				</div>
			</aside>
			<!--Left Part End -->
			
			<!--Middle Part Start-->
			<div id="content" class="col-md-9 col-sm-8">
				<div class="products-category">
					<div class="category-derc">
						<div class="row">
							<div class="col-sm-12">
								<div class="banners">
									<div>
										<a  href="#"><img style="width:870px; height:284px;" src="<?php echo empty($data_stacks['b_img'])?'images/special/back/4.jpg':$data_stacks['b_img'];?>"><br></a>
									</div>
								</div>
							
							</div>
						</div>
					</div>
					<!-- Filters -->
					<div class="product-filter filters-panel">
						<div class="row">
							<div class="col-md-2 visible-lg">
								<div class="view-mode">
									<div class="list-view">
										<button class="btn btn-default grid active" data-view="grid" data-toggle="tooltip"  data-original-title="Grid"><i class="fa fa-th"></i></button>
										<!-- <button class="btn btn-default list" data-view="list" data-toggle="tooltip" data-original-title="List"><i class="fa fa-th-list"></i></button> -->
									</div>
								</div>
							</div>
							<div class="short-by-show form-inline text-right col-md-7 col-sm-8 col-xs-12">

							</div>
							<div class="box-pagination col-md-3 col-sm-4 col-xs-12 text-right">

<?php $data_book_belong = $this->widget('page',
	['book_belong' => $book_belong]);?>

							</div>
						</div>
					</div>
					<!-- //end Filters -->
					<!--changed listings-->
					<div class="products-list row grid">

<?php
if(!empty($data_book_belong)){


foreach($data_book_belong as $bl){
	$data_book = $book->findByb_id($bl['b_id']);

?>					
	<div class="product-layout col-md-4 col-sm-6 col-xs-12 ">
		<div class="product-item-container" style="width:270px;height:300px">
			<div class="left-block">
				<div data-id=<?php echo $bl['bl_id'];?> class="product-images-container second_img">
 					<img data-src="" src="<?php echo empty($data_book['img'])?'images/special/none.jpg':$data_book['img'];?>"  style="width:170px;height:200px;" alt="Apple Cinema 30&quot;" class="img-responsive" /> 
				</div>
				<!--Sale Label-->
				<?php echo ($bl['already_borrow'] == 1)?'<span class="label label-sale">在库</span>':''; 
				?>
				<!--full quick view block-->
				<a class="quickview iframe-link visible-lg" data-fancybox-type="iframe"  href="?controller=book&method=info&b_id=<?php echo $bl['b_id'];?>">查看</a>

				<!--end full quick view block-->
			</div>
			<div class="right-block">
				<div class="caption" style="height: 20px; overflow: hidden; ">
					<h4 style="line-height: 20px;"><a href="?controller=book&method=info&b_id=<?php echo $bl['b_id'];?>"><?php echo $data_book['title'];?></a></h4>	
				</div>

<?php if($this->role == 'other' || $this->role == 'me' ){?>


				  <div data-id="<?php echo $bl['bl_id'];?>" class="button-group">
<?php  if($bl['already_borrow'] == 1){?>
					<button class="borrow addToCart" type="button" data-toggle="tooltip" title="" onclick="cart.add('<?php echo $data_book['title'];?>', '1');"> <span class="hidden-xs">申请借阅</span></button>
<?php }?>
					<button data-id="<?php echo $bl['b_id'];?>" class="collect wishlist" type="button" data-toggle="tooltip" title="收藏" onclick="wishlist.add('<?php echo $data_book['title'];?>');"><i class="fa fa-heart"></i></button>
				  </div>

<?php }?>

			</div><!-- right block -->

		</div>
	</div>
	<div class="clearfix visible-xs-block"></div>
 <?php 
 }
 }else{?>
<h1 style="text-align: center">该图书馆还没有图书哦</h1>
 <?php }?>	
</div>					<!--// End Changed listings-->
					<!-- Filters -->
					<div class="product-filter product-filter-bottom filters-panel" >
						<div class="row">
							<div class="col-md-2 hidden-sm hidden-xs">
							</div>
						   <div class="short-by-show text-center col-md-7 col-sm-8 col-xs-12">
								
							</div>
							<div class="box-pagination col-md-3 col-sm-4 text-right">

<!-- 页码 -->

							</div>
									
						 </div>
					</div>
					<!-- //end Filters -->
					
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


<script>
// 借出点了后消失,收藏点了后消失
$(document).ready(function(){
$(".quxiao").hide();	
	$(".borrow").click(function(){
		$(this).hide();
	});
	$(".collect").click(function(){
		$(this).hide();
	});	
});

</script>
