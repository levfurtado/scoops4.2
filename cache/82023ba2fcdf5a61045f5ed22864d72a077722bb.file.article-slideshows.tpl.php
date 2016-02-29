<?php /* Smarty version Smarty-3.0.9, created on 2016-02-25 15:55:18
         compiled from "/var/www/newscoop/themes/publication_1/theme_1/_tpl/article-slideshows.tpl" */ ?>
<?php /*%%SmartyHeaderCode:75062499956cf6a361724a3-43139414%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '82023ba2fcdf5a61045f5ed22864d72a077722bb' => 
    array (
      0 => '/var/www/newscoop/themes/publication_1/theme_1/_tpl/article-slideshows.tpl',
      1 => 1456425874,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '75062499956cf6a361724a3-43139414',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_smarty_tpl->tpl_vars["counter1"] = new Smarty_variable(0, null, null);?>
<?php  $_smarty_tpl->tpl_vars['slideshow'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('gimme')->value->article->slideshows; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['slideshow']->key => $_smarty_tpl->tpl_vars['slideshow']->value){
?>            
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('slideshow')->value->items; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>      
	<?php $_smarty_tpl->tpl_vars["counter1"] = new Smarty_variable(2, null, null);?>             
<?php }} ?>
<?php }} ?>
<div class="news-sections box-ad" id="imageattachment">
    <?php if ($_smarty_tpl->getVariable('counter1')->value=="2"){?>
	<h2>Slideshow</h2>
    <?php }?>
<?php  $_smarty_tpl->tpl_vars['slideshow'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('gimme')->value->article->slideshows; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['slideshow']->key => $_smarty_tpl->tpl_vars['slideshow']->value){
?>

	<div id="gallery" class="galleria-wrapper">
	<?php $_smarty_tpl->tpl_vars["style"] = new Smarty_variable('true', null, null);?>
	<?php $_smarty_tpl->tpl_vars["counter"] = new Smarty_variable(0, null, null);?>              
	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('slideshow')->value->items; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>      
		<?php $_smarty_tpl->tpl_vars["counter"] = new Smarty_variable($_smarty_tpl->getVariable('counter')->value+1, null, null);?>
		<img src="<?php echo $_smarty_tpl->getVariable('item')->value->image->src;?>
" data-title="<?php echo $_smarty_tpl->getVariable('item')->value->caption;?>
" />                
	<?php }} ?>
	</div>
<?php }} ?>
</div>