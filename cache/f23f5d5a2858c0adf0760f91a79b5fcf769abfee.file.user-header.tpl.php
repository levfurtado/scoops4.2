<?php /* Smarty version Smarty-3.0.9, created on 2016-02-25 15:55:36
         compiled from "/var/www/newscoop/themes/publication_1/theme_1/_tpl/user-header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:138523611656cf6a48e139c4-38966824%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f23f5d5a2858c0adf0760f91a79b5fcf769abfee' => 
    array (
      0 => '/var/www/newscoop/themes/publication_1/theme_1/_tpl/user-header.tpl',
      1 => 1456425874,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '138523611656cf6a48e139c4-38966824',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1><?php echo $_smarty_tpl->getConfigVariable('community');?>
</h1>
<div class="pagination">
    <ul>
        <li id="user-active"><a href="<?php echo $_smarty_tpl->getVariable('view')->value->url(array('controller'=>'user','action'=>'index'),'default',true);?>
"><?php echo $_smarty_tpl->getConfigVariable('active');?>
</a></li>
        <li id="user-all"><a href="<?php echo $_smarty_tpl->getVariable('view')->value->url(array('controller'=>'user','action'=>'filter','f'=>'a-z'),'default',true);?>
"><?php echo $_smarty_tpl->getConfigVariable('all');?>
</a></li>
        <li id="user-ad"><a href="<?php echo $_smarty_tpl->getVariable('view')->value->url(array('controller'=>'user','action'=>'filter','f'=>'a-d'),'default',true);?>
">A-D</a></li>
        <li id="user-ek"><a href="<?php echo $_smarty_tpl->getVariable('view')->value->url(array('controller'=>'user','action'=>'filter','f'=>'e-k'),'default',true);?>
">E-K</a></li>
        <li id="user-lp"><a href="<?php echo $_smarty_tpl->getVariable('view')->value->url(array('controller'=>'user','action'=>'filter','f'=>'l-p'),'default',true);?>
">L-P</a></li>
        <li id="user-qt"><a href="<?php echo $_smarty_tpl->getVariable('view')->value->url(array('controller'=>'user','action'=>'filter','f'=>'q-t'),'default',true);?>
">Q-T</a></li>
        <li id="user-uz"><a href="<?php echo $_smarty_tpl->getVariable('view')->value->url(array('controller'=>'user','action'=>'filter','f'=>'u-z'),'default',true);?>
">U-Z</a></li>
        <li id="user-editors"><a href="<?php echo $_smarty_tpl->getVariable('view')->value->url(array('controller'=>'user','action'=>'editors'),'default',true);?>
"><?php echo $_smarty_tpl->getConfigVariable('editors');?>
</a></li> 
    </ul>
</div>