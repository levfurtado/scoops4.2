<?php
/**
 * @package Newscoop
 * @copyright 2011 Sourcefabric o.p.s.
 * @license http://www.gnu.org/licenses/gpl.txt
 */

namespace Newscoop\Entity\Comment;

use Doctrine\ORM\Mapping AS ORM;
use Newscoop\Entity\Publication;

/**
 * Acceptance entity
 * @ORM\Table(name="comment_acceptance")
 * @ORM\Entity(repositoryClass="Newscoop\Entity\Repository\Comment\AcceptanceRepository")
 */
class Acceptance
{
    /**
     * @var string to code mapper for type
     */
    static $type_enum = array(
        'allow',
        'deny'
    );

    /**
     * @var string to code mapper for search_type
     */
    static $search_type_enum = array(
        'normal',
        'regex'
    );

    /**
     * @var string to code mapper for for_colum
     */
    static $for_column_enum = array(
        'ip',
        'name',
        'email'
    );

    /**
     * @ORM\Id 
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Newscoop\Entity\Publication")
     * @ORM\JoinColumn(name="fk_forum_id", referencedColumnName="Id")
     * @var Newscoop\Entity\Publication
     */
    private $forum;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $for_column;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     * @var int
     */
    private $search;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $search_type;


    /**
     * Set acceptance id
     *
     * @param int $p_id
     * @return Newscoop\Entity\Comment\Acceptance
     */
    public function setId($p_id)
    {
        $this->id = $p_id;
        // return this for chaining mechanism
        return $this;
    }

    /**
     * Get acceptance id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set acceptance forum
     *
     * @param Newscoop\Entity\Publication $p_forum
     * @return Newscoop\Entity\Comment\Acceptance
     */
    public function setForum(Publication $p_forum)
    {
        $this->forum = $p_forum;
        // return this for chaining mechanism
        return $this;
    }

    /**
     * Get acceptance iforum
     *
     * @return int
     */
    public function getForum()
    {
        return $this->forum;
    }

    /**
     * Set acceptance for_column
     *
     * @param string $p_for_column
     * @return Newscoop\Entity\Comment\Acceptance
     */
    public function setForColumn($p_for_column)
    {
        $for_column_enum = array_flip(self::$for_column_enum);
        $this->for_column = $for_column_enum[$p_for_column];
        // return this for chaining mechanism
        return $this;
    }

    /**
     * Get acceptance for_column
     *
     * @return int
     */
    public function getForColumn()
    {
        return self::$for_column_enum[$this->for_column];
    }

    /**
     * Set acceptance type
     *
     * @param string $p_type
     * @return Newscoop\Entity\Comment\Acceptance
     */
    public function setType($p_type)
    {
        $type_enum = array_flip(self::$type_enum);
        $this->type = $type_enum[$p_type];
        // return this for chaining mechanism
        return $this;
    }

    /**
     * Get acceptance type
     *
     * @return int
     */
    public function getType()
    {
        return self::$type_enum[$this->type];
    }

    /**
     * Set acceptance search by
     *
     * @param string $p_search
     * @return Newscoop\Entity\Comment\Acceptance
     */
    public function setSearch($p_search)
    {
        $this->search = $p_search;
        // return this for chaining mechanism
        return $this;
    }

    /**
     * Get acceptance search
     *
     * @return string
     */
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * Set acceptance search type
     *
     * @param string $p_search_type
     * @return Newscoop\Entity\Comment\Acceptance
     */
    public function setSearchType($p_search_type)
    {
        $search_type_enum = array_flip(self::$search_type_enum);
        $this->search_type = $search_type_enum[$p_search_type];
        // return this for chaining mechanism
        return $this;
    }

    /**
     * Get acceptance type
     *
     * @return int
     */
    public function getSearchType()
    {
        return self::$search_type_enum[$this->search_type];
    }

}
