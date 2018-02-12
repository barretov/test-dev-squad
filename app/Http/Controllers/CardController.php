<?php

namespace App\Http\Controllers;

use App\Card;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{

    /**
     * Method for get cards
     *
     * @return object Cards
     */
    public function index()
    {
        $cards = DB::table('cards')
        ->join('users', 'users.id', '=', 'cards.owner')
        ->select('users.name', 'cards.*')
        ->orderBy('crd_order', 'desc')
        ->get();
        return \Response::json($cards, 200);
    }

    /**
     * Method for save card
     *
     * @param  Request $request card data
     * @return object Result message
     */
    public function store(Request $request)
    {
        $order = Card::where(['idLst' => $request->idLst])->count();
        $card = new Card;
        $card->idLst = $request->idLst;
        $card->owner = Auth::user()->id;
        $card->crd_order = ++$order;
        $card->save();

        return \Response::json([
            'success' => true,
            'id' => $card->id,
            'crd_order' => $card->crd_order
        ], 200);
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
        $idOwner = User::where('id', $request->owner)->pluck('id')->first();
        $card = Card::findOrFail($idx);
        $card->data = $request->data;
        $card->idLst = $request->idLst;
        $card->owner = $idOwner;
        $card->crd_invite = $request->crdInvite;
        $card->save();
        return json_encode(['success' => true], 200);
    }

    /**
     * Method for delete card
     *
     * @param  int $idx Identifier of card
     * @return object Result message
     */
    public function destroy($idx)
    {
        Card::where('id', $idx)->delete();
        return json_encode(['success' => true], 200);
    }

    /**
     * Method for update all cards of a list
     *
     * @param  Request $request cards data
     * @return object Result message
     */
    public function cardsOrder(Request $request)
    {
        try {
            DB::beginTransaction();

            foreach ($request->data['value'] as $key => $value) {
                DB::table('cards')
                ->where('id', $request->data['value'][$key]['id'])
                ->update([
                    'crd_order' => $key,
                    'idLst' => $request->data['idLst']
                ]);
            }
            DB::commit();
            return json_encode(['success' => true], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return json_encode(['error' => true], 500);
        }
    }
}
