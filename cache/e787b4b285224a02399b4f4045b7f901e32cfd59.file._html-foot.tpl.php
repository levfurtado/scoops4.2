<?php /* Smarty version Smarty-3.0.9, created on 2016-02-25 16:27:24
         compiled from "/var/www/newscoop/themes/publication_1/theme_1/_tpl/_html-foot.tpl" */ ?>
<?php /*%%SmartyHeaderCode:66126735256cf71bc9008c4-51089901%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e787b4b285224a02399b4f4045b7f901e32cfd59' => 
    array (
      0 => '/var/www/newscoop/themes/publication_1/theme_1/_tpl/_html-foot.tpl',
      1 => 1456435592,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '66126735256cf71bc9008c4-51089901',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_url')) include '/var/www/newscoop/application/../include/smarty/campsite_plugins/function.url.php';
?>   <!-- jQuery Library -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo smarty_function_url(array('static_file'=>'_js/vendor/jquery-1.9.1.min.js'),$_smarty_tpl);?>
"><\/script>')</script>
    <!-- picturefill -->
    <script src="<?php echo smarty_function_url(array('static_file'=>"_js/matchmedia.js"),$_smarty_tpl);?>
"></script>
    <script src="<?php echo smarty_function_url(array('static_file'=>"_js/picturefill.js"),$_smarty_tpl);?>
"></script>
    <script src="<?php echo smarty_function_url(array('static_file'=>"_js/scroll-script.js"),$_smarty_tpl);?>
"></script>
    <script src="<?php echo smarty_function_url(array('static_file'=>"_js/slider.js"),$_smarty_tpl);?>
"></script>
    <script>
    window.innerWidth>500&&$(function(){$("#slider-front").addClass("news-slider"),$("#slider-front").responsiveSlides({maxwidth:960,auto:!1,speed:800,pager:!0,nav:!0,random:!1,pause:!0})}),$(function(){$("#slider-multimedia").responsiveSlides({maxwidth:330,auto:!1,speed:1200,pager:!1,random:!0,pause:!0})});
    </script>
    <?php if ($_smarty_tpl->getVariable('gimme')->value->template->name=='article.tpl'){?>
      <script src="<?php echo smarty_function_url(array('static_file'=>'_js/vendor/galleria/galleria-1.2.9.min.js'),$_smarty_tpl);?>
"></script>
      <link href="<?php echo smarty_function_url(array('static_file'=>'_css/flowplayer_skin/minimalist.css'),$_smarty_tpl);?>
" rel="stylesheet">
      <script src="<?php echo smarty_function_url(array('static_file'=>'_js/vendor/flowplayer/flowplayer.min.js'),$_smarty_tpl);?>
"></script>
      <script>
      $(document).ready(function() {

          $('.rate_widget').each(function(i) {
              var widget = this;
              var out_data = {
                  f_article_number : $(widget).attr('id')
              };
              $.post(
                  '/rating/show',
                  out_data,
                  function(INFO) {
                      $(widget).data( 'fsr', INFO );
                      set_votes(widget);
                  },
                  'json'
              );
          });


          $('.ratings_stars').hover(
              // Handles the mouseover
              function() {
                  $(this).prevAll().andSelf().addClass('ratings_over');
                  $(this).nextAll().removeClass('ratings_vote');
              },
              // Handles the mouseout
              function() {
                  $(this).prevAll().andSelf().removeClass('ratings_over');
                  // can't use 'this' because it wont contain the updated data
                  set_votes($(this).closest('.rate_widget'));
              }
          );


          // This actually records the vote
          $('.ratings_stars').bind('click', function() {
              var star = this;
              var widget = $(this).closest('.rate_widget');
              var score = $(star).attr('class').match(/star_(\d+)/)[1];

              var clicked_data = {
                  f_rating_score : score,
                  f_article_number : widget.attr('id')
              };
              $.post(
                  '/rating/save',
                  clicked_data,
                  function(INFO) {
                      widget.data( 'fsr', INFO );
                      set_votes(widget);
                  },
                  'json'
              );
          });

          var isSlideshow = $('#gallery').is(':visible');

          if (isSlideshow) {
            Galleria.loadTheme('<?php echo smarty_function_url(array('static_file'=>'_js/vendor/galleria/themes/classic/galleria.classic.min.js'),$_smarty_tpl);?>
');
            Galleria.run('#gallery');
            Galleria.ready(function() {
              this.attachKeyboard({
                  right: this.next,
                  left: this.prev
              });
            });
          }
      });

      function set_votes(widget) {
          if ($(widget).data('fsr')) {
              var avg = $(widget).data('fsr').whole_avg;
              var votes = $(widget).data('fsr').number_votes;
              var exact = $(widget).data('fsr').dec_avg;
              var error = $(widget).data('fsr').error;

              $(widget).find('.star_' + avg).prevAll().andSelf().addClass('ratings_vote');
              $(widget).find('.star_' + avg).nextAll().removeClass('ratings_vote');
              $(widget).find('.total_votes').text(votes + ' <?php echo $_smarty_tpl->getConfigVariable('voteS');?>
, <?php echo $_smarty_tpl->getConfigVariable('averageRating');?>
 ' + exact);
              if (error) {
                $(widget).find('.rating_error').addClass('info info-error').text(error);
              }
          }
      }
      !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
      </script>
      <script src="http://connect.facebook.net/en_US/all.js#appId=100924830001723&amp;xfbml=1"></script>
      <script>
        (function(d) {
          var po = d.createElement('script'); po.type = 'text/javascript'; po.async = true;
          po.src = 'https://apis.google.com/js/plusone.js';
          var s = d.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
        })(document);
      </script>
    <?php }?>
    <script>
    $(document).ready(function () {

      $('.link-to-top').click(function(e) {
        e.preventDefault();
        $("body, html").animate({
            scrollTop : 0
        }, 800);
      });

      $('.poll-button').click(function(){
        if ($("input[name='f_debateanswer_nr']:checked").length === 0) {
          $('.info-no-answer').show();
          return false;
        }
        $.post($('form[name=debate]').attr("action"),$('form[name=debate]').serialize(),function(data){$('.box-poll').html(data);});
        return false;
      });

    });

    if('querySelector' in document && 'localStorage' in window && 'addEventListener' in window) {
      window.addEventListener("hashchange",function(){var b=document.getElementById(location.hash.substring(1));b&&(/^(?:a|select|input|button|textarea)$/i.test(b.tagName)||(b.tabIndex=-1),b.focus())},!1);
    }
    </script>
    </body>
</html>
