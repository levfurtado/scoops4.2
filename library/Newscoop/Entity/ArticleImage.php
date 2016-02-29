<?php
/**
 * @package Newscoop
 * @copyright 2012 Sourcefabric o.p.s.
 * @license http://www.gnu.org/licenses/gpl.txt
 */

namespace Newscoop\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * ArticleImage entity
 * @ORM\Entity
 * @ORM\Table(name="ArticleImages")
 */
class ArticleImage
{
    /**
     * @ORM\Id 
     * @ORM\Column(type="integer", name="NrArticle")
     * @var int
     */
    private $articleNumber;

    /**
     * @ORM\Id 
     * @ORM\Column(type="integer", name="IdImage")
     * @var int
     */
    private $imageId;

    /**
     * @ORM\Column(type="integer", name="Number", nullable=True)
     * @var int
     */
    private $number;
}
