<?php /* Smarty version Smarty-3.0.9, created on 2016-02-26 11:35:07
         compiled from "/var/www/newscoop/themes/publication_1/theme_1/section.tpl" */ ?>
<?php /*%%SmartyHeaderCode:108700704056d07ebb1474c6-68567145%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1886e6aa5ad259abf1abc8d4e93656b53b64a598' => 
    array (
      0 => '/var/www/newscoop/themes/publication_1/theme_1/section.tpl',
      1 => 1456425874,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '108700704056d07ebb1474c6-68567145',
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

<main role="main" class="site-section main" id="main">
    
    <section class="main-alpha">
    	<h2 class="hl-alpha"><?php echo $_smarty_tpl->getVariable('gimme')->value->section->name;?>
</h2>

    	<?php $_template = new Smarty_Internal_Template("_tpl/section-cont.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    </section>
    <aside class="main-beta clearfix" role="complementary">
    	<?php $_template = new Smarty_Internal_Template("_tpl/sidebar_ad.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
        <?php $_template = new Smarty_Internal_Template("_tpl/sidebar_comments.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
        
    </aside>                                          
</main>

<?php $_template = new Smarty_Internal_Template("_tpl/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>

<?php $_template = new Smarty_Internal_Template("_tpl/_html-foot.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
