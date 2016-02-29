<?php
/**
 * @package Campsite
 */

/**
 * Includes
 */
require_once(dirname(__FILE__) . '/DatabaseObject.php');

/**
 * @package Campsite
 */
class RequestObject extends DatabaseObject {
	var $m_keyColumnNames = array('object_id');
	var $m_keyIsAutoIncrement = true;
	var $m_dbTableName = 'RequestObjects';
	var $m_columnNames = array('object_id',
	                           'object_type_id',
	                           'request_count');

	public function __construct($p_objectId = null)
	{
        if (!is_null($p_objectId) && !empty($p_objectId)) {
            $this->m_data['object_id'] = $p_objectId;
            $this->fetch();
        }
	} // constructor


    /**
     * @return integer
     */
    public function getObjectId()
    {
        return $this->m_data['object_id'];
    } // fn getObjectId


    /**
     * @return integer
     */
    public function getObjectTypeId()
    {
        return $this->m_data['object_type_id'];
    } // fn getObjectTypeId


    public function getRequestCount()
    {
        if( isset($this->m_data['request_count']) )
    	    return $this->m_data['request_count'];
        else
            return 0;
    }


    public function updateRequestCount()
    {
        global $g_ado_db;
    	
        if (!$this->exists()) {
    		return false;
    	}
    	$objectRequestCount = RequestStats::GetObjectRequestCount($this->getObjectId());
    	return $this->setProperty('request_count', $objectRequestCount);
    }
} // class RequestObject

?>
