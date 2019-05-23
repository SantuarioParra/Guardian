<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class FCMController extends Controller
{
    public function sendMessage($life_time,$title, $body, $sound, $data, $token){
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive($life_time);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)
            ->setSound($sound);

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData($data);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
        //dd(FCM::sendTo($token, $option, $notification, $data));
        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
        return $downstreamResponse->numberSuccess();
    }
}
