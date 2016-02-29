<?php /* Smarty version Smarty-3.0.9, created on 2016-02-25 13:24:33
         compiled from "./templates/precheck.tpl" */ ?>
<?php /*%%SmartyHeaderCode:48429707056cf46e1bc3344-45288963%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4c52062aa6fa7f7f3da0063eabffa36b1da57a0b' => 
    array (
      0 => './templates/precheck.tpl',
      1 => 1411545801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '48429707056cf46e1bc3344-45288963',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("html_header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<form action="index.php" method="post" name="install_form">
<tr>
  <td valign="top">
    <table class="header" cellspacing="0" cellpadding="0">
    <tr>
      <td width="50%">
        <div class="title">Pre-installation Check</div>
      </td>
      <td width="50%">
        <div class="navigate"><input
        class="nav_button" type="button" value="Re-check"
	onclick="submitForm( install_form, 'precheck' );" /> &nbsp;
      <?php if ($_smarty_tpl->getVariable('php_req_ok')->value==true){?>
        <input
        class="nav_button" type="button" value="Next &#155;"
        onclick="submitForm( install_form, 'license' );" />
      <?php }else{ ?>
        <input
        class="nav_button_disabled" type="button" value="Next &#155;" />
      <?php }?>
        </div>
      </td>
    </tr>
    </table>
    <div class="table_spacer"> </div>
    <table class="inside" cellspacing="0" cellpadding="0">
    <tr>
      <td>
        <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
          <th colspan="3" align="left" class="innerHead">
            <div class="subtitle">System Requirements:</div>
          </th>
        </tr>
        <tr>
          <td width="35%" valign="top">
            <div class="help">
              <p><em>Newscoop</em> needs the following requirements to be
              fulfilled in order to install and run on your system.</p>

              <p>If any of these requirements is not fulfilled (marked red),
              please correct them, otherwise you wont be able to continue
              with the installation.</p>

              <p>Exception are PHP CLI and APC.
              PHP CLI (Command Line Interface) enables running utility
              tools such as site backup and restore.
              We highly recommend to enable PHP APC
              caching system so that your site will perform much better.
              However, this is not mandatory and you still will be able
              to continue with the installation process.</p>
            </div>
          </td>
          <td width="5%">&nbsp;</td>
          <td width="60%" valign="top">
            <table class="view_list" cellspacing="0" cellpadding="0">
            <?php if ($_smarty_tpl->getVariable('php_req_ok')->value==true){?>
            <tr><td style="text-align:left;"><h2 style="color:lightgreen;">All system requirements are met.</h2></td></tr>
            <?php }else{ ?>
            <tr>
              <td class="first"><strong>Requirement</strong></td>
              <td>&nbsp;</td>
              <td><strong>Status</strong></td>
            </tr>
            <?php }?>
            <?php  $_smarty_tpl->tpl_vars["phpfunc"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('php_functions')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["phpfunc"]->key => $_smarty_tpl->tpl_vars["phpfunc"]->value){
?>
            <tr>
            <?php if ($_smarty_tpl->getVariable('phpfunc')->value['exists']!='Yes'){?>
              <td class="first"><?php echo $_smarty_tpl->getVariable('phpfunc')->value['tag'];?>
</td>
              <td>&nbsp;</td>
              <td align="center">
              <?php if ($_smarty_tpl->getVariable('phpfunc')->value['exists']=='No'){?>
                <span class="error">
              <?php }else{ ?>
                <span class="other">
              <?php }?>
                <?php echo $_smarty_tpl->getVariable('phpfunc')->value['exists'];?>
</span>
              </td>
            <?php }?>
            </tr>
            <?php }} ?>

            <?php  $_smarty_tpl->tpl_vars["sysreq"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('sys_requirements')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["sysreq"]->key => $_smarty_tpl->tpl_vars["sysreq"]->value){
?>
            <tr>
              <?php if ($_smarty_tpl->getVariable('sysreq')->value['exists']=='No'){?>
              <td class="first"><?php echo $_smarty_tpl->getVariable('sysreq')->value['tag'];?>
</td>
              <td>&nbsp;</td>
              <td align="center">
                <span class="error">
                    <?php echo $_smarty_tpl->getVariable('sysreq')->value['exists'];?>

                </span>
                <small>
                  <br>
                  You will need to grant permissions to folder
                  <br>
                  <i><?php echo $_smarty_tpl->getVariable('sysreq')->value['path'];?>
</i>
               </small>
              </td>
            <?php }?>
            </tr>
            <?php }} ?>
            
            <?php  $_smarty_tpl->tpl_vars["libreq"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('library_requirements')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["libreq"]->key => $_smarty_tpl->tpl_vars["libreq"]->value){
?>
            <tr>
            <?php if ($_smarty_tpl->getVariable('libreq')->value['exists']=='No'){?>
              <td class="first"><?php echo $_smarty_tpl->getVariable('libreq')->value['tag'];?>
</td>
              <td>&nbsp;</td>
              <td align="center">
                <span class="error">No</span>
              </td>
            <?php }?>
            </tr>
            <?php }} ?>

            <tr>
              <td class="first"><strong>Recommended</strong></td>
              <td>&nbsp;</td>
              <td><strong>Status</strong></td>
            </tr>
            <?php  $_smarty_tpl->tpl_vars["phpopt"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('php_recommended')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["phpopt"]->key => $_smarty_tpl->tpl_vars["phpopt"]->value){
?>
            <tr>
              <td class="first"><?php echo $_smarty_tpl->getVariable('phpopt')->value['tag'];?>
</td>
              <td>&nbsp;</td>
              <td align="center">
              <?php if ($_smarty_tpl->getVariable('phpopt')->value['exists']=='Yes'){?>
                <span class="success">
              <?php }elseif($_smarty_tpl->getVariable('phpopt')->value['exists']=='No'){?>
                <span class="warning">
              <?php }else{ ?>
                <span class="other">
              <?php }?>
                <?php echo $_smarty_tpl->getVariable('phpopt')->value['exists'];?>
</span>
              </td>
            </tr>
            <?php }} ?>
            </table>
          </td>
        </tr>
        </table>
        <div class="table_spacer"> </div>
        <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="3">
            <div class="subtitle"><h3>PHP Settings:</h3></div>
          </td>
        </tr>
        <tr>
          <td width="35%" valign="top">
            <div class="help">
              <p>These settings are recommended for PHP in order to ensure
              <em>Newscoop</em> will work well. <em>Newscoop</em> will still
              operate even though these settings are not set as suggested.</p>

              <p><span class="error">WARNING</span>: Always make sure that
              <span class="error"><em>register_globals</em> is OFF</span>,
              because it is a big security hole.</p>
            </div>
          </td>
          <td width="5%">&nbsp;</td>
          <td width="60%" valign="top">
            <table class="view_list" cellspacing="0" cellpadding="0">
            <tr>
              <td class="first"><strong>Option</strong></td>
              <td>&nbsp;</td>
              <td><strong>Recommended</strong></td>
              <td>&nbsp;</td>
              <td><strong>Current Set</strong></td>
            </tr>
            <?php  $_smarty_tpl->tpl_vars["phpset"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('php_settings')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["phpset"]->key => $_smarty_tpl->tpl_vars["phpset"]->value){
?>
            <tr>
              <td class="first"><?php echo $_smarty_tpl->getVariable('phpset')->value['tag'];?>
</td>
              <td>&nbsp;</td>
              <td align="center"><?php echo $_smarty_tpl->getVariable('phpset')->value['rec_state'];?>
</td>
              <td>&nbsp;</td>
              <td align="center">
              <?php if ($_smarty_tpl->getVariable('phpset')->value['cur_state']==$_smarty_tpl->getVariable('phpset')->value['rec_state']){?>
                <span class="success">
              <?php }else{ ?>
                <span class="warning">
              <?php }?>
                <?php echo $_smarty_tpl->getVariable('phpset')->value['cur_state'];?>
</span>
              </td>
            </tr>
            <?php }} ?>
            </table>
          </td>
        </tr>
        </table>
      </td>
    </tr>
    </table>
  </td>
  <td valign="top">
    <table class="right_header" cellspacing="0" cellpadding="0">
    <tr>
      <td>
        <div class="title">Progress...</div>
      </td>
    </tr>
    </table>
    <div class="table_spacer"> </div>
    <table class="right" cellspacing="0" cellpadding="0">
    <tr>
      <td>
        <ul id="steps_list">
        <?php  $_smarty_tpl->tpl_vars["s"] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars["step"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('step_titles')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["s"]->key => $_smarty_tpl->tpl_vars["s"]->value){
 $_smarty_tpl->tpl_vars["step"]->value = $_smarty_tpl->tpl_vars["s"]->key;
?>
          <li><?php echo $_smarty_tpl->getVariable('s')->value['title'];?>

          <?php if ($_smarty_tpl->getVariable('s')->value['title']==$_smarty_tpl->getVariable('current_step_title')->value){?>
            &nbsp; <img src="img/checked.png" />
          <?php }?>
          </li>
        <?php }} ?>
        </ul>
      </td>
    </tr>
    </table>
    <div class="table_spacer"> </div>
    <div align="center">
      <img src="img/installation-progress.png" />
    </div>
  </td>
</tr>
<input type="hidden" name="step" value="" />
</form>
</table>

<?php $_template = new Smarty_Internal_Template("html_footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
