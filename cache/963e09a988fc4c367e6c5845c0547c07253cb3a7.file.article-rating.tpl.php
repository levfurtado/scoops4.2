<?php /* Smarty version Smarty-3.0.9, created on 2016-02-25 15:55:17
         compiled from "/var/www/newscoop/themes/publication_1/theme_1/_tpl/article-rating.tpl" */ ?>
<?php /*%%SmartyHeaderCode:187998700456cf6a35c9f834-44730411%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '963e09a988fc4c367e6c5845c0547c07253cb3a7' => 
    array (
      0 => '/var/www/newscoop/themes/publication_1/theme_1/_tpl/article-rating.tpl',
      1 => 1456425874,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '187998700456cf6a35c9f834-44730411',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="article-rating article-attachments">
    <h3><?php echo $_smarty_tpl->getConfigVariable('articleRating');?>
 : </h3>
    <div id="<?php echo $_smarty_tpl->getVariable('gimme')->value->article->number;?>
" class="rate_widget">
        <ul class="stars">
            <li class="star_1 ratings_stars">1 <?php echo $_smarty_tpl->getConfigVariable('outOf');?>
 5</li>
            <li class="star_2 ratings_stars">2 <?php echo $_smarty_tpl->getConfigVariable('outOf');?>
 5</li>
            <li class="star_3 ratings_stars">3 <?php echo $_smarty_tpl->getConfigVariable('outOf');?>
 5</li>
            <li class="star_4 ratings_stars">4 <?php echo $_smarty_tpl->getConfigVariable('outOf');?>
 5</li>
            <li class="star_5 ratings_stars">5 <?php echo $_smarty_tpl->getConfigVariable('outOf');?>
 5</li>
        </ul>
        <p class="total_votes"></p>
        <p class="rating_error"></p>
    </div>
</div>