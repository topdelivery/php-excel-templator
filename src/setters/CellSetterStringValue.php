<?php

namespace topdelivery\PhpExcelTemplator\setters;

use Exception;
use topdelivery\PhpExcelTemplator\InsertedCells;
use topdelivery\PhpExcelTemplator\params\SetterParam;
use topdelivery\PhpExcelTemplator\params\ExcelParam;
use topdelivery\PhpExcelTemplator\params\CallbackParam;

class CellSetterStringValue implements ICellSetter
{
    /**
     * {@inheritdoc}
     * @throws Exception
     */
	public function setCellValue(SetterParam $setterParam, InsertedCells $insertedCells) {
		$sheet = $setterParam->sheet;
		$row_key = $setterParam->row_key;
		$col_key = $setterParam->col_key;
		$current_col_content = $setterParam->col_content;
		$tpl_var_name = $setterParam->tpl_var_name;
		$param = $setterParam->params[$tpl_var_name];
		if ( ! $this->_validateValue($param->value)) {
			return $insertedCells;
		}

		$coordinate = $insertedCells->getCurrentCellCoordinate($row_key, $col_key);
		$col_value = strtr($current_col_content, [$tpl_var_name => $param->value]);
		$sheet->setCellValue($coordinate, $col_value);
		if ($param->callback) {
			$callbackParam = new CallbackParam([
				'sheet'=>$sheet, 'coordinate'=>$coordinate, 'param'=>$param->value,
				'tpl_var_name'=>$tpl_var_name, 'row_index'=>0, 'col_index'=>0,
			]);
			call_user_func($param->callback, $callbackParam);
		}

		return $insertedCells;
	}

    /**
     * @param mixed $value
     * @return boolean
     * @throws Exception
     */
	private function _validateValue($value)
	{
		if (is_array($value)) {
			throw new Exception('В классе '.ExcelParam::class.' поле "value" не должно быть массивом, когда используется сеттер '.__CLASS__.'.');
		}
		return true;
	}
}
