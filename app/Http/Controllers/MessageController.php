<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 12.06.2020
 * Time: 20:52
 */

namespace App\Http\Controllers;


use App\Models\Advertisement;

class MessageController extends Controller
{
    public function index($advertisementId)
    {
        $a = Advertisement::query()->where('id', $advertisementId)->first();

        return view('messages', [
            'title' => $a->title . " " . $a->price . " ($)",
            'messages' => [],
        ]);
    }

    public function store()
    {

    }

    public function conversations()
    {
        return view('conversations');
    }

    public function conversation($conversationId)
    {

    }
}