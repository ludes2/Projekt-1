<?php
/**
 * Created by PhpStorm.
 * User: salu
 * Date: 11.12.2017
 * Time: 13:53
 */


/**
 * Ziel dieser Klasse ist es, die routen für die entsprechenden model, views und controller festzulegen, damit jedes
 * model den richtigen controller und die entsprechende view erhält.
 * Class router
 */

class router
{
    private $table = array();

    function __construct()
    {
        /**in der table wird eine Router festgelegt. Anschliessend werden Klassennamen
         * gebraucht. Es werden keine Objekte übergeben. Ziel ist es, dass die Instanzen
         * erst erzeugt werden, wenn sie gebraucht werden.
         * **/
        $this->table['duration'] = new route('Model', 'View', 'Controller');
        //$this->table['interval'] = new route('Model', 'View', 'Controller');
        //$this->table['latency'] = new route('Model', 'View', 'Controller');
    }

    /**
     * @param $route
     * @return mixed
     */
    public function getRoute($route)
    {
        $route = strtolower($route);
        return $this->table[$route];
    }

}