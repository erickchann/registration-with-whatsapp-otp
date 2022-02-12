<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BaileysController extends Controller
{
    public function createNewSession(Request $request)
    {
        $data = Http::post(env('URL_WA_SERVER') . '/session/add', ['id' => $request->id]);
        $res = json_decode($data->getBody());

        $find = Http::get(env('URL_WA_SERVER') . '/session/find/' . $request->id);
		$cek = json_decode($find->getBody());

        if ($cek->success == true) {
            $image = 'berhasil';
        } else {
            $image = $res->data->qr;
        }

        return $image;
    }

    public function sendMessage(Request $request)
    {
        $number = $request->number;
        $message = $request->message;
        $id = $request->id;

        $response = Http::post(env('URL_WA_SERVER') . '/chat/send?id=' . $id, [
            'receiver' => $number,
            'message' => $message
        ]);

        $res = json_decode($response->getBody());

        return $res;
    }

    public function sendBrodcast(Request $request)
    {
        $message = $request->message;
        $id = $request->id;

        $numbers = Contact::all();

        foreach ($numbers as $number) {
            $response = Http::post(env('URL_WA_SERVER') . '/chat/send?id=' . $id, [
                'receiver' => $number->number,
                'message' => $message
            ]);
        }

        $res = json_decode($response->getBody());

        return $res;
    }
}
