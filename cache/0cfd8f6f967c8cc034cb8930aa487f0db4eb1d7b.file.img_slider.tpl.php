<?php /* Smarty version Smarty-3.0.9, created on 2016-02-25 14:02:01
         compiled from "/var/www/newscoop/themes/publication_1/theme_1/_tpl/img/img_slider.tpl" */ ?>
<?php /*%%SmartyHeaderCode:109177489956cf4fa9e94345-54831317%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0cfd8f6f967c8cc034cb8930aa487f0db4eb1d7b' => 
    array (
      0 => '/var/www/newscoop/themes/publication_1/theme_1/_tpl/img/img_slider.tpl',
      1 => 1456425874,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '109177489956cf4fa9e94345-54831317',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_image')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/block.image.php';
?><div data-picture data-alt="<?php $_smarty_tpl->smarty->_tag_stack[] = array('image', array('rendition'=>"slidersmall")); $_block_repeat=true; smarty_block_image(array('rendition'=>"slidersmall"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo $_smarty_tpl->getVariable('image')->value->caption;?>
 (photo: <?php echo $_smarty_tpl->getVariable('image')->value->photographer;?>
)<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_image(array('rendition'=>"slidersmall"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
">
		<?php $_smarty_tpl->smarty->_tag_stack[] = array('image', array('rendition'=>"slidersmall")); $_block_repeat=true; smarty_block_image(array('rendition'=>"slidersmall"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<div data-src="<?php echo $_smarty_tpl->getVariable('image')->value->src;?>
"></div>
		<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_image(array('rendition'=>"slidersmall"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		<?php $_smarty_tpl->smarty->_tag_stack[] = array('image', array('rendition'=>"slidermedium")); $_block_repeat=true; smarty_block_image(array('rendition'=>"slidermedium"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<div data-src="<?php echo $_smarty_tpl->getVariable('image')->value->src;?>
" data-media="(min-width: 321px)"></div>
		<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_image(array('rendition'=>"slidermedium"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		<?php $_smarty_tpl->smarty->_tag_stack[] = array('image', array('rendition'=>"sliderbig")); $_block_repeat=true; smarty_block_image(array('rendition'=>"sliderbig"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<div data-src="<?php echo $_smarty_tpl->getVariable('image')->value->src;?>
" data-media="(min-width: 640px)"></div>
		<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_image(array('rendition'=>"sliderbig"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


		<!--[if (lt IE 9) & (!IEMobile)]>
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('image', array('rendition'=>"sliderbig")); $_block_repeat=true; smarty_block_image(array('rendition'=>"sliderbig"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<img src="<?php echo $_smarty_tpl->getVariable('image')->value->src;?>
" alt="<?php echo $_smarty_tpl->getVariable('image')->value->caption;?>
 (photo: <?php echo $_smarty_tpl->getVariable('image')->value->photographer;?>
)">
		<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_image(array('rendition'=>"sliderbig"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    	<![endif]-->

		<noscript>
		<?php $_smarty_tpl->smarty->_tag_stack[] = array('image', array('rendition'=>"slidersmall")); $_block_repeat=true; smarty_block_image(array('rendition'=>"slidersmall"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<img src="<?php echo $_smarty_tpl->getVariable('image')->value->src;?>
" alt="<?php echo $_smarty_tpl->getVariable('image')->value->caption;?>
 (photo: <?php echo $_smarty_tpl->getVariable('image')->value->photographer;?>
)">
		<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_image(array('rendition'=>"slidersmall"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		</noscript>
  </div>