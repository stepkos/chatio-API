<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    // GET 	/conversations
    // wszystkie nazwy konwersacje tego uzytkowniaka
    public function index() {
        return response()->json([
            'data' => auth()->user()->conversations
        ]);
    }

    // /POST 	/conversations 
    // stworzenie nowej konwersacji
    public function store() {

    }

    // GET 	/conversations/{conversation 
    // nazwa pojedynczej kowersacji
    public function show(Conversation $conversation) {
        return response()->json([
            'data' => $conversation
        ]);
    }

    // PUT 	/conversations/{conversation}  
    // zmiana nazwy konwersacji
    public function update($slug) {

    }

    // DELETE  /conversations/{conversation} 
    // usuniecie konwersacji
    public function destroy($slug) {

    }

}
