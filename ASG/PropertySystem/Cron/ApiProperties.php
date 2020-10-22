<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace ASG\PropertySystem\Cron;

class ApiProperties
{
    /**
    * @var \Magento\Framework\App\Config\ScopeConfigInterface
    */
    protected $scopeConfig;
    protected $logger;
    protected $resource;

    const XML_PATH_PAGENUMBER = 'property/api/page_number';
    const XML_PATH_PAGESIZE = 'property/api/page_size';
    const XML_PATH_APIKEY = 'property/api/api_key';

    /**
     * Constructor
     *
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\App\ResourceConnection $resource
    )
    {
        $this->scopeConfig = $scopeConfig;
        $this->logger = $logger;
        $this->resource = $resource;
    }

    /**
     * Execute the cron
     *
     * @return void
     */
    public function execute()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;

        $page_number = $this->scopeConfig->getValue(self::XML_PATH_PAGENUMBER, $storeScope);
        $page_size = $this->scopeConfig->getValue(self::XML_PATH_PAGESIZE, $storeScope);
        $api_key = $this->scopeConfig->getValue(self::XML_PATH_APIKEY, $storeScope);

        $handle = curl_init();
 
        $url = 'http://trialapi.craig.mtcdevserver.com/api/properties?api_key=' . $api_key . '&page[size]=' . $page_size . '&page[num]=' . $page_number;
         
        // Set the url
        curl_setopt($handle, CURLOPT_URL, $url);
        // Set the result output to be a string.
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
         
        $output = curl_exec($handle);
         
        curl_close($handle);

        $response = json_decode($output, true);

        $connection = $this->resource->getConnection();

        $property_types = array();

        foreach($response['data'] as $element) {

            $property_types[] = $element['property_type'];
            $filtered_properties = $this->filter_array($element, ['created_at', 'updated_at', 'property_type']);

            $data = array();

            foreach($filtered_properties as $key => $value) {
                $data[$key] = $value;
            }

            $connection->insertOnDuplicate('asg_propertysystem_property', $data);
        }

        $property_types = array_unique($property_types, SORT_REGULAR);

        foreach($property_types as $property_type) {
            $filtered_property_type = $this->filter_array($property_type, ['created_at', 'updated_at']);
            $data = array();

            foreach($filtered_property_type as $key => $value) {
                $data[$key] = $value;
            }

            $connection->insertOnDuplicate('asg_propertysystem_propertytype', $data);
        }

        $this->logger->addInfo("Cronjob ApiProperties is executed.");
    }

    public function filter_array(array $array, array $remove)
    {
         return array_diff_key($array, array_flip($remove));
    }
}

