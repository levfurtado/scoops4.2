<?php /* Smarty version Smarty-3.0.9, created on 2016-02-26 11:35:07
         compiled from "/var/www/newscoop/themes/publication_1/theme_1/_tpl/section-cont.tpl" */ ?>
<?php /*%%SmartyHeaderCode:88206452856d07ebb207095-00670302%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6d931e40d2b82ee4fdff4641ebce8f515886782b' => 
    array (
      0 => '/var/www/newscoop/themes/publication_1/theme_1/_tpl/section-cont.tpl',
      1 => 1456425874,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '88206452856d07ebb207095-00670302',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_list_articles')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/block.list_articles.php';
if (!is_callable('smarty_modifier_date_format')) include '/var/www/newscoop/vendor/smarty/smarty/libs/plugins/modifier.date_format.php';
if (!is_callable('smarty_modifier_camp_date_format')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/modifier.camp_date_format.php';
if (!is_callable('smarty_function_uri')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/function.uri.php';
if (!is_callable('smarty_block_list_article_authors')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/block.list_article_authors.php';
if (!is_callable('smarty_modifier_truncate')) include '/var/www/newscoop/vendor/smarty/smarty/libs/plugins/modifier.truncate.php';
if (!is_callable('smarty_function_uripath')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/function.uripath.php';
if (!is_callable('smarty_function_urlparameters')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/function.urlparameters.php';
?><?php $_smarty_tpl->smarty->_tag_stack[] = array('list_articles', array('length'=>"5",'ignore_issue'=>"true",'constraints'=>"type not poll",'order'=>"byPublishDate desc")); $_block_repeat=true; smarty_block_list_articles(array('length'=>"5",'ignore_issue'=>"true",'constraints'=>"type not poll",'order'=>"byPublishDate desc"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <article class="news-sections clearfix">

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
        <?php }else{ ?>
            
        <?php }?>
        <?php if (!$_smarty_tpl->getVariable('gimme')->value->article->content_accessible){?>
        <span class="label label-premium"><span aria-hidden="true" class="icon-lock"></span> <?php echo $_smarty_tpl->getConfigVariable('premium');?>
</span>
        <?php }?>
        <h3><a href="<?php echo smarty_function_uri(array('option'=>'article'),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->getVariable('gimme')->value->article->name;?>
</a> </h3>
        <span class="article-author"><?php echo $_smarty_tpl->getConfigVariable('By');?>

        <?php $_smarty_tpl->smarty->_tag_stack[] = array('list_article_authors', array()); $_block_repeat=true; smarty_block_list_article_authors(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php if ($_smarty_tpl->getVariable('gimme')->value->author->type=="Author"){?>
                <?php if ($_smarty_tpl->getVariable('gimme')->value->author->user->defined){?>
                    <a href="<?php echo $_smarty_tpl->getVariable('view')->value->url(array('username'=>$_smarty_tpl->getVariable('gimme')->value->author->user->uname),'user');?>
">
                <?php }?>
                <?php echo $_smarty_tpl->getVariable('gimme')->value->author->name;?>

                <?php if ($_smarty_tpl->getVariable('gimme')->value->author->user->defined){?>
                    </a>
                <?php }?> 
                <?php if (!$_smarty_tpl->getVariable('gimme')->value->current_list->at_end){?>
                    , 
                <?php }?>
            <?php }?>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_list_article_authors(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        </span>                                  
        <a href="<?php echo smarty_function_uri(array('options'=>"article"),$_smarty_tpl);?>
">
         <?php if ($_smarty_tpl->getVariable('gimme')->value->current_list->at_beginning){?>
            <div class="img-big"><?php $_template = new Smarty_Internal_Template("_tpl/img/img_slider.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?></div>
        <?php }else{ ?>
            <?php $_template = new Smarty_Internal_Template("_tpl/img/img_rectangle.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
        <?php }?>
        </a>
        <?php echo smarty_modifier_truncate($_smarty_tpl->getVariable('gimme')->value->article->full_text,420,"...",true);?>

        <a class="link-more" href="<?php echo smarty_function_uri(array('options'=>"article"),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->getConfigVariable('readMore');?>
 <span class="acc"><?php echo $_smarty_tpl->getConfigVariable('from');?>
 <?php echo $_smarty_tpl->getVariable('gimme')->value->article->name;?>
</span></a>  
    </article>

    <?php if ($_smarty_tpl->getVariable('gimme')->value->current_list->at_end){?>
    <?php $_smarty_tpl->tpl_vars['pages'] = new Smarty_variable(ceil($_smarty_tpl->getVariable('gimme')->value->current_list->count/5), null, null);?>
    <?php $_smarty_tpl->tpl_vars['curpage'] = new Smarty_variable(intval($_smarty_tpl->getVariable('gimme')->value->url->get_parameter($_smarty_tpl->getVariable('gimme')->value->current_list_id())), null, null);?>
    <?php if ($_smarty_tpl->getVariable('pages')->value>1){?>
    <div class="pagination">
        <ul>
            <?php if ($_smarty_tpl->getVariable('gimme')->value->current_list->has_previous_elements){?><li class="pagination-prev"><a rel="prev" href="<?php echo smarty_function_uripath(array('options'=>"section"),$_smarty_tpl);?>
?<?php echo smarty_function_urlparameters(array('options'=>"previous_items"),$_smarty_tpl);?>
">&laquo;</a></li><?php }?>
            <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->getVariable('pages')->value-1+1 - (0) : 0-($_smarty_tpl->getVariable('pages')->value-1)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
                <?php $_smarty_tpl->tpl_vars['curlistid'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value*5, null, null);?>
                <?php echo $_smarty_tpl->getVariable('gimme')->value->url->set_parameter($_smarty_tpl->getVariable('gimme')->value->current_list_id(),$_smarty_tpl->getVariable('curlistid')->value);?>

                <?php if ($_smarty_tpl->getVariable('curlistid')->value!=$_smarty_tpl->getVariable('curpage')->value){?>
            <li><a href="<?php echo smarty_function_uripath(array('options'=>"section"),$_smarty_tpl);?>
?<?php echo smarty_function_urlparameters(array(),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value+1;?>
</a></li>
                <?php }else{ ?>
            <li class="active"><a href="<?php echo smarty_function_uripath(array('options'=>"section"),$_smarty_tpl);?>
?<?php echo smarty_function_urlparameters(array(),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value+1;?>
</a></li>
                <?php $_smarty_tpl->tpl_vars['remi'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, null);?>
                <?php }?>
            <?php }} ?>
            <?php if ($_smarty_tpl->getVariable('gimme')->value->current_list->has_next_elements){?><li class="pagination-next"><a rel="next" href="<?php echo smarty_function_uripath(array('options'=>"section"),$_smarty_tpl);?>
?<?php echo smarty_function_urlparameters(array('options'=>"next_items"),$_smarty_tpl);?>
">&raquo;</a></li><?php }?>
        </ul>
    </div>
    <?php echo $_smarty_tpl->getVariable('gimme')->value->url->set_parameter($_smarty_tpl->getVariable('gimme')->value->current_list_id(),$_smarty_tpl->getVariable('curpage')->value);?>

    <?php }?>

    <?php }?>

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_list_articles(array('length'=>"5",'ignore_issue'=>"true",'constraints'=>"type not poll",'order'=>"byPublishDate desc"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
   