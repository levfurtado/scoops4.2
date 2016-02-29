<?php
/**
 * @package Campsite
 *
 * @author Petr Jasek <petr.jasek@sourcefabric.org>
 * @copyright 2010 Sourcefabric o.p.s.
 * @license http://www.gnu.org/licenses/gpl.txt
 * @link http://www.sourcefabric.org
 */

require_once dirname(__FILE__) . '/IWidget.php';
require_once dirname(__FILE__) . '/IWidgetContext.php';
require_once dirname(__FILE__) . '/WidgetManager.php';

/**
 * Widget Context
 */
class WidgetContext extends DatabaseObject implements IWidgetContext
{
    const TABLE = 'WidgetContext';

    /** @var string */
    public $m_dbTableName = self::TABLE;

    /** @var string */
    public $m_keyColumnNames = array('name');

    /** @var array */
    public $m_columnNames = array(
        'id',
        'name',
    );

    /** @var array of IWidget */
    private $widgets = NULL;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct($this->m_columnNames);
        $this->m_data['name'] = strtolower($name);
        $this->fetch();
        if (empty($this->m_data['id'])) { // store new context
            $this->create(array(
                'name' => $this->getName(),
            ));
            $this->fetch();
        }
    }

    /**
     * Get id
     * @return int
     */
    public function getId()
    {
        return (int) $this->m_data['id'];
    }

    /**
     * Get name
     * @return string
     */
    public function getName()
    {
        return (string) $this->m_data['name'];
    }

    /**
     * Set context widgets
     * @param array $widgets
     * @return bool
     */
    public function setWidgets(array $widgets = array())
    {
        foreach ($widgets as $order => $widgetId) {
            $widget = new WidgetManagerDecorator($widgetId);
            $widget->update(array(
                'fk_widgetcontext_id' => $this->getId(),
                'order' => $order,
            ));
        }
        return TRUE;
    }

    /**
     * Get context widgets
     * @return array of IWidget
     */
    public function getWidgets()
    {
        if ($this->widgets === NULL) {
            $this->widgets = WidgetManager::GetWidgetsByContext($this);
        }
        return $this->widgets;
    }

    /**
     * Render context
     * @return void
     */
    public function render()
    {
        $classes = array('context');

        echo '<ul id="', $this->getName();
        echo '" class="', implode(' ', $classes), '">', "\n";
        foreach ($this->getWidgets() as $widget) {
            $widget->render();
        }
        echo '</ul>', "\n";
    }
}
