<?php /* Smarty version Smarty-3.0.9, created on 2016-02-25 13:57:50
         compiled from "/var/www/newscoop/themes/publication_1/theme_1/_tpl/section-stories.tpl" */ ?>
<?php /*%%SmartyHeaderCode:127759571156cf4eae4a5792-82316560%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '13d489b33e734b11ac3cc3271f89409442a4066a' => 
    array (
      0 => '/var/www/newscoop/themes/publication_1/theme_1/_tpl/section-stories.tpl',
      1 => 1456425874,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '127759571156cf4eae4a5792-82316560',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_list_sections')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/block.list_sections.php';
if (!is_callable('smarty_function_uri')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/function.uri.php';
if (!is_callable('smarty_block_list_articles')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/block.list_articles.php';
if (!is_callable('smarty_modifier_date_format')) include '/var/www/newscoop/vendor/smarty/smarty/libs/plugins/modifier.date_format.php';
if (!is_callable('smarty_modifier_camp_date_format')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/modifier.camp_date_format.php';
if (!is_callable('smarty_modifier_truncate')) include '/var/www/newscoop/vendor/smarty/smarty/libs/plugins/modifier.truncate.php';
?><div class="news-sections">
<?php $_smarty_tpl->tpl_vars['currentsection'] = new Smarty_variable($_smarty_tpl->getVariable('gimme')->value->section->number, null, null);?>
	<?php if ($_smarty_tpl->getVariable('currentsection')->value){?>
		<?php $_smarty_tpl->tpl_vars['constraints'] = new Smarty_variable("number not ".($_smarty_tpl->getVariable('currentsection')->value), null, null);?>
	<?php }else{ ?>
		<?php $_smarty_tpl->tpl_vars['constraints'] = new Smarty_variable('', null, null);?>
	<?php }?>
        
<?php $_smarty_tpl->smarty->_tag_stack[] = array('list_sections', array('constraints'=>$_smarty_tpl->getVariable('constraints')->value,'columns'=>"2")); $_block_repeat=true; smarty_block_list_sections(array('constraints'=>$_smarty_tpl->getVariable('constraints')->value,'columns'=>"2"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

	<?php if ($_smarty_tpl->getVariable('gimme')->value->current_list->column=="1"){?>
		<div class="news-sections-inner news-sections-clear">
	<?php }else{ ?>
		<div class="news-sections-inner">
	<?php }?>
		<?php if ($_smarty_tpl->getVariable('gimme')->value->section->name!="Dialogue"){?>
			<h2><a href="<?php echo smarty_function_uri(array('option'=>'section'),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->getVariable('gimme')->value->section->name;?>
 <small>&#10148;</small></a></h2>
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('list_articles', array('length'=>"3",'order'=>"byPublishDate desc")); $_block_repeat=true; smarty_block_list_articles(array('length'=>"3",'order'=>"byPublishDate desc"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<div class="news-sections-inner-alpha">
				<time datetime="<?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('gimme')->value->article->publish_date,"%Y-%m-%dT%H:%MZ");?>
"><?php echo smarty_modifier_camp_date_format($_smarty_tpl->getVariable('gimme')->value->article->publish_date,"%M %e, %Y");?>
</time>
				<?php if ($_smarty_tpl->getVariable('gimme')->value->article->comment_count>0){?>
				<a href="<?php echo smarty_function_uri(array('option'=>'article'),$_smarty_tpl);?>
#comments" class="news-section-comments">
				<span aria-hidden="true" class="icon-bubble"></span>
					<?php if ($_smarty_tpl->getVariable('gimme')->value->article->comment_count==1){?>
						<?php echo $_smarty_tpl->getVariable('gimme')->value->article->comment_count;?>
 <span class="acc"><?php echo $_smarty_tpl->getConfigVariable('comment');?>
 <?php echo $_smarty_tpl->getConfigVariable('for');?>
 <?php echo $_smarty_tpl->getVariable('gimme')->value->article->name;?>
</span>
					<?php }else{ ?>
						<?php echo $_smarty_tpl->getVariable('gimme')->value->article->comment_count;?>
 <span class="acc"><?php echo $_smarty_tpl->getConfigVariable('comments');?>
 <?php echo $_smarty_tpl->getConfigVariable('for');?>
 <?php echo $_smarty_tpl->getVariable('gimme')->value->article->name;?>
</span>
					<?php }?>
				</a>
				<?php }?>
				 <?php if (!$_smarty_tpl->getVariable('gimme')->value->article->content_accessible){?>
        		<span class="label label-premium"><span aria-hidden="true" class="icon-lock"></span> <?php echo $_smarty_tpl->getConfigVariable('premium');?>
</span>
        		<?php }?>
		        <h3><a href="<?php echo smarty_function_uri(array('option'=>'article'),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->getVariable('gimme')->value->article->name;?>
</a></h3>
		        <a href="<?php echo smarty_function_uri(array('option'=>'article'),$_smarty_tpl);?>
"><?php $_template = new Smarty_Internal_Template("_tpl/img/img_thumb.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?></a>
		        <?php echo smarty_modifier_truncate($_smarty_tpl->getVariable('gimme')->value->article->full_text,100,"...",true);?>

		        <a class="link-more" href="<?php echo smarty_function_uri(array('options'=>"article"),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->getConfigVariable('readMore');?>
 <span class="acc"><?php echo $_smarty_tpl->getConfigVariable('from');?>
 <?php echo $_smarty_tpl->getVariable('gimme')->value->article->name;?>
</span></a>
		    </div>
	   	 	<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_list_articles(array('length'=>"3",'order'=>"byPublishDate desc"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

	   	<?php }?>
	</div>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_list_sections(array('constraints'=>$_smarty_tpl->getVariable('constraints')->value,'columns'=>"2"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

</div><!-- end section-stories.tpl -->