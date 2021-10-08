<?php

namespace Rzufil\LogEvents\Plugin;

use Psr\Log\LoggerInterface;
use Magento\Framework\Event\Manager;
use Magento\Framework\App\Request\Http;
use Rzufil\LogEvents\Helper\Data;

class LogDispatchedEvents
{
    protected LoggerInterface $logger;
    protected Http $request;
    protected Data $helper;

    const LOG_ENABLED_CONFIG_PATH = 'logevents/general/enabled';

    public function __construct(
        LoggerInterface $logger,
        Http $request,
        Data $helper
    ) {
        $this->logger = $logger;
        $this->request = $request;
        $this->helper = $helper;
    }

    /**
     * Dispatch event
     *
     * Calls all observer callbacks registered for this event
     * and multiple observers matching event name pattern
     *
     * @param string $eventName
     * @param array $data
     * @return void
     */
    public function beforeDispatch(Manager $subject, $eventName, array $data = [])
    {
        $page = $this->request->getFullActionName();
        if ($page == "__" || $page == "adminhtml_system_config_save") {
            return null;
        }
        $configEnabled = $this->helper->getConfig(self::LOG_ENABLED_CONFIG_PATH);
        if (!$configEnabled) {
            return null;
        }
        $this->logger->log(200, 'PAGE: ' . mb_strtolower($page) . ' EVENT: ' . mb_strtolower($eventName));
        return null;
    }
}
