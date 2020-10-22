<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace ASG\PropertySystem\Api\Data;

interface PropertyTypeSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get PropertyType list.
     * @return \ASG\PropertySystem\Api\Data\PropertyTypeInterface[]
     */
    public function getItems();

    /**
     * Set id list.
     * @param \ASG\PropertySystem\Api\Data\PropertyTypeInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

