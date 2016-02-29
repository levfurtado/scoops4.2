<?php
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InactiveScopeException;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Parameter;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;
class applicationProdProjectContainer extends Newscoop\DependencyInjection\ContainerBuilder
{
    public function __construct()
    {
        $this->parameters = $this->getDefaultParameters();
        $this->services =
        $this->scopedServices =
        $this->scopeStacks = array();
        $this->set('service_container', $this);
        $this->scopes = array('request' => 'container');
        $this->scopeChildren = array('request' => array());
    }
    protected function getAnnotationReaderService()
    {
        return $this->services['annotation_reader'] = new \Doctrine\Common\Annotations\FileCacheReader(new \Doctrine\Common\Annotations\AnnotationReader(), '/var/www/newscoop/cache/prod/annotations', false);
    }
    protected function getAuditService()
    {
        return $this->services['audit'] = new \Newscoop\Services\AuditService($this->get('doctrine.orm.default_entity_manager'), $this->get('user'));
    }
    protected function getAudit_MaintenanceService()
    {
        return $this->services['audit.maintenance'] = new \Newscoop\Services\AuditMaintenanceService($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getAuth_AdapterService()
    {
        return $this->services['auth.adapter'] = new \Newscoop\Services\Auth\DoctrineAuthService($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getAuth_Adapter_SocialService()
    {
        return $this->services['auth.adapter.social'] = new \Newscoop\Services\Auth\SocialAuthService($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getAuthorService()
    {
        return $this->services['author'] = new \Newscoop\Services\AuthorService($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getBlogService()
    {
        return $this->services['blog'] = new \Newscoop\Services\BlogService(array('role' => '6', 'publication' => '5', 'issue' => '3', 'type' => 'bloginfo', 'article_type' => 'blog'));
    }
    protected function getCacheClearerService()
    {
        return $this->services['cache_clearer'] = new \Symfony\Component\HttpKernel\CacheClearer\ChainCacheClearer(array());
    }
    protected function getCacheWarmerService()
    {
        $a = $this->get('kernel');
        $b = $this->get('templating.filename_parser');
        $c = new \Symfony\Bundle\FrameworkBundle\CacheWarmer\TemplateFinder($a, $b, '/var/www/newscoop/application/Resources');
        return $this->services['cache_warmer'] = new \Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerAggregate(array(0 => new \Symfony\Bundle\FrameworkBundle\CacheWarmer\TemplatePathsCacheWarmer($c, $this->get('templating.locator')), 1 => new \Symfony\Bundle\FrameworkBundle\CacheWarmer\RouterCacheWarmer($this->get('router')), 2 => new \Symfony\Bundle\TwigBundle\CacheWarmer\TemplateCacheCacheWarmer($this, $c), 3 => new \Symfony\Bridge\Doctrine\CacheWarmer\ProxyCacheWarmer($this->get('doctrine')), 4 => $this->get('fos_rest.allowed_methods_loader')));
    }
    protected function getCommentService()
    {
        return $this->services['comment'] = new \Newscoop\Services\CommentService($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getCommentNotificationService()
    {
        return $this->services['comment_notification'] = new \Newscoop\Services\CommentNotificationService($this->get('email'), $this->get('comment'), $this->get('user'));
    }
    protected function getCommunityFeedService()
    {
        return $this->services['community_feed'] = new \Newscoop\Services\CommunityFeedService($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getContent_PublicationService()
    {
        return $this->services['content.publication'] = new \Newscoop\Content\PublicationService($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getContent_SectionService()
    {
        return $this->services['content.section'] = new \Newscoop\Content\SectionService($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getContent_TypeService()
    {
        return $this->services['content.type'] = new \Newscoop\Content\ContentTypeService($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getDataCollector_RequestService()
    {
        return $this->services['data_collector.request'] = new \Symfony\Component\HttpKernel\DataCollector\RequestDataCollector();
    }
    protected function getDataCollector_RouterService()
    {
        return $this->services['data_collector.router'] = new \Symfony\Bundle\FrameworkBundle\DataCollector\RouterDataCollector();
    }
    protected function getDoctrineService()
    {
        return $this->services['doctrine'] = new \Doctrine\Bundle\DoctrineBundle\Registry($this, array('default' => 'doctrine.dbal.default_connection'), array('default' => 'doctrine.orm.default_entity_manager'), 'default', 'default');
    }
    protected function getDoctrine_AdodbService()
    {
        return $this->services['doctrine.adodb'] = new \Newscoop\Doctrine\AdoDbAdapter($this->get('doctrine.connection'));
    }
    protected function getDoctrine_ConnectionService()
    {
        return $this->services['doctrine.connection'] = $this->get('doctrine.orm.default_entity_manager')->getConnection();
    }
    protected function getDoctrine_Dbal_ConnectionFactoryService()
    {
        return $this->services['doctrine.dbal.connection_factory'] = new \Doctrine\Bundle\DoctrineBundle\ConnectionFactory(array());
    }
    protected function getDoctrine_Dbal_DefaultConnectionService()
    {
        $a = new \Symfony\Bridge\Doctrine\ContainerAwareEventManager($this);
        $a->addEventSubscriber($this->get('newscoop_newscoop.doctrine.event_dispatcher_proxy'));
        return $this->services['doctrine.dbal.default_connection'] = $this->get('doctrine.dbal.connection_factory')->createConnection(array('dbname' => 'newscoop', 'host' => 'localhost', 'port' => '3306', 'user' => 'root', 'password' => 'xC42N6cgQx&*FpGK', 'charset' => 'UTF8', 'driver' => 'pdo_mysql', 'driverOptions' => array()), new \Doctrine\DBAL\Configuration(), $a, array('enum' => 'string', 'point' => 'string', 'geometry' => 'string'));
    }
    protected function getDoctrine_EventManagerService()
    {
        return $this->services['doctrine.event_manager'] = $this->get('doctrine.orm.default_entity_manager')->getEventManager();
    }
    protected function getDoctrine_Orm_DefaultEntityManagerService()
    {
        $a = $this->get('annotation_reader');
        $b = new \Doctrine\Common\Cache\ArrayCache();
        $b->setNamespace('sf2orm_default_d70ac6f15b003247357432d4740063ad');
        $c = new \Doctrine\Common\Cache\ArrayCache();
        $c->setNamespace('sf2orm_default_d70ac6f15b003247357432d4740063ad');
        $d = new \Doctrine\Common\Cache\ArrayCache();
        $d->setNamespace('sf2orm_default_d70ac6f15b003247357432d4740063ad');
        $e = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver($a, array(0 => '/var/www/newscoop/library/Newscoop', 1 => '/var/www/newscoop/library/Newscoop', 2 => '/var/www/newscoop/library/Newscoop', 3 => '/var/www/newscoop/library/Newscoop'));
        $f = new \Doctrine\ORM\Mapping\Driver\DriverChain();
        $f->addDriver($e, 'Newscoop\\Entity');
        $f->addDriver($e, 'Newscoop\\Package');
        $f->addDriver($e, 'Newscoop\\Image');
        $f->addDriver($e, 'Newscoop\\Subscription');
        $g = new \Doctrine\ORM\Configuration();
        $g->setEntityNamespaces(array('newscoop_entity' => 'Newscoop\\Entity', 'newscoop_package' => 'Newscoop\\Package', 'newscoop_image' => 'Newscoop\\Image', 'newscoop_subscription' => 'Newscoop\\Subscription'));
        $g->setMetadataCacheImpl($b);
        $g->setQueryCacheImpl($c);
        $g->setResultCacheImpl($d);
        $g->setMetadataDriverImpl($f);
        $g->setProxyDir('/var/www/newscoop/library/Proxy');
        $g->setProxyNamespace('Proxy');
        $g->setAutoGenerateProxyClasses(false);
        $g->setClassMetadataFactoryName('Doctrine\\ORM\\Mapping\\ClassMetadataFactory');
        $g->setDefaultRepositoryClassName('Doctrine\\ORM\\EntityRepository');
        $g->addCustomNumericFunction('rand', 'Newscoop\\Query\\MysqlRandom');
        $g->addCustomNumericFunction('dayofweek', 'Newscoop\\Query\\MysqlDayOfWeek');
        $g->addCustomNumericFunction('dayofmonth', 'Newscoop\\Query\\MysqlDayOfMonth');
        $g->addCustomNumericFunction('dayofyear', 'Newscoop\\Query\\MysqlDayOfYear');
        $g->addCustomNumericFunction('date_format', 'Newscoop\\Query\\MysqlDateFormat');
        $this->services['doctrine.orm.default_entity_manager'] = $instance = call_user_func(array('Doctrine\\ORM\\EntityManager', 'create'), $this->get('doctrine.dbal.default_connection'), $g);
        $this->get('doctrine.orm.default_manager_configurator')->configure($instance);
        return $instance;
    }
    protected function getDoctrine_Orm_DefaultManagerConfiguratorService()
    {
        return $this->services['doctrine.orm.default_manager_configurator'] = new \Doctrine\Bundle\DoctrineBundle\ManagerConfigurator(array(), array());
    }
    protected function getDoctrine_Orm_Validator_UniqueService()
    {
        return $this->services['doctrine.orm.validator.unique'] = new \Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntityValidator($this->get('doctrine'));
    }
    protected function getDoctrine_Orm_ValidatorInitializerService()
    {
        return $this->services['doctrine.orm.validator_initializer'] = new \Symfony\Bridge\Doctrine\Validator\DoctrineInitializer($this->get('doctrine'));
    }
    protected function getEmailService()
    {
        return $this->services['email'] = new \Newscoop\Services\EmailService($this->get('view'), $this->get('user.token'));
    }
    protected function getEventDispatcherService()
    {
        $this->services['event_dispatcher'] = $instance = new \Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher($this);
        $instance->addListenerService('knp_pager.before', array(0 => 'knp_paginator.subscriber.paginate', 1 => 'before'), 0);
        $instance->addListenerService('knp_pager.pagination', array(0 => 'knp_paginator.subscriber.paginate', 1 => 'pagination'), 0);
        $instance->addListenerService('knp_pager.before', array(0 => 'knp_paginator.subscriber.sortable', 1 => 'before'), 1);
        $instance->addListenerService('knp_pager.before', array(0 => 'knp_paginator.subscriber.filtration', 1 => 'before'), 1);
        $instance->addListenerService('knp_pager.pagination', array(0 => 'knp_paginator.subscriber.sliding_pagination', 1 => 'pagination'), 1);
        $instance->addListenerService('comment.update', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('comment.delete', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('alias.create', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('alias.update', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('alias.delete', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('article-attachment.create', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('article-attachment.delete', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('article-author.create', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('article-author.delete', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('article-image.create', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('article-image.delete', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('article-publish.create', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('article.create', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('article.delete', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('article-topic.create', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('article-topic.delete', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('article-metadata.create', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('article-metadata.delete', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('attachment.create', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('attachment.delete', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('author-alias.create', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('author-alias.delete', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('author-biography.create', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('author-biography.delete', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('author.create', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('author.delete', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('author-type.create', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('author-type.delete', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('county.create', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('county.delete', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('image.create', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('image.delete', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('issue.create', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('issue.delete', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('language.create', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('language.delete', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('location.create', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('location.delete', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('map.create', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('map.delete', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('plugin.create', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('plugin.delete', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('publication.create', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('publication.delete', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('section.create', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('section.delete', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('subscription.create', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('subscription.delete', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('system-preferences.create', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('system-preferences.delete', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('template.create', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('template.delete', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('topic.create', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('topic.delete', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('translation.create', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('translation.delete', array(0 => 'audit', 1 => 'update'), 0);
        $instance->addListenerService('comment.create', array(0 => 'comment', 1 => 'update'), 0);
        $instance->addListenerService('comment.update', array(0 => 'comment', 1 => 'update'), 0);
        $instance->addListenerService('comment.recommended', array(0 => 'comment', 1 => 'update'), 0);
        $instance->addListenerService('comment.delete', array(0 => 'comment', 1 => 'update'), 0);
        $instance->addListenerService('comment.create', array(0 => 'comment_notification', 1 => 'update'), 0);
        $instance->addListenerService('print.subscribe', array(0 => 'community_feed', 1 => 'update'), 0);
        $instance->addListenerService('comment.recommended', array(0 => 'community_feed', 1 => 'update'), 0);
        $instance->addListenerService('topic.follow', array(0 => 'community_feed', 1 => 'update'), 0);
        $instance->addListenerService('image.approved', array(0 => 'community_feed', 1 => 'update'), 0);
        $instance->addListenerService('document.approved', array(0 => 'community_feed', 1 => 'update'), 0);
        $instance->addListenerService('blog.published', array(0 => 'community_feed', 1 => 'update'), 0);
        $instance->addListenerService('image.delivered', array(0 => 'user_attributes', 1 => 'update'), 0);
        $instance->addListenerService('image.approved', array(0 => 'user_attributes', 1 => 'update'), 0);
        $instance->addListenerService('image.published', array(0 => 'user_attributes', 1 => 'update'), 0);
        $instance->addListenerService('document.delivered', array(0 => 'user_attributes', 1 => 'update'), 0);
        $instance->addListenerService('document.approved', array(0 => 'user_attributes', 1 => 'update'), 0);
        $instance->addListenerService('image.published', array(0 => 'user_points', 1 => 'update'), 0);
        $instance->addListenerService('kernel.controller', array(0 => 'data_collector.router', 1 => 'onKernelController'), 0);
        $instance->addListenerService('kernel.controller', array(0 => 'sensio_framework_extra.controller.listener', 1 => 'onKernelController'), 0);
        $instance->addListenerService('kernel.controller', array(0 => 'sensio_framework_extra.converter.listener', 1 => 'onKernelController'), 0);
        $instance->addListenerService('kernel.response', array(0 => 'sensio_framework_extra.cache.listener', 1 => 'onKernelResponse'), 0);
        $instance->addListenerService('kernel.controller', array(0 => 'fos_rest.view_response_listener', 1 => 'onKernelController'), 0);
        $instance->addListenerService('kernel.view', array(0 => 'fos_rest.view_response_listener', 1 => 'onKernelView'), 100);
        $instance->addListenerService('kernel.request', array(0 => 'fos_rest.body_listener', 1 => 'onKernelRequest'), 0);
        $instance->addListenerService('kernel.controller', array(0 => 'fos_rest.format_listener', 1 => 'onKernelController'), 0);
        $instance->addListenerService('kernel.request', array(0 => 'fos_rest.mime_type_listener', 1 => 'onKernelRequest'), 200);
        $instance->addListenerService('kernel.response', array(0 => 'fos_rest.allowed_methods_listener', 1 => 'onKernelResponse'), 0);
        $instance->addListenerService('kernel.request', array(0 => 'newscoop.paginator.pagination_listener', 1 => 'onRequest'), 31);
        $instance->addListenerService('kernel.request', array(0 => 'newscoop.gimme.listener.publication', 1 => 'onRequest'), 0);
        $instance->addListenerService('kernel.response', array(0 => 'newscoop.gimme.listener.format_json', 1 => 'onResponse'), 0);
        $instance->addListenerService('kernel.response', array(0 => 'newscoop.gimme.listener.allow_origin', 1 => 'onResponse'), 0);
        $instance->addListenerService('kernel.request', array(0 => 'newscoop.gimme.listener.override_method', 1 => 'onRequest'), 34);
        $instance->addListenerService('kernel.request', array(0 => 'knp_paginator.subscriber.sliding_pagination', 1 => 'onKernelRequest'), 0);
        $instance->addListenerService('kernel.request', array(0 => 'newscoop.zendbridge.zendapplication_listener', 1 => 'onRequest'), 31);
        $instance->addSubscriberService('response_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\ResponseListener');
        $instance->addSubscriberService('streamed_response_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\StreamedResponseListener');
        $instance->addSubscriberService('locale_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\LocaleListener');
        $instance->addSubscriberService('fragment.handler', 'Symfony\\Component\\HttpKernel\\Fragment\\FragmentHandler');
        $instance->addSubscriberService('session_listener', 'Symfony\\Bundle\\FrameworkBundle\\EventListener\\SessionListener');
        $instance->addSubscriberService('fragment.listener', 'Symfony\\Component\\HttpKernel\\EventListener\\FragmentListener');
        $instance->addSubscriberService('profiler_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\ProfilerListener');
        $instance->addSubscriberService('data_collector.request', 'Symfony\\Component\\HttpKernel\\DataCollector\\RequestDataCollector');
        $instance->addSubscriberService('router_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\RouterListener');
        $instance->addSubscriberService('twig.exception_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\ExceptionListener');
        $instance->addSubscriberService('newscoop.paginator.query_subscriber', 'Newscoop\\GimmeBundle\\EventListener\\QuerySubscriber');
        $instance->addSubscriberService('newscoop.paginator.pagination_extra_data_subscriber', 'Newscoop\\GimmeBundle\\EventListener\\PaginationExtraDataSubscriber');
        return $instance;
    }
    protected function getFileLocatorService()
    {
        return $this->services['file_locator'] = new \Symfony\Component\HttpKernel\Config\FileLocator($this->get('kernel'), '/var/www/newscoop/application/Resources');
    }
    protected function getFilesystemService()
    {
        return $this->services['filesystem'] = new \Symfony\Component\Filesystem\Filesystem();
    }
    protected function getForm_CsrfProviderService()
    {
        return $this->services['form.csrf_provider'] = new \Symfony\Component\Form\Extension\Csrf\CsrfProvider\SessionCsrfProvider($this->get('session'), 'pleaseChangeMe!pleaseChangeMe!');
    }
    protected function getForm_FactoryService()
    {
        return $this->services['form.factory'] = new \Symfony\Component\Form\FormFactory($this->get('form.registry'), $this->get('form.resolved_type_factory'));
    }
    protected function getForm_RegistryService()
    {
        return $this->services['form.registry'] = new \Symfony\Component\Form\FormRegistry(array(0 => new \Symfony\Component\Form\Extension\DependencyInjection\DependencyInjectionExtension($this, array('field' => 'form.type.field', 'form' => 'form.type.form', 'birthday' => 'form.type.birthday', 'checkbox' => 'form.type.checkbox', 'choice' => 'form.type.choice', 'collection' => 'form.type.collection', 'country' => 'form.type.country', 'date' => 'form.type.date', 'datetime' => 'form.type.datetime', 'email' => 'form.type.email', 'file' => 'form.type.file', 'hidden' => 'form.type.hidden', 'integer' => 'form.type.integer', 'language' => 'form.type.language', 'locale' => 'form.type.locale', 'money' => 'form.type.money', 'number' => 'form.type.number', 'password' => 'form.type.password', 'percent' => 'form.type.percent', 'radio' => 'form.type.radio', 'repeated' => 'form.type.repeated', 'search' => 'form.type.search', 'textarea' => 'form.type.textarea', 'text' => 'form.type.text', 'time' => 'form.type.time', 'timezone' => 'form.type.timezone', 'url' => 'form.type.url', 'entity' => 'form.type.entity'), array('form' => array(0 => 'form.type_extension.form.http_foundation', 1 => 'form.type_extension.form.validator', 2 => 'form.type_extension.csrf'), 'repeated' => array(0 => 'form.type_extension.repeated.validator')), array(0 => 'form.type_guesser.validator', 1 => 'form.type_guesser.doctrine'))), $this->get('form.resolved_type_factory'));
    }
    protected function getForm_ResolvedTypeFactoryService()
    {
        return $this->services['form.resolved_type_factory'] = new \Symfony\Component\Form\ResolvedFormTypeFactory();
    }
    protected function getForm_Type_BirthdayService()
    {
        return $this->services['form.type.birthday'] = new \Symfony\Component\Form\Extension\Core\Type\BirthdayType();
    }
    protected function getForm_Type_CheckboxService()
    {
        return $this->services['form.type.checkbox'] = new \Symfony\Component\Form\Extension\Core\Type\CheckboxType();
    }
    protected function getForm_Type_ChoiceService()
    {
        return $this->services['form.type.choice'] = new \Symfony\Component\Form\Extension\Core\Type\ChoiceType();
    }
    protected function getForm_Type_CollectionService()
    {
        return $this->services['form.type.collection'] = new \Symfony\Component\Form\Extension\Core\Type\CollectionType();
    }
    protected function getForm_Type_CountryService()
    {
        return $this->services['form.type.country'] = new \Symfony\Component\Form\Extension\Core\Type\CountryType();
    }
    protected function getForm_Type_DateService()
    {
        return $this->services['form.type.date'] = new \Symfony\Component\Form\Extension\Core\Type\DateType();
    }
    protected function getForm_Type_DatetimeService()
    {
        return $this->services['form.type.datetime'] = new \Symfony\Component\Form\Extension\Core\Type\DateTimeType();
    }
    protected function getForm_Type_EmailService()
    {
        return $this->services['form.type.email'] = new \Symfony\Component\Form\Extension\Core\Type\EmailType();
    }
    protected function getForm_Type_EntityService()
    {
        return $this->services['form.type.entity'] = new \Symfony\Bridge\Doctrine\Form\Type\EntityType($this->get('doctrine'));
    }
    protected function getForm_Type_FieldService()
    {
        return $this->services['form.type.field'] = new \Symfony\Component\Form\Extension\Core\Type\FieldType();
    }
    protected function getForm_Type_FileService()
    {
        return $this->services['form.type.file'] = new \Symfony\Component\Form\Extension\Core\Type\FileType();
    }
    protected function getForm_Type_FormService()
    {
        return $this->services['form.type.form'] = new \Symfony\Component\Form\Extension\Core\Type\FormType($this->get('property_accessor'));
    }
    protected function getForm_Type_HiddenService()
    {
        return $this->services['form.type.hidden'] = new \Symfony\Component\Form\Extension\Core\Type\HiddenType();
    }
    protected function getForm_Type_IntegerService()
    {
        return $this->services['form.type.integer'] = new \Symfony\Component\Form\Extension\Core\Type\IntegerType();
    }
    protected function getForm_Type_LanguageService()
    {
        return $this->services['form.type.language'] = new \Symfony\Component\Form\Extension\Core\Type\LanguageType();
    }
    protected function getForm_Type_LocaleService()
    {
        return $this->services['form.type.locale'] = new \Symfony\Component\Form\Extension\Core\Type\LocaleType();
    }
    protected function getForm_Type_MoneyService()
    {
        return $this->services['form.type.money'] = new \Symfony\Component\Form\Extension\Core\Type\MoneyType();
    }
    protected function getForm_Type_NumberService()
    {
        return $this->services['form.type.number'] = new \Symfony\Component\Form\Extension\Core\Type\NumberType();
    }
    protected function getForm_Type_PasswordService()
    {
        return $this->services['form.type.password'] = new \Symfony\Component\Form\Extension\Core\Type\PasswordType();
    }
    protected function getForm_Type_PercentService()
    {
        return $this->services['form.type.percent'] = new \Symfony\Component\Form\Extension\Core\Type\PercentType();
    }
    protected function getForm_Type_RadioService()
    {
        return $this->services['form.type.radio'] = new \Symfony\Component\Form\Extension\Core\Type\RadioType();
    }
    protected function getForm_Type_RepeatedService()
    {
        return $this->services['form.type.repeated'] = new \Symfony\Component\Form\Extension\Core\Type\RepeatedType();
    }
    protected function getForm_Type_SearchService()
    {
        return $this->services['form.type.search'] = new \Symfony\Component\Form\Extension\Core\Type\SearchType();
    }
    protected function getForm_Type_TextService()
    {
        return $this->services['form.type.text'] = new \Symfony\Component\Form\Extension\Core\Type\TextType();
    }
    protected function getForm_Type_TextareaService()
    {
        return $this->services['form.type.textarea'] = new \Symfony\Component\Form\Extension\Core\Type\TextareaType();
    }
    protected function getForm_Type_TimeService()
    {
        return $this->services['form.type.time'] = new \Symfony\Component\Form\Extension\Core\Type\TimeType();
    }
    protected function getForm_Type_TimezoneService()
    {
        return $this->services['form.type.timezone'] = new \Symfony\Component\Form\Extension\Core\Type\TimezoneType();
    }
    protected function getForm_Type_UrlService()
    {
        return $this->services['form.type.url'] = new \Symfony\Component\Form\Extension\Core\Type\UrlType();
    }
    protected function getForm_TypeExtension_CsrfService()
    {
        return $this->services['form.type_extension.csrf'] = new \Symfony\Component\Form\Extension\Csrf\Type\FormTypeCsrfExtension($this->get('form.csrf_provider'), true, '_token');
    }
    protected function getForm_TypeExtension_Form_HttpFoundationService()
    {
        return $this->services['form.type_extension.form.http_foundation'] = new \Symfony\Component\Form\Extension\HttpFoundation\Type\FormTypeHttpFoundationExtension();
    }
    protected function getForm_TypeExtension_Form_ValidatorService()
    {
        return $this->services['form.type_extension.form.validator'] = new \Symfony\Component\Form\Extension\Validator\Type\FormTypeValidatorExtension($this->get('validator'));
    }
    protected function getForm_TypeExtension_Repeated_ValidatorService()
    {
        return $this->services['form.type_extension.repeated.validator'] = new \Symfony\Component\Form\Extension\Validator\Type\RepeatedTypeValidatorExtension();
    }
    protected function getForm_TypeGuesser_DoctrineService()
    {
        return $this->services['form.type_guesser.doctrine'] = new \Symfony\Bridge\Doctrine\Form\DoctrineOrmTypeGuesser($this->get('doctrine'));
    }
    protected function getForm_TypeGuesser_ValidatorService()
    {
        return $this->services['form.type_guesser.validator'] = new \Symfony\Component\Form\Extension\Validator\ValidatorTypeGuesser($this->get('validator.mapping.class_metadata_factory'));
    }
    protected function getFosRest_AllowedMethodsListenerService()
    {
        return $this->services['fos_rest.allowed_methods_listener'] = new \FOS\RestBundle\EventListener\AllowedMethodsListener($this->get('fos_rest.allowed_methods_loader'));
    }
    protected function getFosRest_AllowedMethodsLoaderService()
    {
        return $this->services['fos_rest.allowed_methods_loader'] = new \FOS\RestBundle\Response\AllowedMethodsLoader\AllowedMethodsRouterLoader($this->get('router'), '/var/www/newscoop/cache/prod/fos_rest', false);
    }
    protected function getFosRest_BodyListenerService()
    {
        return $this->services['fos_rest.body_listener'] = new \FOS\RestBundle\EventListener\BodyListener($this->get('fos_rest.decoder_provider'));
    }
    protected function getFosRest_Decoder_JsonService()
    {
        return $this->services['fos_rest.decoder.json'] = new \FOS\Rest\Decoder\JsonDecoder();
    }
    protected function getFosRest_Decoder_JsontoformService()
    {
        return $this->services['fos_rest.decoder.jsontoform'] = new \FOS\Rest\Decoder\JsonToFormDecoder();
    }
    protected function getFosRest_Decoder_XmlService()
    {
        return $this->services['fos_rest.decoder.xml'] = new \FOS\Rest\Decoder\XmlDecoder();
    }
    protected function getFosRest_DecoderProviderService()
    {
        $this->services['fos_rest.decoder_provider'] = $instance = new \FOS\RestBundle\Decoder\ContainerDecoderProvider(array('json' => 'fos_rest.decoder.json'));
        $instance->setContainer($this);
        return $instance;
    }
    protected function getFosRest_FormatListenerService()
    {
        return $this->services['fos_rest.format_listener'] = new \FOS\RestBundle\EventListener\FormatListener($this->get('fos_rest.format_negotiator'), 'json', array(0 => 'json', 1 => 'html'), true);
    }
    protected function getFosRest_FormatNegotiatorService()
    {
        return $this->services['fos_rest.format_negotiator'] = new \FOS\Rest\Util\FormatNegotiator();
    }
    protected function getFosRest_Inflector_DoctrineService()
    {
        return $this->services['fos_rest.inflector.doctrine'] = new \FOS\RestBundle\Util\Inflector\DoctrineInflector();
    }
    protected function getFosRest_MimeTypeListenerService()
    {
        return $this->services['fos_rest.mime_type_listener'] = new \FOS\RestBundle\EventListener\MimeTypeListener(array('json' => array(0 => 'application/json', 1 => 'application/x-json', 2 => 'application/vnd.example-com.foo+json')));
    }
    protected function getFosRest_Request_ParamFetcherService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('fos_rest.request.param_fetcher', 'request');
        }
        return $this->services['fos_rest.request.param_fetcher'] = $this->scopedServices['request']['fos_rest.request.param_fetcher'] = new \FOS\RestBundle\Request\ParamFetcher($this->get('fos_rest.request.param_fetcher.reader'), $this->get('request'));
    }
    protected function getFosRest_Request_ParamFetcher_ReaderService()
    {
        return $this->services['fos_rest.request.param_fetcher.reader'] = new \FOS\RestBundle\Request\ParamReader($this->get('annotation_reader'));
    }
    protected function getFosRest_Routing_Loader_ControllerService()
    {
        return $this->services['fos_rest.routing.loader.controller'] = new \FOS\RestBundle\Routing\Loader\RestRouteLoader($this, $this->get('file_locator'), $this->get('controller_name_converter'), $this->get('fos_rest.routing.loader.reader.controller'), NULL);
    }
    protected function getFosRest_Routing_Loader_ProcessorService()
    {
        return $this->services['fos_rest.routing.loader.processor'] = new \FOS\RestBundle\Routing\Loader\RestRouteProcessor();
    }
    protected function getFosRest_Routing_Loader_Reader_ActionService()
    {
        return $this->services['fos_rest.routing.loader.reader.action'] = new \FOS\RestBundle\Routing\Loader\Reader\RestActionReader($this->get('annotation_reader'), $this->get('fos_rest.request.param_fetcher.reader'), $this->get('fos_rest.inflector.doctrine'), true, array('json' => false, 'xml' => false, 'html' => true));
    }
    protected function getFosRest_Routing_Loader_Reader_ControllerService()
    {
        return $this->services['fos_rest.routing.loader.reader.controller'] = new \FOS\RestBundle\Routing\Loader\Reader\RestControllerReader($this->get('fos_rest.routing.loader.reader.action'), $this->get('annotation_reader'));
    }
    protected function getFosRest_Routing_Loader_XmlCollectionService()
    {
        return $this->services['fos_rest.routing.loader.xml_collection'] = new \FOS\RestBundle\Routing\Loader\RestXmlCollectionLoader($this->get('file_locator'), $this->get('fos_rest.routing.loader.processor'));
    }
    protected function getFosRest_Routing_Loader_YamlCollectionService()
    {
        return $this->services['fos_rest.routing.loader.yaml_collection'] = new \FOS\RestBundle\Routing\Loader\RestYamlCollectionLoader($this->get('file_locator'), $this->get('fos_rest.routing.loader.processor'));
    }
    protected function getFosRest_ViewHandlerService()
    {
        $this->services['fos_rest.view_handler'] = $instance = new \FOS\RestBundle\View\ViewHandler(array('json' => false, 'xml' => false, 'html' => true), 400, 204, false, array('html' => 302), 'twig');
        $instance->setContainer($this);
        return $instance;
    }
    protected function getFosRest_ViewResponseListenerService()
    {
        return $this->services['fos_rest.view_response_listener'] = new \FOS\RestBundle\EventListener\ViewResponseListener($this);
    }
    protected function getFragment_HandlerService()
    {
        $this->services['fragment.handler'] = $instance = new \Symfony\Component\HttpKernel\Fragment\FragmentHandler(array(), false);
        $instance->addRenderer($this->get('fragment.renderer.inline'));
        $instance->addRenderer($this->get('fragment.renderer.hinclude'));
        return $instance;
    }
    protected function getFragment_ListenerService()
    {
        return $this->services['fragment.listener'] = new \Symfony\Component\HttpKernel\EventListener\FragmentListener($this->get('uri_signer'), '/_fragment');
    }
    protected function getFragment_Renderer_HincludeService()
    {
        $this->services['fragment.renderer.hinclude'] = $instance = new \Symfony\Bundle\FrameworkBundle\Fragment\ContainerAwareHIncludeFragmentRenderer($this, $this->get('uri_signer'), NULL);
        $instance->setFragmentPath('/_fragment');
        return $instance;
    }
    protected function getFragment_Renderer_InlineService()
    {
        $this->services['fragment.renderer.inline'] = $instance = new \Symfony\Component\HttpKernel\Fragment\InlineFragmentRenderer($this->get('http_kernel'));
        $instance->setFragmentPath('/_fragment');
        return $instance;
    }
    protected function getHttp_Client_FactoryService()
    {
        return $this->services['http.client.factory'] = new \Newscoop\Http\ClientFactory();
    }
    protected function getHttpKernelService()
    {
        return $this->services['http_kernel'] = new \Symfony\Bundle\FrameworkBundle\HttpKernel($this->get('event_dispatcher'), $this, new \Symfony\Bundle\FrameworkBundle\Controller\ControllerResolver($this, $this->get('controller_name_converter'), $this->get('monolog.logger.request')));
    }
    protected function getImageService()
    {
        return $this->services['image'] = new \Newscoop\Image\ImageService(array('cache_url' => 'images/cache', 'cache_path' => '/var/www/newscoop/application/../images/cache'), $this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getImage_RenditionService()
    {
        return $this->services['image.rendition'] = new \Newscoop\Image\RenditionService(array('theme_path' => '/../themes'), $this->get('doctrine.orm.default_entity_manager'), $this->get('image'));
    }
    protected function getImage_SearchService()
    {
        return $this->services['image.search'] = new \Newscoop\Image\ImageSearchService($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getImage_UpdateStorageService()
    {
        return $this->services['image.update_storage'] = new \Newscoop\Image\UpdateStorageService($this->get('doctrine.orm.default_entity_manager'), $this->get('storage'));
    }
    protected function getIngestService()
    {
        return $this->services['ingest'] = new \Newscoop\Services\IngestService(array('path' => ''), $this->get('doctrine.orm.default_entity_manager'), $this->get('ingest.publisher'));
    }
    protected function getIngest_PublisherService()
    {
        return $this->services['ingest.publisher'] = new \Newscoop\Services\Ingest\PublisherService(array('article_type' => 'newswire', 'section_other' => '20', 'field' => array('NewsItemIdentifier' => 'getNewsItemId', 'NewsProduct' => 'getProduct', 'Status' => 'getStatus', 'Urgency' => 'getPriority', 'HeadLine' => 'getTitle', 'NewsLineText' => 'getCatchLine', 'DataLead' => 'getSummary', 'DataContent' => 'getContent', 'AuthorNames' => 'getAuthors'), 'image_path' => ''));
    }
    protected function getJmsSerializerService()
    {
        $a = new \Metadata\MetadataFactory(new \Metadata\Driver\LazyLoadingDriver($this, 'jms_serializer.metadata_driver'), 'Metadata\\ClassHierarchyMetadata', false);
        $a->setCache(new \Metadata\Cache\FileCache('/var/www/newscoop/cache/prod/jms_serializer'));
        $b = new \JMS\Serializer\EventDispatcher\LazyEventDispatcher($this);
        $b->setListeners(array('serializer.pre_serialize' => array(0 => array(0 => array(0 => 'jms_serializer.doctrine_proxy_subscriber', 1 => 'onPreSerialize'), 1 => NULL, 2 => NULL))));
        return $this->services['jms_serializer'] = new \JMS\Serializer\Serializer($a, $this->get('jms_serializer.handler_registry'), $this->get('jms_serializer.unserialize_object_constructor'), new \JMS\DiExtraBundle\DependencyInjection\Collection\LazyServiceMap($this, array('json' => 'jms_serializer.json_serialization_visitor', 'xml' => 'jms_serializer.xml_serialization_visitor', 'yml' => 'jms_serializer.yaml_serialization_visitor')), new \JMS\DiExtraBundle\DependencyInjection\Collection\LazyServiceMap($this, array('json' => 'jms_serializer.json_deserialization_visitor', 'xml' => 'jms_serializer.xml_deserialization_visitor')), $b);
    }
    protected function getJmsSerializer_ArrayCollectionHandlerService()
    {
        return $this->services['jms_serializer.array_collection_handler'] = new \JMS\Serializer\Handler\ArrayCollectionHandler();
    }
    protected function getJmsSerializer_ConstraintViolationHandlerService()
    {
        return $this->services['jms_serializer.constraint_violation_handler'] = new \JMS\Serializer\Handler\ConstraintViolationHandler();
    }
    protected function getJmsSerializer_DatetimeHandlerService()
    {
        return $this->services['jms_serializer.datetime_handler'] = new \JMS\Serializer\Handler\DateHandler('Y-m-d\\TH:i:sO', 'America/New_York');
    }
    protected function getJmsSerializer_DoctrineProxySubscriberService()
    {
        return $this->services['jms_serializer.doctrine_proxy_subscriber'] = new \JMS\Serializer\EventDispatcher\Subscriber\DoctrineProxySubscriber();
    }
    protected function getJmsSerializer_FormErrorHandlerService()
    {
        return $this->services['jms_serializer.form_error_handler'] = new \JMS\Serializer\Handler\FormErrorHandler($this->get('translator'));
    }
    protected function getJmsSerializer_HandlerRegistryService()
    {
        return $this->services['jms_serializer.handler_registry'] = new \JMS\Serializer\Handler\LazyHandlerRegistry($this, array(1 => array('author' => array('json' => array(0 => 'newscoop.gimme.serializer.article_author_handler', 1 => 'serializeToJson')), 'image_uri' => array('json' => array(0 => 'newscoop.gimme.serializer.author_image_uri_handler', 1 => 'serializeToJson')), 'items_link' => array('json' => array(0 => 'newscoop.gimme.serializer.package_items_link_handler', 1 => 'serializeToJson')), 'article_fields' => array('json' => array(0 => 'newscoop.gimme.serializer.article_fields_handler', 1 => 'serializeToJson')), 'article_translations' => array('json' => array(0 => 'newscoop.gimme.serializer.article_translations_handler', 1 => 'serializeToJson')), 'article_renditions' => array('json' => array(0 => 'newscoop.gimme.serializer.article_renditions_handler', 1 => 'serializeToJson')), 'comments_link' => array('json' => array(0 => 'newscoop.gimme.serializer.article_comments_link_handler', 1 => 'serializeToJson')), 'DateTime' => array('json' => array(0 => 'jms_serializer.datetime_handler', 1 => 'serializeDateTime'), 'xml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'serializeDateTime'), 'yml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'serializeDateTime')), 'DateInterval' => array('json' => array(0 => 'jms_serializer.datetime_handler', 1 => 'serializeDateInterval'), 'xml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'serializeDateInterval'), 'yml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'serializeDateInterval')), 'ArrayCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection')), 'Doctrine\\Common\\Collections\\ArrayCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection')), 'Doctrine\\ORM\\PersistentCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection')), 'Doctrine\\ODM\\MongoDB\\PersistentCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection')), 'PhpCollection\\Sequence' => array('json' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'serializeSequence'), 'xml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'serializeSequence'), 'yml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'serializeSequence')), 'PhpCollection\\Map' => array('json' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'serializeMap'), 'xml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'serializeMap'), 'yml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'serializeMap')), 'Symfony\\Component\\Form\\Form' => array('xml' => array(0 => 'jms_serializer.form_error_handler', 1 => 'serializeFormToxml'), 'json' => array(0 => 'jms_serializer.form_error_handler', 1 => 'serializeFormTojson'), 'yml' => array(0 => 'jms_serializer.form_error_handler', 1 => 'serializeFormToyml')), 'Symfony\\Component\\Form\\FormError' => array('xml' => array(0 => 'jms_serializer.form_error_handler', 1 => 'serializeFormErrorToxml'), 'json' => array(0 => 'jms_serializer.form_error_handler', 1 => 'serializeFormErrorTojson'), 'yml' => array(0 => 'jms_serializer.form_error_handler', 1 => 'serializeFormErrorToyml')), 'Symfony\\Component\\Validator\\ConstraintViolationList' => array('xml' => array(0 => 'jms_serializer.constraint_violation_handler', 1 => 'serializeListToxml'), 'json' => array(0 => 'jms_serializer.constraint_violation_handler', 1 => 'serializeListTojson'), 'yml' => array(0 => 'jms_serializer.constraint_violation_handler', 1 => 'serializeListToyml')), 'Symfony\\Component\\Validator\\ConstraintViolation' => array('xml' => array(0 => 'jms_serializer.constraint_violation_handler', 1 => 'serializeViolationToxml'), 'json' => array(0 => 'jms_serializer.constraint_violation_handler', 1 => 'serializeViolationTojson'), 'yml' => array(0 => 'jms_serializer.constraint_violation_handler', 1 => 'serializeViolationToyml'))), 2 => array('DateTime' => array('json' => array(0 => 'jms_serializer.datetime_handler', 1 => 'deserializeDateTimeFromjson'), 'xml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'deserializeDateTimeFromxml'), 'yml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'deserializeDateTimeFromyml')), 'ArrayCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection')), 'Doctrine\\Common\\Collections\\ArrayCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection')), 'Doctrine\\ORM\\PersistentCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection')), 'Doctrine\\ODM\\MongoDB\\PersistentCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection')), 'PhpCollection\\Sequence' => array('json' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'deserializeSequence'), 'xml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'deserializeSequence'), 'yml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'deserializeSequence')), 'PhpCollection\\Map' => array('json' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'deserializeMap'), 'xml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'deserializeMap'), 'yml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'deserializeMap')))));
    }
    protected function getJmsSerializer_JsonDeserializationVisitorService()
    {
        return $this->services['jms_serializer.json_deserialization_visitor'] = new \JMS\Serializer\JsonDeserializationVisitor($this->get('jms_serializer.naming_strategy'), $this->get('jms_serializer.unserialize_object_constructor'));
    }
    protected function getJmsSerializer_JsonSerializationVisitorService()
    {
        $this->services['jms_serializer.json_serialization_visitor'] = $instance = new \JMS\Serializer\JsonSerializationVisitor($this->get('jms_serializer.naming_strategy'));
        $instance->setOptions(0);
        return $instance;
    }
    protected function getJmsSerializer_MetadataDriverService()
    {
        $a = new \Metadata\Driver\FileLocator(array('Symfony\\Bundle\\FrameworkBundle' => '/var/www/newscoop/vendor/symfony/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/config/serializer', 'Symfony\\Bundle\\TwigBundle' => '/var/www/newscoop/vendor/symfony/symfony/src/Symfony/Bundle/TwigBundle/Resources/config/serializer', 'Symfony\\Bundle\\MonologBundle' => '/var/www/newscoop/vendor/symfony/monolog-bundle/Symfony/Bundle/MonologBundle/Resources/config/serializer', 'Doctrine\\Bundle\\DoctrineBundle' => '/var/www/newscoop/vendor/doctrine/doctrine-bundle/Doctrine/Bundle/DoctrineBundle/Resources/config/serializer', 'Sensio\\Bundle\\FrameworkExtraBundle' => '/var/www/newscoop/vendor/sensio/framework-extra-bundle/Sensio/Bundle/FrameworkExtraBundle/Resources/config/serializer', 'JMS\\SerializerBundle' => '/var/www/newscoop/vendor/jms/serializer-bundle/JMS/SerializerBundle/Resources/config/serializer', 'FOS\\RestBundle' => '/var/www/newscoop/vendor/friendsofsymfony/rest-bundle/FOS/RestBundle/Resources/config/serializer', 'Newscoop\\GimmeBundle' => '/var/www/newscoop/src/Newscoop/GimmeBundle/Resources/config/serializer', 'Knp\\Bundle\\PaginatorBundle' => '/var/www/newscoop/vendor/knplabs/knp-paginator-bundle/Knp/Bundle/PaginatorBundle/Resources/config/serializer', 'NoiseLabs\\Bundle\\SmartyBundle' => '/var/www/newscoop/vendor/noiselabs/smarty-bundle/NoiseLabs/Bundle/SmartyBundle/Resources/config/serializer', 'Newscoop\\ZendBridgeBundle' => '/var/www/newscoop/src/Newscoop/ZendBridgeBundle/Resources/config/serializer', 'Newscoop\\NewscoopBundle' => '/var/www/newscoop/src/Newscoop/NewscoopBundle/Resources/config/serializer', 'Newscoop\\Entity' => '/var/www/newscoop/src/Newscoop/GimmeBundle/Resources/config/serializer/newscoop', 'Newscoop\\Package' => '/var/www/newscoop/src/Newscoop/GimmeBundle/Resources/config/serializer/newscoop'));
        return $this->services['jms_serializer.metadata_driver'] = new \JMS\Serializer\Metadata\Driver\DoctrineTypeDriver(new \Metadata\Driver\DriverChain(array(0 => new \JMS\Serializer\Metadata\Driver\YamlDriver($a), 1 => new \JMS\Serializer\Metadata\Driver\XmlDriver($a), 2 => new \JMS\Serializer\Metadata\Driver\PhpDriver($a), 3 => new \JMS\Serializer\Metadata\Driver\AnnotationDriver($this->get('annotation_reader')))), $this->get('doctrine'));
    }
    protected function getJmsSerializer_NamingStrategyService()
    {
        return $this->services['jms_serializer.naming_strategy'] = new \JMS\Serializer\Naming\CacheNamingStrategy(new \JMS\Serializer\Naming\SerializedNameAnnotationStrategy(new \JMS\Serializer\Naming\CamelCaseNamingStrategy('_', true)));
    }
    protected function getJmsSerializer_PhpCollectionHandlerService()
    {
        return $this->services['jms_serializer.php_collection_handler'] = new \JMS\Serializer\Handler\PhpCollectionHandler();
    }
    protected function getJmsSerializer_Templating_Helper_SerializerService()
    {
        return $this->services['jms_serializer.templating.helper.serializer'] = new \JMS\SerializerBundle\Templating\SerializerHelper($this->get('jms_serializer'));
    }
    protected function getJmsSerializer_XmlDeserializationVisitorService()
    {
        $this->services['jms_serializer.xml_deserialization_visitor'] = $instance = new \JMS\Serializer\XmlDeserializationVisitor($this->get('jms_serializer.naming_strategy'), $this->get('jms_serializer.unserialize_object_constructor'));
        $instance->setDoctypeWhitelist(array());
        return $instance;
    }
    protected function getJmsSerializer_XmlSerializationVisitorService()
    {
        return $this->services['jms_serializer.xml_serialization_visitor'] = new \JMS\Serializer\XmlSerializationVisitor($this->get('jms_serializer.naming_strategy'));
    }
    protected function getJmsSerializer_YamlSerializationVisitorService()
    {
        return $this->services['jms_serializer.yaml_serialization_visitor'] = new \JMS\Serializer\YamlSerializationVisitor($this->get('jms_serializer.naming_strategy'));
    }
    protected function getKernelService()
    {
        throw new RuntimeException('You have requested a synthetic service ("kernel"). The DIC does not know how to construct this service.');
    }
    protected function getKnpPaginatorService()
    {
        $this->services['knp_paginator'] = $instance = new \Knp\Component\Pager\Paginator($this->get('event_dispatcher'));
        $instance->setDefaultPaginatorOptions(array('pageParameterName' => 'knp_page', 'sortFieldParameterName' => 'knp_sort', 'sortDirectionParameterName' => 'knp_direction', 'filterFieldParameterName' => 'filterField', 'filterValueParameterName' => 'filterValue', 'distinct' => true));
        return $instance;
    }
    protected function getKnpPaginator_Subscriber_FiltrationService()
    {
        return $this->services['knp_paginator.subscriber.filtration'] = new \Knp\Component\Pager\Event\Subscriber\Filtration\FiltrationSubscriber();
    }
    protected function getKnpPaginator_Subscriber_PaginateService()
    {
        return $this->services['knp_paginator.subscriber.paginate'] = new \Knp\Component\Pager\Event\Subscriber\Paginate\PaginationSubscriber();
    }
    protected function getKnpPaginator_Subscriber_SlidingPaginationService()
    {
        return $this->services['knp_paginator.subscriber.sliding_pagination'] = new \Knp\Bundle\PaginatorBundle\Subscriber\SlidingPaginationSubscriber(array('defaultPaginationTemplate' => 'KnpPaginatorBundle:Pagination:sliding.html.twig', 'defaultSortableTemplate' => 'KnpPaginatorBundle:Pagination:sortable_link.html.twig', 'defaultFiltrationTemplate' => 'KnpPaginatorBundle:Pagination:filtration.html.twig', 'defaultPageRange' => 5));
    }
    protected function getKnpPaginator_Subscriber_SortableService()
    {
        return $this->services['knp_paginator.subscriber.sortable'] = new \Knp\Component\Pager\Event\Subscriber\Sortable\SortableSubscriber();
    }
    protected function getKnpPaginator_Twig_Extension_PaginationService()
    {
        return $this->services['knp_paginator.twig.extension.pagination'] = new \Knp\Bundle\PaginatorBundle\Twig\Extension\PaginationExtension($this->get('templating.helper.router'), $this->get('translator'));
    }
    protected function getLocaleListenerService()
    {
        return $this->services['locale_listener'] = new \Symfony\Component\HttpKernel\EventListener\LocaleListener('en', $this->get('router'));
    }
    protected function getLoggerService()
    {
        $this->services['logger'] = $instance = new \Symfony\Bridge\Monolog\Logger('app');
        $instance->pushHandler($this->get('monolog.handler.main'));
        $instance->pushHandler($this->get('monolog.handler.debug'));
        return $instance;
    }
    protected function getMailchimp_Api_FactoryService()
    {
        return $this->services['mailchimp.api.factory'] = new \Newscoop\MailChimp\ApiFactory($this->get('preferences'));
    }
    protected function getMailchimp_ListService()
    {
        return $this->services['mailchimp.list'] = new \Newscoop\MailChimp\ListApi($this->get('mailchimp.api.factory'), $this->get('preferences'));
    }
    protected function getMonolog_Handler_DebugService()
    {
        return $this->services['monolog.handler.debug'] = new \Symfony\Bridge\Monolog\Handler\DebugHandler(100, true);
    }
    protected function getMonolog_Handler_MainService()
    {
        return $this->services['monolog.handler.main'] = new \Monolog\Handler\FingersCrossedHandler($this->get('monolog.handler.nested'), 400, 0, true, true);
    }
    protected function getMonolog_Handler_NestedService()
    {
        return $this->services['monolog.handler.nested'] = new \Monolog\Handler\StreamHandler('/var/www/newscoop/log/prod.log', 100, true);
    }
    protected function getMonolog_Logger_DoctrineService()
    {
        $this->services['monolog.logger.doctrine'] = $instance = new \Symfony\Bridge\Monolog\Logger('doctrine');
        $instance->pushHandler($this->get('monolog.handler.main'));
        $instance->pushHandler($this->get('monolog.handler.debug'));
        return $instance;
    }
    protected function getMonolog_Logger_ProfilerService()
    {
        $this->services['monolog.logger.profiler'] = $instance = new \Symfony\Bridge\Monolog\Logger('profiler');
        $instance->pushHandler($this->get('monolog.handler.main'));
        $instance->pushHandler($this->get('monolog.handler.debug'));
        return $instance;
    }
    protected function getMonolog_Logger_RequestService()
    {
        $this->services['monolog.logger.request'] = $instance = new \Symfony\Bridge\Monolog\Logger('request');
        $instance->pushHandler($this->get('monolog.handler.main'));
        $instance->pushHandler($this->get('monolog.handler.debug'));
        return $instance;
    }
    protected function getMonolog_Logger_RouterService()
    {
        $this->services['monolog.logger.router'] = $instance = new \Symfony\Bridge\Monolog\Logger('router');
        $instance->pushHandler($this->get('monolog.handler.main'));
        $instance->pushHandler($this->get('monolog.handler.debug'));
        return $instance;
    }
    protected function getMonolog_Logger_SmartybundleService()
    {
        $this->services['monolog.logger.smartybundle'] = $instance = new \Symfony\Bridge\Monolog\Logger('SmartyBundle');
        $instance->pushHandler($this->get('monolog.handler.main'));
        $instance->pushHandler($this->get('monolog.handler.debug'));
        return $instance;
    }
    protected function getNewscoop_Gimme_Listener_AllowOriginService()
    {
        return $this->services['newscoop.gimme.listener.allow_origin'] = new \Newscoop\GimmeBundle\EventListener\AllowOriginListener($this);
    }
    protected function getNewscoop_Gimme_Listener_FormatJsonService()
    {
        return $this->services['newscoop.gimme.listener.format_json'] = new \Newscoop\GimmeBundle\EventListener\FormatJsonResponseListener();
    }
    protected function getNewscoop_Gimme_Listener_OverrideMethodService()
    {
        return $this->services['newscoop.gimme.listener.override_method'] = new \Newscoop\GimmeBundle\EventListener\OverrideMethodListener();
    }
    protected function getNewscoop_Gimme_Listener_PublicationService()
    {
        return $this->services['newscoop.gimme.listener.publication'] = new \Newscoop\GimmeBundle\EventListener\PublicationListener($this->get('newscoop.publication_service'));
    }
    protected function getNewscoop_Gimme_Serializer_ArticleAuthorHandlerService()
    {
        return $this->services['newscoop.gimme.serializer.article_author_handler'] = new \Newscoop\GimmeBundle\Serializer\Article\AuthorHandler($this->get('router'));
    }
    protected function getNewscoop_Gimme_Serializer_ArticleCommentsLinkHandlerService()
    {
        return $this->services['newscoop.gimme.serializer.article_comments_link_handler'] = new \Newscoop\GimmeBundle\Serializer\Article\CommentsLinkHandler($this->get('router'));
    }
    protected function getNewscoop_Gimme_Serializer_ArticleFieldsHandlerService()
    {
        return $this->services['newscoop.gimme.serializer.article_fields_handler'] = new \Newscoop\GimmeBundle\Serializer\Article\FieldsHandler();
    }
    protected function getNewscoop_Gimme_Serializer_ArticleRenditionsHandlerService()
    {
        return $this->services['newscoop.gimme.serializer.article_renditions_handler'] = new \Newscoop\GimmeBundle\Serializer\Article\RenditionsHandler($this->get('image'), $this->get('zend_router'), $this->get('newscoop.publication_service'), $this->get('image.rendition'));
    }
    protected function getNewscoop_Gimme_Serializer_ArticleTranslationsHandlerService()
    {
        return $this->services['newscoop.gimme.serializer.article_translations_handler'] = new \Newscoop\GimmeBundle\Serializer\Article\TranslationsHandler($this->get('doctrine.orm.default_entity_manager'), $this->get('router'));
    }
    protected function getNewscoop_Gimme_Serializer_AuthorImageUriHandlerService()
    {
        return $this->services['newscoop.gimme.serializer.author_image_uri_handler'] = new \Newscoop\GimmeBundle\Serializer\Author\ImageUriHandler($this->get('image'), $this->get('zend_router'), $this->get('newscoop.publication_service'));
    }
    protected function getNewscoop_Gimme_Serializer_PackageItemsLinkHandlerService()
    {
        return $this->services['newscoop.gimme.serializer.package_items_link_handler'] = new \Newscoop\GimmeBundle\Serializer\Package\ItemsLinkHandler($this->get('router'));
    }
    protected function getNewscoop_Paginator_PaginationExtraDataSubscriberService()
    {
        return $this->services['newscoop.paginator.pagination_extra_data_subscriber'] = new \Newscoop\GimmeBundle\EventListener\PaginationExtraDataSubscriber($this->get('newscoop.paginator.paginator_service'));
    }
    protected function getNewscoop_Paginator_PaginationListenerService()
    {
        return $this->services['newscoop.paginator.pagination_listener'] = new \Newscoop\GimmeBundle\EventListener\PaginationListener($this->get('newscoop.paginator.paginator_service'));
    }
    protected function getNewscoop_Paginator_PaginatorServiceService()
    {
        return $this->services['newscoop.paginator.paginator_service'] = new \Newscoop\Gimme\PaginatorService($this->get('knp_paginator'), $this->get('router'));
    }
    protected function getNewscoop_Paginator_QuerySubscriberService()
    {
        return $this->services['newscoop.paginator.query_subscriber'] = new \Newscoop\GimmeBundle\EventListener\QuerySubscriber($this->get('newscoop.paginator.paginator_service'));
    }
    protected function getNewscoop_PublicationServiceService()
    {
        return $this->services['newscoop.publication_service'] = new \Newscoop\Gimme\PublicationService($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getNewscoop_Zendbridge_ZendapplicationListenerService()
    {
        return $this->services['newscoop.zendbridge.zendapplication_listener'] = new \Newscoop\ZendBridgeBundle\EventListener\ZendApplicationListener($this);
    }
    protected function getNewscoopNewscoop_Doctrine_EventDispatcherProxyService()
    {
        return $this->services['newscoop_newscoop.doctrine.event_dispatcher_proxy'] = new \Newscoop\Doctrine\EventDispatcherProxy($this->get('event_dispatcher'));
    }
    protected function getNewscoopNewscoop_Routing_Loader_PluginsService()
    {
        return $this->services['newscoop_newscoop.routing.loader.plugins'] = new \Newscoop\NewscoopBundle\Routing\PluginsLoader($this->get('plugins.manager'), $this);
    }
    protected function getNotificationService()
    {
        return $this->services['notification'] = new \Newscoop\Services\NotificationService($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getPackageService()
    {
        return $this->services['package'] = new \Newscoop\Package\PackageService($this->get('doctrine.orm.default_entity_manager'), $this->get('image'));
    }
    protected function getPackage_SearchService()
    {
        return $this->services['package.search'] = new \Newscoop\Package\PackageSearchService($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getPlugins_ManagerService()
    {
        return $this->services['plugins.manager'] = new \Newscoop\Services\PluginsManagerService($this->get('doctrine.orm.default_entity_manager'), $this->get('event_dispatcher'));
    }
    protected function getPreferencesService()
    {
        return $this->services['preferences'] = new \SystemPref();
    }
    protected function getProfilerService()
    {
        $a = $this->get('monolog.logger.profiler');
        $b = $this->get('kernel');
        $c = new \Symfony\Component\HttpKernel\DataCollector\ConfigDataCollector();
        $c->setKernel($b);
        $this->services['profiler'] = $instance = new \Symfony\Component\HttpKernel\Profiler\Profiler(new \Symfony\Component\HttpKernel\Profiler\FileProfilerStorage('file:/var/www/newscoop/cache/prod/profiler', '', '', 86400), $a);
        $instance->disable();
        $instance->add($c);
        $instance->add($this->get('data_collector.request'));
        $instance->add(new \Symfony\Component\HttpKernel\DataCollector\ExceptionDataCollector());
        $instance->add(new \Symfony\Component\HttpKernel\DataCollector\EventDataCollector());
        $instance->add(new \Symfony\Component\HttpKernel\DataCollector\LoggerDataCollector($a));
        $instance->add(new \Symfony\Component\HttpKernel\DataCollector\TimeDataCollector($b));
        $instance->add(new \Symfony\Component\HttpKernel\DataCollector\MemoryDataCollector());
        $instance->add($this->get('data_collector.router'));
        $instance->add(new \Doctrine\Bundle\DoctrineBundle\DataCollector\DoctrineDataCollector($this->get('doctrine')));
        return $instance;
    }
    protected function getProfilerListenerService()
    {
        return $this->services['profiler_listener'] = new \Symfony\Component\HttpKernel\EventListener\ProfilerListener($this->get('profiler'), NULL, false, false);
    }
    protected function getPropertyAccessorService()
    {
        return $this->services['property_accessor'] = new \Symfony\Component\PropertyAccess\PropertyAccessor();
    }
    protected function getRandomService()
    {
        return $this->services['random'] = new \Newscoop\Random();
    }
    protected function getRequestService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('request', 'request');
        }
        throw new RuntimeException('You have requested a synthetic service ("request"). The DIC does not know how to construct this service.');
    }
    protected function getResponseListenerService()
    {
        return $this->services['response_listener'] = new \Symfony\Component\HttpKernel\EventListener\ResponseListener('UTF-8');
    }
    protected function getRouterService()
    {
        return $this->services['router'] = new \Symfony\Bundle\FrameworkBundle\Routing\Router($this, '/var/www/newscoop/application/configs/symfony/routing.yml', array('cache_dir' => '/var/www/newscoop/cache/prod', 'debug' => false, 'generator_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator', 'generator_base_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator', 'generator_dumper_class' => 'Symfony\\Component\\Routing\\Generator\\Dumper\\PhpGeneratorDumper', 'generator_cache_class' => 'applicationProdUrlGenerator', 'matcher_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher', 'matcher_base_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher', 'matcher_dumper_class' => 'Symfony\\Component\\Routing\\Matcher\\Dumper\\PhpMatcherDumper', 'matcher_cache_class' => 'applicationProdUrlMatcher', 'strict_requirements' => false), $this->get('router.request_context'), $this->get('monolog.logger.router'));
    }
    protected function getRouterListenerService()
    {
        return $this->services['router_listener'] = new \Symfony\Component\HttpKernel\EventListener\RouterListener($this->get('router'), $this->get('router.request_context'), $this->get('monolog.logger.request'));
    }
    protected function getRouting_LoaderService()
    {
        $a = $this->get('file_locator');
        $b = $this->get('annotation_reader');
        $c = new \Sensio\Bundle\FrameworkExtraBundle\Routing\AnnotatedRouteControllerLoader($b);
        $d = new \Symfony\Component\Config\Loader\LoaderResolver();
        $d->addLoader(new \Symfony\Component\Routing\Loader\XmlFileLoader($a));
        $d->addLoader(new \Symfony\Component\Routing\Loader\YamlFileLoader($a));
        $d->addLoader(new \Symfony\Component\Routing\Loader\PhpFileLoader($a));
        $d->addLoader(new \Symfony\Component\Routing\Loader\AnnotationDirectoryLoader($a, $c));
        $d->addLoader(new \Symfony\Component\Routing\Loader\AnnotationFileLoader($a, $c));
        $d->addLoader($c);
        $d->addLoader($this->get('fos_rest.routing.loader.controller'));
        $d->addLoader($this->get('fos_rest.routing.loader.yaml_collection'));
        $d->addLoader($this->get('fos_rest.routing.loader.xml_collection'));
        $d->addLoader($this->get('newscoop_newscoop.routing.loader.plugins'));
        return $this->services['routing.loader'] = new \Symfony\Bundle\FrameworkBundle\Routing\DelegatingLoader($this->get('controller_name_converter'), $this->get('monolog.logger.router'), $d);
    }
    protected function getSearch_IndexService()
    {
        return $this->services['search.index'] = new \Newscoop\Search\SolrIndex($this->get('http.client.factory'), array('solr_server' => 'http://localhost:8983/solr'));
    }
    protected function getSearch_Indexer_ArticleService()
    {
        return $this->services['search.indexer.article'] = new \Newscoop\Search\ArticleIndexer($this->get('doctrine.orm.default_entity_manager'), $this->get('search.index'));
    }
    protected function getSensioFrameworkExtra_Cache_ListenerService()
    {
        return $this->services['sensio_framework_extra.cache.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\CacheListener();
    }
    protected function getSensioFrameworkExtra_Controller_ListenerService()
    {
        return $this->services['sensio_framework_extra.controller.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\ControllerListener($this->get('annotation_reader'));
    }
    protected function getSensioFrameworkExtra_Converter_DatetimeService()
    {
        return $this->services['sensio_framework_extra.converter.datetime'] = new \Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\DateTimeParamConverter();
    }
    protected function getSensioFrameworkExtra_Converter_Doctrine_OrmService()
    {
        return $this->services['sensio_framework_extra.converter.doctrine.orm'] = new \Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\DoctrineParamConverter($this->get('doctrine'));
    }
    protected function getSensioFrameworkExtra_Converter_ListenerService()
    {
        return $this->services['sensio_framework_extra.converter.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\ParamConverterListener($this->get('sensio_framework_extra.converter.manager'));
    }
    protected function getSensioFrameworkExtra_Converter_ManagerService()
    {
        $this->services['sensio_framework_extra.converter.manager'] = $instance = new \Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterManager();
        $instance->add($this->get('sensio_framework_extra.converter.doctrine.orm'), 0, 'doctrine.orm');
        $instance->add($this->get('sensio_framework_extra.converter.datetime'), 0, 'datetime');
        return $instance;
    }
    protected function getSensioFrameworkExtra_View_GuesserService()
    {
        return $this->services['sensio_framework_extra.view.guesser'] = new \Sensio\Bundle\FrameworkExtraBundle\Templating\TemplateGuesser($this->get('kernel'));
    }
    protected function getServiceContainerService()
    {
        throw new RuntimeException('You have requested a synthetic service ("service_container"). The DIC does not know how to construct this service.');
    }
    protected function getSessionService()
    {
        return $this->services['session'] = new \Symfony\Component\HttpFoundation\Session\Session($this->get('session.storage.native'), new \Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag(), new \Symfony\Component\HttpFoundation\Session\Flash\FlashBag());
    }
    protected function getSession_HandlerService()
    {
        return $this->services['session.handler'] = new \Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeFileSessionHandler('/var/www/newscoop/cache/prod/sessions');
    }
    protected function getSession_Storage_FilesystemService()
    {
        return $this->services['session.storage.filesystem'] = new \Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage('/var/www/newscoop/cache/prod/sessions');
    }
    protected function getSession_Storage_NativeService()
    {
        return $this->services['session.storage.native'] = new \Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage(array(), $this->get('session.handler'));
    }
    protected function getSessionListenerService()
    {
        return $this->services['session_listener'] = new \Symfony\Bundle\FrameworkBundle\EventListener\SessionListener($this);
    }
    protected function getSmartyService()
    {
        return $this->services['smarty'] = new \CampTemplate();
    }
    protected function getSmarty_Templating_FinderService()
    {
        return $this->services['smarty.templating.finder'] = new \NoiseLabs\Bundle\SmartyBundle\CacheWarmer\SmartyTemplateFinder($this->get('kernel'), $this->get('templating.filename_parser'), '/var/www/newscoop/application/Resources');
    }
    protected function getStatService()
    {
        return $this->services['stat'] = new \Newscoop\Services\StatService($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getStorageService()
    {
        return $this->services['storage'] = new \Newscoop\Storage\StorageService($this->get('storage.adapter'));
    }
    protected function getStorage_AdapterService()
    {
        return $this->services['storage.adapter'] = new \Zend_Cloud_StorageService_Adapter_FileSystem(array('local_directory' => '/var/www/newscoop/application/..'));
    }
    protected function getStreamedResponseListenerService()
    {
        return $this->services['streamed_response_listener'] = new \Symfony\Component\HttpKernel\EventListener\StreamedResponseListener();
    }
    protected function getSubscriptionService()
    {
        return $this->services['subscription'] = new \Newscoop\Subscription\SubscriptionFacade($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getSubscription_IpService()
    {
        return $this->services['subscription.ip'] = new \Newscoop\Subscription\IpFacade($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getSubscription_SectionService()
    {
        return $this->services['subscription.section'] = new \Newscoop\Subscription\SectionFacade($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getSubscription_ServiceService()
    {
        return $this->services['subscription.service'] = new \Newscoop\Services\SubscriptionService($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getTemplatingService()
    {
        $this->services['templating'] = $instance = new \Symfony\Bundle\FrameworkBundle\Templating\DelegatingEngine($this, array());
        $instance->addEngine($this->get('templating.engine.twig'));
        $instance->addEngine($this->get('templating.engine.smarty'));
        return $instance;
    }
    protected function getTemplating_Asset_PackageFactoryService()
    {
        return $this->services['templating.asset.package_factory'] = new \Symfony\Bundle\FrameworkBundle\Templating\Asset\PackageFactory($this);
    }
    protected function getTemplating_Engine_SmartyService()
    {
        $this->services['templating.engine.smarty'] = $instance = new \Newscoop\Smarty\SmartyEngine($this->get('smarty'), $this, $this->get('templating.name_parser'), $this->get('templating.loader'), array('caching' => false, 'left_delimiter' => '{{', 'right_delimiter' => '}}', 'cache_dir' => '/var/www/newscoop/cache/prod/smarty/cache', 'compile_dir' => '/var/www/newscoop/cache/prod/smarty/templates_c', 'config_dir' => '/var/www/newscoop/application/config/smarty', 'default_resource_type' => 'file', 'template_dir' => '/var/www/newscoop/application/Resources/views', 'use_include_path' => false, 'use_sub_dirs' => true), $this->get('templating.globals'), $this->get('monolog.logger.smartybundle'));
        $instance->addExtension(new \NoiseLabs\Bundle\SmartyBundle\Extension\CoreExtension());
        $instance->addExtension(new \NoiseLabs\Bundle\SmartyBundle\Extension\ActionsExtension($this));
        $instance->addExtension(new \NoiseLabs\Bundle\SmartyBundle\Extension\AssetsExtension($this));
        $instance->addExtension(new \Newscoop\NewscoopBundle\Extension\RoutingExtension($this->get('router')));
        $instance->addExtension(new \NoiseLabs\Bundle\SmartyBundle\Extension\TranslationExtension($this->get('translator')));
        $instance->addExtension(new \NoiseLabs\Bundle\SmartyBundle\Extension\SecurityExtension(NULL));
        $instance->addExtension(new \NoiseLabs\Bundle\SmartyBundle\Extension\FormExtension(new \NoiseLabs\Bundle\SmartyBundle\Form\SmartyRenderer(new \NoiseLabs\Bundle\SmartyBundle\Form\SmartyRendererEngine(array(0 => 'form_div_layout.html.tpl')), $this->get('form.csrf_provider'))));
        return $instance;
    }
    protected function getTemplating_FilenameParserService()
    {
        return $this->services['templating.filename_parser'] = new \Symfony\Bundle\FrameworkBundle\Templating\TemplateFilenameParser();
    }
    protected function getTemplating_GlobalsService()
    {
        return $this->services['templating.globals'] = new \Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables($this);
    }
    protected function getTemplating_Helper_ActionsService()
    {
        return $this->services['templating.helper.actions'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\ActionsHelper($this->get('fragment.handler'));
    }
    protected function getTemplating_Helper_AssetsService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('templating.helper.assets', 'request');
        }
        return $this->services['templating.helper.assets'] = $this->scopedServices['request']['templating.helper.assets'] = new \Symfony\Component\Templating\Helper\CoreAssetsHelper(new \Symfony\Bundle\FrameworkBundle\Templating\Asset\PathPackage($this->get('request'), NULL, '%s?%s'), array());
    }
    protected function getTemplating_Helper_CodeService()
    {
        return $this->services['templating.helper.code'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\CodeHelper(NULL, '/var/www/newscoop/application', 'UTF-8');
    }
    protected function getTemplating_Helper_FormService()
    {
        $a = new \Symfony\Bundle\FrameworkBundle\Templating\PhpEngine($this->get('templating.name_parser'), $this, $this->get('templating.loader'), $this->get('templating.globals'));
        $a->setCharset('UTF-8');
        $a->setHelpers(array('slots' => 'templating.helper.slots', 'assets' => 'templating.helper.assets', 'request' => 'templating.helper.request', 'session' => 'templating.helper.session', 'router' => 'templating.helper.router', 'actions' => 'templating.helper.actions', 'code' => 'templating.helper.code', 'translator' => 'templating.helper.translator', 'form' => 'templating.helper.form', 'jms_serializer' => 'jms_serializer.templating.helper.serializer'));
        return $this->services['templating.helper.form'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\FormHelper(new \Symfony\Component\Form\FormRenderer(new \Symfony\Component\Form\Extension\Templating\TemplatingRendererEngine($a, array(0 => 'FrameworkBundle:Form')), $this->get('form.csrf_provider')));
    }
    protected function getTemplating_Helper_RequestService()
    {
        return $this->services['templating.helper.request'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\RequestHelper($this->get('request'));
    }
    protected function getTemplating_Helper_RouterService()
    {
        return $this->services['templating.helper.router'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\RouterHelper($this->get('router'));
    }
    protected function getTemplating_Helper_SessionService()
    {
        return $this->services['templating.helper.session'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\SessionHelper($this->get('request'));
    }
    protected function getTemplating_Helper_SlotsService()
    {
        return $this->services['templating.helper.slots'] = new \Symfony\Component\Templating\Helper\SlotsHelper();
    }
    protected function getTemplating_Helper_TranslatorService()
    {
        return $this->services['templating.helper.translator'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\TranslatorHelper($this->get('translator'));
    }
    protected function getTemplating_LoaderService()
    {
        return $this->services['templating.loader'] = new \Symfony\Bundle\FrameworkBundle\Templating\Loader\FilesystemLoader($this->get('templating.locator'));
    }
    protected function getTemplating_NameParserService()
    {
        return $this->services['templating.name_parser'] = new \Symfony\Bundle\FrameworkBundle\Templating\TemplateNameParser($this->get('kernel'));
    }
    protected function getTopicService()
    {
        return $this->services['topic'] = new \Newscoop\Topic\TopicService($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getTranslation_Dumper_CsvService()
    {
        return $this->services['translation.dumper.csv'] = new \Symfony\Component\Translation\Dumper\CsvFileDumper();
    }
    protected function getTranslation_Dumper_IniService()
    {
        return $this->services['translation.dumper.ini'] = new \Symfony\Component\Translation\Dumper\IniFileDumper();
    }
    protected function getTranslation_Dumper_MoService()
    {
        return $this->services['translation.dumper.mo'] = new \Symfony\Component\Translation\Dumper\MoFileDumper();
    }
    protected function getTranslation_Dumper_PhpService()
    {
        return $this->services['translation.dumper.php'] = new \Symfony\Component\Translation\Dumper\PhpFileDumper();
    }
    protected function getTranslation_Dumper_PoService()
    {
        return $this->services['translation.dumper.po'] = new \Symfony\Component\Translation\Dumper\PoFileDumper();
    }
    protected function getTranslation_Dumper_QtService()
    {
        return $this->services['translation.dumper.qt'] = new \Symfony\Component\Translation\Dumper\QtFileDumper();
    }
    protected function getTranslation_Dumper_ResService()
    {
        return $this->services['translation.dumper.res'] = new \Symfony\Component\Translation\Dumper\IcuResFileDumper();
    }
    protected function getTranslation_Dumper_XliffService()
    {
        return $this->services['translation.dumper.xliff'] = new \Symfony\Component\Translation\Dumper\XliffFileDumper();
    }
    protected function getTranslation_Dumper_YmlService()
    {
        return $this->services['translation.dumper.yml'] = new \Symfony\Component\Translation\Dumper\YamlFileDumper();
    }
    protected function getTranslation_ExtractorService()
    {
        $this->services['translation.extractor'] = $instance = new \Symfony\Component\Translation\Extractor\ChainExtractor();
        $instance->addExtractor('php', $this->get('translation.extractor.php'));
        $instance->addExtractor('twig', $this->get('twig.translation.extractor'));
        return $instance;
    }
    protected function getTranslation_Extractor_PhpService()
    {
        return $this->services['translation.extractor.php'] = new \Symfony\Bundle\FrameworkBundle\Translation\PhpExtractor();
    }
    protected function getTranslation_LoaderService()
    {
        $a = $this->get('translation.loader.xliff');
        $this->services['translation.loader'] = $instance = new \Symfony\Bundle\FrameworkBundle\Translation\TranslationLoader();
        $instance->addLoader('php', $this->get('translation.loader.php'));
        $instance->addLoader('yml', $this->get('translation.loader.yml'));
        $instance->addLoader('xlf', $a);
        $instance->addLoader('xliff', $a);
        $instance->addLoader('po', $this->get('translation.loader.po'));
        $instance->addLoader('mo', $this->get('translation.loader.mo'));
        $instance->addLoader('ts', $this->get('translation.loader.qt'));
        $instance->addLoader('csv', $this->get('translation.loader.csv'));
        $instance->addLoader('res', $this->get('translation.loader.res'));
        $instance->addLoader('dat', $this->get('translation.loader.dat'));
        $instance->addLoader('ini', $this->get('translation.loader.ini'));
        return $instance;
    }
    protected function getTranslation_Loader_CsvService()
    {
        return $this->services['translation.loader.csv'] = new \Symfony\Component\Translation\Loader\CsvFileLoader();
    }
    protected function getTranslation_Loader_DatService()
    {
        return $this->services['translation.loader.dat'] = new \Symfony\Component\Translation\Loader\IcuResFileLoader();
    }
    protected function getTranslation_Loader_IniService()
    {
        return $this->services['translation.loader.ini'] = new \Symfony\Component\Translation\Loader\IniFileLoader();
    }
    protected function getTranslation_Loader_MoService()
    {
        return $this->services['translation.loader.mo'] = new \Symfony\Component\Translation\Loader\MoFileLoader();
    }
    protected function getTranslation_Loader_PhpService()
    {
        return $this->services['translation.loader.php'] = new \Symfony\Component\Translation\Loader\PhpFileLoader();
    }
    protected function getTranslation_Loader_PoService()
    {
        return $this->services['translation.loader.po'] = new \Symfony\Component\Translation\Loader\PoFileLoader();
    }
    protected function getTranslation_Loader_QtService()
    {
        return $this->services['translation.loader.qt'] = new \Symfony\Component\Translation\Loader\QtFileLoader();
    }
    protected function getTranslation_Loader_ResService()
    {
        return $this->services['translation.loader.res'] = new \Symfony\Component\Translation\Loader\IcuResFileLoader();
    }
    protected function getTranslation_Loader_XliffService()
    {
        return $this->services['translation.loader.xliff'] = new \Symfony\Component\Translation\Loader\XliffFileLoader();
    }
    protected function getTranslation_Loader_YmlService()
    {
        return $this->services['translation.loader.yml'] = new \Symfony\Component\Translation\Loader\YamlFileLoader();
    }
    protected function getTranslation_WriterService()
    {
        $this->services['translation.writer'] = $instance = new \Symfony\Component\Translation\Writer\TranslationWriter();
        $instance->addDumper('php', $this->get('translation.dumper.php'));
        $instance->addDumper('xlf', $this->get('translation.dumper.xliff'));
        $instance->addDumper('po', $this->get('translation.dumper.po'));
        $instance->addDumper('mo', $this->get('translation.dumper.mo'));
        $instance->addDumper('yml', $this->get('translation.dumper.yml'));
        $instance->addDumper('ts', $this->get('translation.dumper.qt'));
        $instance->addDumper('csv', $this->get('translation.dumper.csv'));
        $instance->addDumper('ini', $this->get('translation.dumper.ini'));
        $instance->addDumper('res', $this->get('translation.dumper.res'));
        return $instance;
    }
    protected function getTranslatorService()
    {
        return $this->services['translator'] = new \Symfony\Component\Translation\IdentityTranslator($this->get('translator.selector'));
    }
    protected function getTranslator_DefaultService()
    {
        return $this->services['translator.default'] = new \Symfony\Bundle\FrameworkBundle\Translation\Translator($this, $this->get('translator.selector'), array('translation.loader.php' => array(0 => 'php'), 'translation.loader.yml' => array(0 => 'yml'), 'translation.loader.xliff' => array(0 => 'xlf', 1 => 'xliff'), 'translation.loader.po' => array(0 => 'po'), 'translation.loader.mo' => array(0 => 'mo'), 'translation.loader.qt' => array(0 => 'ts'), 'translation.loader.csv' => array(0 => 'csv'), 'translation.loader.res' => array(0 => 'res'), 'translation.loader.dat' => array(0 => 'dat'), 'translation.loader.ini' => array(0 => 'ini')), array('cache_dir' => '/var/www/newscoop/cache/prod/translations', 'debug' => false));
    }
    protected function getTwigService()
    {
        $this->services['twig'] = $instance = new \Twig_Environment($this->get('twig.loader'), array('exception_controller' => 'Newscoop\\GimmeBundle\\Controller\\ExceptionController::showAction', 'debug' => false, 'strict_variables' => false, 'cache' => '/var/www/newscoop/cache/prod/twig', 'charset' => 'UTF-8', 'paths' => array()));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\TranslationExtension($this->get('translator')));
        $instance->addExtension(new \Symfony\Bundle\TwigBundle\Extension\AssetsExtension($this));
        $instance->addExtension(new \Symfony\Bundle\TwigBundle\Extension\ActionsExtension($this));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\CodeExtension(NULL, '/var/www/newscoop/application', 'UTF-8'));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\RoutingExtension($this->get('router')));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\YamlExtension());
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\HttpKernelExtension($this->get('fragment.handler')));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\FormExtension(new \Symfony\Bridge\Twig\Form\TwigRenderer(new \Symfony\Bridge\Twig\Form\TwigRendererEngine(array(0 => 'form_div_layout.html.twig')), $this->get('form.csrf_provider'))));
        $instance->addExtension(new \Doctrine\Bundle\DoctrineBundle\Twig\DoctrineExtension());
        $instance->addExtension(new \JMS\Serializer\Twig\SerializerExtension($this->get('jms_serializer')));
        $instance->addExtension($this->get('knp_paginator.twig.extension.pagination'));
        $instance->addGlobal('app', $this->get('templating.globals'));
        return $instance;
    }
    protected function getTwig_Controller_ExceptionService()
    {
        return $this->services['twig.controller.exception'] = new \Symfony\Bundle\TwigBundle\Controller\ExceptionController($this->get('twig'), false);
    }
    protected function getTwig_ExceptionListenerService()
    {
        return $this->services['twig.exception_listener'] = new \Symfony\Component\HttpKernel\EventListener\ExceptionListener('Newscoop\\GimmeBundle\\Controller\\ExceptionController::showAction', $this->get('monolog.logger.request'));
    }
    protected function getTwig_LoaderService()
    {
        $this->services['twig.loader'] = $instance = new \Symfony\Bundle\TwigBundle\Loader\FilesystemLoader($this->get('templating.locator'), $this->get('templating.name_parser'));
        $instance->addPath('/var/www/newscoop/vendor/symfony/symfony/src/Symfony/Bridge/Twig/Resources/views/Form');
        $instance->addPath('/var/www/newscoop/vendor/symfony/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/views', 'Framework');
        $instance->addPath('/var/www/newscoop/vendor/symfony/symfony/src/Symfony/Bundle/TwigBundle/Resources/views', 'Twig');
        $instance->addPath('/var/www/newscoop/vendor/doctrine/doctrine-bundle/Doctrine/Bundle/DoctrineBundle/Resources/views', 'Doctrine');
        $instance->addPath('/var/www/newscoop/vendor/knplabs/knp-paginator-bundle/Knp/Bundle/PaginatorBundle/Resources/views', 'KnpPaginator');
        $instance->addPath('/var/www/newscoop/vendor/noiselabs/smarty-bundle/NoiseLabs/Bundle/SmartyBundle/Resources/views', 'Smarty');
        return $instance;
    }
    protected function getTwig_Translation_ExtractorService()
    {
        return $this->services['twig.translation.extractor'] = new \Symfony\Bridge\Twig\Translation\TwigExtractor($this->get('twig'));
    }
    protected function getUriSignerService()
    {
        return $this->services['uri_signer'] = new \Symfony\Component\HttpKernel\UriSigner('pleaseChangeMe!pleaseChangeMe!');
    }
    protected function getUserService()
    {
        return $this->services['user'] = new \Newscoop\Services\UserService($this->get('doctrine.orm.default_entity_manager'), $this->get('zend_auth'));
    }
    protected function getUser_ListService()
    {
        return $this->services['user.list'] = new \Newscoop\Services\ListUserService(array('role' => '6', 'publication' => '5', 'issue' => '3', 'type' => 'bloginfo', 'article_type' => 'blog'), $this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getUser_SearchService()
    {
        return $this->services['user.search'] = new \Newscoop\Services\UserSearchService($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getUser_TokenService()
    {
        return $this->services['user.token'] = new \Newscoop\Services\UserTokenService($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getUser_TopicService()
    {
        return $this->services['user.topic'] = new \Newscoop\Services\UserTopicService($this->get('doctrine.orm.default_entity_manager'), $this->get('event_dispatcher'));
    }
    protected function getUserAttributesService()
    {
        return $this->services['user_attributes'] = new \Newscoop\Services\UserAttributeService($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getUserPointsService()
    {
        return $this->services['user_points'] = new \Newscoop\Services\UserPointsService($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getUserTypeService()
    {
        return $this->services['user_type'] = new \Newscoop\Services\UserTypeService($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getValidatorService()
    {
        return $this->services['validator'] = new \Symfony\Component\Validator\Validator($this->get('validator.mapping.class_metadata_factory'), new \Symfony\Bundle\FrameworkBundle\Validator\ConstraintValidatorFactory($this, array('doctrine.orm.validator.unique' => 'doctrine.orm.validator.unique')), $this->get('translator.default'), 'validators', array(0 => $this->get('doctrine.orm.validator_initializer')));
    }
    protected function getViewService()
    {
        return $this->services['view'] = call_user_func(array('Newscoop\\View\\ViewFactory', 'getView'));
    }
    protected function getView_Helper_RenditionService()
    {
        return $this->services['view.helper.rendition'] = new \Newscoop\Image\RenditionViewHelper($this->get('image'));
    }
    protected function getView_Helper_ThumbnailService()
    {
        return $this->services['view.helper.thumbnail'] = new \Newscoop\Image\ThumbnailViewHelper($this->get('image'));
    }
    protected function getWebcodeService()
    {
        return $this->services['webcode'] = new \Newscoop\WebcodeFacade($this->get('doctrine.orm.default_entity_manager'), $this->get('random'));
    }
    protected function getZendAuthService()
    {
        return $this->services['zend_auth'] = call_user_func(array('Zend_Auth', 'getInstance'));
    }
    protected function getZendRouterService()
    {
        return $this->services['zend_router'] = call_user_func(array('Newscoop\\Router\\RouterFactory', 'initRouter'), $this);
    }
    protected function getDatabaseConnectionService()
    {
        return $this->get('doctrine.dbal.default_connection');
    }
    protected function getDispatcherService()
    {
        return $this->get('event_dispatcher');
    }
    protected function getDoctrine_EmService()
    {
        return $this->get('doctrine.orm.default_entity_manager');
    }
    protected function getDoctrine_Orm_EntityManagerService()
    {
        return $this->get('doctrine.orm.default_entity_manager');
    }
    protected function getEmService()
    {
        return $this->get('doctrine.orm.default_entity_manager');
    }
    protected function getFosRest_InflectorService()
    {
        return $this->get('fos_rest.inflector.doctrine');
    }
    protected function getFosRest_RouterService()
    {
        return $this->get('router');
    }
    protected function getFosRest_SerializerService()
    {
        return $this->get('jms_serializer');
    }
    protected function getFosRest_TemplatingService()
    {
        return $this->get('templating');
    }
    protected function getSerializerService()
    {
        return $this->get('jms_serializer');
    }
    protected function getSession_StorageService()
    {
        return $this->get('session.storage.native');
    }
    protected function getSmarty_EngineService()
    {
        return $this->get('templating.engine.smarty');
    }
    protected function getSmartyEngineService()
    {
        return $this->get('templating.engine.smarty');
    }
    protected function getControllerNameConverterService()
    {
        return $this->services['controller_name_converter'] = new \Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser($this->get('kernel'));
    }
    protected function getJmsSerializer_UnserializeObjectConstructorService()
    {
        return $this->services['jms_serializer.unserialize_object_constructor'] = new \JMS\Serializer\Construction\UnserializeObjectConstructor();
    }
    protected function getRouter_RequestContextService()
    {
        return $this->services['router.request_context'] = new \Symfony\Component\Routing\RequestContext('', 'GET', 'localhost', 'http', 80, 443);
    }
    protected function getTemplating_Engine_TwigService()
    {
        $this->services['templating.engine.twig'] = $instance = new \Symfony\Bundle\TwigBundle\TwigEngine($this->get('twig'), $this->get('templating.name_parser'), $this->get('templating.locator'));
        $instance->setDefaultEscapingStrategy(array(0 => $instance, 1 => 'guessDefaultEscapingStrategy'));
        return $instance;
    }
    protected function getTemplating_LocatorService()
    {
        return $this->services['templating.locator'] = new \Symfony\Bundle\FrameworkBundle\Templating\Loader\TemplateLocator($this->get('file_locator'), '/var/www/newscoop/cache/prod');
    }
    protected function getTranslator_SelectorService()
    {
        return $this->services['translator.selector'] = new \Symfony\Component\Translation\MessageSelector();
    }
    protected function getValidator_Mapping_ClassMetadataFactoryService()
    {
        return $this->services['validator.mapping.class_metadata_factory'] = new \Symfony\Component\Validator\Mapping\ClassMetadataFactory(new \Symfony\Component\Validator\Mapping\Loader\LoaderChain(array(0 => new \Symfony\Component\Validator\Mapping\Loader\AnnotationLoader($this->get('annotation_reader')), 1 => new \Symfony\Component\Validator\Mapping\Loader\StaticMethodLoader(), 2 => new \Symfony\Component\Validator\Mapping\Loader\XmlFilesLoader(array(0 => '/var/www/newscoop/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/config/validation.xml')), 3 => new \Symfony\Component\Validator\Mapping\Loader\YamlFilesLoader(array()))), NULL);
    }
    public function getParameter($name)
    {
        $name = strtolower($name);
        if (!(isset($this->parameters[$name]) || array_key_exists($name, $this->parameters))) {
            throw new InvalidArgumentException(sprintf('The parameter "%s" must be defined.', $name));
        }
        return $this->parameters[$name];
    }
    public function hasParameter($name)
    {
        $name = strtolower($name);
        return isset($this->parameters[$name]) || array_key_exists($name, $this->parameters);
    }
    public function setParameter($name, $value)
    {
        throw new LogicException('Impossible to call set() on a frozen ParameterBag.');
    }
    public function getParameterBag()
    {
        if (null === $this->parameterBag) {
            $this->parameterBag = new FrozenParameterBag($this->parameters);
        }
        return $this->parameterBag;
    }
    protected function getDefaultParameters()
    {
        return array(
            'kernel.root_dir' => '/var/www/newscoop/application',
            'kernel.environment' => 'prod',
            'kernel.debug' => false,
            'kernel.name' => 'application',
            'kernel.cache_dir' => '/var/www/newscoop/cache/prod',
            'kernel.logs_dir' => '/var/www/newscoop/log',
            'kernel.bundles' => array(
                'FrameworkBundle' => 'Symfony\\Bundle\\FrameworkBundle\\FrameworkBundle',
                'TwigBundle' => 'Symfony\\Bundle\\TwigBundle\\TwigBundle',
                'MonologBundle' => 'Symfony\\Bundle\\MonologBundle\\MonologBundle',
                'DoctrineBundle' => 'Doctrine\\Bundle\\DoctrineBundle\\DoctrineBundle',
                'SensioFrameworkExtraBundle' => 'Sensio\\Bundle\\FrameworkExtraBundle\\SensioFrameworkExtraBundle',
                'JMSSerializerBundle' => 'JMS\\SerializerBundle\\JMSSerializerBundle',
                'FOSRestBundle' => 'FOS\\RestBundle\\FOSRestBundle',
                'NewscoopGimmeBundle' => 'Newscoop\\GimmeBundle\\NewscoopGimmeBundle',
                'KnpPaginatorBundle' => 'Knp\\Bundle\\PaginatorBundle\\KnpPaginatorBundle',
                'SmartyBundle' => 'NoiseLabs\\Bundle\\SmartyBundle\\SmartyBundle',
                'NewscoopZendBridgeBundle' => 'Newscoop\\ZendBridgeBundle\\NewscoopZendBridgeBundle',
                'NewscoopNewscoopBundle' => 'Newscoop\\NewscoopBundle\\NewscoopNewscoopBundle',
            ),
            'kernel.charset' => 'UTF-8',
            'kernel.container_class' => 'applicationProdProjectContainer',
            'smarty.class' => 'CampTemplate',
            'templating.engine.smarty.class' => 'Newscoop\\Smarty\\SmartyEngine',
            'application_path' => '/var/www/newscoop/application',
            'phpsettings' => array(
                'display_startup_errors' => '0',
                'display_errors' => '0',
            ),
            'includepaths' => array(
                'library' => '/var/www/newscoop/application/../library',
            ),
            'bootstrap' => array(
                'path' => '/var/www/newscoop/application/Bootstrap.php',
                'class' => 'Bootstrap',
            ),
            'appnamespace' => 'Application',
            'resources' => array(
                'frontController' => array(
                    'controllerDirectory' => '/var/www/newscoop/application/controllers',
                    'params' => array(
                        'displayExceptions' => '0',
                    ),
                    'moduleDirectory' => '/var/www/newscoop/application/modules',
                    'actionHelperPaths' => array(
                        'Action_Helper' => '/var/www/newscoop/application/controllers/helpers',
                    ),
                ),
                'layout' => array(
                    'layoutPath' => '/var/www/newscoop/application/layouts/scripts/',
                ),
                'view' => '',
                'modules' => array(
                    0 => '',
                ),
            ),
            'pluginpaths' => array(
                'Resource' => '/var/www/newscoop/application/../library/Resource',
            ),
            'session' => array(
                'cookie_path' => '/',
            ),
            'translation' => array(
                'path' => '/var/www/newscoop/application/languages',
            ),
            'rendition' => array(
                'theme_path' => '/../themes',
            ),
            'doctrine' => array(
                'cache' => 'array',
                'entity' => array(
                    'dir' => '/var/www/newscoop/application/../library/Newscoop',
                ),
                'proxy' => array(
                    'dir' => '/var/www/newscoop/application/../library/Proxy',
                    'namespace' => 'Proxy',
                    'autogenerate' => false,
                ),
                'functions' => array(
                    'rand' => 'Newscoop\\Query\\MysqlRandom',
                    'dayofweek' => 'Newscoop\\Query\\MysqlDayOfWeek',
                    'dayofmonth' => 'Newscoop\\Query\\MysqlDayOfMonth',
                    'dayofyear' => 'Newscoop\\Query\\MysqlDayOfYear',
                    'date_format' => 'Newscoop\\Query\\MysqlDateFormat',
                ),
            ),
            'admin' => array(
                'resources' => array(
                    'layout' => array(
                        'jsUrl' => '/js/app/admin',
                        'jsPath' => '/var/www/newscoop/application/../js/app/admin',
                        'layout' => 'admin',
                    ),
                    'acl' => array(
                        'modules' => array(
                            0 => 'admin',
                        ),
                        'cache' => 'Doctrine\\Common\\Cache\\ArrayCache',
                    ),
                    'view' => '',
                ),
            ),
            'autoloader' => array(
                'dirs' => array(
                    0 => '/var/www/newscoop/application/../classes',
                    1 => '/var/www/newscoop/application/../classes/Extension',
                    2 => '/var/www/newscoop/application/../template_engine/classes',
                    3 => '/var/www/newscoop/application/../template_engine/metaclasses',
                ),
            ),
            'resourcenames' => array(
                'Aliases' => 'alias',
                'ArticleAttachments' => 'article-attachment',
                'ArticleAuthors' => 'article-author',
                'ArticleImages' => 'article-image',
                'ArticlePublish' => 'article-publish',
                'Articles' => 'article',
                'ArticleTopics' => 'article-topic',
                'ArticleTypeMetadata' => 'article-metadata',
                'Attachments' => 'attachment',
                'AuditEvent' => 'audit-event',
                'AuthorAliases' => 'author-alias',
                'AuthorBiographies' => 'author-biography',
                'Authors' => 'author',
                'AuthorTypes' => 'author-type',
                'Countries' => 'county',
                'Images' => 'image',
                'Issues' => 'issue',
                'Languages' => 'language',
                'Locations' => 'location',
                'Maps' => 'map',
                'Plugins' => 'plugin',
                'Publication' => 'publication',
                'Sections' => 'section',
                'Subscriptions' => 'subscription',
                'SystemPreferences' => 'system-preferences',
                'Templates' => 'template',
                'Topics' => 'topic',
                'Translations' => 'translation',
            ),
            'auth' => array(
                'modules' => array(
                    0 => 'admin',
                ),
                'ignore' => array(
                    0 => 'auth',
                    1 => 'error',
                    2 => 'legacy',
                    3 => 'login.php',
                    4 => 'password_recovery.php',
                    5 => 'password_check_token.php',
                ),
            ),
            'acl' => array(
                'modules' => array(
                    0 => 'admin',
                ),
                'ignore' => array(
                    0 => 'auth',
                    1 => 'error',
                    2 => 'legacy',
                    3 => 'login.php',
                    4 => 'password_recovery.php',
                    5 => 'password_check_token.php',
                ),
            ),
            'email' => array(
                'from' => 'no-reply@domain.com',
                'contact' => 'info@domain.com',
            ),
            'ingest' => array(
                'path' => '',
            ),
            'ingest_publisher' => array(
                'article_type' => 'newswire',
                'section_other' => '20',
                'field' => array(
                    'NewsItemIdentifier' => 'getNewsItemId',
                    'NewsProduct' => 'getProduct',
                    'Status' => 'getStatus',
                    'Urgency' => 'getPriority',
                    'HeadLine' => 'getTitle',
                    'NewsLineText' => 'getCatchLine',
                    'DataLead' => 'getSummary',
                    'DataContent' => 'getContent',
                    'AuthorNames' => 'getAuthors',
                ),
                'image_path' => '',
            ),
            'blog' => array(
                'role' => '6',
                'publication' => '5',
                'issue' => '3',
                'type' => 'bloginfo',
                'article_type' => 'blog',
            ),
            'image' => array(
                'cache_url' => 'images/cache',
                'cache_path' => '/var/www/newscoop/application/../images/cache',
            ),
            'search' => array(
                'solr_server' => 'http://localhost:8983/solr',
            ),
            'storage' => array(
                'local_directory' => '/var/www/newscoop/application/..',
            ),
            'controller_resolver.class' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\ControllerResolver',
            'controller_name_converter.class' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\ControllerNameParser',
            'response_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\ResponseListener',
            'streamed_response_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\StreamedResponseListener',
            'locale_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\LocaleListener',
            'event_dispatcher.class' => 'Symfony\\Component\\EventDispatcher\\ContainerAwareEventDispatcher',
            'http_kernel.class' => 'Symfony\\Bundle\\FrameworkBundle\\HttpKernel',
            'filesystem.class' => 'Symfony\\Component\\Filesystem\\Filesystem',
            'cache_warmer.class' => 'Symfony\\Component\\HttpKernel\\CacheWarmer\\CacheWarmerAggregate',
            'cache_clearer.class' => 'Symfony\\Component\\HttpKernel\\CacheClearer\\ChainCacheClearer',
            'file_locator.class' => 'Symfony\\Component\\HttpKernel\\Config\\FileLocator',
            'uri_signer.class' => 'Symfony\\Component\\HttpKernel\\UriSigner',
            'fragment.handler.class' => 'Symfony\\Component\\HttpKernel\\Fragment\\FragmentHandler',
            'fragment.renderer.inline.class' => 'Symfony\\Component\\HttpKernel\\Fragment\\InlineFragmentRenderer',
            'fragment.renderer.hinclude.class' => 'Symfony\\Bundle\\FrameworkBundle\\Fragment\\ContainerAwareHIncludeFragmentRenderer',
            'fragment.renderer.hinclude.global_template' => NULL,
            'fragment.path' => '/_fragment',
            'translator.class' => 'Symfony\\Bundle\\FrameworkBundle\\Translation\\Translator',
            'translator.identity.class' => 'Symfony\\Component\\Translation\\IdentityTranslator',
            'translator.selector.class' => 'Symfony\\Component\\Translation\\MessageSelector',
            'translation.loader.php.class' => 'Symfony\\Component\\Translation\\Loader\\PhpFileLoader',
            'translation.loader.yml.class' => 'Symfony\\Component\\Translation\\Loader\\YamlFileLoader',
            'translation.loader.xliff.class' => 'Symfony\\Component\\Translation\\Loader\\XliffFileLoader',
            'translation.loader.po.class' => 'Symfony\\Component\\Translation\\Loader\\PoFileLoader',
            'translation.loader.mo.class' => 'Symfony\\Component\\Translation\\Loader\\MoFileLoader',
            'translation.loader.qt.class' => 'Symfony\\Component\\Translation\\Loader\\QtFileLoader',
            'translation.loader.csv.class' => 'Symfony\\Component\\Translation\\Loader\\CsvFileLoader',
            'translation.loader.res.class' => 'Symfony\\Component\\Translation\\Loader\\IcuResFileLoader',
            'translation.loader.dat.class' => 'Symfony\\Component\\Translation\\Loader\\IcuDatFileLoader',
            'translation.loader.ini.class' => 'Symfony\\Component\\Translation\\Loader\\IniFileLoader',
            'translation.dumper.php.class' => 'Symfony\\Component\\Translation\\Dumper\\PhpFileDumper',
            'translation.dumper.xliff.class' => 'Symfony\\Component\\Translation\\Dumper\\XliffFileDumper',
            'translation.dumper.po.class' => 'Symfony\\Component\\Translation\\Dumper\\PoFileDumper',
            'translation.dumper.mo.class' => 'Symfony\\Component\\Translation\\Dumper\\MoFileDumper',
            'translation.dumper.yml.class' => 'Symfony\\Component\\Translation\\Dumper\\YamlFileDumper',
            'translation.dumper.qt.class' => 'Symfony\\Component\\Translation\\Dumper\\QtFileDumper',
            'translation.dumper.csv.class' => 'Symfony\\Component\\Translation\\Dumper\\CsvFileDumper',
            'translation.dumper.ini.class' => 'Symfony\\Component\\Translation\\Dumper\\IniFileDumper',
            'translation.dumper.res.class' => 'Symfony\\Component\\Translation\\Dumper\\IcuResFileDumper',
            'translation.extractor.php.class' => 'Symfony\\Bundle\\FrameworkBundle\\Translation\\PhpExtractor',
            'translation.loader.class' => 'Symfony\\Bundle\\FrameworkBundle\\Translation\\TranslationLoader',
            'translation.extractor.class' => 'Symfony\\Component\\Translation\\Extractor\\ChainExtractor',
            'translation.writer.class' => 'Symfony\\Component\\Translation\\Writer\\TranslationWriter',
            'kernel.secret' => 'pleaseChangeMe!pleaseChangeMe!',
            'kernel.trusted_proxies' => array(
            ),
            'kernel.trust_proxy_headers' => false,
            'kernel.default_locale' => 'en',
            'session.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Session',
            'session.flashbag.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Flash\\FlashBag',
            'session.attribute_bag.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Attribute\\AttributeBag',
            'session.storage.native.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Storage\\NativeSessionStorage',
            'session.storage.mock_file.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Storage\\MockFileSessionStorage',
            'session.handler.native_file.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Storage\\Handler\\NativeFileSessionHandler',
            'session_listener.class' => 'Symfony\\Bundle\\FrameworkBundle\\EventListener\\SessionListener',
            'session.storage.options' => array(
            ),
            'session.save_path' => '/var/www/newscoop/cache/prod/sessions',
            'form.resolved_type_factory.class' => 'Symfony\\Component\\Form\\ResolvedFormTypeFactory',
            'form.registry.class' => 'Symfony\\Component\\Form\\FormRegistry',
            'form.factory.class' => 'Symfony\\Component\\Form\\FormFactory',
            'form.extension.class' => 'Symfony\\Component\\Form\\Extension\\DependencyInjection\\DependencyInjectionExtension',
            'form.type_guesser.validator.class' => 'Symfony\\Component\\Form\\Extension\\Validator\\ValidatorTypeGuesser',
            'property_accessor.class' => 'Symfony\\Component\\PropertyAccess\\PropertyAccessor',
            'form.csrf_provider.class' => 'Symfony\\Component\\Form\\Extension\\Csrf\\CsrfProvider\\SessionCsrfProvider',
            'form.type_extension.csrf.enabled' => true,
            'form.type_extension.csrf.field_name' => '_token',
            'templating.engine.delegating.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\DelegatingEngine',
            'templating.name_parser.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\TemplateNameParser',
            'templating.filename_parser.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\TemplateFilenameParser',
            'templating.cache_warmer.template_paths.class' => 'Symfony\\Bundle\\FrameworkBundle\\CacheWarmer\\TemplatePathsCacheWarmer',
            'templating.locator.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Loader\\TemplateLocator',
            'templating.loader.filesystem.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Loader\\FilesystemLoader',
            'templating.loader.cache.class' => 'Symfony\\Component\\Templating\\Loader\\CacheLoader',
            'templating.loader.chain.class' => 'Symfony\\Component\\Templating\\Loader\\ChainLoader',
            'templating.finder.class' => 'Symfony\\Bundle\\FrameworkBundle\\CacheWarmer\\TemplateFinder',
            'templating.engine.php.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\PhpEngine',
            'templating.helper.slots.class' => 'Symfony\\Component\\Templating\\Helper\\SlotsHelper',
            'templating.helper.assets.class' => 'Symfony\\Component\\Templating\\Helper\\CoreAssetsHelper',
            'templating.helper.actions.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\ActionsHelper',
            'templating.helper.router.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\RouterHelper',
            'templating.helper.request.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\RequestHelper',
            'templating.helper.session.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\SessionHelper',
            'templating.helper.code.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\CodeHelper',
            'templating.helper.translator.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\TranslatorHelper',
            'templating.helper.form.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\FormHelper',
            'templating.form.engine.class' => 'Symfony\\Component\\Form\\Extension\\Templating\\TemplatingRendererEngine',
            'templating.form.renderer.class' => 'Symfony\\Component\\Form\\FormRenderer',
            'templating.globals.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\GlobalVariables',
            'templating.asset.path_package.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Asset\\PathPackage',
            'templating.asset.url_package.class' => 'Symfony\\Component\\Templating\\Asset\\UrlPackage',
            'templating.asset.package_factory.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Asset\\PackageFactory',
            'templating.helper.code.file_link_format' => NULL,
            'templating.helper.form.resources' => array(
                0 => 'FrameworkBundle:Form',
            ),
            'templating.loader.cache.path' => NULL,
            'templating.engines' => array(
                0 => 'twig',
                1 => 'smarty',
            ),
            'validator.class' => 'Symfony\\Component\\Validator\\Validator',
            'validator.mapping.class_metadata_factory.class' => 'Symfony\\Component\\Validator\\Mapping\\ClassMetadataFactory',
            'validator.mapping.cache.apc.class' => 'Symfony\\Component\\Validator\\Mapping\\Cache\\ApcCache',
            'validator.mapping.cache.prefix' => '',
            'validator.mapping.loader.loader_chain.class' => 'Symfony\\Component\\Validator\\Mapping\\Loader\\LoaderChain',
            'validator.mapping.loader.static_method_loader.class' => 'Symfony\\Component\\Validator\\Mapping\\Loader\\StaticMethodLoader',
            'validator.mapping.loader.annotation_loader.class' => 'Symfony\\Component\\Validator\\Mapping\\Loader\\AnnotationLoader',
            'validator.mapping.loader.xml_files_loader.class' => 'Symfony\\Component\\Validator\\Mapping\\Loader\\XmlFilesLoader',
            'validator.mapping.loader.yaml_files_loader.class' => 'Symfony\\Component\\Validator\\Mapping\\Loader\\YamlFilesLoader',
            'validator.validator_factory.class' => 'Symfony\\Bundle\\FrameworkBundle\\Validator\\ConstraintValidatorFactory',
            'validator.mapping.loader.xml_files_loader.mapping_files' => array(
                0 => '/var/www/newscoop/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/config/validation.xml',
            ),
            'validator.mapping.loader.yaml_files_loader.mapping_files' => array(
            ),
            'validator.translation_domain' => 'validators',
            'fragment.listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\FragmentListener',
            'profiler.class' => 'Symfony\\Component\\HttpKernel\\Profiler\\Profiler',
            'profiler_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\ProfilerListener',
            'data_collector.config.class' => 'Symfony\\Component\\HttpKernel\\DataCollector\\ConfigDataCollector',
            'data_collector.request.class' => 'Symfony\\Component\\HttpKernel\\DataCollector\\RequestDataCollector',
            'data_collector.exception.class' => 'Symfony\\Component\\HttpKernel\\DataCollector\\ExceptionDataCollector',
            'data_collector.events.class' => 'Symfony\\Component\\HttpKernel\\DataCollector\\EventDataCollector',
            'data_collector.logger.class' => 'Symfony\\Component\\HttpKernel\\DataCollector\\LoggerDataCollector',
            'data_collector.time.class' => 'Symfony\\Component\\HttpKernel\\DataCollector\\TimeDataCollector',
            'data_collector.memory.class' => 'Symfony\\Component\\HttpKernel\\DataCollector\\MemoryDataCollector',
            'data_collector.router.class' => 'Symfony\\Bundle\\FrameworkBundle\\DataCollector\\RouterDataCollector',
            'profiler_listener.only_exceptions' => false,
            'profiler_listener.only_master_requests' => false,
            'profiler.storage.dsn' => 'file:/var/www/newscoop/cache/prod/profiler',
            'profiler.storage.username' => '',
            'profiler.storage.password' => '',
            'profiler.storage.lifetime' => 86400,
            'router.class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\Router',
            'router.request_context.class' => 'Symfony\\Component\\Routing\\RequestContext',
            'routing.loader.class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\DelegatingLoader',
            'routing.resolver.class' => 'Symfony\\Component\\Config\\Loader\\LoaderResolver',
            'routing.loader.xml.class' => 'Symfony\\Component\\Routing\\Loader\\XmlFileLoader',
            'routing.loader.yml.class' => 'Symfony\\Component\\Routing\\Loader\\YamlFileLoader',
            'routing.loader.php.class' => 'Symfony\\Component\\Routing\\Loader\\PhpFileLoader',
            'router.options.generator_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator',
            'router.options.generator_base_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator',
            'router.options.generator_dumper_class' => 'Symfony\\Component\\Routing\\Generator\\Dumper\\PhpGeneratorDumper',
            'router.options.matcher_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher',
            'router.options.matcher_base_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher',
            'router.options.matcher_dumper_class' => 'Symfony\\Component\\Routing\\Matcher\\Dumper\\PhpMatcherDumper',
            'router.cache_warmer.class' => 'Symfony\\Bundle\\FrameworkBundle\\CacheWarmer\\RouterCacheWarmer',
            'router.options.matcher.cache_class' => 'applicationProdUrlMatcher',
            'router.options.generator.cache_class' => 'applicationProdUrlGenerator',
            'router_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\RouterListener',
            'router.request_context.host' => 'localhost',
            'router.request_context.scheme' => 'http',
            'router.request_context.base_url' => '',
            'router.resource' => '/var/www/newscoop/application/configs/symfony/routing.yml',
            'router.cache_class_prefix' => 'applicationProd',
            'request_listener.http_port' => 80,
            'request_listener.https_port' => 443,
            'annotations.reader.class' => 'Doctrine\\Common\\Annotations\\AnnotationReader',
            'annotations.cached_reader.class' => 'Doctrine\\Common\\Annotations\\CachedReader',
            'annotations.file_cache_reader.class' => 'Doctrine\\Common\\Annotations\\FileCacheReader',
            'twig.class' => 'Twig_Environment',
            'twig.loader.filesystem.class' => 'Symfony\\Bundle\\TwigBundle\\Loader\\FilesystemLoader',
            'twig.loader.chain.class' => 'Twig_Loader_Chain',
            'templating.engine.twig.class' => 'Symfony\\Bundle\\TwigBundle\\TwigEngine',
            'twig.cache_warmer.class' => 'Symfony\\Bundle\\TwigBundle\\CacheWarmer\\TemplateCacheCacheWarmer',
            'twig.extension.trans.class' => 'Symfony\\Bridge\\Twig\\Extension\\TranslationExtension',
            'twig.extension.assets.class' => 'Symfony\\Bundle\\TwigBundle\\Extension\\AssetsExtension',
            'twig.extension.actions.class' => 'Symfony\\Bundle\\TwigBundle\\Extension\\ActionsExtension',
            'twig.extension.code.class' => 'Symfony\\Bridge\\Twig\\Extension\\CodeExtension',
            'twig.extension.routing.class' => 'Symfony\\Bridge\\Twig\\Extension\\RoutingExtension',
            'twig.extension.yaml.class' => 'Symfony\\Bridge\\Twig\\Extension\\YamlExtension',
            'twig.extension.form.class' => 'Symfony\\Bridge\\Twig\\Extension\\FormExtension',
            'twig.extension.httpkernel.class' => 'Symfony\\Bridge\\Twig\\Extension\\HttpKernelExtension',
            'twig.form.engine.class' => 'Symfony\\Bridge\\Twig\\Form\\TwigRendererEngine',
            'twig.form.renderer.class' => 'Symfony\\Bridge\\Twig\\Form\\TwigRenderer',
            'twig.translation.extractor.class' => 'Symfony\\Bridge\\Twig\\Translation\\TwigExtractor',
            'twig.exception_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\ExceptionListener',
            'twig.controller.exception.class' => 'Symfony\\Bundle\\TwigBundle\\Controller\\ExceptionController',
            'twig.exception_listener.controller' => 'Newscoop\\GimmeBundle\\Controller\\ExceptionController::showAction',
            'twig.form.resources' => array(
                0 => 'form_div_layout.html.twig',
            ),
            'twig.options' => array(
                'exception_controller' => 'Newscoop\\GimmeBundle\\Controller\\ExceptionController::showAction',
                'debug' => false,
                'strict_variables' => false,
                'cache' => '/var/www/newscoop/cache/prod/twig',
                'charset' => 'UTF-8',
                'paths' => array(
                ),
            ),
            'monolog.logger.class' => 'Symfony\\Bridge\\Monolog\\Logger',
            'monolog.gelf.publisher.class' => 'Gelf\\MessagePublisher',
            'monolog.handler.stream.class' => 'Monolog\\Handler\\StreamHandler',
            'monolog.handler.group.class' => 'Monolog\\Handler\\GroupHandler',
            'monolog.handler.buffer.class' => 'Monolog\\Handler\\BufferHandler',
            'monolog.handler.rotating_file.class' => 'Monolog\\Handler\\RotatingFileHandler',
            'monolog.handler.syslog.class' => 'Monolog\\Handler\\SyslogHandler',
            'monolog.handler.null.class' => 'Monolog\\Handler\\NullHandler',
            'monolog.handler.test.class' => 'Monolog\\Handler\\TestHandler',
            'monolog.handler.gelf.class' => 'Monolog\\Handler\\GelfHandler',
            'monolog.handler.firephp.class' => 'Symfony\\Bridge\\Monolog\\Handler\\FirePHPHandler',
            'monolog.handler.chromephp.class' => 'Symfony\\Bridge\\Monolog\\Handler\\ChromePhpHandler',
            'monolog.handler.debug.class' => 'Symfony\\Bridge\\Monolog\\Handler\\DebugHandler',
            'monolog.handler.swift_mailer.class' => 'Monolog\\Handler\\SwiftMailerHandler',
            'monolog.handler.native_mailer.class' => 'Monolog\\Handler\\NativeMailerHandler',
            'monolog.handler.socket.class' => 'Monolog\\Handler\\SocketHandler',
            'monolog.handler.pushover.class' => 'Monolog\\Handler\\PushoverHandler',
            'monolog.handler.fingers_crossed.class' => 'Monolog\\Handler\\FingersCrossedHandler',
            'monolog.handler.fingers_crossed.error_level_activation_strategy.class' => 'Monolog\\Handler\\FingersCrossed\\ErrorLevelActivationStrategy',
            'monolog.handlers_to_channels' => array(
                'monolog.handler.main' => NULL,
            ),
            'doctrine.dbal.logger.chain.class' => 'Doctrine\\DBAL\\Logging\\LoggerChain',
            'doctrine.dbal.logger.profiling.class' => 'Doctrine\\DBAL\\Logging\\DebugStack',
            'doctrine.dbal.logger.class' => 'Symfony\\Bridge\\Doctrine\\Logger\\DbalLogger',
            'doctrine.dbal.configuration.class' => 'Doctrine\\DBAL\\Configuration',
            'doctrine.data_collector.class' => 'Doctrine\\Bundle\\DoctrineBundle\\DataCollector\\DoctrineDataCollector',
            'doctrine.dbal.connection.event_manager.class' => 'Symfony\\Bridge\\Doctrine\\ContainerAwareEventManager',
            'doctrine.dbal.connection_factory.class' => 'Doctrine\\Bundle\\DoctrineBundle\\ConnectionFactory',
            'doctrine.dbal.events.mysql_session_init.class' => 'Doctrine\\DBAL\\Event\\Listeners\\MysqlSessionInit',
            'doctrine.dbal.events.oracle_session_init.class' => 'Doctrine\\DBAL\\Event\\Listeners\\OracleSessionInit',
            'doctrine.class' => 'Doctrine\\Bundle\\DoctrineBundle\\Registry',
            'doctrine.entity_managers' => array(
                'default' => 'doctrine.orm.default_entity_manager',
            ),
            'doctrine.default_entity_manager' => 'default',
            'doctrine.dbal.connection_factory.types' => array(
            ),
            'doctrine.connections' => array(
                'default' => 'doctrine.dbal.default_connection',
            ),
            'doctrine.default_connection' => 'default',
            'doctrine.orm.configuration.class' => 'Doctrine\\ORM\\Configuration',
            'doctrine.orm.entity_manager.class' => 'Doctrine\\ORM\\EntityManager',
            'doctrine.orm.manager_configurator.class' => 'Doctrine\\Bundle\\DoctrineBundle\\ManagerConfigurator',
            'doctrine.orm.cache.array.class' => 'Doctrine\\Common\\Cache\\ArrayCache',
            'doctrine.orm.cache.apc.class' => 'Doctrine\\Common\\Cache\\ApcCache',
            'doctrine.orm.cache.memcache.class' => 'Doctrine\\Common\\Cache\\MemcacheCache',
            'doctrine.orm.cache.memcache_host' => 'localhost',
            'doctrine.orm.cache.memcache_port' => 11211,
            'doctrine.orm.cache.memcache_instance.class' => 'Memcache',
            'doctrine.orm.cache.memcached.class' => 'Doctrine\\Common\\Cache\\MemcachedCache',
            'doctrine.orm.cache.memcached_host' => 'localhost',
            'doctrine.orm.cache.memcached_port' => 11211,
            'doctrine.orm.cache.memcached_instance.class' => 'Memcached',
            'doctrine.orm.cache.redis.class' => 'Doctrine\\Common\\Cache\\RedisCache',
            'doctrine.orm.cache.redis_host' => 'localhost',
            'doctrine.orm.cache.redis_port' => 6379,
            'doctrine.orm.cache.redis_instance.class' => 'Redis',
            'doctrine.orm.cache.xcache.class' => 'Doctrine\\Common\\Cache\\XcacheCache',
            'doctrine.orm.cache.wincache.class' => 'Doctrine\\Common\\Cache\\WinCacheCache',
            'doctrine.orm.cache.zenddata.class' => 'Doctrine\\Common\\Cache\\ZendDataCache',
            'doctrine.orm.metadata.driver_chain.class' => 'Doctrine\\ORM\\Mapping\\Driver\\DriverChain',
            'doctrine.orm.metadata.annotation.class' => 'Doctrine\\ORM\\Mapping\\Driver\\AnnotationDriver',
            'doctrine.orm.metadata.xml.class' => 'Doctrine\\ORM\\Mapping\\Driver\\SimplifiedXmlDriver',
            'doctrine.orm.metadata.yml.class' => 'Doctrine\\ORM\\Mapping\\Driver\\SimplifiedYamlDriver',
            'doctrine.orm.metadata.php.class' => 'Doctrine\\ORM\\Mapping\\Driver\\PHPDriver',
            'doctrine.orm.metadata.staticphp.class' => 'Doctrine\\ORM\\Mapping\\Driver\\StaticPHPDriver',
            'doctrine.orm.proxy_cache_warmer.class' => 'Symfony\\Bridge\\Doctrine\\CacheWarmer\\ProxyCacheWarmer',
            'form.type_guesser.doctrine.class' => 'Symfony\\Bridge\\Doctrine\\Form\\DoctrineOrmTypeGuesser',
            'doctrine.orm.validator.unique.class' => 'Symfony\\Bridge\\Doctrine\\Validator\\Constraints\\UniqueEntityValidator',
            'doctrine.orm.validator_initializer.class' => 'Symfony\\Bridge\\Doctrine\\Validator\\DoctrineInitializer',
            'doctrine.orm.security.user.provider.class' => 'Symfony\\Bridge\\Doctrine\\Security\\User\\EntityUserProvider',
            'doctrine.orm.listeners.resolve_target_entity.class' => 'Doctrine\\ORM\\Tools\\ResolveTargetEntityListener',
            'doctrine.orm.naming_strategy.default.class' => 'Doctrine\\ORM\\Mapping\\DefaultNamingStrategy',
            'doctrine.orm.naming_strategy.underscore.class' => 'Doctrine\\ORM\\Mapping\\UnderscoreNamingStrategy',
            'doctrine.orm.auto_generate_proxy_classes' => false,
            'doctrine.orm.proxy_dir' => '/var/www/newscoop/library/Proxy',
            'doctrine.orm.proxy_namespace' => 'Proxy',
            'sensio_framework_extra.view.guesser.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Templating\\TemplateGuesser',
            'sensio_framework_extra.controller.listener.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\EventListener\\ControllerListener',
            'sensio_framework_extra.routing.loader.annot_dir.class' => 'Symfony\\Component\\Routing\\Loader\\AnnotationDirectoryLoader',
            'sensio_framework_extra.routing.loader.annot_file.class' => 'Symfony\\Component\\Routing\\Loader\\AnnotationFileLoader',
            'sensio_framework_extra.routing.loader.annot_class.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Routing\\AnnotatedRouteControllerLoader',
            'sensio_framework_extra.converter.listener.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\EventListener\\ParamConverterListener',
            'sensio_framework_extra.converter.manager.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Request\\ParamConverter\\ParamConverterManager',
            'sensio_framework_extra.converter.doctrine.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Request\\ParamConverter\\DoctrineParamConverter',
            'sensio_framework_extra.converter.datetime.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Request\\ParamConverter\\DateTimeParamConverter',
            'jms_serializer.metadata.file_locator.class' => 'Metadata\\Driver\\FileLocator',
            'jms_serializer.metadata.annotation_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\AnnotationDriver',
            'jms_serializer.metadata.chain_driver.class' => 'Metadata\\Driver\\DriverChain',
            'jms_serializer.metadata.yaml_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\YamlDriver',
            'jms_serializer.metadata.xml_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\XmlDriver',
            'jms_serializer.metadata.php_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\PhpDriver',
            'jms_serializer.metadata.doctrine_type_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\DoctrineTypeDriver',
            'jms_serializer.metadata.lazy_loading_driver.class' => 'Metadata\\Driver\\LazyLoadingDriver',
            'jms_serializer.metadata.metadata_factory.class' => 'Metadata\\MetadataFactory',
            'jms_serializer.metadata.cache.file_cache.class' => 'Metadata\\Cache\\FileCache',
            'jms_serializer.event_dispatcher.class' => 'JMS\\Serializer\\EventDispatcher\\LazyEventDispatcher',
            'jms_serializer.camel_case_naming_strategy.class' => 'JMS\\Serializer\\Naming\\CamelCaseNamingStrategy',
            'jms_serializer.serialized_name_annotation_strategy.class' => 'JMS\\Serializer\\Naming\\SerializedNameAnnotationStrategy',
            'jms_serializer.cache_naming_strategy.class' => 'JMS\\Serializer\\Naming\\CacheNamingStrategy',
            'jms_serializer.doctrine_object_constructor.class' => 'JMS\\Serializer\\Construction\\DoctrineObjectConstructor',
            'jms_serializer.unserialize_object_constructor.class' => 'JMS\\Serializer\\Construction\\UnserializeObjectConstructor',
            'jms_serializer.version_exclusion_strategy.class' => 'JMS\\Serializer\\Exclusion\\VersionExclusionStrategy',
            'jms_serializer.serializer.class' => 'JMS\\Serializer\\Serializer',
            'jms_serializer.twig_extension.class' => 'JMS\\Serializer\\Twig\\SerializerExtension',
            'jms_serializer.templating.helper.class' => 'JMS\\SerializerBundle\\Templating\\SerializerHelper',
            'jms_serializer.json_serialization_visitor.class' => 'JMS\\Serializer\\JsonSerializationVisitor',
            'jms_serializer.json_serialization_visitor.options' => 0,
            'jms_serializer.json_deserialization_visitor.class' => 'JMS\\Serializer\\JsonDeserializationVisitor',
            'jms_serializer.xml_serialization_visitor.class' => 'JMS\\Serializer\\XmlSerializationVisitor',
            'jms_serializer.xml_deserialization_visitor.class' => 'JMS\\Serializer\\XmlDeserializationVisitor',
            'jms_serializer.xml_deserialization_visitor.doctype_whitelist' => array(
            ),
            'jms_serializer.yaml_serialization_visitor.class' => 'JMS\\Serializer\\YamlSerializationVisitor',
            'jms_serializer.handler_registry.class' => 'JMS\\Serializer\\Handler\\LazyHandlerRegistry',
            'jms_serializer.datetime_handler.class' => 'JMS\\Serializer\\Handler\\DateHandler',
            'jms_serializer.array_collection_handler.class' => 'JMS\\Serializer\\Handler\\ArrayCollectionHandler',
            'jms_serializer.php_collection_handler.class' => 'JMS\\Serializer\\Handler\\PhpCollectionHandler',
            'jms_serializer.form_error_handler.class' => 'JMS\\Serializer\\Handler\\FormErrorHandler',
            'jms_serializer.constraint_violation_handler.class' => 'JMS\\Serializer\\Handler\\ConstraintViolationHandler',
            'jms_serializer.doctrine_proxy_subscriber.class' => 'JMS\\Serializer\\EventDispatcher\\Subscriber\\DoctrineProxySubscriber',
            'fos_rest.serializer.exclusion_strategy.version' => '',
            'fos_rest.serializer.exclusion_strategy.groups' => '',
            'fos_rest.routing.loader.controller.class' => 'FOS\\RestBundle\\Routing\\Loader\\RestRouteLoader',
            'fos_rest.routing.loader.yaml_collection.class' => 'FOS\\RestBundle\\Routing\\Loader\\RestYamlCollectionLoader',
            'fos_rest.routing.loader.xml_collection.class' => 'FOS\\RestBundle\\Routing\\Loader\\RestXmlCollectionLoader',
            'fos_rest.routing.loader.processor.class' => 'FOS\\RestBundle\\Routing\\Loader\\RestRouteProcessor',
            'fos_rest.routing.loader.reader.controller.class' => 'FOS\\RestBundle\\Routing\\Loader\\Reader\\RestControllerReader',
            'fos_rest.routing.loader.reader.action.class' => 'FOS\\RestBundle\\Routing\\Loader\\Reader\\RestActionReader',
            'fos_rest.format_negotiator.class' => 'FOS\\Rest\\Util\\FormatNegotiator',
            'fos_rest.inflector.class' => 'FOS\\RestBundle\\Util\\Inflector\\DoctrineInflector',
            'fos_rest.request.param_fetcher.class' => 'FOS\\RestBundle\\Request\\ParamFetcher',
            'fos_rest.request.param_fetcher.reader.class' => 'FOS\\RestBundle\\Request\\ParamReader',
            'fos_rest.cache_dir' => '/var/www/newscoop/cache/prod/fos_rest',
            'fos_rest.formats' => array(
                'json' => false,
                'xml' => false,
                'html' => true,
            ),
            'fos_rest.default_engine' => 'twig',
            'fos_rest.force_redirects' => array(
                'html' => 302,
            ),
            'fos_rest.failed_validation' => 400,
            'fos_rest.empty_content' => 204,
            'fos_rest.serialize_null' => false,
            'fos_rest.view_response_listener.force_view' => true,
            'fos_rest.routing.loader.default_format' => NULL,
            'fos_rest.routing.loader.include_format' => true,
            'fos_rest.exception.codes' => array(
                'Symfony\\Component\\Routing\\Exception\\ResourceNotFoundException' => 404,
                'Doctrine\\ORM\\OptimisticLockException' => 409,
                'Symfony\\Component\\HttpKernel\\Exception\\FlattenException' => 404,
                'Symfony\\Component\\Routing\\Exception\\MethodNotAllowedException' => 404,
                'Symfony\\Component\\HttpKernel\\Exception\\NotFoundHttpException' => 404,
            ),
            'fos_rest.exception.messages' => array(
                'Symfony\\Component\\Routing\\Exception\\ResourceNotFoundException' => true,
                'Doctrine\\ORM\\OptimisticLockException' => true,
                'Symfony\\Component\\Routing\\Exception\\MethodNotAllowedException' => true,
                'Symfony\\Component\\HttpKernel\\Exception\\FlattenException' => true,
                'Symfony\\Component\\HttpKernel\\Exception\\NotFoundHttpException' => true,
            ),
            'fos_rest.decoders' => array(
                'json' => 'fos_rest.decoder.json',
            ),
            'fos_rest.default_priorities' => array(
                0 => 'json',
                1 => 'html',
            ),
            'fos_rest.prefer_extension' => true,
            'fos_rest.fallback_format' => 'json',
            'fos_rest.mime_types' => array(
                'json' => array(
                    0 => 'application/json',
                    1 => 'application/x-json',
                    2 => 'application/vnd.example-com.foo+json',
                ),
            ),
            'fos_rest.allowed_methods_listener.class' => 'FOS\\RestBundle\\EventListener\\AllowedMethodsListener',
            'fos_rest.allowed_methods_loader.class' => 'FOS\\RestBundle\\Response\\AllowedMethodsLoader\\AllowedMethodsRouterLoader',
            'newscoop.gimme.allow_origin' => array(
                0 => '*',
            ),
            'knp_paginator.class' => 'Knp\\Component\\Pager\\Paginator',
            'knp_paginator.template.pagination' => 'KnpPaginatorBundle:Pagination:sliding.html.twig',
            'knp_paginator.template.filtration' => 'KnpPaginatorBundle:Pagination:filtration.html.twig',
            'knp_paginator.template.sortable' => 'KnpPaginatorBundle:Pagination:sortable_link.html.twig',
            'knp_paginator.page_range' => 5,
            'smarty.class_file' => 'Smarty.class.php',
            'smarty.extension.core.class' => 'NoiseLabs\\Bundle\\SmartyBundle\\Extension\\CoreExtension',
            'smarty.extension.actions.class' => 'NoiseLabs\\Bundle\\SmartyBundle\\Extension\\ActionsExtension',
            'smarty.extension.assets.class' => 'NoiseLabs\\Bundle\\SmartyBundle\\Extension\\AssetsExtension',
            'smarty.extension.routing.class' => 'Newscoop\\NewscoopBundle\\Extension\\RoutingExtension',
            'smarty.extension.security.class' => 'NoiseLabs\\Bundle\\SmartyBundle\\Extension\\SecurityExtension',
            'smarty.extension.trans.class' => 'NoiseLabs\\Bundle\\SmartyBundle\\Extension\\TranslationExtension',
            'smarty.templating.finder.class' => 'NoiseLabs\\Bundle\\SmartyBundle\\CacheWarmer\\SmartyTemplateFinder',
            'smarty.cache_warmer.class' => 'NoiseLabs\\Bundle\\SmartyBundle\\CacheWarmer\\SmartyCacheWarmer',
            'smarty.options' => array(
                'caching' => false,
                'left_delimiter' => '{{',
                'right_delimiter' => '}}',
                'cache_dir' => '/var/www/newscoop/cache/prod/smarty/cache',
                'compile_dir' => '/var/www/newscoop/cache/prod/smarty/templates_c',
                'config_dir' => '/var/www/newscoop/application/config/smarty',
                'default_resource_type' => 'file',
                'template_dir' => '/var/www/newscoop/application/Resources/views',
                'use_include_path' => false,
                'use_sub_dirs' => true,
            ),
            'smarty.assetic' => false,
            'smarty.bootstrap' => false,
            'smarty.extension.form.class' => 'NoiseLabs\\Bundle\\SmartyBundle\\Extension\\FormExtension',
            'smarty.form.engine.class' => 'NoiseLabs\\Bundle\\SmartyBundle\\Form\\SmartyRendererEngine',
            'smarty.form.renderer.class' => 'NoiseLabs\\Bundle\\SmartyBundle\\Form\\SmartyRenderer',
            'smarty.form.resources' => array(
                0 => 'form_div_layout.html.tpl',
            ),
            'smarty.menu' => false,
            'data_collector.templates' => array(
                'data_collector.config' => array(
                    0 => 'config',
                    1 => '@WebProfiler/Collector/config.html.twig',
                ),
                'data_collector.request' => array(
                    0 => 'request',
                    1 => '@WebProfiler/Collector/request.html.twig',
                ),
                'data_collector.exception' => array(
                    0 => 'exception',
                    1 => '@WebProfiler/Collector/exception.html.twig',
                ),
                'data_collector.events' => array(
                    0 => 'events',
                    1 => '@WebProfiler/Collector/events.html.twig',
                ),
                'data_collector.logger' => array(
                    0 => 'logger',
                    1 => '@WebProfiler/Collector/logger.html.twig',
                ),
                'data_collector.time' => array(
                    0 => 'time',
                    1 => '@WebProfiler/Collector/time.html.twig',
                ),
                'data_collector.memory' => array(
                    0 => 'memory',
                    1 => '@WebProfiler/Collector/memory.html.twig',
                ),
                'data_collector.router' => array(
                    0 => 'router',
                    1 => '@WebProfiler/Collector/router.html.twig',
                ),
                'data_collector.doctrine' => array(
                    0 => 'db',
                    1 => 'DoctrineBundle:Collector:db',
                ),
            ),
        );
    }
}