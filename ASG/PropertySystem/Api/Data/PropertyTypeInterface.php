<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace ASG\PropertySystem\Api\Data;

interface PropertyTypeInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const TITLE = 'title';
    const DESCRIPTION = 'description';
    const ID = 'id';
    const PROPERTYTYPE_ID = 'propertytype_id';

    /**
     * Get propertytype_id
     * @return string|null
     */
    public function getPropertytypeId();

    /**
     * Set propertytype_id
     * @param string $propertytypeId
     * @return \ASG\PropertySystem\Api\Data\PropertyTypeInterface
     */
    public function setPropertytypeId($propertytypeId);

    /**
     * Get id
     * @return string|null
     */
    public function getId();

    /**
     * Set id
     * @param string $id
     * @return \ASG\PropertySystem\Api\Data\PropertyTypeInterface
     */
    public function setId($id);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \ASG\PropertySystem\Api\Data\PropertyTypeExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \ASG\PropertySystem\Api\Data\PropertyTypeExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \ASG\PropertySystem\Api\Data\PropertyTypeExtensionInterface $extensionAttributes
    );

    /**
     * Get title
     * @return string|null
     */
    public function getTitle();

    /**
     * Set title
     * @param string $title
     * @return \ASG\PropertySystem\Api\Data\PropertyTypeInterface
     */
    public function setTitle($title);

    /**
     * Get description
     * @return string|null
     */
    public function getDescription();

    /**
     * Set description
     * @param string $description
     * @return \ASG\PropertySystem\Api\Data\PropertyTypeInterface
     */
    public function setDescription($description);
}

