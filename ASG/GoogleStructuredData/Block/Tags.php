<?php

namespace ASG\GoogleStructuredData\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Tags extends Template
{
    protected $scopeConfig;

	public function __construct(
        Template\Context $context,
        ScopeConfigInterface $scopeConfig
    )
	{
        $this->scopeConfig = $scopeConfig;
		parent::__construct($context);
    }

    public function getPostalAddress()
    {
        $address = new \stdClass();

        $address->{'@type'} = 'PostalAddress';
        $address->streetAddress = $this->scopeConfig->getValue('structured_data/address/streetAddress');
        $address->addressLocality = $this->scopeConfig->getValue('structured_data/address/addressLocality');
        $address->addressRegion = $this->scopeConfig->getValue('structured_data/address/addressRegion');
        $address->postalCode = $this->scopeConfig->getValue('structured_data/address/postalCode');

        return (object) array_filter((array) $address);
    }

    public function getGeo()
    {
        $geo = new \stdClass();

        $geo->{'@type'} = 'GeoCoordinates';
        $geo->latitude = $this->scopeConfig->getValue('structured_data/geo/latitude');
        $geo->longitude = $this->scopeConfig->getValue('structured_data/geo/longitude');

        return $geo;
    }

    public function createMarkup()
    {
        $data = new \stdClass();

        $data->{'@context'} = 'https://schema.org';
        $data->{'@type'} = 'LocalBusiness';
        $data->image = [$this->scopeConfig->getValue('structured_data/general/image')];
        $data->{'@id'} = $this->scopeConfig->getValue('structured_data/general/url');
        $data->name = $this->scopeConfig->getValue('structured_data/general/name');
        $data->address = $this->getPostalAddress();
        $data->geo = $this->getGeo();
        $data->url = $this->scopeConfig->getValue('structured_data/general/url');
        $data->telephone = $this->scopeConfig->getValue('structured_data/general/telephone');
        $data->openingHoursSpecification = $this->getOpeningHours();
        $data->priceRange = $this->scopeConfig->getValue('structured_data/general/pricerange');

        return json_encode((object) array_filter((array) $data), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function getOpeningHours()
    {
        $defaultopening = $this->scopeConfig->getValue('structured_data/openinghours/usedefault');
        $openingdays = explode(',', $this->scopeConfig->getValue('structured_data/openinghours/days'));

        if(!$defaultopening) {
            $open = explode(',', $this->scopeConfig->getValue('structured_data/openinghours/open'));
            $close = explode(',', $this->scopeConfig->getValue('structured_data/openinghours/close'));

            $opening = new \stdClass();

            $opening->{'@type'} = 'OpeningHoursSpecification';
            $opening->dayOfWeek = array_map('ucwords', $openingdays);
            $opening->opens = implode(':', $open);
            $opening->closes = implode(':', $close);
        } else {
            foreach($openingdays as $openingday) {
                $open = explode(',', $this->scopeConfig->getValue('structured_data/openinghours/' . strtolower($openingday) .'/open'));
                $close = explode(',', $this->scopeConfig->getValue('structured_data/openinghours/' . strtolower($openingday) .'/close'));

                $times[] = $days[$openingday] = implode(',', [
                    implode(':', $open),
                    implode(':', $close)
                ]);

                $times = array_unique($times, SORT_REGULAR); 
            }

            foreach($times as $time) {
                $daygroups[] = [
                    'days' => array_keys(array_filter($days, function ($v) use ($time) {
                        return $time == $v;//(in_array($time[0], $v) && in_array($time[1], $v));
                    })),
                    'open' => explode(',', $time)[0],
                    'close' => explode(',', $time)[1]
                ]; 
            }

            foreach($daygroups as $daygroup) {
                $obj = new \stdClass();

                $obj->{'@type'} = 'OpeningHoursSpecification';
                $obj->dayOfWeek = array_map('ucwords', $daygroup['days']);
                $obj->opens = $daygroup['open'];
                $obj->closes = $daygroup['close'];

                $opening[] = $obj;
            } 
        }

        return $opening;
    }
}