<?php /* Smarty version Smarty-3.0.9, created on 2016-02-25 15:55:36
         compiled from "/var/www/newscoop/themes/publication_1/theme_1/_tpl/user-cont.tpl" */ ?>
<?php /*%%SmartyHeaderCode:101615782156cf6a48ed3597-53873618%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '74d8cf0b5967b87b441584d60b2c1422edddb14d' => 
    array (
      0 => '/var/www/newscoop/themes/publication_1/theme_1/_tpl/user-cont.tpl',
      1 => 1456425874,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '101615782156cf6a48ed3597-53873618',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_camp_date_format')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/modifier.camp_date_format.php';
?><form class="users-search" action="<?php echo $_smarty_tpl->getVariable('view')->value->url(array('controller'=>'user','action'=>'search'),'default',true);?>
" method="GET">
    <label class="acc" for="q"><?php echo $_smarty_tpl->getConfigVariable('search');?>
</label>
    <input type="search" placeholder="<?php echo $_smarty_tpl->getConfigVariable('searchUsers');?>
" name="q">
    <input type="submit" value="<?php echo $_smarty_tpl->getConfigVariable('search');?>
">
</form>

<section class="user-list">
    <?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('users')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
?>
        <article class="news-sections">
            <h2><a  href="<?php echo $_smarty_tpl->getVariable('view')->value->url(array('username'=>$_smarty_tpl->getVariable('user')->value->uname),'user');?>
"><?php echo $_smarty_tpl->getVariable('user')->value->first_name;?>
 <?php echo $_smarty_tpl->getVariable('user')->value->last_name;?>
</a></h2>
            <a href="<?php echo $_smarty_tpl->getVariable('view')->value->url(array('username'=>$_smarty_tpl->getVariable('user')->value->uname),'user');?>
">
                <img width="60" src="<?php $_template = new Smarty_Internal_Template("_tpl/user-image.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('user',$_smarty_tpl->tpl_vars['user']->value);$_template->assign('width',50);$_template->assign('height',50); echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>" alt="<?php echo $_smarty_tpl->getVariable('user')->value->uname;?>
">
            </a>
            
            <p><?php echo $_smarty_tpl->getConfigVariable('memberSince');?>
 <time class="timeago" datetime="<?php echo smarty_modifier_camp_date_format($_smarty_tpl->getVariable('user')->value->created,'%M %e, %Y');?>
"><?php echo smarty_modifier_camp_date_format($_smarty_tpl->getVariable('user')->value->created,"%M %e, %Y");?>
</time></p>
            <?php if ($_smarty_tpl->getVariable('user')->value->posts_count>0){?>
                <p><?php echo $_smarty_tpl->getVariable('user')->value->posts_count;?>
&nbsp;<?php echo $_smarty_tpl->getConfigVariable('posts');?>
</p>
            <?php }else{ ?>
                <p><?php echo $_smarty_tpl->getConfigVariable('noPosts');?>
</p>
            <?php }?>
        </article>
        <?php }} ?>      
</section>