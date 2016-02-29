<?php
/**
 * @package Newscoop
 * @copyright 2011 Sourcefabric o.p.s.
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 */
class ErrorController extends Zend_Controller_Action
{
    public function init()
    {
        camp_load_translation_strings('bug_reporting');
    }

    /**
     * Forward to legacy controller if controller/action not found
     */
    public function preDispatch()
    {
        $errors = $this->_getParam('error_handler');
        if (!$errors) {
            return;
        }

        $notFound = array(
            Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER,
            //Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION,
        );

        if (in_array($errors->type, $notFound)) { // handle with old code
            $errors = null;
            $this->_forward('index', 'legacy', $this->_getParam('module'), array(
                'errors' => $errors,
            ));
        }
    }

    public function errorAction()
    {
        if (defined('APPLICATION_ENV') && APPLICATION_ENV == 'development') {
            $this->_helper->layout->disableLayout(); // allow debuging
        }

        $errors = $this->_getParam('error_handler');
        $request = $this->getRequest();

        if (!$errors) {
            $this->view->message = getGS('You have reached the error page');
            return;
        }

        switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                // 404 error -- controller or action not found
                $this->getResponse()->setHttpResponseCode(404);
                $priority = Zend_Log::NOTICE;
                $this->view->message = getGS('Page not found');
                break;
            default:
                // application error
                $this->getResponse()->setHttpResponseCode(500);
                $priority = Zend_Log::CRIT;
                $this->view->message = getGS('Application error');
                break;
        }

        // Log exception, if logger available
        if ($log = $this->getLog()) {
            $params = $request->getParams();
            $log->log(sprintf("%s (Params: %s)", $this->view->message, json_encode($request->getParams())), $priority, $errors->exception);
        }

        if (defined('APPLICATION_ENV') && APPLICATION_ENV == 'development') {
            // conditionally display exceptions
            if ($this->getInvokeArg('displayExceptions') == true) {
                $this->view->exception = $errors->exception;
            }
        
            $this->view->request = $errors->request;
            $this->view->errors = $errors;
        }
    }

    public function getLog()
    {
        $bootstrap = $this->getInvokeArg('bootstrap');
        if (!$bootstrap->hasResource('Log')) {
            return false;
        }

        $log = $bootstrap->getResource('Log');
        return $log;
    }
}
