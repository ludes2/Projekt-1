<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 14.11.2017
 * Time: 21:01
 */

interface model_interface
{
    public function calculateAverage();
    public function calculateAverageDuration($userId);
    public function calculateAverageLatency();
    public function calculateAverageInterval();

}