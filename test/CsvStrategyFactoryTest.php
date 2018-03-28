<?php

/*
 * LegoW\Zend-View-CsvStrategy (https://github.com/adamturcsan/zend-view-csvstrategy)
 * 
 * @copyright Copyright (c) 2014-2016 Legow Hosting Kft. (http://www.legow.hu)
 * @license https://opensource.org/licenses/MIT MIT License
 */

namespace LegoW\View\Test;

use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;
use Zend\View\HelperPluginManager;
use LegoW\View\Strategy\CsvStrategyFactory;
use LegoW\View\Strategy\CsvStrategy;

/**
 * Description of CsvStrategyFactoryTest
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
class CsvStrategyFactoryTest extends TestCase
{
    public function testFactory()
    {
        $mockContainer = $this->createMock(ContainerInterface::class);
        
        $mockViewHelperManager = $this->createMock(HelperPluginManager::class);
        
        $mockContainer->method('get')
                      ->will($this->onConsecutiveCalls([],$mockViewHelperManager));
        
        $csvStrategyFactory = new CsvStrategyFactory();
        
        $this->assertInstanceOf(CsvStrategy::class, $csvStrategyFactory($mockContainer, 'CsvStrategy'));
    }
}
