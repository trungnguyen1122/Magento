<?php
namespace Packt\Helloworld\Block\Adminhtml\Movie;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{

    protected $_coreRegistry = null;


    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    protected function _construct()
    {
        $this->_objectId = 'movie_id';
        $this->_blockGroup = 'Packt_HelloWorld';
        $this->_controller = 'adminhtml_movie';

        parent::_construct();

        if ($this->_isAllowedAction('Packt_HelloWorld:save')) {
            $this->buttonList->update('save', 'label', __('Save Movie'));
            $this->buttonList->add(
                'saveandcontinue',
                [
                    'label' => __('Save and Continue Edit'),
                    'class' => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                        ],
                    ]
                ],
                -100
            );
        } else {
            $this->buttonList->remove('save');
        }

        if ($this->_isAllowedAction('Pack_HelloWorld::movie_delete')) {
            $this->buttonList->update('delete', 'label', __('Delete Movie'));
        } else {
            $this->buttonList->remove('delete');
        }
    }


    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('magenest_movie')->getId()) {
            return __("Edit Movie '%1'", $this->escapeHtml($this->_coreRegistry->registry('magenest_movie')->getTitle()));
        } else {
            return __('New Movie');
        }
    }

    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('helloworld/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
    }
}
