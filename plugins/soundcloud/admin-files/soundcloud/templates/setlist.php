<?php $counter = 0 ?>
<?php
$translator = \Zend_Registry::get('container')->getService('translator');
?>
<input id="set-track" type="hidden" value="<?= $track ?>">
<table cellspacing="0" cellpadding="0" class="datatable" id="gridx" style="width: 100%; margin: 0pt;">
  <tbody>
  <?php foreach ($setList as $index => $t): ?>
    <tr class="<?= $index % 2 ? 'odd' : 'even' ?>">
      <td>
          <div class="soundcloud-list-item">
            <div class="controls">
            <div class="buttons">
            <?php $tracks = array();
               foreach ($t['tracks'] as $value):
                   $tracks[] = $value['id'];
               endforeach ?>
            <?php if ($g_user->hasPermission('plugin_soundcloud_update')): ?>
                <?php $trackInSet = in_array($track, $tracks) ?>
                <a id="<?= $t['id'] ?>" style="<?= !$trackInSet ? '' : 'display:none;' ?>" class="addtoset ui-state-default icon-button no-text" href=""><span class="ui-icon ui-icon-plusthick"></span></a>
                <a id="<?= $t['id'] ?>" style="<?= $trackInSet ? '' : 'display:none;' ?>" class="removefromset ui-state-default icon-button no-text" href=""><span class="ui-icon ui-icon-minusthick"></span></a>
            <?php endif ?>
            </div>
            <div class="metadata">
                <h3><a id="title-<?= $t['id'] ?>" target="soundcloud" href="<?= $t['permalink_url'] ?><?= $t['sharing']=='public'?'':'/'.$t['secret_token'] ?>" class="text-link soundcloud-title"><?= $t['title'] ?></a>
                <?php if($t['sharing'] != 'public'): ?>
                    <img alt="<?= $translator->trans('Private') ?>" src="<?= $Campsite['SUBDIR'] ?>/plugins/soundcloud/css/images/locked_big.png">
                <?php endif ?>
                </h3>
            </div>
        </div>
        </div>
      </td>
    </tr>
    <?php $counter++ ?>
  <?php endforeach ?>
  </tbody>
</table>
<?php if ($counter == 0): ?>
    <?php echo $translator->trans('No sets found', array(), 'plugin_soundcloud') ?>
<?php endif ?>
