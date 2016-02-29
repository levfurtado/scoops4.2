<?php /* Smarty version Smarty-3.0.9, created on 2016-02-25 13:57:50
         compiled from "/var/www/newscoop/themes/publication_1/theme_1/_tpl/sidebar_comments.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24530205856cf4eaedce597-15805763%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ac53c5bd877e905a0b84daed687417ea52f5a7d2' => 
    array (
      0 => '/var/www/newscoop/themes/publication_1/theme_1/_tpl/sidebar_comments.tpl',
      1 => 1456425874,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24530205856cf4eaedce597-15805763',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_list_article_comments')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/block.list_article_comments.php';
if (!is_callable('smarty_function_uri')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/function.uri.php';
if (!is_callable('smarty_modifier_truncate')) include '/var/www/newscoop/vendor/smarty/smarty/libs/plugins/modifier.truncate.php';
if (!is_callable('smarty_modifier_date_format')) include '/var/www/newscoop/vendor/smarty/smarty/libs/plugins/modifier.date_format.php';
?><div class="news-sections box-comments">
    <h2><span aria-hidden="true" class="icon-bubble-2"></span> Latest Comments</h2>
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('list_article_comments', array('length'=>"3",'ignore_article'=>"true",'order'=>"byDate desc")); $_block_repeat=true; smarty_block_list_article_comments(array('length'=>"3",'ignore_article'=>"true",'order'=>"byDate desc"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <?php if ($_smarty_tpl->getVariable('gimme')->value->comment->content){?>
        <h3><a href="<?php echo smarty_function_uri(array(),$_smarty_tpl);?>
#comments"><?php echo smarty_modifier_truncate($_smarty_tpl->getVariable('gimme')->value->comment->content,120);?>
</a></h3>
        <p><time class="timeago link-color" datetime="<?php echo $_smarty_tpl->getVariable('gimme')->value->comment->submit_date;?>
"><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('gimme')->value->comment->submit_date,"%a, %d %b %Y %H:%M:%S");?>
,</time> <?php echo $_smarty_tpl->getConfigVariable('by');?>

            <?php if ($_smarty_tpl->getVariable('gimme')->value->comment->user->identifier){?>
                <a href="http://<?php echo $_smarty_tpl->getVariable('gimme')->value->publication->site;?>
/user/profile/<?php echo urlencode($_smarty_tpl->getVariable('gimme')->value->comment->user->uname);?>
"><?php echo $_smarty_tpl->getVariable('gimme')->value->comment->user->uname;?>
</a>
            <?php }else{ ?>
                <?php echo $_smarty_tpl->getVariable('gimme')->value->comment->nickname;?>
 (<?php echo $_smarty_tpl->getConfigVariable('anonymous');?>
)
            <?php }?>
        </p>
        <?php }?>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_list_article_comments(array('length'=>"3",'ignore_article'=>"true",'order'=>"byDate desc"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

</div>