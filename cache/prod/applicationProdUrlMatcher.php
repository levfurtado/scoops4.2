<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * applicationProdUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class applicationProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);

        if (0 === strpos($pathinfo, '/api')) {
            if (0 === strpos($pathinfo, '/api/a')) {
                if (0 === strpos($pathinfo, '/api/articles')) {
                    // newscoop_gimme_articles_getarticles
                    if (preg_match('#^/api/articles(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_newscoop_gimme_articles_getarticles;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'newscoop_gimme_articles_getarticles')), array (  '_format' => 'json',  '_controller' => 'Newscoop\\GimmeBundle\\Controller\\ArticlesController::getArticlesAction',));
                    }
                    not_newscoop_gimme_articles_getarticles:

                    // newscoop_gimme_articles_getarticle
                    if (preg_match('#^/api/articles/(?P<number>[^/\\.]++)(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_newscoop_gimme_articles_getarticle;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'newscoop_gimme_articles_getarticle')), array (  '_format' => 'json',  '_controller' => 'Newscoop\\GimmeBundle\\Controller\\ArticlesController::getArticleAction',));
                    }
                    not_newscoop_gimme_articles_getarticle:

                }

                // newscoop_gimme_authors_getarticle
                if (0 === strpos($pathinfo, '/api/author') && preg_match('#^/api/author/(?P<id>[^/\\.]++)(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_newscoop_gimme_authors_getarticle;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'newscoop_gimme_authors_getarticle')), array (  '_format' => 'json',  '_controller' => 'Newscoop\\GimmeBundle\\Controller\\AuthorsController::getArticleAction',));
                }
                not_newscoop_gimme_authors_getarticle:

                // newscoop_gimme_comments_getcommentsforarticle
                if (0 === strpos($pathinfo, '/api/articles') && preg_match('#^/api/articles/(?P<number>[^/]++)/(?P<language>[^/]++)/comments(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_newscoop_gimme_comments_getcommentsforarticle;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'newscoop_gimme_comments_getcommentsforarticle')), array (  '_format' => 'json',  '_controller' => 'Newscoop\\GimmeBundle\\Controller\\CommentsController::getCommentsForArticleAction',));
                }
                not_newscoop_gimme_comments_getcommentsforarticle:

            }

            // newscoop_gimme_slideshows_getslideshowitems
            if (0 === strpos($pathinfo, '/api/slideshows') && preg_match('#^/api/slideshows/(?P<id>[^/\\.]++)(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_newscoop_gimme_slideshows_getslideshowitems;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'newscoop_gimme_slideshows_getslideshowitems')), array (  '_format' => 'json',  '_controller' => 'Newscoop\\GimmeBundle\\Controller\\SlideshowsController::getSlideshowItemsAction',));
            }
            not_newscoop_gimme_slideshows_getslideshowitems:

            if (0 === strpos($pathinfo, '/api/topics')) {
                // newscoop_gimme_topics_gettopics
                if (preg_match('#^/api/topics(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_newscoop_gimme_topics_gettopics;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'newscoop_gimme_topics_gettopics')), array (  '_format' => 'json',  '_controller' => 'Newscoop\\GimmeBundle\\Controller\\TopicsController::getTopicsAction',));
                }
                not_newscoop_gimme_topics_gettopics:

                // newscoop_gimme_topics_gettopicsarticles
                if (preg_match('#^/api/topics/(?P<id>[^/]++)/(?P<language>[^/]++)/articles(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_newscoop_gimme_topics_gettopicsarticles;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'newscoop_gimme_topics_gettopicsarticles')), array (  '_format' => 'json',  '_controller' => 'Newscoop\\GimmeBundle\\Controller\\TopicsController::getTopicsArticlesAction',));
                }
                not_newscoop_gimme_topics_gettopicsarticles:

            }

            if (0 === strpos($pathinfo, '/api/users')) {
                // newscoop_gimme_users_getusers
                if (preg_match('#^/api/users(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_newscoop_gimme_users_getusers;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'newscoop_gimme_users_getusers')), array (  '_format' => 'json',  '_controller' => 'Newscoop\\GimmeBundle\\Controller\\UsersController::getUsersAction',));
                }
                not_newscoop_gimme_users_getusers:

                // newscoop_gimme_users_getuser
                if (preg_match('#^/api/users/(?P<id>[^/\\.]++)(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_newscoop_gimme_users_getuser;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'newscoop_gimme_users_getuser')), array (  '_format' => 'json',  '_controller' => 'Newscoop\\GimmeBundle\\Controller\\UsersController::getUserAction',));
                }
                not_newscoop_gimme_users_getuser:

            }

            if (0 === strpos($pathinfo, '/api/sections')) {
                // newscoop_gimme_sections_getsections
                if (preg_match('#^/api/sections(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_newscoop_gimme_sections_getsections;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'newscoop_gimme_sections_getsections')), array (  '_format' => 'json',  '_controller' => 'Newscoop\\GimmeBundle\\Controller\\SectionsController::getSectionsAction',));
                }
                not_newscoop_gimme_sections_getsections:

                // newscoop_gimme_sections_getsectionsarticles
                if (preg_match('#^/api/sections/(?P<number>[^/]++)/(?P<language>[^/]++)/articles(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_newscoop_gimme_sections_getsectionsarticles;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'newscoop_gimme_sections_getsectionsarticles')), array (  '_format' => 'json',  '_controller' => 'Newscoop\\GimmeBundle\\Controller\\SectionsController::getSectionsArticlesAction',));
                }
                not_newscoop_gimme_sections_getsectionsarticles:

            }

            if (0 === strpos($pathinfo, '/api/articles-lists')) {
                // newscoop_gimme_articleslist_getarticleslist
                if (preg_match('#^/api/articles\\-lists(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_newscoop_gimme_articleslist_getarticleslist;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'newscoop_gimme_articleslist_getarticleslist')), array (  '_format' => 'json',  '_controller' => 'Newscoop\\GimmeBundle\\Controller\\ArticlesListController::getArticlesListAction',));
                }
                not_newscoop_gimme_articleslist_getarticleslist:

                // newscoop_gimme_articleslist_getsectionsarticles
                if (preg_match('#^/api/articles\\-lists/(?P<id>[^/]++)/articles(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_newscoop_gimme_articleslist_getsectionsarticles;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'newscoop_gimme_articleslist_getsectionsarticles')), array (  '_format' => 'json',  '_controller' => 'Newscoop\\GimmeBundle\\Controller\\ArticlesListController::getSectionsArticlesAction',));
                }
                not_newscoop_gimme_articleslist_getsectionsarticles:

            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
