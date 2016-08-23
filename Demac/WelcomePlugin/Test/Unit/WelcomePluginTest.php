<?php

namespace Demac\WelcomePlugin\Test\Unit;


use Demac\WelcomePlugin\Plugin\Frontend\WelcomePlugin;
use Magento\Customer\Model\Session;
use Magento\Framework\Message\ManagerInterface as MessageManager;

/**
 * @package Demac\WelcomePlugin\Test\Unit
 */
class WelcomePluginTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MessageManager
     */
    private $messageManager;

    /**
     * @var WelcomePlugin
     */
    private $welcomePlugin;

    protected function setUp()
    {
        $this->messageManager = $this->getMockForAbstractClass(
            MessageManager::class, ['addSuccessMessage']
        );
        $this->welcomePlugin = new WelcomePlugin($this->messageManager);
    }

    public function testAfterSetCustomerDataAsLoggedInMethod_CanBeCalled()
    {
        $session = $this->getMockBuilder(Session::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->messageManager->expects($this->once())
            ->method('addSuccessMessage')
            ->willReturn($this->messageManager);

        $this->assertSame(
            $session,
            $this->welcomePlugin->afterSetCustomerDataAsLoggedIn($session, $session)
        );
    }
}