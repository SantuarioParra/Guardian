<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class FCMController extends Controller
{
    public function sendMessage($life_time,$title, $body, $sound, $data){
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive($life_time*20);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)
            ->setSound($sound);

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData($data);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
        $token = "dN-sfRejVws:APA91bEc5Hoor_Yt5dUjhPAjxpTlNjQh9T2aIbf0gZdy9LHnellbnbeG5GVAPKzKVsOkkSuINzMG_J6eotZVYhGS8sYs0iGHcLeIWCTW6nQyeBUKplX9eI57qN2yz69k1xe3DjfepSNv";
        //dd(FCM::sendTo($token, $option, $notification, $data));
        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
        return $downstreamResponse->numberSuccess();;
    }
}
