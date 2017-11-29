<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 28.11.2017
 * Time: 19:43
 */

class averages_view
{
    private $averagesModel;

    function __construct(averages $averages_model)
    {
        $this->averagesModel = $averages_model;
    }

    public function showDurationAverages($userID){
        $averages = $this->averagesModel->getDurationAverage($userID);
        var_dump($averages);
    }

}