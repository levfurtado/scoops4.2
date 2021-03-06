
<link type="text/css" href="<?= $Campsite['SUBDIR'] ?>/plugins/soundcloud/css/soundcloud.css" rel="stylesheet" />
<script src="<?= $Campsite['SUBDIR'] ?>/plugins/soundcloud/js/functions.js" type="text/javascript"></script>
<?php
$translator = \Zend_Registry::get('container')->getService('translator');
?>
<script type="text/javascript">
var localizer = localizer || {};
localizer.uploading = '<?php echo $translator->trans('Uploading... please wait', array(), 'plugin_soundcloud') ?>';
localizer.processing = '<?php echo $translator->trans('Processing...', array(), 'plugin_soundcloud') ?>';
localizer.attention = '<?php echo $translator->trans('Attention!', array(), 'plugin_soundcloud') ?>';
localizer.deleteQuestion = '<?php echo $translator->trans('Are you sure you want to delete the track:', array(), 'plugin_soundcloud') ?>';
localizer.ok = '<?php echo $translator->trans('Ok', array(), 'plugin_soundcloud') ?>';
localizer.cancel = '<?php echo $translator->trans('Cancel') ?>';
localizer.setlist = '<?php echo $translator->trans('Set list', array(), 'plugin_soundcloud') ?>';
<?php if ($js): ?>
    <?= $js ?>
<?php endif ?>
$(document).ready(function(){
    setEvents();
    $('.tabs').tabs()
    .tabs('select', '<?= $g_user->hasPermission('plugin_soundcloud_upload') ? '#tabs-1' : '#tabs-2' ?>');
<?php if ($showMessage): ?>
    showMessage('<?= $showMessage['title'] ?>','<?= $showMessage['message'] ?>'
      ,'<?= $showMessage['type'] ?>',<?= $showMessage['fixed'] ?>);
<?php endif ?>
});
</script>

<div class="ui-widget-content small-block block-shadow soundcloud soundcloud-attach">
  <div class="padded clearfix inner-tabs">
    <div class="tabs">
      <ul>
        <li <?= !$g_user->hasPermission('plugin_soundcloud_upload') ? 'style="display:none"' : '' ?>>
            <a href="#tabs-1"><?php echo $translator->trans('Upload', array(), 'plugin_soundcloud') ?></a></li>
        <li><a href="#tabs-2"><?php echo $translator->trans('Tracks', array(), 'plugin_soundcloud') ?></a></li>
        <li id="edit-tab" style="display:none"><a href="#tabs-3"><?php echo $translator->trans('Edit') ?></a></li>
      </ul>
      <div id="tabs-1"><?php include 'upload.php' ?></div>
      <div id="tabs-2"><?php include 'tracks.php' ?></div>
      <div id="tabs-3">
          <form id="edit-form" name="edit-form" method="post" action="controller.php" enctype="multipart/form-data">
          </form>
      </div>
    </div>
  </div>
</div>
