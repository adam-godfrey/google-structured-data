<?php

namespace ASG\GoogleStructuredData\Plugin;

use Psr\Log\LoggerInterface;
use Magento\Config\Model\Config;

class ConfigPlugin
{
    protected $_logger;

    public function __construct(
        LoggerInterface $logger
    )
    {        
        $this->_logger = $logger;
    }

    public function beforeSave(
        Config $subject
    ) {
        $tmp = [];
        $groups = $subject->getGroups();

        if($groups['openinghours']['fields']['usedefault']['value'] == '0') {
            foreach(['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'] as $day) {
                $groups['openinghours']['fields'][$day]['value'][0] = null;
                $groups['openinghours']['fields'][$day]['value'][1] = null;
            }
        }
        else {
            $groups['openinghours']['fields']['defaulthours']['value'][0] = null;
            $groups['openinghours']['fields']['defaulthours']['value'][0] = null;
        }

        return $subject->setGroups($groups);        
    }
}
