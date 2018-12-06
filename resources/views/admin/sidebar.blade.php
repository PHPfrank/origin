<script>
    var _global={sider:'<?=$sider?>'};
</script>
<div class="col-md-3 left_col">
	<div class="left_col scroll-view">
	<!-- sidebar menu -->
	<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
		<div class="menu_section">
				<h3>&nbsp;</h3>
				<br>
			<ul class="nav side-menu" style="margin-top:-15px;">
				<?php foreach ($rulesInfo as $k1 => $v1) {?>
				<li>
				<?php if($v1->level == 1) {?>
				<a <?php if($v1->name == "homeManage") {?>href="/admin/home"<?php }?>><i class="fa
				<?php switch ($v1->name) {
					case "homeManage":
						echo "fa-home";
						break;
					case "adminManage":
						echo "fa-desktop";
						break;
					case "userManage":
						echo "fa-user";
						break;
					case "hongNiangManage":
						echo "fa-female";
						break;
					case "payManage":
						echo "fa-rmb";
						break;
					case "goodManage":
						echo "fa-group";
						break;
					case "infoManage":
						echo "fa-mortar-board";
						break;
					case "messageManage":
						echo "fa-weixin";
						break;
					case "dmcManage":
						echo "fa-commenting";
						break;
					default:
						echo "fa-cog";
						break;
				}?>
				"></i> <?php echo $v1->title;?> <?php if($v1->name != "homeManage") {?><span class="fa fa-chevron-down" style="padding-left:95px"></span><?php } ?></a>
				<?php }?>
				
				<ul class="nav child_menu">
				<?php foreach ($rulesInfo as $k2 => $v2) {?>
					<?php if(($v2->pid == $v1->id) && ($v2->level == 2)) {?>
						<li><a href="/admin/<?php echo $v2->name;?>" val="<?=$v2->name?>"><?php echo $v2->title;?></a></li>
					<?php }?>
				<?php } ?>
				</ul>
				</li>
				<?php } ?>
			</ul>
		</div>
	
	
	</div>
	<!-- /sidebar menu -->
	

	</div>
</div>