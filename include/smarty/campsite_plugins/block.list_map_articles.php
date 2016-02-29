<?php
/**
 * Campsite customized Smarty plugin
 * @package Campsite
 */


/**
 * Campsite list_map_articles block plugin
 *
 * Type:     block
 * Name:     list_map_articles
 * Purpose:  Provides a list of articles for the multi-map in context
 *
 * @param string
 *     $p_params
 * @param string
 *     $p_smarty
 * @param string
 *     $p_content
 *
 * @return
 *
 */
function smarty_block_list_map_articles($p_params, $p_content, &$p_smarty, &$p_repeat)
{
    $p_smarty->smarty->loadPlugin('smarty_shared_escape_special_chars');
    $campContext = $p_smarty->getTemplateVars('gimme');

    if (!isset($p_content)) {
        $start = $campContext->next_list_start('MapArticlesList');
        $mapArticlesList = new MapArticlesList($start, $p_params);
        if ($mapArticlesList->isEmpty()) {
            $campContext->setCurrentList($mapArticlesList, array());
            $campContext->resetCurrentList();
            $p_repeat = false;
            return null;
        }
        $campContext->setCurrentList($mapArticlesList, array('publication', 'language',
                                                          'issue', 'section', 'article',
                                                          'image', 'attachment', 'comment',
                                                          'subtitle'));
        $campContext->article = $campContext->current_map_articles_list->current;
        $p_repeat = true;
    } else {
        $campContext->current_map_articles_list->defaultIterator()->next();
        if (!is_null($campContext->current_map_articles_list->current)) {
            $campContext->article = $campContext->current_map_articles_list->current;
            $p_repeat = true;
        } else {
            $campContext->resetCurrentList();
            $p_repeat = false;
        }
    }

    return $p_content;
}

?>
