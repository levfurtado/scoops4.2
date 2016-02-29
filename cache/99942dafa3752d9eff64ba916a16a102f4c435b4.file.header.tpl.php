<?php /* Smarty version Smarty-3.0.9, created on 2016-02-26 15:08:59
         compiled from "/var/www/newscoop/themes/publication_1/theme_1/_tpl/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:112636970656d0b0dbeec084-60916336%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '99942dafa3752d9eff64ba916a16a102f4c435b4' => 
    array (
      0 => '/var/www/newscoop/themes/publication_1/theme_1/_tpl/header.tpl',
      1 => 1456517269,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '112636970656d0b0dbeec084-60916336',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_local')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/block.local.php';
if (!is_callable('smarty_function_set_current_issue')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/function.set_current_issue.php';
if (!is_callable('smarty_block_list_sections')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/block.list_sections.php';
if (!is_callable('smarty_function_uri')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/function.uri.php';
if (!is_callable('smarty_block_search_form')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/block.search_form.php';
?><!-- <ul class="skiplinks">
  <li class="acc"><a href="#main">Skip to content</a></li>
  <?php $_smarty_tpl->smarty->_tag_stack[] = array('local', array()); $_block_repeat=true; smarty_block_local(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

  <?php echo smarty_function_set_current_issue(array(),$_smarty_tpl);?>

  <?php $_smarty_tpl->smarty->_tag_stack[] = array('list_sections', array()); $_block_repeat=true; smarty_block_list_sections(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <li<?php if (($_smarty_tpl->getVariable('gimme')->value->section->number==$_smarty_tpl->getVariable('gimme')->value->default_section->number)&&($_smarty_tpl->getVariable('gimme')->value->template->name=="section.tpl"||$_smarty_tpl->getVariable('gimme')->value->template->name=="article.tpl")){?> class="acc nav-current"<?php }else{ ?> class="acc"<?php }?>><a href="<?php echo smarty_function_uri(array('options'=>"section"),$_smarty_tpl);?>
">Skip to <?php echo $_smarty_tpl->getVariable('gimme')->value->section->name;?>
</a></li>
  <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_list_sections(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

  <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_local(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

</ul> -->
<link href='https://fonts.googleapis.com/css?family=UnifrakturCook:700' rel='stylesheet' type='text/css'>
<div class="header-image">
  <div class="header-title">
    <h1 class="header-text">
      <span>The Cape Cod</span>
      <span> Chronicle</span>
     </h1>
  </div>
  <img src="../../../images/bridge250px.jpg" alt="">
</div>
<header class="header-main clearfix" role="banner">
  <div class="container-wrap">
    <div class="container">
      <div class="row twelve">
        <div class="row-item one">
          <h1 class="logo-header"><a class="logo-alpha" href="#">CCC</a></h1>
        </div>
        <div class="row-item six">
          <nav id="nav-top" class="nav-alpha nav" role="navigation">
            <ul class="menu-nav">
              <li<?php if ($_smarty_tpl->getVariable('gimme')->value->template->name=="front.tpl"){?> class="nav-current"<?php }?>><a class="ease" href="/"><?php echo $_smarty_tpl->getConfigVariable('home');?>
</a></li>
              <?php echo smarty_function_set_current_issue(array(),$_smarty_tpl);?>

              <li>
                <a href="">Sections</a>
                <ul class="submenu">
                  <li><a href="#">Chatham News</a></li>
                  <li><a href="#">Harwich News</a></li>
                  <li><a href="#">Sports</a></li>
                  <li><a href="#">Features</a></li>
                  <li><a href="#">Opinion</a></li>
                  <li><a href="#">Obituaries</a></li>
                </ul>
              </li>
              <li><a href="">Advertising</a></li>
              <li><a href="">Archives</a></li>
              <li><a href="">Contact</a></li>
              <li><a href="">Subscribe</a></li>
              </ul>
          </nav>
        </div>
        <div class="row-item five">
          <a href="#body" class="nav-link nav-link-open icon-list"> <?php echo $_smarty_tpl->getConfigVariable('sections');?>
</a>
          <a href="#" class="nav-link nav-link-close icon-list"> <?php echo $_smarty_tpl->getConfigVariable('sections');?>
</a>
          <?php $_smarty_tpl->smarty->_tag_stack[] = array('search_form', array('template'=>"search.tpl",'submit_button'=>"Search",'html_code'=>"role=\"search\" class=\"search-field-alpha\"")); $_block_repeat=true; smarty_block_search_form(array('template'=>"search.tpl",'submit_button'=>"Search",'html_code'=>"role=\"search\" class=\"search-field-alpha\""), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <label class="acc" for="f_search_keywords"><?php echo $_smarty_tpl->getConfigVariable('search');?>
</label>
            <input classs="inp-f" id="f_search_keywords" type="search" required aria-required="true" placeholder="<?php echo $_smarty_tpl->getConfigVariable('keywords');?>
" name="f_search_keywords">
          <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_search_form(array('template'=>"search.tpl",'submit_button'=>"Search",'html_code'=>"role=\"search\" class=\"search-field-alpha\""), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>




          <ul class="nav-top">
          <!--  <li><span><?php echo $_smarty_tpl->getConfigVariable('language');?>
: <a href="#">En</a> | <a href="#">De</a></span></li>-->
            <li><a href="<?php echo $_smarty_tpl->getVariable('view')->value->url(array('controller'=>'user','action'=>'index'),'default');?>
" title="Community index"><?php echo $_smarty_tpl->getConfigVariable('community');?>
</a></li>
            <?php if (!$_smarty_tpl->getVariable('gimme')->value->user->logged_in){?>
            <li><a href="<?php echo $_smarty_tpl->getVariable('view')->value->url(array('controller'=>'auth','action'=>'index'),'default');?>
"> <?php echo $_smarty_tpl->getConfigVariable('login');?>
 </a></li>
            <?php }else{ ?>
            <li><a href='<?php echo $_smarty_tpl->getVariable('view')->value->url(array('username'=>$_smarty_tpl->getVariable('gimme')->value->user->uname),'user');?>
'><?php echo $_smarty_tpl->getConfigVariable('profile');?>
</a></li>
            <li><a href="<?php echo $_smarty_tpl->getVariable('view')->value->url(array('controller'=>'auth','action'=>'logout'),'default');?>
"><?php echo $_smarty_tpl->getConfigVariable('logout');?>
</a></li>
            <?php }?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</header>
