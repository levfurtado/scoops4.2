<?php

namespace Proxy\__CG__\Newscoop\Entity\Ingest\Feed;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class Entry extends \Newscoop\Entity\Ingest\Feed\Entry implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    /** @private */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["id"];
        }
        $this->__load();
        return parent::getId();
    }

    public function getTitle()
    {
        $this->__load();
        return parent::getTitle();
    }

    public function getContent()
    {
        $this->__load();
        return parent::getContent();
    }

    public function setPublished(\DateTime $published)
    {
        $this->__load();
        return parent::setPublished($published);
    }

    public function getPublished()
    {
        $this->__load();
        return parent::getPublished();
    }

    public function isPublished()
    {
        $this->__load();
        return parent::isPublished();
    }

    public function getCreated()
    {
        $this->__load();
        return parent::getCreated();
    }

    public function getUpdated()
    {
        $this->__load();
        return parent::getUpdated();
    }

    public function getPriority()
    {
        $this->__load();
        return parent::getPriority();
    }

    public function getFeed()
    {
        $this->__load();
        return parent::getFeed();
    }

    public function setFeed(\Newscoop\Entity\Ingest\Feed $feed)
    {
        $this->__load();
        return parent::setFeed($feed);
    }

    public function getService()
    {
        $this->__load();
        return parent::getService();
    }

    public function getSummary()
    {
        $this->__load();
        return parent::getSummary();
    }

    public function getLanguage()
    {
        $this->__load();
        return parent::getLanguage();
    }

    public function getSubject()
    {
        $this->__load();
        return parent::getSubject();
    }

    public function getCountry()
    {
        $this->__load();
        return parent::getCountry();
    }

    public function getProduct()
    {
        $this->__load();
        return parent::getProduct();
    }

    public function getSubtitle()
    {
        $this->__load();
        return parent::getSubtitle();
    }

    public function getProviderId()
    {
        $this->__load();
        return parent::getProviderId();
    }

    public function getDateId()
    {
        $this->__load();
        return parent::getDateId();
    }

    public function getNewsItemId()
    {
        $this->__load();
        return parent::getNewsItemId();
    }

    public function getRevisionId()
    {
        $this->__load();
        return parent::getRevisionId();
    }

    public function getLocation()
    {
        $this->__load();
        return parent::getLocation();
    }

    public function getProvider()
    {
        $this->__load();
        return parent::getProvider();
    }

    public function getSource()
    {
        $this->__load();
        return parent::getSource();
    }

    public function getCatchLine()
    {
        $this->__load();
        return parent::getCatchLine();
    }

    public function getCatchWord()
    {
        $this->__load();
        return parent::getCatchWord();
    }

    public function getAuthors()
    {
        $this->__load();
        return parent::getAuthors();
    }

    public function getImages()
    {
        $this->__load();
        return parent::getImages();
    }

    public function getStatus()
    {
        $this->__load();
        return parent::getStatus();
    }

    public function getEmbargoed()
    {
        $this->__load();
        return parent::getEmbargoed();
    }

    public function setArticleNumber($articleNumber)
    {
        $this->__load();
        return parent::setArticleNumber($articleNumber);
    }

    public function getArticleNumber()
    {
        $this->__load();
        return parent::getArticleNumber();
    }

    public function update(\Newscoop\Ingest\Parser $parser)
    {
        $this->__load();
        return parent::update($parser);
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'title', 'updated', 'author', 'content', 'summary', 'category', 'created', 'published', 'embargoed', 'status', 'priority', 'date_id', 'news_item_id', 'attributes', 'feed');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields AS $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}