<?php
/**
 * Created by PhpStorm.
 * User: CHIDO
 * Date: 22/11/14
 * Time: 01:27
 */

class gv_calender
{
    private $etag = null;
    private $id = null;
    public $name = null;

    public function __construct($etag, $calender_id, $calender_name)
    {
        $this->etag = $etag;
        $this->id = $calender_id;
        $this->name = $calender_name;
    }

}