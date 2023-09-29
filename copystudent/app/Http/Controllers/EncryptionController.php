<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;

class EncryptionController extends Controller
{
    public function getEncryptionKey()
    {
        $key = "Config::get('APP_KEY')"; // Assurez-vous que ENCRYPTION_KEY est défini dans votre .env

        return response()->json(['key' => $key]);
    }
}
