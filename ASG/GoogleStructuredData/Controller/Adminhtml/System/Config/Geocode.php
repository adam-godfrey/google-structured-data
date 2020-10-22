<?php

namespace ASG\GoogleStructuredData\Controller\Adminhtml\System\Config;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Geocode extends Action
{
    protected $resultJsonFactory;

    /** @var Client */
    protected $client;

    /**
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     */
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory
    )
    {
        $this->resultJsonFactory = $resultJsonFactory;
        try {
            $this->client = new Client([
                'http_errors' => false, 
                'verify' => false, 
                'base_uri' => 'https://api.postcodes.io/',
            ]);
        } catch (InvalidArgumentException $e) {
            echo $e->getMessage();
        }
        parent::__construct($context);
    }

    /**
     * Collect relations data
     *
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        $postcode = $this->getRequest()->getParam('postcode');

        try {
            $response = $this->client->request('GET', 'postcodes/' . $postcode);

            $contents = json_decode($response->getBody()->getContents());

             /** @var \Magento\Framework\Controller\Result\Json $result */
            $result = $this->resultJsonFactory->create();

            return $result->setData($contents);
        } catch (RequestException $e) {
           // echo $e->getRequest();
            if ($e->hasResponse()) {
                //echo $e->getResponse();
            }
        }
    }
}