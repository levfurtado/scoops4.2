<?php /* Smarty version Smarty-3.0.9, created on 2016-02-25 12:42:18
         compiled from "/var/www/newscoop/themes/system_templates/_campsite_error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:33957126656cf3cfa47ddd6-99314322%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '83541189f45a416b2719897b3cda1bcb3fd68675' => 
    array (
      0 => '/var/www/newscoop/themes/system_templates/_campsite_error.tpl',
      1 => 1411545800,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '33957126656cf3cfa47ddd6-99314322',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('dynamic', array()); $_block_repeat=true; smarty_block_dynamic(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<!DOCTYPE html
    PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <title><?php echo $_smarty_tpl->getVariable('siteinfo')->value['title'];?>
</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="generator" content="<?php echo $_smarty_tpl->getVariable('siteinfo')->value['generator'];?>
" />
  <meta name="description" content="<?php echo $_smarty_tpl->getVariable('siteinfo')->value['description'];?>
" />
  <meta name="keywords" content="<?php echo $_smarty_tpl->getVariable('siteinfo')->value['keywords'];?>
" />

  <link rel="stylesheet" type="text/css" href="/<?php echo $_smarty_tpl->getVariable('siteinfo')->value['templates_path'];?>
/css/_style_offline.css" />
</head>
<body>
<div id="offline">
  <div><img src="/<?php echo $_smarty_tpl->getVariable('siteinfo')->value['templates_path'];?>
/img/newscoop_logo_big.png" />
  <div>Error: <?php echo $_smarty_tpl->getVariable('siteinfo')->value['error_message'];?>
</div>
</div>
</body>
</html>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_dynamic(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
