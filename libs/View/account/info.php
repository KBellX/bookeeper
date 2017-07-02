<?php
$u_id = $_SESSION['u_id'];
?>
	<body>
	
	
	<div id="fh5co-page">
	<?php $this->widget('top2');?>
	
<div style="width: 100%;height:1400px;background: url(images/images/bcperson.png);">
	<div class="personphoto">
		<img src="images/images/person.png">
		<div><b><?php echo $data_account['username'];?></b></div>
	</div>
	<div class="personmain">
		<div class="personnav">
			<div>我的资料</div>
		</div>
		<div class="personziliao">
			<div class="zongleft">
				<div class="ziliaoleft">
					<div class="changehead">更改头像</div>
					<div class="infor">昵称：<?php echo $data_account['username'];?></div>
					<div class="infor">性别：<?php echo ($data_account['sex'])==0?'男':'女';?></div>
					<div class="infor">已加入书库：1</div>
					<div class="infor">自己的书库：1</div>
					<div class="qianming">个性签名</div>
				</div>
				<div class="ziliaomain">
					<div>推荐</div>
					<div>推荐</div>
					<div>推荐</div>
				</div>
				<div class="ziliaobottom">
					<a href=""><div>书库最新公告</div></a>
					<a href=""><div>书库最新公告</div></a>
					<a href=""><div>书库最新公告</div></a>
					<a href=""><div>书库最新公告</div></a>
				</div>
			</div>

			<div class="ziliaoright">
				<div class="name">昵称：</div>
				<input id="username" type="text" class="textone" value="<?php echo $data_account['username'];?>">
				<div class="sex">性别：</div>
				<select id="sex">
				  <option value="0">男</option>
				  <option value="1" <?php echo ($data_account['sex'])==1?'selected="selected"':'';?>>女</option>
				</select>
				<div class="personal">签名：</div>
				<textarea id="desc" cols="40" rows="6" style="OVERFLOW:auto"><?php echo $data_account['desc'];?></textarea>
				<button type="button" id="check" style="float: left;transition:all 0.5s;margin-left: 195px;margin-top: 50px">提交</button>
			</div>

		</div>
	</div>
</div>				
	</div>				
			</div>
		</div>
	</div>


<script>
var data = {};
$(document).ready(function(){
	$("#check").click(function(){
		data['username'] = $("#username").val();
		data['sex'] = $("#sex").val();	//获取select所选的value
		data['province'] = $("#province").val();
		data['city'] = $("#city").val();
		data['area'] = $("#area").val();
		data['desc'] = $("#desc").val();
		if(1){
			$.post('?controller=account&method=info&u_id=<?php echo $u_id;?>',{'data':data},function(response,status){
			if(status = "success"){
				alert('恭喜你,修改成功');
				// $("#pic").attr("src",arr['img'])
				// $("#s_name").text(arr['title']);
				// window.location.href = "?controller=account&method=index";
				}
			});
		}
	});	
	
});		
</script>	

	

	
