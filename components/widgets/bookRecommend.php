				<div class="related titleLine products-list grid module ">
	<h3 class="modtitle">相关图书 </h3>
	<div class="releate-products ">




<?php
$book = M('book');
for($i=1;$i<=6;$i++){
	$b_id = rand(4917,4989);
	$data_book = $book->findByB_id($b_id);	
?>	
		<div class="product-layout" style="width:270px;height:380px">
			<div class="product-item-container">
				<div class="left-block">
									<div class="product-images-container second_img ">
										<img style="width:170px;height:200px;" src="<?php echo $data_book['img']?>"  alt="Apple Cinema 30&quot;" class="img-responsive" />
									</div>
									<!--Sale Label-->
									<!--full quick view block-->
									<a class="quickview iframe-link visible-lg" data-fancybox-type="iframe"  href="?controller=book&method=info&b_id=<?php echo $b_id;?>"> 查看</a>
									<!--end full quick view block-->
								</div>
								<div class="right-block">
									<div class="caption">
									<div style="height: 30px;overflow: hidden;">
										<h4 style="line-height: 20px;"><a class="iframe-link" href="?controller=book&method=info&b_id=<?php echo $b_id;?>"><?php echo $data_book['title']?></a></h4>
									</div>		
										<div class="ratings">
											<div class="rating-box">
						<?php for($n=1;$n<=rand(3,5);$n++){?>
						   <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
						  <?php }?> 
											</div>
										</div>					
										<div class="price">
											<span class="price-new"><?php echo $data_book['price']?></span> 
										</div>
									</div>
<!-- 									  <div class="button-group">
										<button class="addToCart" type="button" data-toggle="tooltip" title="购买" onclick="cart.add('42', '1');"><i class="fa fa-shopping-cart"></i> <span class="">购买</span></button>
									  </div> -->
								</div><!-- right block -->

			</div>
		</div>
<?php }?>

		</div>
	</div>