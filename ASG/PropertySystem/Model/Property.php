<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace ASG\PropertySystem\Model;

use ASG\PropertySystem\Api\Data\PropertyInterface;
use ASG\PropertySystem\Api\Data\PropertyInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

class Property extends \Magento\Framework\Model\AbstractModel
{

    protected $dataObjectHelper;

    protected $_eventPrefix = 'asg_propertysystem_property';
    protected $propertyDataFactory;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param PropertyInterfaceFactory $propertyDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \ASG\PropertySystem\Model\ResourceModel\Property $resource
     * @param \ASG\PropertySystem\Model\ResourceModel\Property\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        PropertyInterfaceFactory $propertyDataFactory,
        DataObjectHelper $dataObjectHelper,
        \ASG\PropertySystem\Model\ResourceModel\Property $resource,
        \ASG\PropertySystem\Model\ResourceModel\Property\Collection $resourceCollection,
        array $data = []
    ) {
        $this->propertyDataFactory = $propertyDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve property model with property data
     * @return PropertyInterface
     */
    public function getDataModel()
    {
        $propertyData = $this->getData();
        
        $propertyDataObject = $this->propertyDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $propertyDataObject,
            $propertyData,
            PropertyInterface::class
        );
        
        return $propertyDataObject;
    }
}

