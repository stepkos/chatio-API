<?php

namespace App\Http\Controllers;

use App\Http\Requests\Message\StoreRequest;
use App\Models\Conversation;
use Illuminate\Http\Request;

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
    public function store(StoreRequest $request, Conversation $conversation) {
        if (!$conversation)
            $conversation = auth()->user()->conversations()->create();

        // \Log::debug($conversation->messages);
        // $conversation->messages()->create($request->validated());
        // return response()->json([
        //     'message' => 'success'
        // ], 201);

        \Log::debug($conversation->messages);
        $conversation->messages()->create([
            'content' => $request->validated('content'),
            'user_conversation_id' => $conversation->users()->where(['user_id' => auth()->user()->id])
        ]);

        return response()->json([
            'message' => 'success'
        ], 201);
    }

    // GET 	/conversations/{conversation}/messages/{message} 
    // pojedyncza wiadomosc
    public function show() {
      
    }

    // PUT 	/conversations/{conversation}/messages/{message} 
    // edycja pojedynczej wiadomosci
    public function update($slug) {

    }

    // DELETE  /conversations/{conversation}/messages/{message} 
    // usuniecie pojedynczej wiadomosci
    public function destroy($slug) {

    }
}
