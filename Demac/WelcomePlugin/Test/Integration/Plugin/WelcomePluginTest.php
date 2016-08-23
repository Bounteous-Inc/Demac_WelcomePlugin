<?php

namespace Demac\WelcomePlugin\Test\Integration\Plugin;


use Demac\WelcomePlugin\Plugin\Frontend\WelcomePlugin;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Area;
use Magento\TestFramework\App\State;
use Magento\TestFramework\Interception\PluginList;
use Magento\TestFramework\ObjectManager;

/***
 * Class WelcomePluginTest
 * @package Demac\WelcomePlugin\Test\Integration\Plugin
 */
class WelcomePluginTest extends \PHPUnit_Framework_TestCase
{
    private $objectManager;

    protected function setUp()
    {
        $this->objectManager = ObjectManager::getInstance();
    }

    public function testThePluginIsRegistered()
    {
        /** @var State $appState */
        $appState = $this->objectManager->create(State::class);
        $appState->setAreaCode(Area::AREA_FRONTEND);

        /** @var PluginList $pluginList */
        $pluginList = $this->objectManager->create(PluginList::class);
        $pluginInfo = $pluginList->get(Session::class, []);

        $this->assertSame(WelcomePlugin::class, $pluginInfo['demac_welcomeplugin_frontend_welcomeplugin']['instance']);
    }
}