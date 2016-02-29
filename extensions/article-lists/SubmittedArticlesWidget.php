<?php
/**
 * @package Campsite
 *
 * @author Petr Jasek <petr.jasek@sourcefabric.org>
 * @copyright 2010 Sourcefabric o.p.s.
 * @license http://www.gnu.org/licenses/gpl.txt
 * @link http://www.sourcefabric.org
 */

require_once dirname(__FILE__) . '/ArticlesWidget.php';

/**
 * @title Submitted Articles
 */
class SubmittedArticlesWidget extends ArticlesWidget
{
    public function __construct()
    {
        $this->title = getGS('Submitted Articles');
    }

    public function beforeRender()
    {
        $this->items = Article::GetSubmittedArticles();
    }

    public function render()
    {
        if ($this->getUser()->hasPermission('ChangeArticle') || $this->getUser()->hasPermission('Publish')) {
            parent::render();
        } else {
            echo '<p>', getGS('Access Denied'), '</p>';
        }
    }
}
