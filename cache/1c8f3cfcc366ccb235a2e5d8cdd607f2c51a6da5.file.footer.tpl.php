<?php /* Smarty version Smarty-3.0.9, created on 2016-02-25 13:57:50
         compiled from "/var/www/newscoop/themes/publication_1/theme_1/_tpl/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:163860683356cf4eaeec5a18-25279105%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1c8f3cfcc366ccb235a2e5d8cdd607f2c51a6da5' => 
    array (
      0 => '/var/www/newscoop/themes/publication_1/theme_1/_tpl/footer.tpl',
      1 => 1456425874,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '163860683356cf4eaeec5a18-25279105',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_local')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/block.local.php';
if (!is_callable('smarty_function_set_current_issue')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/function.set_current_issue.php';
if (!is_callable('smarty_block_list_sections')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/block.list_sections.php';
if (!is_callable('smarty_function_url')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/function.url.php';
if (!is_callable('smarty_block_list_articles')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/block.list_articles.php';
?><footer class="footer-alpha clearfix" role="contentinfo">
    <div class="footer-main">
        <div>
            <h4><?php echo $_smarty_tpl->getConfigVariable('sections');?>
</h4>
            <ul>
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('local', array()); $_block_repeat=true; smarty_block_local(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php echo smarty_function_set_current_issue(array(),$_smarty_tpl);?>

            <?php $_smarty_tpl->smarty->_tag_stack[] = array('list_sections', array()); $_block_repeat=true; smarty_block_list_sections(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <li><a href="<?php echo smarty_function_url(array('options'=>'section'),$_smarty_tpl);?>
" title="<?php echo $_smarty_tpl->getVariable('gimme')->value->section->name;?>
"> <?php echo $_smarty_tpl->getVariable('gimme')->value->section->name;?>
</a></li>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_list_sections(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_local(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            </ul>
        </div>
        <div>
            <h4><?php echo $_smarty_tpl->getConfigVariable('moreLinks');?>
</h4>
            <ul>
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('list_articles', array('ignore_issue'=>"true",'ignore_section'=>"true",'constraints'=>"type is page")); $_block_repeat=true; smarty_block_list_articles(array('ignore_issue'=>"true",'ignore_section'=>"true",'constraints'=>"type is page"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <li><a href="<?php echo smarty_function_url(array('options'=>"article"),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->getVariable('gimme')->value->article->name;?>
</a></li>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_list_articles(array('ignore_issue'=>"true",'ignore_section'=>"true",'constraints'=>"type is page"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                <li><a title="<?php echo $_smarty_tpl->getConfigVariable('opensNewWindow');?>
" target="_blank" href="http://twitter.com/sourcefabric "><span aria-hidden="true" class="icon-twitter"></span> Twitter</a></li>
                <li><a title="<?php echo $_smarty_tpl->getConfigVariable('opensNewWindow');?>
" target="_blank"  href="http://facebook.com/sourcefabric "><span aria-hidden="true" class="icon-facebook"></span> Facebook</a></li>
                <li><a title="<?php echo $_smarty_tpl->getConfigVariable('opensNewWindow');?>
" target="_blank" href="/en/static/rss"><span aria-hidden="true" class="icon-feed"></span> RSS</a></li> 
                <li><a href="/?tpl=6"><span aria-hidden="true" class="icon-list"></span> <?php echo $_smarty_tpl->getConfigVariable('archive');?>
</a></li>                           
            </ul>
        </div>
        <div>
            <h4><?php echo $_smarty_tpl->getConfigVariable('aboutUs');?>
</h4>
            <p><?php echo $_smarty_tpl->getConfigVariable('newscoopPromo');?>
</p>
        </div>
        <div class="copyright">
            <p><?php echo $_smarty_tpl->getConfigVariable('copyrightMessage');?>
 <a title="<?php echo $_smarty_tpl->getConfigVariable('opensNewWindow');?>
" target="_blank" href="http://www.sourcefabric.org/en/newscoop/">Powered by Newscoop. </a></p>
            <p>Newscoop Tommy Theme</p>
        </div>
        <a class="link-to-top" href="#top"><?php echo $_smarty_tpl->getConfigVariable('backToTop');?>
</a>
    </div>
</footer>
