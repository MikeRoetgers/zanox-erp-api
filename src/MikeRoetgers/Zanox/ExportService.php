<?php

namespace MikeRoetgers\Zanox;

use MikeRoetgers\Zanox\ExportFilter\BasketFilter;
use MikeRoetgers\Zanox\ExportFilter\PplFilter;
use MikeRoetgers\Zanox\ExportFilter\PpsFilter;

class ExportService
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var \SoapClient
     */
    private $client;

    /**
     * @param UserService $userService
     * @param string $url
     */
    public function __construct(UserService $userService, $url = 'https://services.zanox.com/erp/v2/ExportService.asmx?WSDL')
    {
        $this->userService = $userService;
        $this->client = new \SoapClient($url);
    }

    public function getBasket($programId, BasketFilter $filter)
    {
        return $this->client->__soapCall('GetBasket', array(array('programid' => $programId, 'basketfilter' => $filter->toSoapParam())), array(), array($this->userService->getTicketSoapHeader()));
    }

    public function getHistoryExport($programId, $trackingType, $rowCount = 0)
    {
        return $this->client->__soapCall('GetHistoryExport', array(array('programid' => $programId, 'trackingtype' => $trackingType, 'rowcount' => $rowCount)), array(), array($this->userService->getTicketSoapHeader()));
    }

    public function getHistoryForId($historyId)
    {
        return $this->client->__soapCall('GetHistoryForId', array(array('historyid' => $historyId)), array(), array($this->userService->getTicketSoapHeader()));
    }

    public function getPpl($programId, PplFilter $filter)
    {
        return $this->client->__soapCall('GetPpl', array(array('programid' => $programId, 'pplfilter' => $filter->toSoapParam('ns2:'))), array(), array($this->userService->getTicketSoapHeader()));
    }

    public function getPps($programId, PpsFilter $filter)
    {
        return $this->client->__soapCall('GetPps', array(array('programid' => $programId, 'ppsfilter' => $filter->toSoapParam('ns2:'))), array(), array($this->userService->getTicketSoapHeader()));
    }

    /**
     * @param \SoapClient $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return \SoapClient
     */
    public function getClient()
    {
        return $this->client;
    }
}