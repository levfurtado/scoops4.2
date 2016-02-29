<?php /* Smarty version Smarty-3.0.9, created on 2016-02-25 13:57:49
         compiled from "/var/www/newscoop/themes/publication_1/theme_1/_tpl/_html-head.tpl" */ ?>
<?php /*%%SmartyHeaderCode:114693306756cf4eadebbca3-60640491%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3fcc1f287314283760a26ca49e4991e1bd4d37f9' => 
    array (
      0 => '/var/www/newscoop/themes/publication_1/theme_1/_tpl/_html-head.tpl',
      1 => 1456425874,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '114693306756cf4eadebbca3-60640491',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/newscoop/vendor/smarty/smarty/libs/plugins/modifier.escape.php';
if (!is_callable('smarty_function_url')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/function.url.php';
if (!is_callable('smarty_modifier_regex_replace')) include '/var/www/newscoop/vendor/smarty/smarty/libs/plugins/modifier.regex_replace.php';
if (!is_callable('smarty_function_uri')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/function.uri.php';
if (!is_callable('smarty_block_list_article_images')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/block.list_article_images.php';
?><!DOCTYPE html>
<!--[if gte IEMobile 7]> <html class="no-js iemobile"> <![endif]-->
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js top" lang="en-en" dir="ltr"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <title><?php if ($_smarty_tpl->getVariable('gimme')->value->article->defined){?><?php echo $_smarty_tpl->getVariable('gimme')->value->article->name;?>
 | <?php }elseif($_smarty_tpl->getVariable('gimme')->value->section->defined){?><?php echo $_smarty_tpl->getVariable('gimme')->value->section->name;?>
 | <?php }?><?php echo $_smarty_tpl->getVariable('gimme')->value->publication->name;?>
</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <?php if (empty($_smarty_tpl->getVariable('siteinfo',null,true,false)->value)){?><?php $_smarty_tpl->tpl_vars['siteinfo'] = new Smarty_variable(array('description'=>'','keywords'=>''), null, null);?><?php }?>
    <meta name="description" content="<?php if ($_smarty_tpl->getVariable('gimme')->value->article->defined){?><?php echo smarty_modifier_escape(preg_replace('!\s+!u', ' ',strip_tags($_smarty_tpl->getVariable('gimme')->value->article->deck)),'html','utf-8');?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('siteinfo')->value['description'];?>
<?php }?>">
    <meta name="keywords" content="<?php if ($_smarty_tpl->getVariable('gimme')->value->article->defined){?><?php echo $_smarty_tpl->getVariable('gimme')->value->article->keywords;?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('siteinfo')->value['keywords'];?>
<?php }?>" />
    
    <link href='http://fonts.googleapis.com/css?family=Merriweather+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo smarty_function_url(array('static_file'=>'_css/css/styles.css'),$_smarty_tpl);?>
">
    <!--[if lte IE 9]>
       <link rel="stylesheet" href="<?php echo smarty_function_url(array('static_file'=>"_css/css/tommy.ie.css"),$_smarty_tpl);?>
">
    <![endif]-->

    <!-- RSS & Pingback -->
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://<?php echo $_smarty_tpl->getVariable('gimme')->value->publication->site;?>
/en/static/rss/">

    <?php if ($_smarty_tpl->getVariable('gimme')->value->article->defined){?>
    <meta property="og:title" content="<?php echo smarty_modifier_regex_replace(html_entity_decode($_smarty_tpl->getVariable('gimme')->value->article->name),'/&(.*?)quo;/','&quot;');?>
" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="http://<?php echo $_smarty_tpl->getVariable('gimme')->value->publication->site;?>
<?php echo smarty_function_uri(array(),$_smarty_tpl);?>
" />
    <meta property="og:site_name" content="<?php echo $_smarty_tpl->getVariable('gimme')->value->publication->name;?>
" />
    <meta property="og:description" content="<?php echo smarty_modifier_escape(preg_replace('!\s+!u', ' ',strip_tags($_smarty_tpl->getVariable('gimme')->value->article->deck)),'html','utf-8');?>
" />
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('list_article_images', array()); $_block_repeat=true; smarty_block_list_article_images(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <meta property="og:image" content="<?php echo $_smarty_tpl->getVariable('gimme')->value->article->image->imageurl;?>
" />
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_list_article_images(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php }?>

    <link rel="shortcut icon" href="<?php echo smarty_function_url(array('static_file'=>'favicon.ico'),$_smarty_tpl);?>
">
    <link rel="apple-touch-icon" href="<?php echo smarty_function_url(array('static_file'=>'apple-touch-icon.png'),$_smarty_tpl);?>
">

   <!--[if lt IE 9]>
       <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
       <script>window.html5 || document.write('<script src="<?php echo smarty_function_url(array('static_file'=>'_js/vendor/html5shiv.js'),$_smarty_tpl);?>
"><\/script>')</script>
       <script src="<?php echo smarty_function_url(array('static_file'=>"_js/respond.js"),$_smarty_tpl);?>
"></script>
   <![endif]-->

   <!-- Check for svg support -->
   <script>
    var issvg=function(){var div=document.createElement("div");div.innerHTML="<svg/>";return(div.firstChild&&div.firstChild.namespaceURI)==="http://www.w3.org/2000/svg"};if(issvg())document.documentElement.className="svg js";else document.documentElement.className=" js";
    </script>

</head>
