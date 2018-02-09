<?php

namespace App\Http\Controllers;

use App\Card;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    /**
     * Method for save card
     *
     * @param  Request $request card data
     * @return object Result message
     */
    public function store(Request $request)
    {
        $card = new Card;
        $card->id = $request->id;
        $card->idLst = $request->idLst;
        $card->owner = Auth::user()->id;
        $card->save();
        return json_encode(['message' => 'card created']);
    }

    /**
     * Method for update card
     *
     * @param  Request $request card data
     * @param  int $idx Identifier of card
     * @return object Result message
     */
    public function update(Request $request, $idx)
    {
        $idOwner = User::where('name', $request->owner)->pluck('id')->first();
        $card = Card::findOrFail($idx);
        $card->data = $request->data;
        $card->idLst = $request->idLst;
        $card->owner = $idOwner;
        $card->save();
        return json_encode(['message' => $request->owner]);
        // return json_encode(['message' => 'card updated']);
    }

    /**
     * Method for delete card
     *
     * @param  int $idx Identifier of card
     * @return object Result message
     */
    public function destroy($idx)
    {
        $card = Card::findOrFail($idx);
        $card->delete();
        return json_encode(['message' => 'card deleted']);
    }
}
