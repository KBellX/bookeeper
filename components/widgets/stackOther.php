<?php
$stacks = M('stacks');
$data_stacks = $stacks->findByS_id($_GET['s_id']);
?>
				<div class="module menu-category titleLine">
	<h3 class="modtitle"><?php echo $data_stacks['name'];?></h3>
	<div class="modcontent">
		<div class="box-category">
			<ul id="cat_accordion" class="list-group">
				<li class="hadchild"><a href="" class="cutom-parent">所有图书</a> 				
				<li><a href="">已借出图书</a></li>
				<li><a href="">未借出图书</a></li>
				</li>
			</ul>
		</div>
	</div>	
