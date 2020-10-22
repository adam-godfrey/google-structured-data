<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace ASG\PropertySystem\Model\ResourceModel\PropertyType;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'propertytype_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \ASG\PropertySystem\Model\PropertyType::class,
            \ASG\PropertySystem\Model\ResourceModel\PropertyType::class
        );
    }
}

