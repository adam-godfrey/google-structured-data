<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace ASG\PropertySystem\Model\Data;

use ASG\PropertySystem\Api\Data\PropertyTypeInterface;

class PropertyType extends \Magento\Framework\Api\AbstractExtensibleObject implements PropertyTypeInterface
{

    /**
     * Get propertytype_id
     * @return string|null
     */
    public function getPropertytypeId()
    {
        return $this->_get(self::PROPERTYTYPE_ID);
    }

    /**
     * Set propertytype_id
     * @param string $propertytypeId
     * @return \ASG\PropertySystem\Api\Data\PropertyTypeInterface
     */
    public function setPropertytypeId($propertytypeId)
    {
        return $this->setData(self::PROPERTYTYPE_ID, $propertytypeId);
    }

    /**
     * Get id
     * @return string|null
     */
    public function getId()
    {
        return $this->_get(self::ID);
    }

    /**
     * Set id
     * @param string $id
     * @return \ASG\PropertySystem\Api\Data\PropertyTypeInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \ASG\PropertySystem\Api\Data\PropertyTypeExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \ASG\PropertySystem\Api\Data\PropertyTypeExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \ASG\PropertySystem\Api\Data\PropertyTypeExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get title
     * @return string|null
     */
    public function getTitle()
    {
        return $this->_get(self::TITLE);
    }

    /**
     * Set title
     * @param string $title
     * @return \ASG\PropertySystem\Api\Data\PropertyTypeInterface
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Get description
     * @return string|null
     */
    public function getDescription()
    {
        return $this->_get(self::DESCRIPTION);
    }

    /**
     * Set description
     * @param string $description
     * @return \ASG\PropertySystem\Api\Data\PropertyTypeInterface
     */
    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }
}

