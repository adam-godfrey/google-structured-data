<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace ASG\PropertySystem\Model;

use ASG\PropertySystem\Api\Data\PropertyTypeInterface;
use ASG\PropertySystem\Api\Data\PropertyTypeInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

class PropertyType extends \Magento\Framework\Model\AbstractModel
{

    protected $dataObjectHelper;

    protected $propertytypeDataFactory;

    protected $_eventPrefix = 'asg_propertysystem_propertytype';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param PropertyTypeInterfaceFactory $propertytypeDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \ASG\PropertySystem\Model\ResourceModel\PropertyType $resource
     * @param \ASG\PropertySystem\Model\ResourceModel\PropertyType\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        PropertyTypeInterfaceFactory $propertytypeDataFactory,
        DataObjectHelper $dataObjectHelper,
        \ASG\PropertySystem\Model\ResourceModel\PropertyType $resource,
        \ASG\PropertySystem\Model\ResourceModel\PropertyType\Collection $resourceCollection,
        array $data = []
    ) {
        $this->propertytypeDataFactory = $propertytypeDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve propertytype model with propertytype data
     * @return PropertyTypeInterface
     */
    public function getDataModel()
    {
        $propertytypeData = $this->getData();
        
        $propertytypeDataObject = $this->propertytypeDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $propertytypeDataObject,
            $propertytypeData,
            PropertyTypeInterface::class
        );
        
        return $propertytypeDataObject;
    }
}

