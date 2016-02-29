<?php /* Smarty version Smarty-3.0.9, created on 2016-02-25 15:55:17
         compiled from "/var/www/newscoop/themes/publication_1/theme_1/_tpl/_edit-article.tpl" */ ?>
<?php /*%%SmartyHeaderCode:161329970056cf6a35a34281-57548695%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '21e882936a0df40ed7c22620dab3779a909d500b' => 
    array (
      0 => '/var/www/newscoop/themes/publication_1/theme_1/_tpl/_edit-article.tpl',
      1 => 1456425874,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '161329970056cf6a35a34281-57548695',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('gimme')->value->user->is_admin){?>
<a href="http://<?php echo $_smarty_tpl->getVariable('gimme')->value->publication->site;?>
/admin/articles/edit.php?f_publication_id=<?php echo $_smarty_tpl->getVariable('gimme')->value->publication->identifier;?>
&f_issue_number=<?php echo $_smarty_tpl->getVariable('gimme')->value->issue->number;?>
&f_section_number=<?php echo $_smarty_tpl->getVariable('gimme')->value->section->number;?>
&f_article_number=<?php echo $_smarty_tpl->getVariable('gimme')->value->article->number;?>
&f_language_id=<?php echo $_smarty_tpl->getVariable('gimme')->value->language->number;?>
&f_language_selected=<?php echo $_smarty_tpl->getVariable('gimme')->value->language->number;?>
" target="_blank" 
style="" title="Edit article">
<span aria-hidden="true" class="icon-cog"></span> <?php echo $_smarty_tpl->getConfigVariable('editArticle');?>

</a>
<?php }?>