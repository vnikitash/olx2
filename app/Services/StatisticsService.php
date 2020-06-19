<?php

namespace App\Services;


use App\Exceptions\StatisticsException;
use App\Exceptions\Statistics2Exception;

class StatisticsService
{
    public function sendStats(string $str)
    {
        if (rand(1,3) === 2) {
            throw new StatisticsException();
        }
    }

    public function sendStats2(string $str)
    {
        if (rand(1,3) === 2) {
            throw new Statistics2Exception();
        }
    }
}