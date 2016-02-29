<?php
/**
 * @package Newscoop
 * @copyright 2011 Sourcefabric o.p.s.
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */

namespace Newscoop\Entity\Ingest;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="ingest_feed")
 */
class Feed
{
    /**
     * @ORM\Id @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(type="datetime", nullable=True)
     * @var DateTime
     */
    private $updated;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $mode;

    /**
     * @param string $title
     */
    public function __construct($title)
    {
        $this->title = $title;
        $this->mode = "manual";
    }

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
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set mode (manual|automatic)
     *
     * @param string $mode
     * @return Newscoop\Entity\Ingest\Feed
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
        return $this;
    }

    /**
     * Get mode
     *
     * @return string
     */
    public function getMode()
    {
        return (string) $this->mode;
    }

    public function isAutoMode()
    {
        return (bool) ($this->getMode() === "auto");
    }

    /**
     * Set updated
     *
     * @param DateTime $updated
     * @return Newscoop\Entity\Ingest\Feed
     */
    public function setUpdated(\DateTime $updated)
    {
        $this->updated = $updated;
        return $this;
    }

    /**
     * Get updated
     *
     * @return DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }
}
