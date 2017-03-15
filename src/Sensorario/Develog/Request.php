<?php

namespace Sensorario\Develog;

interface Request
{
    public function getHttpVerb();

    public static function getRequestUri();

    public static function getRemoteAddress();

    public static function getUserAgent();

    public static function getAccept();
}
