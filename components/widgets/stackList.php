<div class="module menu-category titleLine">
	<h3 class="modtitle">我的图书馆</h3>
	<div class="modcontent">
		<div class="box-category">
			<ul id="cat_accordion" class="list-group">
<?php
$u_id = $_SESSION['u_id'];
$stacks = M('stacks');
$data_stacks = $stacks->findAllByU_id($u_id);
foreach($data_stacks as $data_stack){
?>
				<li data-id="<?php echo $data_stack['s_id']?>" class="hadchild"
				<?php echo ($data_stack['s_id'] == $_GET['s_id'])?'"':''?>>
				<a href="?controller=stacks&method=stack&u_id=<?php echo $u_id?>&s_id=<?php echo $data_stack['s_id']?>&kind=all" class="cutom-parent"></a>
				<?php echo $data_stack['name'];?>
				<span class="button-view  fa fa-plus-square-o"></span>
					<ul style="display: block;">
						<li><a href="?controller=stacks&method=stack&u_id=<?php echo $u_id?>&s_id=<?php echo $data_stack['s_id']?>&kind=all">所有图书</a></li>
						<li><a href="?controller=stacks&method=stack&u_id=<?php echo $u_id?>&s_id=<?php echo $data_stack['s_id']?>&kind=2">已借出图书</a></li>
						<li><a href="?controller=stacks&method=stack&u_id=<?php echo $u_id?>&s_id=<?php echo $data_stack['s_id']?>&kind=1">在库图书</a></li>
						<li><a href="?controller=book&method=input&s_id=<?php echo $data_stack['s_id']?>">录入书籍</a></li>
					</ul>
				</li>
<?php }?>				
			</ul>
		</div>
		
		
	</div>
</div>