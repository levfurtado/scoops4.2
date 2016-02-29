<?php
/**
 * @package Newscoop
 * @copyright 2011 Sourcefabric o.p.s.
 * @license http://www.gnu.org/licenses/gpl.txt
 */

namespace Newscoop\Entity\Comment\Preference;

use Doctrine\ORM\Mapping AS ORM;
use Newscoop\Entity\Language;

/**
 * Article entity
 * @ORM\Entity(repositoryClass="Newscoop\Entity\Repository\Comment\Preference\ArticleRepository")
 * @ORM\Table(name="comment_preference_article")
 */
class Article
{
    /**
     * @ORM\Id @ORM\GeneratedValue
     * @ORM\Column(name="Number", type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Newscoop\Entity\Language")
     * @ORM\JoinColumn(name="IdLanguage", referencedColumnName="Id")
     * @var Newscoop\Entity\Language
     */
    private $language;

    /**
     * @ORM\Column(name="comments_enabled")
     * @var int
     */
    private $enabled;

    /**
     * @ORM\Column(name="comments_locked")
     * @var int
     */
    private $locked;

    /**
     * Set article id
     *
     * @param int $p_id
     * @return Article
     */
    public function setId($p_id)
    {
        $this->id = $p_id;
        // return this for chaining mechanism
        return $this;
    }

    /**
     * Get article id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the flag if the comments are enabled or not
     *
     * @param bool $p_enabled
     * @return Article
     */
    public function setEnabled($p_enabled)
    {
        $this->enabled = $p_enabled;
        // return this for chaining mechanism
        return $this;
    }

    /**
     * Get the flag if the comments are enabled or not
     *
     * @return bool
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set the flag if the comments are enabled or not
     *
     * @param bool $p_enabled
     * @return Article
     */
    public function setLocked($p_locked)
    {
        $this->locked = $p_locked;
        // return this for chaining mechanism
        return $this;
    }

    /**
     * Get the flag if the comments are enabled or not
     *
     * @return bool
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * Set language
     *
     * @param  Newscoop\Entity\Language $p_language
     * @return Newscoop\Entity\Article
     */
    public function setLanguage(Language $p_language)
    {
        $this->language = $p_language;
        // return this for chaining mechanism
        return $this;
    }

    /**
     * Get language
     *
     * @return Newscoop\Entity\Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

}
