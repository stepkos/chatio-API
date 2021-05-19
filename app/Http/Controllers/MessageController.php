<?php

namespace App\Http\Controllers;

use App\Http\Requests\Message\MessageStoreRequest;
use App\Http\Requests\Message\MessageUpdateRequest;
use App\Models\Conversation;
use App\Models\Message;

class MessageController extends Controller {

    // GET 	/conversations/{conversation}/messages 		
    // wiadomosci pojedynczej konwersacji z paginacja
    public function index(Conversation $conversation) {
        return response()->json([
            'data' => $conversation->messages
        ]);
    }

    // POST /conversations/{conversation}/messages 
    // wyslanie wiadmosci
    public function store(MessageStoreRequest $request, Conversation $conversation) {
        $conversation->messages()->create(
            array_merge($request->validated(), ["user_id" => auth()->user()->id])
        );

        return response()->json([
            'message' => 'success'
        ], 201);
    }

    // GET 	/conversations/{conversation}/messages/{message} 
    // pojedyncza wiadomosc
    public function show(Conversation $conversation, Message $message) {
        return response()->json([
            'data' => $message
        ], 200);
    }

    // PUT 	/conversations/{conversation}/messages/{message} 
    // edycja pojedynczej wiadomosci
    public function update(MessageUpdateRequest $request, Conversation $conversation, Message $message) {
        $message->update($request->validated());

        return response()->json([
            "message" => "success"
        ], 200);
    }

    // DELETE  /conversations/{conversation}/messages/{message} 
    // usuniecie pojedynczej wiadomosci
    public function destroy(Conversation $conversation, Message $message) {
        $message->delete();

        return response()->json([
            'message' => 'success'
        ], 200);
    }
}
