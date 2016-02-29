<?php
/**
 * @package Newscoop
 * @copyright 2011 Sourcefabric o.p.s.
 * @license http://www.gnu.org/licenses/gpl.txt
 */

namespace Newscoop\Auth;

use Doctrine\ORM\EntityRepository,
    Zend_Auth_Adapter_Interface,
    Zend_Auth_Result;

/**
 * Auth adapter
 */
class Adapter implements Zend_Auth_Adapter_Interface
{
    /** @var Doctrine\ORM\EntityRepository */
    private $repository;

    /** @var string */
    private $username;

    /** @var string */
    private $password;

    /**
     * @param Doctrine\ORM\EntityRepository
     * @param string $username
     * @param string $password
     */
    public function __construct(EntityRepository $repository, $username, $password)
    {
        $this->repository = $repository;
        $this->username = (string) $username;
        $this->password = (string) $password;
    }

    /**
     * Authenticate user
     *
     * @return Zend_Auth_Result
     */
    public function authenticate()
    {
        $user = $this->repository->findOneBy(array(
            'username' => $this->username,
            'password' => sha1($this->password),
        ));

        $code = $user ?
            Zend_Auth_Result::SUCCESS : Zend_Auth_Result::FAILURE;

        return new Zend_Auth_Result($code, $user ? $user->getId() : NULL);
    }
}
