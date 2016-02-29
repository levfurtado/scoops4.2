<?php /* Smarty version Smarty-3.0.9, created on 2016-02-25 15:55:37
         compiled from "/var/www/newscoop/themes/publication_1/theme_1/_tpl/user-sidebar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:108685143156cf6a4905b887-20829443%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8df9197a6a1aaef1305d00f2d273964fbf075dd4' => 
    array (
      0 => '/var/www/newscoop/themes/publication_1/theme_1/_tpl/user-sidebar.tpl',
      1 => 1456425874,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '108685143156cf6a4905b887-20829443',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_local')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/block.local.php';
if (!is_callable('smarty_function_set_current_issue')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/function.set_current_issue.php';
if (!is_callable('smarty_block_list_articles')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/block.list_articles.php';
if (!is_callable('smarty_block_list_article_comments')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/block.list_article_comments.php';
if (!is_callable('smarty_function_uri')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/function.uri.php';
?><!-- sidebar -->
<section class="news-sections user-feed">                                
    <h2><?php echo $_smarty_tpl->getConfigVariable('communityFeed');?>
</h2>
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('local', array()); $_block_repeat=true; smarty_block_local(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php echo smarty_function_set_current_issue(array(),$_smarty_tpl);?>

    <?php $_smarty_tpl->smarty->_tag_stack[] = array('list_articles', array('length'=>"10",'order'=>"byLastComment desc",'constraints'=>"type is news")); $_block_repeat=true; smarty_block_list_articles(array('length'=>"10",'order'=>"byLastComment desc",'constraints'=>"type is news"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <?php $_smarty_tpl->smarty->_tag_stack[] = array('list_article_comments', array('length'=>"1",'order'=>"bydate desc")); $_block_repeat=true; smarty_block_list_article_comments(array('length'=>"1",'order'=>"bydate desc"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <p><time datetime="<?php echo $_smarty_tpl->getVariable('gimme')->value->comment->submit_date;?>
"><?php echo $_smarty_tpl->getVariable('gimme')->value->comment->submit_date;?>
</time></p>
        <p><?php echo $_smarty_tpl->getConfigVariable('newCommentOn');?>
</p>
        <a href="<?php echo smarty_function_uri(array('options'=>"article"),$_smarty_tpl);?>
"> <?php echo $_smarty_tpl->getVariable('gimme')->value->article->name;?>
</a>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_list_article_comments(array('length'=>"1",'order'=>"bydate desc"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_list_articles(array('length'=>"10",'order'=>"byLastComment desc",'constraints'=>"type is news"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_local(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

</section>