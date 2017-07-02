<div class="header-top compact-hidden">
	<div class="container">
		<div class="row">
			<div class="header-top-left form-inline col-sm-6 col-xs-12 compact-hidden">
				<div class="form-group languages-block ">
					<form action="index.html" method="post" enctype="multipart/form-data" id="bt-language">
						<a class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
							<!-- <img src="" alt="English" title="English"> -->
							<span class="">湖南</span>
							
						</a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo CURRENTURL;?>"> 湖南</a></li>
<!-- 							<li> <a href=""> 广东 </a> </li>
							<li><a href=""> 湖北</a></li>
							<li><a href=""> 上海</a></li> -->
						</ul>
					</form>
				</div>

				<div class="form-group currencies-block">
					<form action="index.html" method="post" enctype="multipart/form-data" id="currency">
						<a class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
							<span class="icon icon-credit "></span>  长沙 
						</a>
						<ul class="dropdown-menu btn-xs">
							<li> <a href="<?php echo CURRENTURL;?>">长沙</a></li>
<!-- 							<li> <a href="">常德</a></li>
							<li> <a href="">岳阳</a></li>
							<li> <a href="">怀化</a></li>
							<li> <a href="">衡阳</a></li> -->
						</ul>
					</form>
				</div>
				<a  href="?controller=stacks&method=list">
				<div class="form-group currencies-block">
				
							<span class="icon icon-credit btn btn-xs dropdown-toggle" > MORE </span>  
						
				</div>	</a>			
			</div>
			<div class="header-top-right collapsed-block text-right  col-sm-6 col-xs-12 compact-hidden">
				<h5 class="tabBlockTitle visible-xs">More<a class="expander " href="mybl.htmlTabBlock-1"><i class="fa fa-angle-down"></i></a></h5>
				<div class="tabBlock" id="TabBlock-1">

					<ul class="top-link list-inline">
<?php
if($this->role == 'tourist'){?>
						<li class="account" id="my_account">
							<a href="?controller=index&method=index" title="My Account" class="btn btn-xs dropdown-toggle" data-toggle="dropdown"> 登录 </a>	
						</li>
<?php }else{
$u_id = $_SESSION['u_id'];
$account = M('account');
$data_account = $account->findByU_id($u_id);
	?>

						<li class="account" id="my_account">
							<a href="?controller=account&method=index" title="My Account" class="btn btn-xs dropdown-toggle" data-toggle="dropdown"> <span><?php echo $data_account['username'];?></span> <span class="fa fa-angle-down"></span></a>
							<ul class="dropdown-menu ">
								<li><a href="?controller=account&method=info&u_id=<?php echo $u_id;?>"><i class="fa fa-user"></i> 个人中心</a></li>
							</ul>
						</li>
						<li class="wishlist"><a href="?controller=book&method=collection&u_id=<?php echo $u_id;?>" id="wishlist-total" class="top-link-wishlist" title="收藏"><span>收藏</span></a></li>
						<li class="checkout"><a href="?controller=news&method=ask&u_id=<?php echo $u_id;?>" class="top-link-checkout" title="news"><span >消息</span></a></li>
						<li class="login"><a href="?controller=account&method=logout&u_id=<?php echo $u_id;?>" title="Shopping Cart"><span >退出</span></a></li>
<?php }?>						
					</ul>

					
				</div>
			</div>
		</div>
	</div>
</div>



	<!-- 登陆注册弹出js -->
 <script>
    $('.button2').click(function () {
    $('#modal').css('display', 'block');
    $('.modal-bg').fadeIn();
});
$('.close').click(function () {
    $('.modal-bg').fadeOut();
    $('#modal').fadeOut();
    return false;
});
    //@ sourceURL=pen.js
     $('.button1').click(function () {
    $('#modal1').css('display', 'block');
    $('.modal-bg1').fadeIn();
});
$('.close1').click(function () {
    $('.modal-bg1').fadeOut();
    $('#modal1').fadeOut();
    return false;
});
    //@ sourceURL=pen.js
  </script>	