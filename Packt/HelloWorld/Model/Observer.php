<?php
namespace Packt\HelloWorld\Model;
use Magento\Framework\Event\ObserverInterface;
class Observer implements ObserverInterface
{
    /** @var \Psr\Log\LoggerInterface $logger */
    protected $logger;
    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $this->logger->debug('Registered');
    }
}