<?php
/**
 * @package Newscoop
 * @copyright 2011 Sourcefabric o.p.s.
 * @license http://www.gnu.org/licenses/gpl.txt
 */

namespace Newscoop\Entity\Acl;

use Doctrine\ORM\Mapping AS ORM;
use Resource\Acl\RuleInterface;

/**
 * Rule entity
 * @ORM\Entity(repositoryClass="Newscoop\Entity\Repository\Acl\RuleRepository")
 * @ORM\Table(name="acl_rule")
 */
class Rule implements RuleInterface
{
    const ALLOW = 'allow';
    const DENY = 'deny';

    /**
     * @ORM\Id @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column
     * @var string
     */
    private $type;

    /** @var array */
    private $types = array(self::ALLOW, self::DENY);

    /**
     * @ORM\ManyToOne(targetEntity="Newscoop\Entity\Acl\Role", inversedBy="rules")
     * @var Newscoop\Entity\Acl\Role
     */
    private $role;

    /**
     * @ORM\Column(length=80)
     * @var string
     */
    private $resource;

    /**
     * @ORM\Column(length=80)
     * @var string
     */
    private $action;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Newscoop\Entity\Acl\Rule
     * @throws InvalidArgumentException
     */
    public function setType($type)
    {
        $type = strtolower((string) $type);
        if (!in_array($type, $this->types)) {
            throw new \InvalidArgumentException("Rule type '$type' not allowed.");
        }

        $this->type = (string) $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set role
     *
     * @param Newscoop\Entity\Acl\Role $role
     * @return Newscoop\Entity\Acl\Rule
     */
    public function setRole(Role $role)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * Get role id
     *
     * @return int
     */
    public function getRoleId()
    {
        return $this->role->getId();
    }

    /**
     * Set resource
     *
     * @param string $resource
     * @return Newscoop\Entity\Acl\Rule
     */
    public function setResource($resource)
    {
        $this->resource = (string) $resource;
        return $this;
    }

    /**
     * Get resource
     *
     * @return string|NULL
     */
    public function getResource()
    {
        return empty($this->resource) ? NULL : $this->resource;
    }

    /**
     * Set action
     *
     * @param string $action
     * @return Newscoop\Entity\Acl\Rule
     */
    public function setAction($action)
    {
        $this->action = (string) $action;
        return $this;
    }

    /**
     * Get action
     *
     * @return string
     */
    public function getAction()
    {
        return empty($this->action) ? NULL : $this->action;
    }
}
