<?php /* Smarty version Smarty-3.1.15, created on 2017-03-29 18:27:16
         compiled from "/Library/WebServer/Documents/OSAdmin/uploads/include/template/panel/sale_detail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:152418817558db7d2e9ae368-81717431%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9165dccc73a8e03f76c3c1a8110ebeafb5754880' => 
    array (
      0 => '/Library/WebServer/Documents/OSAdmin/uploads/include/template/panel/sale_detail.tpl',
      1 => 1490780419,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '152418817558db7d2e9ae368-81717431',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_58db7d2e9bdc66_95961022',
  'variables' => 
  array (
    'osadmin_action_alert' => 0,
    'osadmin_quick_note' => 0,
    'player' => 0,
    'sale_infos' => 0,
    'sale_info' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58db7d2e9bdc66_95961022')) {function content_58db7d2e9bdc66_95961022($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("navibar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<?php echo $_smarty_tpl->tpl_vars['osadmin_action_alert']->value;?>

<?php echo $_smarty_tpl->tpl_vars['osadmin_quick_note']->value;?>

<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">请修改账号资料</a></li>
    </ul>

	<div id="myTabContent" class="tab-content">
		<div class="tab-pane active in" id="home">

			<form id="tab" method="post" action="" autocomplete="off">
				<label>ID<span class="label label-info">不可修改</span></label>
				<input type="text" name="player_id" value="<?php echo $_smarty_tpl->tpl_vars['player']->value['id'];?>
" class="input-xlarge" readonly="true">
				<label>注册时间<span class="label label-important">不可修改</span></label>
				<input type="text" name="player_time" value="<?php echo $_smarty_tpl->tpl_vars['player']->value['time'];?>
" class="input-xlarge" readonly="true">
				<label>金币数</label>
				<input type="text" name="player_coins" value="<?php echo $_smarty_tpl->tpl_vars['player']->value['data']['key_user_base_data']['userCoins'];?>
"
					   class="input-xlarge" required="true">
				<div class="btn-toolbar">
					<button type="submit" class="btn btn-primary"><strong>提交</strong></button>
					<div class="btn-group"></div>
				</div>
			</form>

		</div>
	</div>

	<div class="block">
		<a href="#page-stats" class="block-heading" data-toggle="collapse">商品列表</a>
		<div id="page-stats" class="block-body collapse in">
			<table class="table table-striped">
				<thead>
				<tr>
					<th style="width:80px">名称</th>
					<th style="width:150px">购买数量</th>
					<th style="width:150px">购买总额</th>
					<th style="width:150px">操作</th>
				</tr>
				</thead>
				<tbody>
				<?php  $_smarty_tpl->tpl_vars['sale_info'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sale_info']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sale_infos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sale_info']->key => $_smarty_tpl->tpl_vars['sale_info']->value) {
$_smarty_tpl->tpl_vars['sale_info']->_loop = true;
?>
					<tr>
						<td><?php echo $_smarty_tpl->tpl_vars['sale_info']->value['date'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['sale_info']->value['pay_users'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['sale_info']->value['pay_amount'];?>
</td>

						<td>
							<a data-toggle="modal" href="sale_detail.php?sale_id=<?php echo $_smarty_tpl->tpl_vars['sale_info']->value['id'];?>
" title="查看"><i class="icon-pencil" href="sale_detail.php?sale_id=<?php echo $_smarty_tpl->tpl_vars['sale_info']->value['id'];?>
"></i></a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>	
<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>