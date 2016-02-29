<?php
/**
 * @package Newscoop
 * @copyright 2011 Sourcefabric o.p.s.
 * @license http://www.gnu.org/licenses/gpl.txt
 */

namespace Newscoop\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Newscoop\Utils\Validation;

/**
 * @ORM\Entity(repositoryClass="Newscoop\Entity\Repository\UserPointsRepository")
 * @ORM\Table(name="user_points_index")
 */
class UserPoints
{
    /**
     * @ORM\Id 
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer",unique=true,name="id")
     */
    private $id;

    /**
     * @ORM\Column(type="string",unique=true,name="action")
     */
    private $action;

    /**
     * @ORM\Column(type="string",unique=true,name="name")
     */
    private $name;

    /**
     * @ORM\Column(type="integer",unique=false,name="points")
     */
    private $points;


    /**
     * Get action
     *
     * @return string
     */
    public function getAction() {
        return (string) $this->action;
    }

    /**
     * Set action
     *
     * @param int $action
     * @return Newscoop\Entity\UserPoints
     */
    public function setAction($action) {
        $this->action = (string) $action;
        return $this;
    }

    /**
     * Get human readable action name
     *
     * @return string
     */
    public function getName() {
        return (string) $this->name;
    }

    /**
     * Get point value of action
     *
     * @return int
     */
    public function getPoints() {
        return (int) $this->points;
    }

    /**
     * Set point value
     *
     * @param int $points
     * @return Newscoop\Entity\UserPoints
     */
    public function setPoints($points) {
        $this->points = $points;
        return $this;
    }
}