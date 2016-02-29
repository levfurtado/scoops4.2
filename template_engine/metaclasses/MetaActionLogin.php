<?php

define('ACTION_LOGIN_ERR_NO_USER_NAME', 'action_login_err_no_user_name');
define('ACTION_LOGIN_ERR_NO_PASSWORD', 'action_login_err_no_password');
define('ACTION_LOGIN_ERR_INVALID_CREDENTIALS', 'action_login_err_invalid_credentials');

class MetaActionLogin extends MetaAction
{
    private $m_user;


    /**
     * Reads the input parameters and sets up the login action.
     *
     * @param array $p_input
     */
    public function __construct(array $p_input)
    {
        $this->m_defined = true;
        $this->m_name = 'login';
        if (!isset($p_input['f_login_uname']) || empty($p_input['f_login_uname'])) {
            $this->m_error = new PEAR_Error('The user name was not filled in.',
            ACTION_LOGIN_ERR_NO_USER_NAME);
            return;
        }
        $this->m_properties['user_name'] = $p_input['f_login_uname'];
        if (!isset($p_input['f_login_password'])) {
            $this->m_error = new PEAR_Error('The password was not filled in.',
            ACTION_LOGIN_ERR_NO_PASSWORD);
            return;
        }

        global $controller;
        $adapter = $controller->getHelper('service')->direct('auth.adapter');
        $adapter->setUsername($p_input['f_login_uname']);
        $adapter->setPassword($p_input['f_login_password']);
        $result = Zend_Auth::getInstance()->authenticate($adapter);

        if ($result->getCode() != Zend_Auth_Result::SUCCESS) {
            $this->m_error = new PEAR_Error('Invalid user credentials', ACTION_LOGIN_ERR_INVALID_CREDENTIALS);
            return;
        }

        $this->m_error = ACTION_OK;
        $this->m_properties['remember_user'] = !empty($p_input['f_login_rememberuser']);
        $this->m_user = $controller->getHelper('service')->direct('user')->getCurrentUser();
    }


    /**
     * Performs the action; returns true on success, false on error.
     *
     * @param $p_context - the current context object
     * @return bool
     */
    public function takeAction(CampContext &$p_context)
    {
        $p_context->default_url->reset_parameter('f_'.$this->m_name);
        $p_context->url->reset_parameter('f_'.$this->m_name);

        $p_context->default_url->reset_parameter('f_login_uname');
        $p_context->url->reset_parameter('f_login_uname');
        $p_context->default_url->reset_parameter('f_login_password');
        $p_context->url->reset_parameter('f_login_password');

        if (!is_int($this->m_error) || $this->m_error != ACTION_OK) {
            return false;
        }
        $time = $this->m_properties['remember_user'] ? time() + 14 * 24 * 3600 : null;

        $p_context->user = new MetaUser($this->m_user);
        return true;
    }
}

?>
