<?php
require_once($GLOBALS['g_campsiteDir']."/$ADMIN_DIR/pub/pub_common.php");
require_once($GLOBALS['g_campsiteDir']."/classes/Alias.php");

if (!SecurityToken::isValid()) {
    camp_html_display_error(getGS('Invalid security token!'));
    exit;
}

// Check permissions
if (!$g_user->hasPermission('ManagePub')) {
	camp_html_display_error(getGS("You do not have the right to manage publications."));
	exit;
}

$f_publication_id = Input::Get('f_publication_id', 'int');
$f_alias_id = Input::Get('f_alias_id', 'int');
$f_name = trim(Input::Get('f_name'));

if (!Input::IsValid()) {
	camp_html_display_error(getGS('Invalid input: $1', Input::GetErrorString()), $_SERVER['REQUEST_URI']);
	exit;
}

$publicationObj = new Publication($f_publication_id);

$correct = true;
$errorMsgs = array();

if (empty($f_name)) {
	$correct = false;
	$errorMsgs[] = getGS('You must fill in the $1 field.', '<B>Name</B>');
}

$alias = new Alias($f_alias_id);
$aliases = 0;
if ($correct) {
	if ($alias->getName() != $f_name) {
		$aliasDups = count(Alias::GetAliases(null, null, $f_name));
		if ($aliasDups <= 0) {
			$success = $alias->setName($f_name);
		}
		else {
			$errorMsgs[] = getGS('Another alias with the same name exists already.');
			$correct = false;
		}
	}
}

if ($correct) {
	camp_html_goto_page("/$ADMIN/pub/aliases.php?Pub=$f_publication_id&Alias=$f_alias_id");
	exit;
} else {
	$errorMsgs[] = getGS('The site alias $1 could not be modified.', '<B>'.$alias->getName().'</B>');
}

$crumbs = array(getGS("Publication Aliases") => "aliases.php?Pub=$f_publication_id");
camp_html_content_top(getGS("Editing alias"), array("Pub" => $publicationObj), true, false, $crumbs);

?>

<P>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="8" class="message_box">
<TR>
	<TD COLSPAN="2">
		<B> <?php  putGS("Editing alias"); ?> </B>
		<HR NOSHADE SIZE="1" COLOR="BLACK">
	</TD>
</TR>
<TR>
	<TD COLSPAN="2">
		<BLOCKQUOTE>
		<?PHP
		foreach ($errorMsgs as $errorMsg) { ?>
			<li><?php echo $errorMsg; ?></li>
			<?PHP
		}
		?>
		</BLOCKQUOTE>
	</TD>
</TR>
<TR>
	<TD COLSPAN="2" align="center">
		<INPUT TYPE="button" class="button" NAME="OK" VALUE="<?php  putGS('OK'); ?>" ONCLICK="location.href='/<?php p($ADMIN); ?>/pub/aliases.php?Pub=<?php p($f_publication_id); ?>&Alias=<?php p($f_alias_id); ?>'">
	</TD>
</TR>
</TABLE>
<P>
<?php camp_html_copyright_notice(); ?>
