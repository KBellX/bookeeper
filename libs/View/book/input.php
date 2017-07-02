

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

	<!-- //Header Container  -->
	<!-- Main Container  -->
	<div class="main-container container">
		
		<div class="row">
			<div id="content" class="col-sm-12">
				<div class="page-login">
				
					<div class="account-border">
						<div class="row">
						<form action="
						<?php echo CURRENTURL; ?>"
						 method="POST" enctype="multipart/form-data">
								<div class="col-sm-6 customer-login">
									<div class="well">
										<h2><i class="fa fa-file-text-o" aria-hidden="true"></i> 搜索</h2>
										<p><strong>search</strong></p>
										<div class="form-group">
											<label class="control-label " for="input-email">isbn码</label>
											<input type="text" name="isbn" id="isbn" class="form-control" />
										</div>
										<div class="form-group">
											<label class="control-label " for="input-email">书名</label>
											<input type="text" name="name" id="name" class="form-control" />
										</div>
									</div>
									<div class="bottom-form">
										
										<input type="button" value="搜索" id="search2" class="btn btn-default pull-right">
									</div>
								</div>						
								<div class="col-sm-6 new-customer">
									<div class="well">
										<h2><i class="fa fa-file-o" aria-hidden="true"></i> 图书</h2>
										<div class="row">
										<div class="col-sm-5">
										<div style="width:120px;height:155px;background: #ddd;float: left;"><img width="120px" height="155px" id="pic" /></div>
										</div>
										<div class="col-sm-7" style="float: left;">
										
											<p><span><strong>书名&nbsp;&nbsp;:</strong></span><span id="s_name"></span></p>
											<p><span><strong>出版社&nbsp;:</strong></span><span id="s_publisher"></span></p>
											<p><span><strong>作者&nbsp;&nbsp;:</strong></span><span id="s_author"></span></p>
											<p><span><strong>出版时间:</strong></span><span id="s_time"></span></p>
											<p><span><strong>isbn&nbsp;&nbsp;:</strong></span><span id="s_isbn"></span></p>
											<p id="b_id" style="display:none;"></p>
											
										</div>
										</div>
									</div>
									<div class="bottom-form">
										<input type="button" name="submit" value="录入" id="submitL" class="btn btn-default pull-right">
									</div>
								</div>
							</form>
							
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<!-- //Main Container -->

<script>
var data = {};
$(document).ready(function(){
	$("#search2").click(function(){
		data['isbn'] = $("#isbn").val();
		data['name'] = $("#name").val();
		if(1){
			$.post('<?php echo CURRENTURL;?>',{'data':data},function(response,status){
			if(status = "success"){
				if(response == "null"){
					alert('很抱歉，没有找到该书');			
				}
				var arr = JSON.parse(response);
				$("#pic").attr("src",arr['img'])
				$("#s_name").text(arr['title']);
				$("#s_publisher").text(arr['publisher']);
				$("#s_author").text(arr['author']);
				$("#s_time").text(arr['timePublish']);
				$("#s_isbn").text(arr['isbn']);
				$("#b_id").text(arr['b_id']);
				}
			});
		}
	});

	$("#submitL").click(function(){
		var b_id = $("#b_id").text();	
		if(1){
			$.post("<?php echo CURRENTURL;?>",{"b_id":b_id},function(response,status){
			if(status = "success"){
				alert('恭喜你,成功录入该书！');
				window.location.href="<?php echo CURRENTURL;?>";
				}
			});
		}
	});				
});	
</script>





