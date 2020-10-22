<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace ASG\PropertySystem\Api\Data;

interface PropertySearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Property list.
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface[]
     */
    public function getItems();

    /**
     * Set county list.
     * @param \ASG\PropertySystem\Api\Data\PropertyInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

