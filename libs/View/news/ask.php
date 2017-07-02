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



	<!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  <div class="col-md-10 col-md-offset-1">
                  <ul id="myTab" class="nav nav-tabs">
	<li class="active">
		<a href="?controller=news&method=ask&u_id=<?php echo $_SESSION['u_id']?>">
			 请求
		</a>
	</li>
	<li><a href="?controller=news&method=return&u_id=<?php echo $_SESSION['u_id']?>">归还</a></li>
	
</ul>
<div id="myTabContent" class="tab-content">
	<div class="tab-pane fade in active">
		 <section class="panel tasks-widget">

<form method="POST" action="<?php echo CURRENTURL; ?>">      
                          <div class="panel-body"> 
                              <div class="task-content">
                                  <ul class="task-list">

<?php 
if(!empty($data_book_borrow)){
foreach($data_book_borrow as $br){
  $data_acccount = $account->findByU_id($br['u_id']);
  $data_book_belong = $book_belong->findByBl_id($br['bl_id']);
  $data_book = $book->findByb_id($data_book_belong['b_id']);
  $data_stacks = $stacks->findByS_id($data_book_belong['s_id']);
?>

                                      <li>
                                          <div class="task-checkbox">
                                              <input name="ask[<?php echo $br['br_id'];?>]" type="checkbox" class="list-child" value=""  />
                                          </div>
                                          <div class="task-title">
                                              <span class="task-title-sp">
                                              <?php echo $data_acccount['username']?>&nbsp;
                                              请求从&nbsp;
                                              <?php echo $data_stacks['name']?>&nbsp;
                                              借阅&nbsp;
                                              <?php echo $data_book['title']?>
                                              </span>
                                             
                                              <div data-id="<?php echo $br['br_id'];?>" class="pull-right hidden-phone">
                                                  <button type="button" class="agreea btn btn-success btn-xs"><i class=" fa fa-check"></i> 同意</button>
                                                  <button type="button" class="disagreea btn btn-danger btn-xs"><i class="fa fa-trash-o "></i> 拒绝</button>
                                              </div>
                                          </div>
                                      </li>

<?php 
}
}?>

                                  </ul>
                              </div>

                              <div class=" add-task-row">
                              <input type="submit" name="agree" value="同意所选" class="btn btn-success btn-sm pull-left">
                                  <!-- <a class="btn btn-success btn-sm pull-left" href="#">同意所选</a> -->
                                  <!-- <a class="btn btn-default btn-sm pull-right" href="#">拒绝所选</a> -->                                  
                              <input type="submit" name="disagree" value="拒绝所选" class="btn btn-default btn-sm pull-right">
                              </div>
                          </div>
</form>                          
                      </section>
	</div>

	
</div>

                     
                  </div>
              </div>

              <!-- page start-->
            


              <!-- page end-->

          </section>
      </section>
      <!--main content end-->

<script>
$(document).ready(function(){
var agreea = {};
var disagreea = {};
  $(".agreea").click(function(){
    agreea['id']  = $(this).parents("div").attr("data-id");
    if(1){
      $.post('<?php echo CURRENTURL;?>',{'agreea':agreea},function(response,status){
      if(status = "success"){
          window.location.href = "<?php echo CURRENTURL;?>";
        }
      });
    }
  });
  $(".disagreea").click(function(){
    disagreea['id']  = $(this).parents("div").attr("data-id");
    if(1){
      $.post('<?php echo CURRENTURL;?>',{'disagreea':disagreea},function(response,status){
      if(status = "success"){
          window.location.href = "<?php echo CURRENTURL;?>";
        }
      });
    }
  });  
}); 
</script>
	
