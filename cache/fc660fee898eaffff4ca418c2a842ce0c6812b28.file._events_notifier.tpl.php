<?php /* Smarty version Smarty-3.0.9, created on 2016-02-29 16:32:16
         compiled from "/var/www/newscoop/themes/system_templates/_events_notifier.tpl" */ ?>
<?php /*%%SmartyHeaderCode:120719059556d4b8e0e17a99-52060484%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fc660fee898eaffff4ca418c2a842ce0c6812b28' => 
    array (
      0 => '/var/www/newscoop/themes/system_templates/_events_notifier.tpl',
      1 => 1411545800,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '120719059556d4b8e0e17a99-52060484',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo $_smarty_tpl->getVariable('event_text')->value;?>
 on <?php echo $_smarty_tpl->getVariable('event_timestamp')->value;?>

Performed by: <?php echo $_smarty_tpl->getVariable('user_real_name')->value;?>
 (<?php echo $_smarty_tpl->getVariable('user_name')->value;?>
) - email: <?php echo $_smarty_tpl->getVariable('user_email')->value;?>


To unsubscribe - go to site administration and update your profile settings.
