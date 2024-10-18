<?php

namespace App\Services;

class GetApiKeyService
{
    public static function getApiKey():string
    {
        return file_get_contents('../../apikey');
    }

}
