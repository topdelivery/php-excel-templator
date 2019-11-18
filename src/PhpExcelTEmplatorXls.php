<?php


namespace topdelivery\PhpExcelTemplator;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Ods;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class PhpExcelTemplatorXls extends PhpExcelTemplator
{
    /**
     * {@inheritDoc}
     */
    protected static function getWriter(Spreadsheet $spreadsheet)
    {
        return IOFactory::createWriter($spreadsheet, 'Xls');
    }
}
