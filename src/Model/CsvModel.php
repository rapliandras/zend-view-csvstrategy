<?php

/*
 * LegoW\Zend-View-CsvStrategy (https://github.com/adamturcsan/zend-view-csvstrategy)
 * 
 * @copyright Copyright (c) 2014-2016 Legow Hosting Kft. (http://www.legow.hu)
 * @license https://opensource.org/licenses/MIT MIT License
 */

namespace LegoW\View\Model;

use Zend\View\Model\ViewModel;
/**
 * Description of CsvModel
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
class CsvModel extends ViewModel
{
    protected $__fileName = "csvmodel.csv";
    
    public function getFileName()
    {
        return $this->__fileName;
    }

    public function setFileName($fileName)
    {
        $this->__fileName = $fileName;
        return $this;
    }
   
}