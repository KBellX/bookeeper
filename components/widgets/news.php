			<div class="col-md-2 col-sm-5 col-xs-12 shopping_cart pull-right">
				<!--cart-->
				<div id="cart" class=" btn-group btn-shopping-cart">
					<a data-loading-text="Loading..." class="top_cart dropdown-toggle" data-toggle="dropdown">
						<div class="shopcart">
							<span class="handle pull-left"></span>
							<span class="title">我的借阅</span>
							<!-- <p class="text-shopping-cart cart-total-full">3未读 </p> -->
						</div>
					</a>

					<ul class="tab-content content dropdown-menu pull-right shoppingcart-box" role="menu">
						
						<li>
							<table class="table table-striped">
								<tbody>
								<tr>
										<td class="text-left"> <a class="cart_product_name" ></a> </td>
										<td class="text-left"> <a class="cart_product_name" href="mybl.html">书名</a> </td>
										<!-- <td class="text-left"> <a class="cart_product_name" >借出/入</a></td> -->
										<td class="text-center"> <a class="cart_product_name" >到期时间</a></td>
								
<?php
$book = M('book');
$book_belong = M('book_belong');
$u_id = $_SESSION['u_id'];
$book_borrow = M('book_borrow');
$data_book_borrow = $book_borrow->findAllByU_id($u_id,1);
if(!empty($data_book_borrow)){
foreach($data_book_borrow as $br){
	$bl = $book_belong->findByBl_id($br['bl_id']);
	$data_book = $book->findByb_id($bl['b_id']);
?>						
								</tr>
									<tr>
										<td class="text-center" style="width:70px">
											<!-- <a href="mybl.html"> <img src="images/demo/shop/product/j9.jpg" style="width:50px" alt="Filet Mign" title="Filet Mign" class="preview"> </a> -->
										</td>
										<td class="text-left"> <a class="cart_product_name"><?php echo $data_book['title'];?></a> </td>
										<!-- <td class="text-center"> 借出 </td> -->
										<td class="text-center"> 5.28 </td>
										<td class="text-right">
											<a href="mybl.html" class="fa fa-edit"></a>
										</td>
<!-- 										<td class="text-right">
											<a onclick="cart.remove('2');" class="fa fa-times fa-delete"></a>
										</td> -->
									</tr>
<?php 
}
}?>


								</tbody>
							</table>
						</li>
						
					</ul>
				</div>
				<!--//cart-->
			</div>