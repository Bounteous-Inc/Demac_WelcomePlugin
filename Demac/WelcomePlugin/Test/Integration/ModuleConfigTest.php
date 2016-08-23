<?php

namespace Demac\WelcomePlugin\Test\Integration;


use Magento\Framework\App\DeploymentConfig;
use Magento\Framework\App\DeploymentConfig\Reader;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Component\ComponentRegistrar;
use Magento\Framework\Module\ModuleList;
use Magento\TestFramework\ObjectManager;

/**
 * @package Demac\WelcomePlugin\Test\Integration
 */
class ModuleConfigTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    private $subjectModuleName = 'Demac_WelcomePlugin';

    /**
     * @var ObjectManager
     */
    private $objectManager;

    protected function setUp()
    {
        $this->objectManager = ObjectManager::getInstance();
    }

    public function testTheModuleIsRegistered()
    {
        /** @var ComponentRegistrar $registrar */
        $registrar = $this->objectManager->create(ComponentRegistrar::class);
        $this->assertArrayHasKey(
            $this->subjectModuleName,
            $registrar->getPaths(ComponentRegistrar::MODULE)
        );
    }

    public function testTheModuleIsConfiguredInTestEnvironment()
    {
        /** @var ModuleList $moduleList */
        $moduleList = $this->objectManager->create(ModuleList::class);
        $this->assertTrue(
            $moduleList->has($this->subjectModuleName),
            'The module is not configured and enabled in the test environment'
        );
    }

    public function testTheModuleIsConfiguredInRealEnvironment()
    {
        $directoryList = $this->objectManager->create(
            DirectoryList::class,
            ['root' => BP]
        );
        $deploymentConfigReader = $this->objectManager->create(
            Reader::class,
            ['dirList' => $directoryList]
        );
        $deploymentConfig = $this->objectManager->create(
            DeploymentConfig::class,
            ['reader' => $deploymentConfigReader]
        );
        $moduleList = $this->objectManager->create(
            ModuleList::class,
            ['config' => $deploymentConfig]
        );

        $this->assertTrue($moduleList->has($this->subjectModuleName));
    }
}