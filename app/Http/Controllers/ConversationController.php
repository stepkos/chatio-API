<?php

namespace App\Http\Controllers;

use App\Http\Requests\Conversation\ConversationStoreRequest;
use App\Http\Requests\Conversation\ConversationUpdateRequest;
use App\Models\Conversation;
use App\Models\User;
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
    public function store(ConversationStoreRequest $request) {
        auth()->user()->conversations()->create($request->validated());
        
        return response()->json([
            'message' => 'success'
        ], 201);
    }

    // GET 	/conversations/{conversation 
    // nazwa pojedynczej kowersacji
    // model-binding = Conversation $conversation
    public function show(Conversation $conversation) {

        // Uzycie polityki
        $this->authorize('view', $conversation);

        return response()->json([
            'data' => $conversation->with('users')->get()
        ]);
    }

    // PUT 	/conversations/{conversation}  
    // zmiana nazwy konwersacji
    public function update(ConversationUpdateRequest $request, Conversation $conversation) {
        $this->authorize('update', $conversation);

        $conversation->update($request->validated());

        return response()->json([
            'message' => 'success'
        ], 200);
    }

    // DELETE  /conversations/{conversation} 
    // usuniecie konwersacji
    public function destroy(Conversation $conversation) {
        $this->authorize('delete', $conversation);

        $conversation->messages()->delete();
        $conversation->users()->detach();
        $conversation->delete();

        return response()->json([
            'message' => 'success'
        ], 200);
    }

    public function addMember(Request $request, Conversation $conversation) {
        $conversation->users()->attach(User::find($request->get('user_id')));

        return response()->json([
            'message' => 'success'
        ], 200);
    }

    public function kickMember(Request $request, Conversation $conversation) {
        $conversation->users()->dettach($request->get('user_id'));

        return response()->json([
            'message' => 'success'
        ], 200);
    }

}
