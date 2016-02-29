<?php /* Smarty version Smarty-3.0.9, created on 2016-02-25 13:57:50
         compiled from "/var/www/newscoop/themes/publication_1/theme_1/_tpl/img/img_thumb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:71316810556cf4eae747893-49652535%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '015b8dea359401b3f0e26ee0cd288086e62ed24b' => 
    array (
      0 => '/var/www/newscoop/themes/publication_1/theme_1/_tpl/img/img_thumb.tpl',
      1 => 1456425874,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '71316810556cf4eae747893-49652535',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_image')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/block.image.php';
?><div data-picture data-alt="<?php $_smarty_tpl->smarty->_tag_stack[] = array('image', array('rendition'=>"thumbsmall")); $_block_repeat=true; smarty_block_image(array('rendition'=>"thumbsmall"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo $_smarty_tpl->getVariable('image')->value->caption;?>
 (photo: <?php echo $_smarty_tpl->getVariable('image')->value->photographer;?>
)<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_image(array('rendition'=>"thumbsmall"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
">
		<?php $_smarty_tpl->smarty->_tag_stack[] = array('image', array('rendition'=>"thumbsmall")); $_block_repeat=true; smarty_block_image(array('rendition'=>"thumbsmall"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<div data-src="<?php echo $_smarty_tpl->getVariable('image')->value->src;?>
"></div>
		<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_image(array('rendition'=>"thumbsmall"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		<?php $_smarty_tpl->smarty->_tag_stack[] = array('image', array('rendition'=>"thumbmedium")); $_block_repeat=true; smarty_block_image(array('rendition'=>"thumbmedium"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<div data-src="<?php echo $_smarty_tpl->getVariable('image')->value->src;?>
" data-media="(min-width: 321px)"></div>
		<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_image(array('rendition'=>"thumbmedium"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		<?php $_smarty_tpl->smarty->_tag_stack[] = array('image', array('rendition'=>"thumbbig")); $_block_repeat=true; smarty_block_image(array('rendition'=>"thumbbig"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<div data-src="<?php echo $_smarty_tpl->getVariable('image')->value->src;?>
" data-media="(min-width: 641px)"></div>
		<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_image(array('rendition'=>"thumbbig"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


		<!--[if (lt IE 9) & (!IEMobile)]>
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('image', array('rendition'=>"thumbbig")); $_block_repeat=true; smarty_block_image(array('rendition'=>"thumbbig"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<img src="<?php echo $_smarty_tpl->getVariable('image')->value->src;?>
" alt="<?php echo $_smarty_tpl->getVariable('image')->value->caption;?>
 (photo: <?php echo $_smarty_tpl->getVariable('image')->value->photographer;?>
)">
		<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_image(array('rendition'=>"thumbbig"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    	<![endif]-->

		<noscript>
		<?php $_smarty_tpl->smarty->_tag_stack[] = array('image', array('rendition'=>"thumbsmall")); $_block_repeat=true; smarty_block_image(array('rendition'=>"thumbsmall"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<img src="<?php echo $_smarty_tpl->getVariable('image')->value->src;?>
" alt="<?php echo $_smarty_tpl->getVariable('image')->value->caption;?>
 (photo: <?php echo $_smarty_tpl->getVariable('image')->value->photographer;?>
)">
		<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_image(array('rendition'=>"thumbsmall"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		</noscript>
  </div>