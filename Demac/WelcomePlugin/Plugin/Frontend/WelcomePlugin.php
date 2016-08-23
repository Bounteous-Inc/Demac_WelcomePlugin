<?php

namespace Demac\WelcomePlugin\Plugin\Frontend;


use Magento\Customer\Model\Session;
use Magento\Framework\Message\ManagerInterface as MessageManager;

/**
 * @package Demac\WelcomePlugin\Plugin\Frontend
 */
class WelcomePlugin
{
    /**
     * @var MessageManager
     */
    private $messageManager;

    /**
     * @param MessageManager $messageManager
     */
    public function __construct(MessageManager $messageManager)
    {
        $this->messageManager = $messageManager;
    }

    /**
     * @param Session $subject
     * @param $result
     * @return mixed
     */
    public function afterSetCustomerDataAsLoggedIn(
        Session $subject,
        $result)
    {
        $this->messageManager->addSuccessMessage('Don\'t forget to check out our latest line of death rays');
        return $result;
    }
}