<?php
/**
 * Created by PhpStorm.
 * User: rober
 * Date: 10.04.2019
 * Time: 16:05
 */

namespace app\adapter;

use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;

class ReadFilter implements IReadFilter {

    public function readCell($column, $row, $worksheetName = '') {
        // Read title row and rows 20 - 30
        if ($row > 1 && $column<6 ) {
            return true;
        }
        return false;
    }


}