<?php
/**
 * @package Campsite
 */

/**
 * Includes
 */
require_once($GLOBALS['g_campsiteDir'].'/classes/Subscription.php');
require_once($GLOBALS['g_campsiteDir'].'/classes/Language.php');
require_once($GLOBALS['g_campsiteDir'].'/template_engine/metaclasses/MetaDbObject.php');
require_once($GLOBALS['g_campsiteDir'].'/template_engine/classes/CampTemplate.php');

/**
 * @package Campsite
 */
final class MetaSubscription extends MetaDbObject {

    public function __construct($p_subscriptionId = null)
    {
        $this->m_dbObject = new Subscription($p_subscriptionId);
        if (!$this->m_dbObject->exists()) {
            $this->m_dbObject = new Subscription();
        }

        $this->m_properties['identifier'] = 'Id';
        $this->m_properties['currency'] = 'Currency';

        $this->m_customProperties['type'] = 'getType';
        $this->m_customProperties['start_date'] = 'getStartDate';
        $this->m_customProperties['expiration_date'] = 'getExpirationDate';
        $this->m_customProperties['is_active'] = 'isActive';
        $this->m_customProperties['is_valid'] = 'isValid';
        $this->m_customProperties['publication'] = 'getPublication';
        $this->m_customProperties['defined'] = 'defined';
    } // fn __construct


    protected function getType()
    {
        $type = $this->m_dbObject->getType();
        return $type == 'T' ? 'trial' : 'paid';
    }


    protected function getStartDate() {
        $startDate = null;
        $sections = SubscriptionSection::GetSubscriptionSections($this->m_dbObject->getSubscriptionId());
        foreach ($sections as $section) {
            $sectionStartDate = $section->getStartDate();
            if ($sectionStartDate < $startDate || is_null($startDate)) {
                $startDate = $sectionStartDate;
            }
        }
        return $startDate;
    }


    protected function getExpirationDate() {
        $expirationDate = null;
        $sections = SubscriptionSection::GetSubscriptionSections($this->m_dbObject->getSubscriptionId());
        foreach ($sections as $section) {
            $sectionExpDate = $section->getExpirationDate();
            if ($sectionExpDate > $expirationDate) {
                $expirationDate = $sectionExpDate;
            }
        }
        return $expirationDate;
    }


    protected function isActive()
    {
        return (int)$this->m_dbObject->isActive();
    }


    protected function isValid() {
        $expirationDate = $this->getExpirationDate();
        $today = new Date(time());
        return (int)($this->isActive() && $expirationDate >= $today->getDate());
    }


    protected function getPublication() {
        return new MetaPublication($this->m_dbObject->getPublicationId());
    }


    public function has_section($p_sectionNumber) {
        $today = new Date(time());

        $subscriptionId = $this->m_dbObject->getSubscriptionId();
        $section = new SubscriptionSection($subscriptionId, $p_sectionNumber, 0);
        if ($section->exists() && $section->getExpirationDate() >= $today->getDate()) {
            return (int)true;
        }
        $currentLanguageNumber = CampTemplate::singleton()->context()->language->number;
        $section = new SubscriptionSection($subscriptionId, $p_sectionNumber, $currentLanguageNumber);
        return (int)($section->exists() && $section->getExpirationDate() >= $today->getDate());
    }

    public function has_article($articleNumber) {
        $container = \Zend_Registry::get('container');
        $today = new Date(time());
        $currentLanguageNumber = CampTemplate::singleton()->context()->language->number;
        $subscriptionId = $this->m_dbObject->getSubscriptionId();

        $subscriptionArticle = $container->getService('em')
            ->getRepository('Newscoop\Subscription\Article')
            ->findOneBy(array(
                'subscription' => $subscriptionId,
                'articleNumber' => $articleNumber,
                'language' => $currentLanguageNumber
            ));
        
        if ($subscriptionArticle) {
            if ($subscriptionArticle->getExpirationDate() >= $today->getDate()) {
                return (int) true;
            }
        }

        return (int) false;
    }

    public function has_issue($issueNumber) {
        $container = \Zend_Registry::get('container');
        $today = new Date(time());
        $currentLanguageNumber = CampTemplate::singleton()->context()->language->number;
        $subscriptionId = $this->m_dbObject->getSubscriptionId();

        $subscriptionIssue = $container->getService('em')
            ->getRepository('Newscoop\Subscription\Issue')
            ->findOneBy(array(
                'subscription' => $subscriptionId,
                'issueNumber' => $issueNumber,
                'language' => $currentLanguageNumber
            ));
        
        if ($subscriptionIssue) {
            if ($subscriptionIssue->getExpirationDate() >= $today->getDate()) {
                return (int) true;
            }
        }

        return (int) false;
    }

} // class MetaSubscription

?>