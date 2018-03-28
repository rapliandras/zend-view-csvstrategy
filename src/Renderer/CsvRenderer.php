<?php

/*
 * LegoW\Zend-View-CsvStrategy (https://github.com/adamturcsan/zend-view-csvstrategy)
 * 
 * @copyright Copyright (c) 2014-2016 Legow Hosting Kft. (http://www.legow.hu)
 * @license https://opensource.org/licenses/MIT MIT License
 */

namespace LegoW\View\Renderer;

/**
 * Description of CsvRenderer
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
class CsvRenderer extends \Zend\View\Renderer\PhpRenderer
{

    public function render($nameOrModel, $values = null)
    {
        $output = parent::render($nameOrModel, $values);
        $utf16Output = chr(255) . chr(254) .  mb_convert_encoding($output,
                        'UTF-16LE', 'UTF-8');
        return $utf16Output;
    }

}
