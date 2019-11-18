<?php

namespace topdelivery\PhpExcelTemplator\setters;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use topdelivery\PhpExcelTemplator\InsertedCells;
use topdelivery\PhpExcelTemplator\params\SetterParam;

interface ICellSetter
{
	/**
	 * Установить значения в указанной ячейке.
	 * @param SetterParam $setter_param
	 * @param InsertedCells $inserted_cells Объект, хранящий в себе число вставленных ячеек
	 * @return InsertedCells Объект, хранящий в себе число вставленных ячеек
	 */
	public function setCellValue(SetterParam $setter_param, InsertedCells $inserted_cells);
}
