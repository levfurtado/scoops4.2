<?php /* Smarty version Smarty-3.0.9, created on 2016-02-25 15:55:17
         compiled from "/var/www/newscoop/themes/publication_1/theme_1/_tpl/article-comments.tpl" */ ?>
<?php /*%%SmartyHeaderCode:116365443756cf6a35ce1378-98732821%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4119b5e3dae65616db22f9c746695ef92cb031be' => 
    array (
      0 => '/var/www/newscoop/themes/publication_1/theme_1/_tpl/article-comments.tpl',
      1 => 1456425874,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '116365443756cf6a35ce1378-98732821',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_list_article_comments')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/block.list_article_comments.php';
if (!is_callable('smarty_block_comment_form')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/block.comment_form.php';
if (!is_callable('smarty_function_camp_edit')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/function.camp_edit.php';
?><!-- _tpl/article-comments.tpl-->
<?php if ($_smarty_tpl->getVariable('gimme')->value->article->comment_count>0){?>
<section id="comments" class="article-attachments article-comments">
    <a href="#comment-form" class="article-comments-write"><?php echo $_smarty_tpl->getConfigVariable('writeComment');?>
</a>
    <h3><?php echo $_smarty_tpl->getConfigVariable('comments');?>
 ( <?php echo $_smarty_tpl->getVariable('gimme')->value->article->comment_count;?>
 )</h3>
    <ul>
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('list_article_comments', array('order'=>"bydate desc")); $_block_repeat=true; smarty_block_list_article_comments(array('order'=>"bydate desc"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <li id="comment-<?php echo $_smarty_tpl->getVariable('gimme')->value->current_list->index;?>
" class="article-comment">
                <time datetime="<?php echo $_smarty_tpl->getVariable('gimme')->value->comment->submit_date;?>
"><?php echo $_smarty_tpl->getVariable('gimme')->value->comment->submit_date;?>
</time>
                <?php if ($_smarty_tpl->getVariable('gimme')->value->comment->user->identifier){?>
                <a href="http://<?php echo $_smarty_tpl->getVariable('gimme')->value->publication->site;?>
/user/profile/<?php echo urlencode($_smarty_tpl->getVariable('gimme')->value->comment->user->uname);?>
">
                    <img src="<?php $_template = new Smarty_Internal_Template('_tpl/user-image.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('user',$_smarty_tpl->getVariable('user')->value);$_template->assign('width',60);$_template->assign('height',60); echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>" class="avatar" alt="<?php echo $_smarty_tpl->getVariable('gimme')->value->comment->user->uname;?>
">
                </a>
                <?php }else{ ?>
                    <img src="<?php $_template = new Smarty_Internal_Template('_tpl/user-image.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('user',$_smarty_tpl->getVariable('user')->value);$_template->assign('width',60);$_template->assign('height',60); echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>" class="avatar" alt="<?php echo $_smarty_tpl->getVariable('gimme')->value->comment->user->uname;?>
">
                <?php }?>                                               
                <h4>
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
                </h4>
                
                <p><?php echo $_smarty_tpl->getVariable('gimme')->value->comment->content;?>
</p>
        </li>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_list_article_comments(array('order'=>"bydate desc"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    
    </ul>
</section>
<?php }?>

<!-- COMMENT FORM -->
<section id="comment-form" class="article-attachments article-comments">
    <h3><?php echo $_smarty_tpl->getConfigVariable('yourOpinion');?>
</h3>
     <?php if (!$_smarty_tpl->getVariable('gimme')->value->user->logged_in){?>
        <a href="<?php echo $_smarty_tpl->getVariable('view')->value->url(array('controller'=>'auth','action'=>'index'),'default');?>
" ><?php echo $_smarty_tpl->getConfigVariable('loginOrSignUp');?>
</a>
    <?php }?>
        
    <?php if (!$_smarty_tpl->getVariable('gimme')->value->publication->public_comments){?>
        <!-- public comments are not allowed-->
        <?php if ($_smarty_tpl->getVariable('gimme')->value->user->logged_in){?>
            <!-- user is logged in -->
            <?php if ($_smarty_tpl->getVariable('gimme')->value->article->number&&$_smarty_tpl->getVariable('gimme')->value->article->comments_locked==0&&$_smarty_tpl->getVariable('gimme')->value->article->comments_enabled==1){?>
                <?php if ($_smarty_tpl->getVariable('gimme')->value->submit_comment_action->defined&&$_smarty_tpl->getVariable('gimme')->value->submit_comment_action->rejected){?>
                <p><?php echo $_smarty_tpl->getConfigVariable('yourCommentHasNotBeenAccepted');?>
</p>
                <?php }?>

                <?php if ($_smarty_tpl->getVariable('gimme')->value->submit_comment_action->is_error){?>
                    <p><?php echo $_smarty_tpl->getVariable('gimme')->value->submit_comment_action->error_message;?>
</p>
                <?php }else{ ?>
                    <?php if ($_smarty_tpl->getVariable('gimme')->value->submit_comment_action->defined){?>
                        <?php if ($_smarty_tpl->getVariable('gimme')->value->publication->moderated_comments){?>
                            <p><?php echo $_smarty_tpl->getConfigVariable('yourCommentHasBeenSentForApproval');?>
</p>
                        <?php }?>
                    <?php }?>   
                <?php }?>
                <?php $_smarty_tpl->smarty->_tag_stack[] = array('comment_form', array('html_code'=>"id=\"commentform\" class=\"article-comment-form\"",'_button'=>($_smarty_tpl->getConfigVariable('submitComment')))); $_block_repeat=true; smarty_block_comment_form(array('html_code'=>"id=\"commentform\" class=\"article-comment-form\"",'_button'=>($_smarty_tpl->getConfigVariable('submitComment'))), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <?php echo smarty_function_camp_edit(array('object'=>"comment",'attribute'=>"content",'html_code'=>"id=\"comment\"  placeholder=\"Write your message here\" "),$_smarty_tpl);?>

                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_comment_form(array('html_code'=>"id=\"commentform\" class=\"article-comment-form\"",'_button'=>($_smarty_tpl->getConfigVariable('submitComment'))), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            <?php }else{ ?>
                <p><?php echo $_smarty_tpl->getConfigVariable('commentsLocked');?>
</p>
            <?php }?>
        <?php }else{ ?>
            <p><?php echo $_smarty_tpl->getConfigVariable('registrationNeeded');?>
</p>
        <?php }?>
    <?php }else{ ?>
        <!-- public comments are allowed-->
        <?php if ($_smarty_tpl->getVariable('gimme')->value->user->logged_in){?>
            <?php if ($_smarty_tpl->getVariable('gimme')->value->article->number&&$_smarty_tpl->getVariable('gimme')->value->article->comments_locked==0&&$_smarty_tpl->getVariable('gimme')->value->article->comments_enabled==1){?>
                <?php if ($_smarty_tpl->getVariable('gimme')->value->submit_comment_action->defined&&$_smarty_tpl->getVariable('gimme')->value->submit_comment_action->rejected){?>
                    <p><?php echo $_smarty_tpl->getConfigVariable('yourCommentHasNotBeenAccepted');?>
</p>
                <?php }?>

                <?php if ($_smarty_tpl->getVariable('gimme')->value->submit_comment_action->is_error){?>
                    <p><?php echo $_smarty_tpl->getVariable('gimme')->value->submit_comment_action->error_message;?>
</p>
                <?php }else{ ?>
                    <?php if ($_smarty_tpl->getVariable('gimme')->value->submit_comment_action->defined){?>
                        <?php if ($_smarty_tpl->getVariable('gimme')->value->publication->moderated_comments){?>
                            <p><?php echo $_smarty_tpl->getConfigVariable('yourCommentHasBeenSentForApproval');?>
</p>
                        <?php }?>
                    <?php }?>   
                <?php }?>

                <?php $_smarty_tpl->smarty->_tag_stack[] = array('comment_form', array('html_code'=>"id=\"commentform\" class=\"article-comment-form\"",'_button'=>($_smarty_tpl->getConfigVariable('submitComment')))); $_block_repeat=true; smarty_block_comment_form(array('html_code'=>"id=\"commentform\" class=\"article-comment-form\"",'_button'=>($_smarty_tpl->getConfigVariable('submitComment'))), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <?php echo smarty_function_camp_edit(array('object'=>"comment",'attribute'=>"content",'html_code'=>"id=\"comment\"  placeholder=\"Write your message here\" "),$_smarty_tpl);?>

                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_comment_form(array('html_code'=>"id=\"commentform\" class=\"article-comment-form\"",'_button'=>($_smarty_tpl->getConfigVariable('submitComment'))), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            <?php }else{ ?>
                <p><?php echo $_smarty_tpl->getConfigVariable('commentsLocked');?>
</p>
            <?php }?>
        <?php }else{ ?>
            <!-- user is not logged in -->
            <?php if ($_smarty_tpl->getVariable('gimme')->value->article->number&&$_smarty_tpl->getVariable('gimme')->value->article->comments_locked==0&&$_smarty_tpl->getVariable('gimme')->value->article->comments_enabled==1){?>
                <?php if ($_smarty_tpl->getVariable('gimme')->value->submit_comment_action->defined&&$_smarty_tpl->getVariable('gimme')->value->submit_comment_action->rejected){?>
                    <p><?php echo $_smarty_tpl->getConfigVariable('yourCommentHasNotBeenAccepted');?>
</p>
                <?php }?>

                <?php if ($_smarty_tpl->getVariable('gimme')->value->submit_comment_action->is_error){?>
                    <p><?php echo $_smarty_tpl->getVariable('gimme')->value->submit_comment_action->error_message;?>
</p>
                <?php }else{ ?>
                    <?php if ($_smarty_tpl->getVariable('gimme')->value->submit_comment_action->defined){?>
                        <?php if ($_smarty_tpl->getVariable('gimme')->value->publication->moderated_comments){?>
                            <p><?php echo $_smarty_tpl->getConfigVariable('yourCommentHasBeenSentForApproval');?>
</p>
                        <?php }?>
                    <?php }?>   
                <?php }?>


                <?php $_smarty_tpl->smarty->_tag_stack[] = array('comment_form', array('html_code'=>"id=\"commentform\" class=\"article-comment-form\"",'_button'=>($_smarty_tpl->getConfigVariable('submitComment')))); $_block_repeat=true; smarty_block_comment_form(array('html_code'=>"id=\"commentform\" class=\"article-comment-form\"",'_button'=>($_smarty_tpl->getConfigVariable('submitComment'))), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <?php echo smarty_function_camp_edit(array('object'=>"comment",'attribute'=>"nickname",'html_code'=>"id=\"author\"  placeholder=\"Your name\" "),$_smarty_tpl);?>

                    <?php echo smarty_function_camp_edit(array('object'=>"comment",'attribute'=>"reader_email",'html_code'=>"id=\"email\"  placeholder=\"Your Email\""),$_smarty_tpl);?>

                    <?php echo smarty_function_camp_edit(array('object'=>"comment",'attribute'=>"content",'html_code'=>"id=\"comment\"  placeholder=\"Write your message here\" "),$_smarty_tpl);?>


                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_comment_form(array('html_code'=>"id=\"commentform\" class=\"article-comment-form\"",'_button'=>($_smarty_tpl->getConfigVariable('submitComment'))), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            <?php }else{ ?>
                <p><?php echo $_smarty_tpl->getConfigVariable('commentsLocked');?>
</p>
            <?php }?>
        <?php }?>
    <?php }?>

</section>
<!--  end _tpl/article-comments.tpl-->
