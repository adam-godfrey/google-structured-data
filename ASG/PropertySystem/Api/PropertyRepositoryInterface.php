<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace ASG\PropertySystem\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface PropertyRepositoryInterface
{

    /**
     * Save Property
     * @param \ASG\PropertySystem\Api\Data\PropertyInterface $property
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \ASG\PropertySystem\Api\Data\PropertyInterface $property
    );

    /**
     * Retrieve Property
     * @param string $propertyId
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($propertyId);

    /**
     * Retrieve Property matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \ASG\PropertySystem\Api\Data\PropertySearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Property
     * @param \ASG\PropertySystem\Api\Data\PropertyInterface $property
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \ASG\PropertySystem\Api\Data\PropertyInterface $property
    );

    /**
     * Delete Property by ID
     * @param string $propertyId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($propertyId);
}

