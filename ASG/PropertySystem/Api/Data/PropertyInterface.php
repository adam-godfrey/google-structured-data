<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace ASG\PropertySystem\Api\Data;

interface PropertyInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const PROPERTY_TYPE_ID = 'property_type_id';
    const LONGITUDE = 'longitude';
    const NUM_BATHROOMS = 'num_bathrooms';
    const TOWN = 'town';
    const PROPERTY_ID = 'property_id';
    const COUNTY = 'county';
    const DESCRIPTION = 'description';
    const IMAGE_THUMBNAIL = 'image_thumbnail';
    const UUID = 'uuid';
    const NUM_BEDROOMS = 'num_bedrooms';
    const PRICE = 'price';
    const IMAGE_FULL = 'image_full';
    const LATITUDE = 'latitude';
    const COUNTRY = 'country';
    const ADDRESS = 'address';
    const TYPE = 'type';

    /**
     * Get property_id
     * @return string|null
     */
    public function getPropertyId();

    /**
     * Set property_id
     * @param string $propertyId
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setPropertyId($propertyId);

    /**
     * Get county
     * @return string|null
     */
    public function getCounty();

    /**
     * Set county
     * @param string $county
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setCounty($county);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \ASG\PropertySystem\Api\Data\PropertyExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \ASG\PropertySystem\Api\Data\PropertyExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \ASG\PropertySystem\Api\Data\PropertyExtensionInterface $extensionAttributes
    );

    /**
     * Get country
     * @return string|null
     */
    public function getCountry();

    /**
     * Set country
     * @param string $country
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setCountry($country);

    /**
     * Get town
     * @return string|null
     */
    public function getTown();

    /**
     * Set town
     * @param string $town
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setTown($town);

    /**
     * Get description
     * @return string|null
     */
    public function getDescription();

    /**
     * Set description
     * @param string $description
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setDescription($description);

    /**
     * Get address
     * @return string|null
     */
    public function getAddress();

    /**
     * Set address
     * @param string $address
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setAddress($address);

    /**
     * Get image_full
     * @return string|null
     */
    public function getImageFull();

    /**
     * Set image_full
     * @param string $imageFull
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setImageFull($imageFull);

    /**
     * Get image_thumbnail
     * @return string|null
     */
    public function getImageThumbnail();

    /**
     * Set image_thumbnail
     * @param string $imageThumbnail
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setImageThumbnail($imageThumbnail);

    /**
     * Get latitude
     * @return string|null
     */
    public function getLatitude();

    /**
     * Set latitude
     * @param string $latitude
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setLatitude($latitude);

    /**
     * Get longitude
     * @return string|null
     */
    public function getLongitude();

    /**
     * Set longitude
     * @param string $longitude
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setLongitude($longitude);

    /**
     * Get num_bedrooms
     * @return string|null
     */
    public function getNumBedrooms();

    /**
     * Set num_bedrooms
     * @param string $numBedrooms
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setNumBedrooms($numBedrooms);

    /**
     * Get num_bathrooms
     * @return string|null
     */
    public function getNumBathrooms();

    /**
     * Set num_bathrooms
     * @param string $numBathrooms
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setNumBathrooms($numBathrooms);

    /**
     * Get price
     * @return string|null
     */
    public function getPrice();

    /**
     * Set price
     * @param string $price
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setPrice($price);

    /**
     * Get property_type_id
     * @return string|null
     */
    public function getPropertyTypeId();

    /**
     * Set property_type_id
     * @param string $propertyTypeId
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setPropertyTypeId($propertyTypeId);

    /**
     * Get type
     * @return string|null
     */
    public function getType();

    /**
     * Set type
     * @param string $type
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setType($type);

    /**
     * Get uuid
     * @return string|null
     */
    public function getUuid();

    /**
     * Set uuid
     * @param string $uuid
     * @return \ASG\PropertySystem\Api\Data\PropertyInterface
     */
    public function setUuid($uuid);
}

