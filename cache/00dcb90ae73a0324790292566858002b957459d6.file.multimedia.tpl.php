<?php /* Smarty version Smarty-3.0.9, created on 2016-02-29 12:28:09
         compiled from "/var/www/newscoop/themes/publication_1/theme_1/_tpl/multimedia.tpl" */ ?>
<?php /*%%SmartyHeaderCode:207579351956d47fa9c66ea7-49174394%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '00dcb90ae73a0324790292566858002b957459d6' => 
    array (
      0 => '/var/www/newscoop/themes/publication_1/theme_1/_tpl/multimedia.tpl',
      1 => 1456766887,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '207579351956d47fa9c66ea7-49174394',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_list_articles')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/block.list_articles.php';
if (!is_callable('smarty_block_list_article_attachments')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/block.list_article_attachments.php';
if (!is_callable('smarty_function_uri')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/function.uri.php';
?>
<?php $_smarty_tpl->tpl_vars['multimediacounter'] = new Smarty_variable(0, null, null);?>
<?php $_smarty_tpl->tpl_vars['multimediacountermax'] = new Smarty_variable(5, null, null);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('list_articles', array('length'=>"100",'ignore_issue'=>"true",'ignore_section'=>"true",'order'=>"bypublishdate desc")); $_block_repeat=true; smarty_block_list_articles(array('length'=>"100",'ignore_issue'=>"true",'ignore_section'=>"true",'order'=>"bypublishdate desc"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

  <?php if ($_smarty_tpl->getVariable('multimediacounter')->value<$_smarty_tpl->getVariable('multimediacountermax')->value){?>
      <?php $_smarty_tpl->tpl_vars['multimediacurrent'] = new Smarty_variable(0, null, null);?>
      <?php  $_smarty_tpl->tpl_vars['slideshow'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('gimme')->value->article->slideshows; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['slideshow']->key => $_smarty_tpl->tpl_vars['slideshow']->value){
?>
        <?php $_smarty_tpl->tpl_vars['multimediacurrent'] = new Smarty_variable(1, null, null);?>
        <?php $_smarty_tpl->tpl_vars['multimediatype'] = new Smarty_variable('slideshow', null, null);?>
      <?php }} ?>
      <?php if ($_smarty_tpl->getVariable('gimme')->value->article->has_attachments){?>
          <?php $_smarty_tpl->smarty->_tag_stack[] = array('list_article_attachments', array()); $_block_repeat=true; smarty_block_list_article_attachments(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

              <?php if ($_smarty_tpl->getVariable('gimme')->value->attachment->extension=='oga'){?>
                <?php $_smarty_tpl->tpl_vars['multimediacurrent'] = new Smarty_variable(1, null, null);?>
                <?php $_smarty_tpl->tpl_vars['multimediatype'] = new Smarty_variable('audio', null, null);?>
              <?php }elseif($_smarty_tpl->getVariable('gimme')->value->attachment->extension=='ogv'||$_smarty_tpl->getVariable('gimme')->value->attachment->extension=='ogg'||$_smarty_tpl->getVariable('gimme')->value->attachment->extension=='mp4'||$_smarty_tpl->getVariable('gimme')->value->attachment->extension=='webm'){?>
                <?php $_smarty_tpl->tpl_vars['multimediacurrent'] = new Smarty_variable(1, null, null);?>
                <?php $_smarty_tpl->tpl_vars['multimediatype'] = new Smarty_variable('video', null, null);?>
              <?php }?>
          <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_list_article_attachments(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

      <?php }?>
      <?php if ($_smarty_tpl->getVariable('multimediacurrent')->value==1){?>
        <?php if (!isset($_smarty_tpl->tpl_vars['multimedia']) || !is_array($_smarty_tpl->tpl_vars['multimedia']->value)) $_smarty_tpl->createLocalArrayVariable('multimedia', null, null);
$_smarty_tpl->tpl_vars['multimedia']->value[($_smarty_tpl->getVariable('gimme')->value->article->number)] = ($_smarty_tpl->getVariable('multimediatype')->value);?>
        <?php $_smarty_tpl->tpl_vars["multimediacounter"] = new Smarty_variable($_smarty_tpl->getVariable('multimediacounter')->value+1, null, null);?>
      <?php }?>
  <?php }?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_list_articles(array('length'=>"100",'ignore_issue'=>"true",'ignore_section'=>"true",'order'=>"bypublishdate desc"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<div class="news-sections news-sections-multimedia">
      <h2>Multimedia</h2>
      <div id="slider-multimedia" class="news-slider slider-multimedia">
      <?php  $_smarty_tpl->tpl_vars['multimediaType'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['articleID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('multimedia')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['multimediaType']->key => $_smarty_tpl->tpl_vars['multimediaType']->value){
 $_smarty_tpl->tpl_vars['articleID']->value = $_smarty_tpl->tpl_vars['multimediaType']->key;
?>

          <?php $_smarty_tpl->smarty->_tag_stack[] = array('list_articles', array('ignore_issue'=>"true",'ignore_section'=>"true",'length'=>"1",'constraints'=>"number is ".($_smarty_tpl->tpl_vars['articleID']->value))); $_block_repeat=true; smarty_block_list_articles(array('ignore_issue'=>"true",'ignore_section'=>"true",'length'=>"1",'constraints'=>"number is ".($_smarty_tpl->tpl_vars['articleID']->value)), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <div class="container-wrap">
              <div class="container">
                <div class="row">
                  <div class="mutlimedia-area-wrap clearfix">
                    <div class="multimedia-area clearfix">
                      <?php if ($_smarty_tpl->tpl_vars['multimediaType']->value=="video"||$_smarty_tpl->tpl_vars['multimediaType']->value=='audio'){?>
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('list_article_attachments', array('length'=>"1")); $_block_repeat=true; smarty_block_list_article_attachments(array('length'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                            <?php if ($_smarty_tpl->tpl_vars['multimediaType']->value=="audio"){?>
                              <a class="multimedia-link-sidebar" href="<?php echo smarty_function_uri(array('options'=>"article"),$_smarty_tpl);?>
#audioattachment">
                            <?php }elseif($_smarty_tpl->tpl_vars['multimediaType']->value=="video"){?>
                              <a class="multimedia-link-sidebar" href="<?php echo smarty_function_uri(array('options'=>"article"),$_smarty_tpl);?>
#videoattachment">
                            <?php }?>
                        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_list_article_attachments(array('length'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    <?php }else{ ?>
                              <a class="multimedia-link-sidebar" href="<?php echo smarty_function_uri(array('options'=>"article"),$_smarty_tpl);?>
#imageattachment">
                        <div class="multimedia-box-wrap">
                          <div class="multimedia-box">
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['multimediaType']->value=="video"||$_smarty_tpl->tpl_vars['multimediaType']->value=='audio'){?>
                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('list_article_attachments', array('length'=>"1")); $_block_repeat=true; smarty_block_list_article_attachments(array('length'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                              <?php if ($_smarty_tpl->tpl_vars['multimediaType']->value=="audio"){?>
                                <h3><span aria-hidden="true" class="icon-music"></span> Audio</h3>
                              <?php }elseif($_smarty_tpl->tpl_vars['multimediaType']->value=="video"){?>
                                <h3><span aria-hidden="true" class="icon-play"></span> Video</h3>
                              <?php }?>
                            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_list_article_attachments(array('length'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                            <?php }else{ ?>
                                <h3><span aria-hidden="true" class="icon-camera"></span> Image</h3>
                              <?php }?>


                            <?php $_template = new Smarty_Internal_Template("_tpl/img/img_rectangle.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('where',"no"); echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>                            
                          </div>
                        </div>
                        </a>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_list_articles(array('ignore_issue'=>"true",'ignore_section'=>"true",'length'=>"1",'constraints'=>"number is ".($_smarty_tpl->tpl_vars['articleID']->value)), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

      <?php }} ?>
      </div>
  </div>
