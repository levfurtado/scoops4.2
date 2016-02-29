<?php /* Smarty version Smarty-3.0.9, created on 2016-02-26 15:28:10
         compiled from "/var/www/newscoop/themes/publication_1/theme_1/auth_index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:89903309756d0b55a674290-33318632%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dd2c19d133eb05ea5019d32acbfad363942d5410' => 
    array (
      0 => '/var/www/newscoop/themes/publication_1/theme_1/auth_index.tpl',
      1 => 1456518488,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '89903309756d0b55a674290-33318632',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php  $_config = new Smarty_Internal_Config(($_smarty_tpl->getVariable('gimme')->value->language->english_name).".conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars(null, 'local'); ?>
<?php $_template = new Smarty_Internal_Template("_tpl/_html-head.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>

<body>
<!--[if lt IE 7]>
    <p class="chromeframe"><?php echo $_smarty_tpl->getConfigVariable('outdatedBrowser');?>
</p>
<![endif]-->

<?php $_template = new Smarty_Internal_Template("_tpl/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<main role="main" class="main site-login">
    <section class="main-alpha">
        <h1><?php echo $_smarty_tpl->getConfigVariable('login');?>
</h1>
        <h1>Login Page</h1>
        <form class="form" action="<?php echo $_smarty_tpl->getVariable('form')->value->getAction();?>
" class="zend_form" method="<?php echo $_smarty_tpl->getVariable('form')->value->getMethod();?>
">
            <?php if ($_smarty_tpl->getVariable('form')->value->isErrors()){?>
            <div class="info info-error">
                <h5><span aria-hidden="true" class="icon-blocked"></span> <?php echo $_smarty_tpl->getConfigVariable('loginFailed');?>
</h5>
                <p><?php echo $_smarty_tpl->getConfigVariable('loginFailedMessage');?>
</p>
                <p><?php echo $_smarty_tpl->getConfigVariable('tryAgainPlease');?>
</p>
                <p><a href="<?php echo $_smarty_tpl->getVariable('view')->value->url(array('controller'=>'auth','action'=>'password-restore'));?>
"><?php echo $_smarty_tpl->getConfigVariable('forgotYourPassword');?>
</a></p>
            </div>
            <?php }?>
                <?php echo $_smarty_tpl->getVariable('form')->value->email->setLabel("E-mail")->removeDecorator('Errors');?>

                <?php echo $_smarty_tpl->getVariable('form')->value->password->setLabel("Password")->removeDecorator('Errors');?>

                <input type="submit" id="submit" class="button big" value="<?php echo $_smarty_tpl->getConfigVariable('login');?>
" />
        </form>
        <p>
          <p>here</p>
            <a class="register-link link-color" href="<?php echo $_smarty_tpl->getVariable('view')->value->url(array('controller'=>'register','action'=>'index'));?>
">Register | </a>
            <a class="register-link link-color" href="<?php echo $_smarty_tpl->getVariable('view')->value->url(array('controller'=>'auth','action'=>'password-restore'));?>
"><?php echo $_smarty_tpl->getConfigVariable('forgotYourPassword');?>
</a>
        </p>
    </section>
    <aside class="main-beta clearfix">
        <?php $_template = new Smarty_Internal_Template("_tpl/user-sidebar.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    </aside>
</main>

<?php $_template = new Smarty_Internal_Template("_tpl/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>

<?php $_template = new Smarty_Internal_Template("_tpl/_html-foot.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
