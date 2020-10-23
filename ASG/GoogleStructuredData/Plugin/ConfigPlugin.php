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
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        $groups = $subject->getGroups();
        $opendays = $groups['openinghours']['fields']['days']['value'];

        if($groups['openinghours']['fields']['usedefault']['value'] == '0') {
            foreach($days as $day) {
                for($i = 0; $i < 3; $i++) {
                    $groups['openinghours']['groups'][$day]['fields']['open']['value'][$i] = null;
                    $groups['openinghours']['groups'][$day]['fields']['close']['value'][$i] = null;
                }
            }
        }
        else {
            foreach($days as $day) {
                if(!in_array($day, $opendays)) {
                    for($i = 0; $i < 3; $i++) {
                        $groups['openinghours']['groups'][$day]['fields']['open']['value'][$i] = null;
                        $groups['openinghours']['groups'][$day]['fields']['close']['value'][$i] = null;
                    }
                }
            }

            for($i = 0; $i < 3; $i++) {
                $groups['openinghours']['fields']['open']['value'][$i] = null;
                $groups['openinghours']['fields']['close']['value'][$i] = null;
            }
        }

        return $subject->setGroups($groups);        
    }
}
