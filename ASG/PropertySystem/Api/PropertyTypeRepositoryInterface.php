<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace ASG\PropertySystem\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface PropertyTypeRepositoryInterface
{

    /**
     * Save PropertyType
     * @param \ASG\PropertySystem\Api\Data\PropertyTypeInterface $propertyType
     * @return \ASG\PropertySystem\Api\Data\PropertyTypeInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \ASG\PropertySystem\Api\Data\PropertyTypeInterface $propertyType
    );

    /**
     * Retrieve PropertyType
     * @param string $propertytypeId
     * @return \ASG\PropertySystem\Api\Data\PropertyTypeInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($propertytypeId);

    /**
     * Retrieve PropertyType matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \ASG\PropertySystem\Api\Data\PropertyTypeSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete PropertyType
     * @param \ASG\PropertySystem\Api\Data\PropertyTypeInterface $propertyType
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \ASG\PropertySystem\Api\Data\PropertyTypeInterface $propertyType
    );

    /**
     * Delete PropertyType by ID
     * @param string $propertytypeId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($propertytypeId);
}

