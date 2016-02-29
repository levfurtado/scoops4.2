<?php

require_once dirname(dirname(__FILE__)) . '/db_connect.php';
require_once dirname(dirname(__FILE__)) . '/classes/Extension/WidgetManager.php';

camp_load_translation_strings('home');
camp_load_translation_strings('api');
camp_load_translation_strings('extensions');
camp_load_translation_strings('articles');

echo camp_html_breadcrumbs(array(
    array(getGS('Dashboard'), $Campsite['WEBSITE_URL'] . '/admin/home.php'),
    array(getGS('Widgets'), ''),
));
?>

<div class="links">
    <a href="<?php echo $Campsite['WEBSITE_URL']; ?>/admin/" title="<?php putGS('Go to dashboard'); ?>"><?php putGS('Go to dashboard'); ?></a>
</div>

<ul id="widgets">
    <?php foreach (WidgetManager::GetAvailable() as $widget) { ?>
    <li>
        <h3><?php echo $widget->getTitle(); ?></h3>
        <p><a href="#<?php echo $widget->getExtension()->getId(); ?>" class="add"><?php putGS('Add to dashboard'); ?></a>&nbsp;</p>
        <p><?php putGS($widget->getDescription()); ?></p>
        <?php $widget->renderMeta(); ?>
    </li>
    <?php } ?>
</ul>

<script type="text/javascript">
$(document).ready(function() {
    var dashboard_id = 1;
    $('a.add').click(function() {
        var a = $(this);
        var id = a.attr('href').slice(1);
        callServer(['WidgetManager', 'AddWidget'], [
            id,
            'dashboard' + dashboard_id,
            ], function(json) {
                flashMessage('<?php putGS('Widget added to dashboard.'); ?>');
                a.hide();
                dashboard_id = dashboard_id + 1;
                if (dashboard_id > 2) {
                    dashboard_id = 1;
                }
                a.closest('li').addClass('ui-state-highlight');
            });
    });
});
</script>

<?php camp_html_copyright_notice(); ?>
</body>
</html>
