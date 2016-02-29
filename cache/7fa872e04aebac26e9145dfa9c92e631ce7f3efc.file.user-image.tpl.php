<?php /* Smarty version Smarty-3.0.9, created on 2016-02-26 11:30:35
         compiled from "/var/www/newscoop/themes/publication_1/theme_1/_tpl/user-image.tpl" */ ?>
<?php /*%%SmartyHeaderCode:74747287456d07dab00f157-00172960%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7fa872e04aebac26e9145dfa9c92e631ce7f3efc' => 
    array (
      0 => '/var/www/newscoop/themes/publication_1/theme_1/_tpl/user-image.tpl',
      1 => 1456425874,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '74747287456d07dab00f157-00172960',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_url')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/function.url.php';
?><?php if (!$_smarty_tpl->getVariable('user')->value->is_active){?>
<?php echo smarty_function_url(array('static_file'=>"_img/user_inactive_60x60.png"),$_smarty_tpl);?>

<?php }elseif($_smarty_tpl->getVariable('user')->value->image()){?>
<?php echo $_smarty_tpl->getVariable('user')->value->image($_smarty_tpl->getVariable('width')->value,$_smarty_tpl->getVariable('height')->value);?>

<?php }else{ ?>
<?php echo smarty_function_url(array('static_file'=>"_img/user_inactive_60x60.png"),$_smarty_tpl);?>

<?php }?>
