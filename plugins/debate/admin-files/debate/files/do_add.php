<?php
$translator = \Zend_Registry::get('container')->getService('translator');

if (!SecurityToken::isValid()) {
    camp_html_display_error($translator->trans('Invalid security token!'));
    exit;
}

// Check permissions
if (!$g_user->hasPermission('plugin_debate_admin')) {
    camp_html_display_error($translator->trans('You do not have the right to manage debates.', array(), 'plugin_debate'));
    exit;
}
if (!$g_user->hasPermission('AddFile')) {
	camp_html_display_error($translator->trans('You do not have the right to add files.', array(), 'article_files'), null, true);
	exit;
}

// We set to unlimit the maximum time to execution whether
// safe_mode is disabled. Upload is still under control of
// max upload size.
if (!ini_get('safe_mode')) {
	set_time_limit(0);
}

$f_debate_nr = Input::Get('f_debate_nr', 'int', 0);
$f_debateanswer_nr = Input::Get('f_debateanswer_nr', 'int', 0);
$f_fk_language_id = Input::Get('f_fk_language_id', 'int', 0);
$f_description = Input::Get('f_description');
$f_language_specific = Input::Get('f_language_specific');
$f_content_disposition = Input::Get('f_content_disposition');

$BackLink = Input::Get('BackLink', 'string', null, true);

if (isset($_FILES["f_file"])) {
	switch($_FILES["f_file"]['error']) {
		case 0: // UPLOAD_ERR_OK
			break;
		case 1: // UPLOAD_ERR_INI_SIZE
		case 2: // UPLOAD_ERR_FORM_SIZE
			camp_html_display_error($translator->trans("The file exceeds the allowed max file size.", array(), 'article_files'), null, true);
			break;
		case 3: // UPLOAD_ERR_PARTIAL
			camp_html_display_error($translator->trans("The uploaded file was only partially uploaded. This is common when the maximum time to upload a file is low in contrast with the file size you are trying to input. The maximum input time is specified in php.ini", array(), 'article_files'), null, true);
			break;
		case 4: // UPLOAD_ERR_NO_FILE
			camp_html_display_error($translator->trans("You must select a file to upload.", array(), 'article_files'), null, true);
			break;
		case 6: // UPLOAD_ERR_NO_TMP_DIR
		case 7: // UPLOAD_ERR_CANT_WRITE
			camp_html_display_error($translator->trans("There was a problem uploading the file.", array(), 'article_files'), null, true);
			break;
	}
} else {
	camp_html_display_error($translator->trans("The file exceeds the allowed max file size.", array(), 'article_files'), null, true);
}

$DebateAnswer = new DebateAnswer($f_fk_language_id, $f_debate_nr, $f_debateanswer_nr);

if (!$DebateAnswer->exists()) {
	camp_html_display_error($translator->trans("Debate Answer $1 does not exist.", array('$1' => $f_debateanswer_nr)), null, true);
	exit;
}

$description = new Translation(@$f_language_id);
$description->create($f_description);

$attributes = array();
$attributes['fk_description_id'] = $description->getPhraseId();
$attributes['fk_user_id'] = $g_user->getUserId();
if ($f_language_specific == "yes") {
	$attributes['fk_language_id'] = @$f_language_id;
}
if ($f_content_disposition == "attachment") {
	$attributes['content_disposition'] = "attachment";
}

if (!empty($_FILES['f_file'])) {
	$file = Attachment::OnFileUpload($_FILES['f_file'], $attributes);
} else {
	camp_html_goto_page(camp_html_article_url($articleObj, @$f_language_id, 'files/popup.php'));
}

// Check if image was added successfully
if (PEAR::isError($file)) {
	camp_html_add_msg($file->getMessage());
	camp_html_goto_page($BackLink);
}

$DebateAnswerAttachment = new DebateAnswerAttachment($f_debate_nr, $f_debateanswer_nr, $file->getAttachmentId());
$DebateAnswerAttachment->create();

// Go back to upload screen.
camp_html_add_msg($translator->trans("File $1 added.", array('$1' => $file->getFileName()), 'plugin_debate'), "ok");
?>
<script>
location.href="popup.php?f_debate_nr=<?php p($f_debate_nr) ?>&f_debateanswer_nr=<?php p($f_debateanswer_nr) ?>&f_fk_language_id=<?php p($f_fk_language_id) ?>";
</script>
