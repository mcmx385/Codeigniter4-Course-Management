<?php

namespace App\Libraries;

class ArrObjUtil
{
    public function arrCol($arr, $col)
    {
        $list = [];
        foreach ($arr as $item):
            $item = (array) $item;
            array_push($list, $item[$col]);
        endforeach;
        return $list;
    }
}
