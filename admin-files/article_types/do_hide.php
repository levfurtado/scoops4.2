<?php
camp_load_translation_strings("article_types");
require_once($GLOBALS['g_campsiteDir'].'/classes/Log.php');
require_once($GLOBALS['g_campsiteDir'].'/classes/Input.php');
require_once($GLOBALS['g_campsiteDir'].'/classes/Article.php');
require_once($GLOBALS['g_campsiteDir'].'/classes/ArticleType.php');

if (!SecurityToken::isValid()) {
    camp_html_display_error(getGS('Invalid security token!'));
    exit;
}

$articleTypeName = Input::Get('f_article_type');
$status = Input::Get('f_status');
$errorMsgs = array();

$articleType = new ArticleType($articleTypeName);
$articleType->setStatus($status);

\Zend_Registry::get('container')->getService('dispatcher')
	->dispatch('article_type.hide', new \Newscoop\EventDispatcher\Events\GenericEvent($this, array(
	    'article_type' => $articleType
	)));

camp_html_goto_page("/$ADMIN/article_types/");