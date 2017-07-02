			<div class="sidebar-menu col-md-3 col-sm-6 col-xs-12 ">
				<div class="responsive so-megamenu ">
					<div class="so-vertical-menu no-gutter compact-hidden">
						<nav class="navbar-default">	
							
							<div class="container-megamenu vertical
							 
<?php 
if($_GET['method'] == 'index'){
	echo 'open';
}
?>
							">
								<div id="menuHeading">
									<div class="megamenuToogle-wrapper">
										<div class="megamenuToogle-pattern">
											<div class="container">
												<div>
													<span></span>
													<span></span>
													<span></span>
												</div>
												今日借书排行榜							
												<i class="fa pull-right arrow-circle fa-chevron-circle-up"></i>
											</div>
										</div>
									</div>
								</div>
								<div class="navbar-header">
									<button type="button" id="show-verticalmenu" data-toggle="collapse" class="navbar-toggle fa fa-list-alt">
										
									</button>
									今日借书排行榜	
								</div>
								<div class="vertical-wrapper" >
									<span id="remove-verticalmenu" class="fa fa-times"></span>
									<div class="megamenu-pattern">
										<div class="container">
											<ul class="megamenu">

<?php 
$book = M('book');
$b_id = 150001;
for($i = 1; $i<= 9; $i++){
	$data_book = $book->findByb_id($b_id);
	$b_id = $b_id + 4;
?>											
												<li class="item-vertical style1 with-sub-menu hover" style="height:46px; overflow: hidden;">
													<p class="close-menu"></p>
													<a href="?controller=book&method=info&b_id=<?php echo $b_id;?>" class="iframe-link clearfix">
														<img src="images/images/theme/icons/<?php echo $i;?>.png" alt="icon">
														<span style="line-height: 40px;"><?php echo $data_book['title']?></span>
														
													</a>
												</li>
	
<?php }?>



													
												
												</ul>
											</div>
										</div>
									</div>
								</div>
							</nav>
					</div>
				</div>

			</div>