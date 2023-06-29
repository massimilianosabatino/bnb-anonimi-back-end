<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request){
        
        $id = $request['id'];
        $name = $request['name'];
        $email = $request['email'];
        $content = $request['content'];
        $date = $request['date'];

        if(empty($name) || empty($email) || empty($content)){
            return response()->json([
                'success' => false,
                'result' => 'Compilare tutti i campi',
            ]);
        }else{

            $newMessage = new Message();
            $newMessage->apartment_id = $id;
            $newMessage->name = $name;
            $newMessage->email = $email;
            $newMessage->content = $content;
            $newMessage->send_date = $date;
            $newMessage->save();
            return response()->json([
            'success'=> true,
            'result' => 'Messaggio inviato con successo',
        ]);
        }
        
    }
}
