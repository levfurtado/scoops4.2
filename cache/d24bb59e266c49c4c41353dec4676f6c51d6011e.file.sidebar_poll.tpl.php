<?php /* Smarty version Smarty-3.0.9, created on 2016-02-25 13:57:50
         compiled from "/var/www/newscoop/themes/publication_1/theme_1/_tpl/sidebar_poll.tpl" */ ?>
<?php /*%%SmartyHeaderCode:128412291356cf4eaeafbfa5-66193996%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd24bb59e266c49c4c41353dec4676f6c51d6011e' => 
    array (
      0 => '/var/www/newscoop/themes/publication_1/theme_1/_tpl/sidebar_poll.tpl',
      1 => 1456425874,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '128412291356cf4eaeafbfa5-66193996',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_list_articles')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/block.list_articles.php';
if (!is_callable('smarty_block_list_debates')) include '/var/www/newscoop/plugins/debate/smarty_camp_plugins/block.list_debates.php';
if (!is_callable('smarty_block_list_debate_answers')) include '/var/www/newscoop/plugins/debate/smarty_camp_plugins/block.list_debate_answers.php';
if (!is_callable('smarty_function_math')) include '/var/www/newscoop/vendor/smarty/smarty/libs/plugins/function.math.php';
if (!is_callable('smarty_block_debate_form')) include '/var/www/newscoop/plugins/debate/smarty_camp_plugins/block.debate_form.php';
if (!is_callable('smarty_function_uri')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/function.uri.php';
if (!is_callable('smarty_function_debateanswer_edit')) include '/var/www/newscoop/plugins/debate/smarty_camp_plugins/function.debateanswer_edit.php';
?><?php  $_config = new Smarty_Internal_Config(($_smarty_tpl->getVariable('gimme')->value->language->english_name).".conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars(null, 'local'); ?>
<div class="news-sections box-poll">
<?php $_smarty_tpl->smarty->_tag_stack[] = array('list_articles', array('length'=>"1",'ignore_issue'=>"true",'ignore_section'=>"true",'constraints'=>"type is poll")); $_block_repeat=true; smarty_block_list_articles(array('length'=>"1",'ignore_issue'=>"true",'ignore_section'=>"true",'constraints'=>"type is poll"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('list_debates', array('length'=>"1",'item'=>"article")); $_block_repeat=true; smarty_block_list_debates(array('length'=>"1",'item'=>"article"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php if ($_smarty_tpl->getVariable('gimme')->value->debate_action->defined){?>
        <h2><span aria-hidden="true" class="icon-bullhorn"></span> <?php echo $_smarty_tpl->getVariable('gimme')->value->debate->question;?>
</h2>
        <?php if ($_smarty_tpl->getVariable('gimme')->value->debate->user_vote_count>=$_smarty_tpl->getVariable('gimme')->value->debate->votes_per_user||$_smarty_tpl->getVariable('gimme')->value->debate_action->ok){?>
            <p class="info info-success"><span aria-hidden="true" class="icon-checkmark-circle"></span> <?php echo $_smarty_tpl->getConfigVariable('thankYouPoll');?>
</p>
        <?php }elseif($_smarty_tpl->getVariable('gimme')->value->debate_action->is_error){?>
            <p class="info info-error"><span aria-hidden="true" class="icon-blocked"></span> <?php echo $_smarty_tpl->getConfigVariable('alreadyVoted');?>
</p>
        <?php }?>                        
        <?php $_smarty_tpl->tpl_vars["votes"] = new Smarty_variable(0, null, null);?>
        <fieldset id="debate_1_1_form">
          <legend class="acc"><?php echo $_smarty_tpl->getVariable('gimme')->value->debate->question;?>
</legend>
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('list_debate_answers', array()); $_block_repeat=true; smarty_block_list_debate_answers(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

          <div class="poll-option">
              <label for="radio<?php echo $_smarty_tpl->getVariable('gimme')->value->current_list->index;?>
"><?php echo $_smarty_tpl->getVariable('gimme')->value->debateanswer->answer;?>
</label>
              <div class="poll-progress">
                        <div class="bar" style="width:<?php echo smarty_function_math(array('equation'=>"round(x)",'x'=>$_smarty_tpl->getVariable('gimme')->value->debateanswer->percentage_overall,'format'=>"%d"),$_smarty_tpl);?>
%;"></div>
                  </div>
              <span class="poll-score"><?php echo smarty_function_math(array('equation'=>"round(x)",'x'=>$_smarty_tpl->getVariable('gimme')->value->debateanswer->percentage_overall,'format'=>"%d"),$_smarty_tpl);?>
%</span>
          </div>
            <?php $_smarty_tpl->tpl_vars["votes"] = new Smarty_variable($_smarty_tpl->getVariable('votes')->value+$_smarty_tpl->getVariable('gimme')->value->debateanswer->votes, null, null);?>
            <?php if ($_smarty_tpl->getVariable('gimme')->value->current_list->at_end){?>
            <p>Number of votes: <?php echo $_smarty_tpl->getVariable('votes')->value;?>
</p>
            <?php }?>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_list_debate_answers(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        </fieldset>
    <?php }else{ ?>
       <?php if ($_smarty_tpl->getVariable('gimme')->value->debate->is_votable){?>

            <h2><span aria-hidden="true" class="icon-bullhorn"></span> <?php echo $_smarty_tpl->getVariable('gimme')->value->debate->question;?>
</h2> 
            <p class="info-hidden info-no-answer info info-error"><span aria-hidden="true" class="icon-blocked"></span> <?php echo $_smarty_tpl->getConfigVariable('pleaseSelectOneAnswer');?>
</p>
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('debate_form', array('template'=>"_tpl/sidebar_poll.tpl",'submit_button'=>($_smarty_tpl->getConfigVariable('pollButton')),'html_code'=>"class=\"poll-button\"")); $_block_repeat=true; smarty_block_debate_form(array('template'=>"_tpl/sidebar_poll.tpl",'submit_button'=>($_smarty_tpl->getConfigVariable('pollButton')),'html_code'=>"class=\"poll-button\""), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
  
                 
            <?php ob_start();?><?php echo smarty_function_uri(array('options'=>"template _tpl/sidebar_poll.tpl"),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['uriAry'] = new Smarty_variable(explode("tpl=",$_tmp1,2), null, null);?>                        

            <input name="tpl" value="<?php echo $_smarty_tpl->getVariable('uriAry')->value[1];?>
" type="hidden">
            <fieldset id="debate_1_1_form">
              <legend class="acc"><?php echo $_smarty_tpl->getVariable('gimme')->value->debate->question;?>
</legend>
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('list_debate_answers', array()); $_block_repeat=true; smarty_block_list_debate_answers(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

              <div class="poll-option">
                  <!--input type="radio" id="radio<?php echo $_smarty_tpl->getVariable('gimme')->value->current_list->index;?>
" name="radios1" /-->
                  <label for="radio<?php echo $_smarty_tpl->getVariable('gimme')->value->current_list->index;?>
"><?php echo $_smarty_tpl->getVariable('gimme')->value->debateanswer->answer;?>

                  <?php echo smarty_function_debateanswer_edit(array('html_code'=>"id=\"radio".($_smarty_tpl->getVariable('gimme')->value->current_list->index)."\""),$_smarty_tpl);?>

                  <span class="poll-score"><?php echo smarty_function_math(array('equation'=>"round(x)",'x'=>$_smarty_tpl->getVariable('gimme')->value->debateanswer->percentage_overall,'format'=>"%d"),$_smarty_tpl);?>
%</span>
                  </label>
                  <div class="poll-progress">
                        <div class="bar" style="width:<?php echo smarty_function_math(array('equation'=>"round(x)",'x'=>$_smarty_tpl->getVariable('gimme')->value->debateanswer->percentage_overall,'format'=>"%d"),$_smarty_tpl);?>
%;"></div>
                  </div>
              </div>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_list_debate_answers(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_debate_form(array('template'=>"_tpl/sidebar_poll.tpl",'submit_button'=>($_smarty_tpl->getConfigVariable('pollButton')),'html_code'=>"class=\"poll-button\""), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
                        
            </fieldset>
       <?php }else{ ?>                       
            <h2><span aria-hidden="true" class="icon-bullhorn"></span> <?php echo $_smarty_tpl->getVariable('gimme')->value->debate->question;?>
</h2> 
            <?php if ($_smarty_tpl->getVariable('gimme')->value->debate->user_vote_count>=$_smarty_tpl->getVariable('gimme')->value->debate->votes_per_user){?>
            <p class="info info-success"><span aria-hidden="true" class="icon-checkmark-circle"></span> <?php echo $_smarty_tpl->getConfigVariable('thankYouPoll');?>
</p>
            <?php }?>
            <fieldset id="debate_1_1_form">
              <legend class="acc"><?php echo $_smarty_tpl->getVariable('gimme')->value->debate->question;?>
</legend>
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('list_debate_answers', array()); $_block_repeat=true; smarty_block_list_debate_answers(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

              <div class="poll-option">
                  <label for="radio<?php echo $_smarty_tpl->getVariable('gimme')->value->current_list->index;?>
"><?php echo $_smarty_tpl->getVariable('gimme')->value->debateanswer->answer;?>

                        <span class="poll-score"><?php echo smarty_function_math(array('equation'=>"round(x)",'x'=>$_smarty_tpl->getVariable('gimme')->value->debateanswer->percentage_overall,'format'=>"%d"),$_smarty_tpl);?>
%</span> 
                  </label>
                  <div class="poll-progress">
                        <div class="bar" style="width:<?php echo smarty_function_math(array('equation'=>"round(x)",'x'=>$_smarty_tpl->getVariable('gimme')->value->debateanswer->percentage_overall,'format'=>"%d"),$_smarty_tpl);?>
%;"></div>
                  </div>
              </div>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_list_debate_answers(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

             </fieldset>
       <?php }?>
    <?php }?>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_list_debates(array('length'=>"1",'item'=>"article"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_list_articles(array('length'=>"1",'ignore_issue'=>"true",'ignore_section'=>"true",'constraints'=>"type is poll"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

</div>