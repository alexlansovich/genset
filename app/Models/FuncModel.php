<?php

namespace App\Models;

use CodeIgniter\Model;

class FuncModel extends Model
{
    public function calculateTimeDifference($timestamp1, $timestamp2)
    {
        $diffSeconds = abs($timestamp1 - $timestamp2);
        // Calculate hours and minutes
        $hours = floor($diffSeconds / 3600); // 1 hour = 3600 seconds
        $minutes = floor(($diffSeconds % 3600) / 60); // 1 minute = 60 seconds
        // If hours are less than 1, set them to 0
        if ($hours < 1)
            return "$minutes хв.";
        else
            return "$hours год., $minutes хв.";
    }

    public function convertArray($array)
    {
        $outArray = [];
        //convert array to new array with index=id
        foreach ($array as $item)
        {
            if (isset($item['id']) && $item['id'] !== '') {
                $outArray[$item['id']] = $item;
            }
            else return false;
        }
        return $outArray;
    }

    public function canUser ($path)
    {
        $user = auth()->user();
        if ($user)
        {
            return $this->getModelFunction($path);
        }
        else
            return 'no loged';
    }


}

