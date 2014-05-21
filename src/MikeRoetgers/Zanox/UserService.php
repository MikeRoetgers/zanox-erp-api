<?php

namespace MikeRoetgers\Zanox;

class UserService
{
    /**
     * @var string
     */
    private $ticket;

    /**
     * @var \SoapClient
     */
    private $client;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @param string $url
     * @param string $username
     * @param string $password
     */
    public function __construct($username, $password, $url = 'https://services.zanox.com/erp/v2/UserService.asmx?WSDL')
    {
        $this->client = new \SoapClient($url);
        $this->username = $username;
        $this->password = $password;
    }

    public function getUserPrograms()
    {
        return $this->client->__soapCall('GetUserPrograms', array(), array(), array($this->getTicketSoapHeader()));
    }

    public function login()
    {
        $headers = null;
        $response = $this->client->__soapCall('Login', array('Login' => array('loginname' => $this->username, 'password' => $this->password)), array(), array(), $headers);
        $this->ticket = $headers['zanox']->ticket;
        return $response;
    }

    public function logout()
    {
        return $this->client->__soapCall('Logout', array(), array(), array($this->getTicketSoapHeader()));
    }

    /**
     * @param string $ticket
     */
    public function setTicket($ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * @return string
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * @param \SoapClient $client
     */
    public function setClient(\SoapClient $client)
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

    /**
     * @param null $ticket
     * @return \SoapHeader
     */
    public function getTicketSoapHeader($ticket = null)
    {
        if ($ticket === null) {
            $ticket = $this->ticket;
        }

        return new \SoapHeader('http://services.zanox.com/erp', 'zanox', array('ticket' => $ticket));
    }
}