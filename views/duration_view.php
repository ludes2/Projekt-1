<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 22.11.2017
 * Time: 14:57
 */

class duration_view
{
    private $durationModel;

    function __construct(duration $durationModel)
    {
        $this->durationModel = $durationModel;
    }

    public function render() {
        $lastFive = $this->durationModel->getLastFiveDurationsOfUser(5);
        echo $lastFive;
        echo "hallo";
    }

}