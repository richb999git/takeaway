<?php

namespace App\Services;

class OpeningTimes 
{

    public static function OpeningTimes() {
        date_default_timezone_set("Europe/London");
        $current_time = date("h:i a");
        $opening = "05:00 pm";
        $closing = "11:30 pm";
        $last_delivery = "10:30 pm";
        $last_collection = "11:15 pm";
        $current_time = \DateTime::createFromFormat('H:i a', $current_time);
        $opening = \DateTime::createFromFormat('H:i a', $opening);
        $closing = \DateTime::createFromFormat('H:i a', $closing);
        $last_delivery = \DateTime::createFromFormat('H:i a', $last_delivery);
        $last_collection = \DateTime::createFromFormat('H:i a', $last_collection); 
        return ['current_time' => $current_time,
                'opening' => $opening,
                'closing' => $closing,
                'last_delivery' => $last_delivery,
                'last_collection' => $last_collection,
                'day_closed' => "Tuesday"];
    }
        

}