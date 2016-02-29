<?php /* Smarty version Smarty-3.0.9, created on 2016-02-26 11:30:34
         compiled from "/var/www/newscoop/themes/publication_1/theme_1/dashboard_index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:70534718456d07daae23bd4-62528985%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '227949c510f5f434de1da38f09b939eb52b1d5c7' => 
    array (
      0 => '/var/www/newscoop/themes/publication_1/theme_1/dashboard_index.tpl',
      1 => 1456425874,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '70534718456d07daae23bd4-62528985',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php  $_config = new Smarty_Internal_Config(($_smarty_tpl->getVariable('gimme')->value->language->english_name).".conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars(null, 'local'); ?>
<?php $_template = new Smarty_Internal_Template("_tpl/_html-head.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>

<body id="body">
<!--[if lt IE 7]>
    <p class="chromeframe"><?php echo $_smarty_tpl->getConfigVariable('outdatedBrowser');?>
</p>
<![endif]-->
          
<?php $_template = new Smarty_Internal_Template("_tpl/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>

<main role="main" class="main site-archive">
    <section class="main-alpha">
        <h1><?php echo $_smarty_tpl->getConfigVariable('welcome');?>
 <?php echo $_smarty_tpl->getVariable('user')->value->name;?>
 <a class="user-edit-link" href='<?php echo $_smarty_tpl->getVariable('view')->value->url(array('username'=>$_smarty_tpl->getVariable('gimme')->value->user->uname),'user');?>
'><?php echo $_smarty_tpl->getConfigVariable('show');?>
 <?php echo $_smarty_tpl->getConfigVariable('profile');?>
</a></h1>
        <img alt="<?php echo $_smarty_tpl->getConfigVariable('profilePicture');?>
 <?php echo $_smarty_tpl->getConfigVariable('from');?>
 <?php echo $_smarty_tpl->getVariable('user')->value->name;?>
" src="<?php $_template = new Smarty_Internal_Template("_tpl/user-image.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('user',$_smarty_tpl->getVariable('user')->value);$_template->assign('width',140);$_template->assign('height',210); echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>" />
        <div class="form-user">
            <?php echo $_smarty_tpl->getVariable('form')->value;?>

        </div>
    </section>
    <aside class="main-beta clearfix">
        <?php $_template = new Smarty_Internal_Template("_tpl/user-sidebar.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    </aside>
</main> <!-- end main role main -->

<?php $_template = new Smarty_Internal_Template("_tpl/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>

<?php $_template = new Smarty_Internal_Template("_tpl/_html-foot.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>