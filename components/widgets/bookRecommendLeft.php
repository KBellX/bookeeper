				<div class="module latest-product titleLine">
   <h3 class="modtitle">推荐购买图书</h3>
   <div class="modcontent ">

<?php
$book = M('book');
for($i=1;$i<=4;$i++){
	$b_id = rand(4917,4989);
	$data_book = $book->findByB_id($b_id);	
?>

		<div class="product-latest-item">
			<div class="media">
			   <div class="media-left">
				  <a class="iframe-link" href="?controller=book&method=info&b_id=<?php echo $b_id;?>"><img src="<?php echo $data_book['img']?>" alt="Cisi Chicken" title="Cisi Chicken" class="img-responsive" style="width: 100px; height: 82px;"></a>
			   </div>
			   <div class="media-body">
				  <div class="caption">
					 <h4><a href="#"><?php echo $data_book['title']?></a></h4>
					
					 <div class="price">
						<span class="price-new"><?php echo $data_book['price']?></span>
					 </div>
					 <div class="ratings">
						<div class="rating-box">
						<?php for($n=1;$n<=rand(3,5);$n++){?>
						   <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
						  <?php }?> 
						</div>
					 </div>
				  </div>
				  
			   </div>
			</div>
		</div>

<?php }?>

		
		
   </div>
   
</div>