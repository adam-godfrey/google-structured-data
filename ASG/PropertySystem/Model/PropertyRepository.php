<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace ASG\PropertySystem\Model;

use ASG\PropertySystem\Api\Data\PropertyInterfaceFactory;
use ASG\PropertySystem\Api\Data\PropertySearchResultsInterfaceFactory;
use ASG\PropertySystem\Api\PropertyRepositoryInterface;
use ASG\PropertySystem\Model\ResourceModel\Property as ResourceProperty;
use ASG\PropertySystem\Model\ResourceModel\Property\CollectionFactory as PropertyCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

class PropertyRepository implements PropertyRepositoryInterface
{

    protected $propertyCollectionFactory;

    protected $dataPropertyFactory;

    protected $searchResultsFactory;

    private $collectionProcessor;

    protected $propertyFactory;

    protected $resource;

    protected $extensibleDataObjectConverter;
    protected $dataObjectProcessor;

    protected $dataObjectHelper;

    private $storeManager;

    protected $extensionAttributesJoinProcessor;


    /**
     * @param ResourceProperty $resource
     * @param PropertyFactory $propertyFactory
     * @param PropertyInterfaceFactory $dataPropertyFactory
     * @param PropertyCollectionFactory $propertyCollectionFactory
     * @param PropertySearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceProperty $resource,
        PropertyFactory $propertyFactory,
        PropertyInterfaceFactory $dataPropertyFactory,
        PropertyCollectionFactory $propertyCollectionFactory,
        PropertySearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->propertyFactory = $propertyFactory;
        $this->propertyCollectionFactory = $propertyCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataPropertyFactory = $dataPropertyFactory;
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
        \ASG\PropertySystem\Api\Data\PropertyInterface $property
    ) {
        /* if (empty($property->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $property->setStoreId($storeId);
        } */
        
        $propertyData = $this->extensibleDataObjectConverter->toNestedArray(
            $property,
            [],
            \ASG\PropertySystem\Api\Data\PropertyInterface::class
        );
        
        $propertyModel = $this->propertyFactory->create()->setData($propertyData);
        
        try {
            $this->resource->save($propertyModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the property: %1',
                $exception->getMessage()
            ));
        }
        return $propertyModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($propertyId)
    {
        $property = $this->propertyFactory->create();
        $this->resource->load($property, $propertyId);
        if (!$property->getId()) {
            throw new NoSuchEntityException(__('Property with id "%1" does not exist.', $propertyId));
        }
        return $property->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->propertyCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \ASG\PropertySystem\Api\Data\PropertyInterface::class
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
        \ASG\PropertySystem\Api\Data\PropertyInterface $property
    ) {
        try {
            $propertyModel = $this->propertyFactory->create();
            $this->resource->load($propertyModel, $property->getPropertyId());
            $this->resource->delete($propertyModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Property: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($propertyId)
    {
        return $this->delete($this->get($propertyId));
    }
}

