<?php
namespace thewulf7\travelPayouts;


use thewulf7\travelPayouts\components\Client;
use thewulf7\travelPayouts\components\HotelsClient;
use thewulf7\travelPayouts\components\ServiceInjector;

/**
 * Class Travel
 *
 * @package thewulf7\travelPayouts
 */
class Travel
{
    use ServiceInjector;

    /**
     * @var Client
     */
    private $_client;

    /**
     * @var string
     */
    private $_token;

    /**
     * @param string $token
     */
    public function __construct($token = '',$mode = 'flights')
    {
        if ($token !== '')
        {
            $this->setToken($token);
        }
        $this->init($mode);
    }

    private function init($mode)
    {
        if ($mode === 'hotels') {
            $this->_client = new HotelsClient($this->getToken());
        } else {
            $this->_client = new Client($this->getToken());
        }
    }

    /**
     * Get client
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->_client;
    }

    /**
     * Get Token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->_token;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return Travel
     */
    public function setToken($token)
    {
        $this->_token = $token;
        return $this;
    }
}