<?php

namespace App\Http\Controllers\CategoryChat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryMessage;
use Illuminate\Support\Facades\Auth;
use Response;

class CategoryChatController extends Controller {

    public function index() {
        $category = CategoryMessage::where('company_id', Auth::user()->company_id)->get();
        return view('categorychat/index')
                        ->with('category', $category);
    }
    
    public function store(Request $request)
    {
        $data = [
            'company_id' => Auth::user()->company_id,
            'name' => strtoupper($request->input('name')),
            'description' => strtoupper($request->input('description')),
            'date_created' => date('Y-m-d'),
            'status' => true,
        ];
        CategoryMessage::create($data);
        return Response::json(true);
    }

    public function update(Request $request, $id)
    {
        $category = CategoryMessage::find($id);
        $category->company_id = Auth::user()->company_id;
        $category->name = strtoupper($request->input('name'));
        $category->description = strtoupper($request->input('description'));
        $category->date_created = date('Y-m-d');
        $category->status = true;
        $category->save();
        return Response::json(true);
    }

    
    public function edit($id)
    {
        $category = CategoryMessage::find($id);
        return Response::json($category);
    }

}
