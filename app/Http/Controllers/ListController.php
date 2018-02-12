<?php

namespace App\Http\Controllers;

use App\Lists;
use App\Card;
use Illuminate\Http\Request;

class ListController extends Controller
{

    /**
     * Method for get lists
     *
     * @return object Lists
     */
    public function index()
    {
        return \Response::json(Lists::all(), 200);
    }

    /**
     * Method for save list
     *
     * @return object Result message
     */
    public function store()
    {
        $list = new Lists;
        $list->name = 'New List';
        $list->save();

        return \Response::json([
            'success' => true,
            'id' => $list->id
        ], 200);
    }

    /**
     * Method for update list
     *
     * @param  Request $request List data
     * @param  int $idx Identifier of list
     * @return object Result message
     */
    public function update(Request $request, $idx)
    {
        $list = Lists::findOrFail($idx);
        $list->name = $request->name;
        $list->save();
        return \Response::json(['success' => true], 200);
    }

    /**
     * Method for delete list
     *
     * @param  int $idx Identifier of list
     * @return object Result message
     */
    public function destroy($idx)
    {
        // remove cards of the list, if exists
        Card::where('idLst', $idx)->delete();
        Lists::where('id', $idx)->delete();
        return \Response::json(['success' => true], 200);
    }
}
