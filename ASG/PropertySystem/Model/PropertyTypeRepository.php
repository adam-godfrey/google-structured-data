<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace ASG\PropertySystem\Model;

use ASG\PropertySystem\Api\Data\PropertyTypeInterfaceFactory;
use ASG\PropertySystem\Api\Data\PropertyTypeSearchResultsInterfaceFactory;
use ASG\PropertySystem\Api\PropertyTypeRepositoryInterface;
use ASG\PropertySystem\Model\ResourceModel\PropertyType as ResourcePropertyType;
use ASG\PropertySystem\Model\ResourceModel\PropertyType\CollectionFactory as PropertyTypeCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

class PropertyTypeRepository implements PropertyTypeRepositoryInterface
{

    protected $dataPropertyTypeFactory;

    private $collectionProcessor;

    protected $searchResultsFactory;

    protected $resource;

    protected $extensibleDataObjectConverter;
    protected $dataObjectProcessor;

    protected $dataObjectHelper;

    protected $propertyTypeFactory;

    protected $propertyTypeCollectionFactory;

    private $storeManager;

    protected $extensionAttributesJoinProcessor;


    /**
     * @param ResourcePropertyType $resource
     * @param PropertyTypeFactory $propertyTypeFactory
     * @param PropertyTypeInterfaceFactory $dataPropertyTypeFactory
     * @param PropertyTypeCollectionFactory $propertyTypeCollectionFactory
     * @param PropertyTypeSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourcePropertyType $resource,
        PropertyTypeFactory $propertyTypeFactory,
        PropertyTypeInterfaceFactory $dataPropertyTypeFactory,
        PropertyTypeCollectionFactory $propertyTypeCollectionFactory,
        PropertyTypeSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->propertyTypeFactory = $propertyTypeFactory;
        $this->propertyTypeCollectionFactory = $propertyTypeCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataPropertyTypeFactory = $dataPropertyTypeFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \ASG\PropertySystem\Api\Data\PropertyTypeInterface $propertyType
    ) {
        /* if (empty($propertyType->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $propertyType->setStoreId($storeId);
        } */
        
        $propertyTypeData = $this->extensibleDataObjectConverter->toNestedArray(
            $propertyType,
            [],
            \ASG\PropertySystem\Api\Data\PropertyTypeInterface::class
        );
        
        $propertyTypeModel = $this->propertyTypeFactory->create()->setData($propertyTypeData);
        
        try {
            $this->resource->save($propertyTypeModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the propertyType: %1',
                $exception->getMessage()
            ));
        }
        return $propertyTypeModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($propertyTypeId)
    {
        $propertyType = $this->propertyTypeFactory->create();
        $this->resource->load($propertyType, $propertyTypeId);
        if (!$propertyType->getId()) {
            throw new NoSuchEntityException(__('PropertyType with id "%1" does not exist.', $propertyTypeId));
        }
        return $propertyType->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->propertyTypeCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \ASG\PropertySystem\Api\Data\PropertyTypeInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \ASG\PropertySystem\Api\Data\PropertyTypeInterface $propertyType
    ) {
        try {
            $propertyTypeModel = $this->propertyTypeFactory->create();
            $this->resource->load($propertyTypeModel, $propertyType->getPropertytypeId());
            $this->resource->delete($propertyTypeModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the PropertyType: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($propertyTypeId)
    {
        return $this->delete($this->get($propertyTypeId));
    }
}

