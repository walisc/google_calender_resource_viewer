<?php
/**
 * Created by PhpStorm.
 * User: CHIDO
 * Date: 22/11/14
 * Time: 01:21
 */


require_once 'calender_model.php';

class calender_processor
{
    public static function process($calender_service)
    {
        $calendarList = $calender_service->calendarList->listCalendarList();
        $calender_objs = array();

        foreach($calendarList as $calender_item)
        {
           array_push($calender_objs, new gv_calender($calender_item["etag"], $calender_item["id"], $calender_item["summary"] ));
        }

        return $calender_objs;
    }
}