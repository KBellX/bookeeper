<?php
// 书分页
// $show = $_GET['show'];
$show = 9;
$s_id = $_GET['s_id'];
if(isset($_GET['kind'])){
	$count = $book_belong->count($s_id,$_GET['kind']);
	$page = page($count,$show,5);			
	$data_book_belong = $book_belong->findAllByS_id($s_id,$_GET['kind'],$page['limit']);	
}else{
	$count = $book_belong->count($s_id);
	$page = page($count,$show,5);
	$data_book_belong = $book_belong->findAllByS_id($s_id,0,$page['limit']);
}							
?>
<ul class="pagination">
	<?php echo $page['html'];?>
</ul>
<?php
	return $data_book_belong;
?>



<?php
// 书库分页
?>