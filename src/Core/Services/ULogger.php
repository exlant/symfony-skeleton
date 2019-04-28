<?php
declare(strict_types=1);

namespace App\Core\Services;

use App\Core\Interfaces\ILogger;
use Psr\Log\LoggerInterface;

/**
 * Class ULogger
 * @package App\Core\Service
 */
class ULogger implements ILogger
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * ULogger constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function emergency($message, array $context = array()): void
    {
        $this->logger->emergency($this->makeMessage($message), $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function alert($message, array $context = array()): void
    {
        $this->logger->alert($this->makeMessage($message), $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function critical($message, array $context = array()): void
    {
        $this->logger->critical($this->makeMessage($message), $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function error($message, array $context = array()): void
    {
        $this->logger->error($this->makeMessage($message), $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function warning($message, array $context = array()): void
    {
        $this->logger->warning($this->makeMessage($message), $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function notice($message, array $context = array()): void
    {
        $this->logger->notice($this->makeMessage($message), $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function info($message, array $context = array()): void
    {
        $this->logger->info($this->makeMessage($message), $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function debug($message, array $context = array()): void
    {
        $this->logger->debug($this->makeMessage($message), $context);
    }

    /**
     * @param mixed $level
     * @param string $message
     * @param array $context
     */
    public function log($level, $message, array $context = array()): void
    {
        $this->logger->log($level, $this->makeMessage($message), $context);
    }

    /**
     * @param mixed $item
     * @param bool $jsonEncode
     *
     * @return array|string
     */
    public function makeMessage($item, bool $jsonEncode = true)
    {
        $info = [];
        if ($item instanceof \Exception) {

        }


        return $jsonEncode ? json_encode($info) : $info;
    }

}