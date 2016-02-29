<?php
/**
 * @package Newscoop
 * @copyright 2011 Sourcefabric o.p.s.
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */

namespace Newscoop\Annotations;

use Doctrine\Common\Annotations\Annotation;

/**
 * Acl annotation class
 *
 * @Annotation
 */
class Acl extends Annotation
{
    /** @var string */
    public $resource;

    /** @var string */
    public $action;

    /** @var string */
    public $ignore;

    /** @var string */
    public $allow;
}
