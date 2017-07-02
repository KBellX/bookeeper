
	<header id="fh5co-header" role="banner">
		<div class="container">
			<div class="header-inner">
				<h1><a href="controller=index&method=index">Bookeeper</a></h1>
				<nav role="navigation">

<?php if($this->role == 'tourist'){?>
						<ul>
						<li><a class="button2">登录</a></li>
						<li><a class="button1">注册</a></li>
						</ul>
						<div class="modal-bg">
							<div id="modal">
							<div class="modal-content modal-popup">
        					<div class="modal-header">
          					<div type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></div>
          					<h2 class="modal-title">登录</h2>
        					</div>
						<form method="POST" action="?controller=account&method=login">
						<input id="email" name="email" type="email" placeholder="email" required>
						<input id="password" name="password" type="password" placeholder="Password" required>
						<!-- <a id="forgot-link" href="#">Forgot password?</a> -->
						<a href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
						<button name="submit" id="submit" type="submit">登录</button>
						</form>
							</div>
							</div>
						</div>
						
						<div class="modal-bg1">
							<div id="modal1">
							<div class="modal-content modal-popup">
        					<div class="modal-header">
          					<div type="button" class="close1" data-dismiss="modal1" aria-label="Close1"><span aria-hidden="true">&times;</span></div>
          					<h2 class="modal-title">注册</h2>
        					</div>
						<form method="POST" action="?controller=account&method=register">
						<input id="email" name="email" type="email" placeholder="email" required>
						<input id="username" name="username" type="username" placeholder="name" required>
						<input id="password" name="password" type="password" placeholder="Password" required>
						<!-- <a id="forgot-link" href="#">Forgot password?</a> -->
						<a href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
						<button name="submit" id="submit" type="submit">注册</button>
						</form>
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

<?php }else{
$account = M('account');
$data_account = $account->findByU_id($_SESSION['u_id']);
?>
				<ul><li><a href="?controller=account&method=index&u_id=<?php echo $data_account['u_id']; ?>"><i class="icon-user"></i> <?php echo $data_account['username']; ?></a></li></ul>				
<?php }?>					
				</nav>
			</div>
		</div>
	</header>



