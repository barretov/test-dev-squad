<?php

namespace App\Http\Controllers;

use App\Lists;
use Illuminate\Http\Request;

class ListController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $lists = Lists::orderBy('created_at', 'desc');
    }

    /**
     * Method for save list
     *
     * @param  Request $request List data
     * @return object Result message
     */
    public function store(Request $request)
    {
        $list = new Lists;
        $list->id = $request->id;
        $list->save();
        return json_encode(['message' => 'list created']);
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
        return json_encode(['message' => 'list updated']);
    }

    /**
     * Method for delete list
     *
     * @param  int $idx Identifier of list
     * @return object Result message
     */
    public function destroy($idx)
    {
        $list = Lists::findOrFail($idx);
        $list->delete();
        return json_encode(['message' => 'list deleted']);
    }
}
