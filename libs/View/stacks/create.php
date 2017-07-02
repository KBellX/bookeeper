<body class="res layout-subpage">
    <div id="wrapper" class="wrapper-full ">
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
<style>
	.fileUpload {
    position: relative;
    overflow: hidden;
    margin: 10px;
}
 
.fileUpload input.upload {  position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}

</style>
<!-- Navbar switcher -->
<!-- //end Navbar switcher -->
	</header>

	<!-- //Header Container  -->
	<!-- Main Container  -->
	<div class="main-container container">

		<div class="row">
			<div id="content" class="col-sm-12">
				<h2 class="title">信息设置</h2>
				<p>让读书充满生活让生活更加简单，欢迎来到图书馆信息设置页面<a href="#"> </a>~ </p>
				<form action="?controller=stacks&method=create" method="POST" enctype="multipart/form-data" class="form-horizontal account-register clearfix">
					<fieldset id="account">
						<legend>图书馆信息</legend>
						<div class="form-group required" style="display: none;">
							<label class="col-sm-2 control-label">Customer Group</label>
							<div class="col-sm-10">
								<div class="radio">
									<label>
										<input type="radio" name="customer_group_id" value="1" checked="checked"> Default
									</label>
								</div>
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-firstname">图书馆名称</label>
							<div class="col-sm-10">
								<input type="text" name="name" value="" placeholder="图书馆名称" id="name" class="form-control">
								<p id="err_name1"></p>
								<p id="err_name2"></p>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-fax">图书馆简介</label>
							<div class="col-sm-10">
								<input type="text" name="desc" value="" placeholder="图书馆简介" id="desc" class="form-control">
								<p id="err_desc"></p>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-fax">图书馆地点</label>
							<div class="col-sm-10">
								<input type="text" name="desc" value="" placeholder="图书馆地点" id="desc" class="form-control">
								<p id="err_place"></p>
							</div>
						</div>
					</fieldset>
					<fieldset id="address">
<script type="text/javascript" src="images/js/upload/jquery.form.js"></script>					
						<legend>图片上传</legend>
						<p>小尺寸图片：上传gif/jpg格式的图片，最佳尺寸：300 X 250像素</p>
   		
        <div class="fileUpload btn btn-primary u1_btn">
   						 <span>  选择文件  </span>
   				<p id="small" style="display:none"></p>		 
    	<input id="u1_fileupload"  class="upload" type="file" name="small" />
		</div>



        <div class="u1_progress">
    		<span class="u1_bar"></span><span class="u1_percent">0%</span >
		</div>
        <div class="files"></div>
        <div id="u1_showimg"></div>



						<p>大尺寸图片：上传gif/jpg格式的图片，最佳尺寸：870 X 290像素</p>
   		
        <div class="fileUpload btn btn-primary u2_btn">
   						 <span>  选择文件  </span>
   				<p id="big" style="display:none"></p>		 
    	<input id="u2_fileupload"  class="upload" type="file" name="big" />
		</div>



        <div class="u2_progress">
    		<span class="u2_bar"></span><span class="u2_percent">0%</span >
		</div>
        <div class="u2_files"></div>
        <div id="u2_showimg"></div>

					</fieldset>


					<fieldset>
						<legend>密码设置</legend>
						<div class="form-group required">
						<label class="col-sm-2 control-label">是否公开</label>
							<div class="col-sm-10">
								<label class="radio-inline">
									<input id="yes" checked="checked" type="radio" name="is_open" value="1"> Yes
								</label>
								<label class="radio-inline">
									<input id="no" type="radio" name="is_open" value="0"> No
								</label>

							</div>

							<div id="password" style="display:none">
								<label class="col-sm-2 control-label" for="input-password">密码</label>
								<div class="col-sm-10">
									<input type="password" name="password" value="" placeholder="密码" id="input-password" class="form-control">
								</div>
							</div>

						</div>
<!-- 						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-confirm">确认密码</label>
							<div class="col-sm-10">
								<input type="password" name="confirm" value="" placeholder="确认密码" id="input-confirm" class="form-control">
							</div>
						</div> -->
					</fieldset>
					<div class="buttons">
						<div class="pull-right">我已经阅读并同意<a href="#" class="agree"><b>条款</b></a>
							<input class="box-checkbox" type="checkbox" name="agree" value="1"> &nbsp;
							<input type="button" id="submit" name="submit" class="btn btn-default pull-right" value="完成" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- //Main Container -->

<!-- 客户端check和ajax传值 -->
<script>
// var err = [1,1,1,1];
// var past = '';
var data = {};
// 隐藏报错信息
$("#err_name1").css("display","none");
$("#err_name2").css("display","none");
$("#err_desc").css("display","none");
$("#err_admin1").css("display","none");
$("#err_admin2").css("display","none");
$(document).ready(function(){
	$("#no").click(function(){
		$("#password").css("display","block");
		// alert('aa');
	})
	$("#yes").click(function(){
		$("#password").css("display","none");
		// alert('aa');
	})		


//check
	$("#name").blur(function(){
		if($("#name").val() == '' ){
			$("#err_name1").text('图书馆名称不得为空!') ;
			$("#err_name1").css("display","block");
		}else{
			err[0] = 0;
		}
		if($("#name").val().length > 48 ){
			$("#err_name2").text('图书馆名称不得超过48个字!') ;
			$("#err_name2").css("display","block");
		}else{
			err[1] = 0;
		}
	})
	$("#desc").blur(function(){
		if($("#desc").val().length > 255 ){
			$("#err_desc").text('图书管简介不得超过255个字!') ;
			$("#err_desc").css("display","block");
		}else{
			err[2] = 0;
		}
	})
//ajax
	$("#submit").click(function(){
		data['name'] = $("#name").val();
		data['desc'] = $("#desc").val();
		data['small'] = $("#small").text();
		data['big'] = $("#big").text();
		data['is_open'] = $("input[name='is_open']:checked").val();
		//怎么判断是否被选
		// data['agree'] = $("input[type='checkbox']").attr("checked",false);
		// alert($("input[name='agree']").attr("checked"));

		// for(i = 0; i < err.length; $i++){
		// 	if(err[i] != 0){

		// 	}
		// }
		if(1){
			$.post('<?php echo CURRENTURL;?>',{'data':data},function(response,status){
			if(status = "success"){
				if(response){
					alert('恭喜你,创建书库成功！');
					window.location.href = "?controller=book&method=input&s_id="+response;					
				}else{
					alert("请填写相关信息");
				}
	
				}
			});
		}
	});
});
</script>

<script type="text/javascript">
$(function () {
	var u1_bar = $('.u1_bar');
	var u1_percent = $('.u1_percent');
	var u1_showimg = $('#u1_showimg');
	var u1_progress = $(".u1_progress");
	var files = $(".files");
	var u1_btn = $(".u1_btn span");
	$("#u1_fileupload").wrap("<form id='u1_myupload' action='<?php echo CURRENTURL;?>' method='post' enctype='multipart/form-data'></form>");
    $("#u1_fileupload").change(function(){
		$("#u1_myupload").ajaxSubmit({
			dataType:  'json',
			beforeSend: function() {
        		u1_showimg.empty();
				u1_progress.show();
        		var percentVal = '0%';
        		u1_bar.width(percentVal);
        		u1_percent.html(percentVal);
				u1_btn.html("上传中...");
    		},
    		uploadProgress: function(event, position, total, percentComplete) {
        		var percentVal = percentComplete + '%';
        		u1_bar.width(percentVal);
        		u1_percent.html(percentVal);
    		},
			success: function(data) {
				$.each(data, function(key, value) {
					if(key == "small")
						$("#small").text(value);
				});		
				u1_btn.html("上传成功");
			},
			error:function(xhr){
				u1_btn.html("上传失败");
				u1_bar.width('0')
				files.html(xhr.responseText);
			}
		});
	});
});
</script>

<script type="text/javascript">
$(function () {
	var u2_bar = $('.u2_bar');
	var u2_percent = $('.u2_percent');
	var u2_showimg = $('#u2_showimg');
	var u2_progress = $(".u2_progress");
	var u2_files = $(".u2_files");
	var u2_btn = $(".u2_btn span");
	$("#u2_fileupload").wrap("<form id='u2_myupload' action='<?php echo CURRENTURL;?>' method='post' enctype='multipart/form-data'></form>");
    $("#u2_fileupload").change(function(){
		$("#u2_myupload").ajaxSubmit({
			dataType:  'json',
			beforeSend: function() {
        		u2_showimg.empty();
				u2_progress.show();
        		var percentVal = '0%';
        		u2_bar.width(percentVal);
        		u2_percent.html(percentVal);
				u2_btn.html("上传中...");
    		},
    		uploadProgress: function(event, position, total, percentComplete) {
        		var percentVal = percentComplete + '%';
        		u2_bar.width(percentVal);
        		u2_percent.html(percentVal);
    		},
			success: function(data) {
				$.each(data, function(key, value) {
					if(key == "big")
						$("#big").text(value);
				});		
				u2_btn.html("上传成功");
			},
			error:function(xhr){
				u2_btn.html("上传失败");
				u2_bar.width('0')
				u2_files.html(xhr.responseText);
			}
		});
	});
});
</script>
















