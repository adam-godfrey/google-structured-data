<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace ASG\PropertySystem\Model\Data;

use ASG\PropertySystem\Api\Data\PropertyInterface;

class Property extends \Magento\Framework\Api\AbstractExtensibleObject implements PropertyInterface
{

    /**
     * Get property_id
     * @return string|null
     */
    public function getPropertyId()
    {
        return $this->_get(self::PROPERTY_ID);
    }

    /**
     * Set property_id
     * @param string $propertyId
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setPropertyId($propertyId)
    {
        return $this->setData(self::PROPERTY_ID, $propertyId);
    }

    /**
     * Get county
     * @return string|null
     */
    public function getCounty()
    {
        return $this->_get(self::COUNTY);
    }

    /**
     * Set county
     * @param string $county
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setCounty($county)
    {
        return $this->setData(self::COUNTY, $county);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \ASG\PropertySystem\Api\Data\PropertyExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \ASG\PropertySystem\Api\Data\PropertyExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \ASG\PropertySystem\Api\Data\PropertyExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get country
     * @return string|null
     */
    public function getCountry()
    {
        return $this->_get(self::COUNTRY);
    }

    /**
     * Set country
     * @param string $country
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setCountry($country)
    {
        return $this->setData(self::COUNTRY, $country);
    }

    /**
     * Get town
     * @return string|null
     */
    public function getTown()
    {
        return $this->_get(self::TOWN);
    }

    /**
     * Set town
     * @param string $town
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setTown($town)
    {
        return $this->setData(self::TOWN, $town);
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
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * Get address
     * @return string|null
     */
    public function getAddress()
    {
        return $this->_get(self::ADDRESS);
    }

    /**
     * Set address
     * @param string $address
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setAddress($address)
    {
        return $this->setData(self::ADDRESS, $address);
    }

    /**
     * Get image_full
     * @return string|null
     */
    public function getImageFull()
    {
        return $this->_get(self::IMAGE_FULL);
    }

    /**
     * Set image_full
     * @param string $imageFull
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setImageFull($imageFull)
    {
        return $this->setData(self::IMAGE_FULL, $imageFull);
    }

    /**
     * Get image_thumbnail
     * @return string|null
     */
    public function getImageThumbnail()
    {
        return $this->_get(self::IMAGE_THUMBNAIL);
    }

    /**
     * Set image_thumbnail
     * @param string $imageThumbnail
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setImageThumbnail($imageThumbnail)
    {
        return $this->setData(self::IMAGE_THUMBNAIL, $imageThumbnail);
    }

    /**
     * Get latitude
     * @return string|null
     */
    public function getLatitude()
    {
        return $this->_get(self::LATITUDE);
    }

    /**
     * Set latitude
     * @param string $latitude
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setLatitude($latitude)
    {
        return $this->setData(self::LATITUDE, $latitude);
    }

    /**
     * Get longitude
     * @return string|null
     */
    public function getLongitude()
    {
        return $this->_get(self::LONGITUDE);
    }

    /**
     * Set longitude
     * @param string $longitude
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setLongitude($longitude)
    {
        return $this->setData(self::LONGITUDE, $longitude);
    }

    /**
     * Get num_bedrooms
     * @return string|null
     */
    public function getNumBedrooms()
    {
        return $this->_get(self::NUM_BEDROOMS);
    }

    /**
     * Set num_bedrooms
     * @param string $numBedrooms
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setNumBedrooms($numBedrooms)
    {
        return $this->setData(self::NUM_BEDROOMS, $numBedrooms);
    }

    /**
     * Get num_bathrooms
     * @return string|null
     */
    public function getNumBathrooms()
    {
        return $this->_get(self::NUM_BATHROOMS);
    }

    /**
     * Set num_bathrooms
     * @param string $numBathrooms
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setNumBathrooms($numBathrooms)
    {
        return $this->setData(self::NUM_BATHROOMS, $numBathrooms);
    }

    /**
     * Get price
     * @return string|null
     */
    public function getPrice()
    {
        return $this->_get(self::PRICE);
    }

    /**
     * Set price
     * @param string $price
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setPrice($price)
    {
        return $this->setData(self::PRICE, $price);
    }

    /**
     * Get property_type_id
     * @return string|null
     */
    public function getPropertyTypeId()
    {
        return $this->_get(self::PROPERTY_TYPE_ID);
    }

    /**
     * Set property_type_id
     * @param string $propertyTypeId
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setPropertyTypeId($propertyTypeId)
    {
        return $this->setData(self::PROPERTY_TYPE_ID, $propertyTypeId);
    }

    /**
     * Get type
     * @return string|null
     */
    public function getType()
    {
        return $this->_get(self::TYPE);
    }

    /**
     * Set type
     * @param string $type
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setType($type)
    {
        return $this->setData(self::TYPE, $type);
    }

    /**
     * Get uuid
     * @return string|null
     */
    public function getUuid()
    {
        return $this->_get(self::UUID);
    }

    /**
     * Set uuid
     * @param string $uuid
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setUuid($uuid)
    {
        return $this->setData(self::UUID, $uuid);
    }
}

