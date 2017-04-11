<?php

namespace ServerControllerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ServerInfo
 */
class ServerInfo
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $serverId;

    /**
     * @var string
     */
    private $serverName;

    /**
     * @var string
     */
    private $serverIp;

    /**
     * @var string
     */
    private $serverPort;

    /**
     * @var string
     */
    private $serverStatus;

    /**
     * @var string
     */
    private $toConnect;

    /**
     * @var string
     */
    private $fromConnect;

    /**
     * @var string
     */
    private $serverInfo;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set serverId
     *
     * @param string $serverId
     * @return ServerInfo
     */
    public function setServerId($serverId)
    {
        $this->serverId = $serverId;

        return $this;
    }

    /**
     * Get serverId
     *
     * @return string 
     */
    public function getServerId()
    {
        return $this->serverId;
    }

    /**
     * Set serverName
     *
     * @param string $serverName
     * @return ServerInfo
     */
    public function setServerName($serverName)
    {
        $this->serverName = $serverName;

        return $this;
    }

    /**
     * Get serverName
     *
     * @return string 
     */
    public function getServerName()
    {
        return $this->serverName;
    }

    /**
     * Set serverIp
     *
     * @param string $serverIp
     * @return ServerInfo
     */
    public function setServerIp($serverIp)
    {
        $this->serverIp = $serverIp;

        return $this;
    }

    /**
     * Get serverIp
     *
     * @return string 
     */
    public function getServerIp()
    {
        return $this->serverIp;
    }

    /**
     * Set serverPort
     *
     * @param string $serverPort
     * @return ServerInfo
     */
    public function setServerPort($serverPort)
    {
        $this->serverPort = $serverPort;

        return $this;
    }

    /**
     * Get serverPort
     *
     * @return string 
     */
    public function getServerPort()
    {
        return $this->serverPort;
    }

    /**
     * Set serverStatus
     *
     * @param string $serverStatus
     * @return ServerInfo
     */
    public function setServerStatus($serverStatus)
    {
        $this->serverStatus = $serverStatus;

        return $this;
    }

    /**
     * Get serverStatus
     *
     * @return string 
     */
    public function getServerStatus()
    {
        return $this->serverStatus;
    }

    /**
     * Set toConnect
     *
     * @param string $toConnect
     * @return ServerInfo
     */
    public function setToConnect($toConnect)
    {
        $this->toConnect = $toConnect;

        return $this;
    }

    /**
     * Get toConnect
     *
     * @return string 
     */
    public function getToConnect()
    {
        return $this->toConnect;
    }

    /**
     * Set fromConnect
     *
     * @param string $fromConnect
     * @return ServerInfo
     */
    public function setFromConnect($fromConnect)
    {
        $this->fromConnect = $fromConnect;

        return $this;
    }

    /**
     * Get fromConnect
     *
     * @return string 
     */
    public function getFromConnect()
    {
        return $this->fromConnect;
    }

    /**
     * Set serverInfo
     *
     * @param string $serverInfo
     * @return ServerInfo
     */
    public function setServerInfo($serverInfo)
    {
        $this->serverInfo = $serverInfo;

        return $this;
    }

    /**
     * Get serverInfo
     *
     * @return string 
     */
    public function getServerInfo()
    {
        return $this->serverInfo;
    }
}
