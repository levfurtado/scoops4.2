<?php /* Smarty version Smarty-3.0.9, created on 2016-02-25 16:23:26
         compiled from "/var/www/newscoop/themes/publication_1/theme_1/article.tpl" */ ?>
<?php /*%%SmartyHeaderCode:141695395456cf6a355c1118-37272658%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '36413a4a81e1ce0849f90bbfcb2bc8eea9c309e5' => 
    array (
      0 => '/var/www/newscoop/themes/publication_1/theme_1/article.tpl',
      1 => 1456425874,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '141695395456cf6a355c1118-37272658',
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

<main role="main" class="main site-article" id="main">
    <section class="main-alpha">
    <?php if ($_smarty_tpl->getVariable('gimme')->value->article->type_name=="debate"){?>
        <?php $_template = new Smarty_Internal_Template("_tpl/article-debate.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    <?php }else{ ?>
        <?php $_template = new Smarty_Internal_Template("_tpl/article-cont.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    <?php }?>
    </section>
    <aside class="main-beta clearfix" role="complementary">
        <?php if ($_smarty_tpl->getVariable('gimme')->value->article->type_name=="debate"){?>
            <?php $_template = new Smarty_Internal_Template("_tpl/sidebar_comments.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
            <?php $_template = new Smarty_Internal_Template("_tpl/debate-voting.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
        <?php }?>
        <?php if ($_smarty_tpl->getVariable('gimme')->value->article->type_name=="news"){?>
            <?php $_template = new Smarty_Internal_Template("_tpl/article-slideshows.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
            <?php $_template = new Smarty_Internal_Template("_tpl/sidebar_comments.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
        <?php }?>
        
        <?php $_template = new Smarty_Internal_Template("_tpl/sidebar_ad.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    </aside>
</main>

<?php $_template = new Smarty_Internal_Template("_tpl/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>

<?php $_template = new Smarty_Internal_Template("_tpl/_html-foot.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>

