<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Note;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Note::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'note' => 'required',
            'category_id' => 'exists:categories,id'
        ]);


        $data = $request->only(['note', 'category_id']);
        $note = Note::create($data);

        return [
            'success' =>  true,
            'note' => $note->toArray()
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $this->validate($request, [
            'note' => 'required',
            'category_id' => 'exists:categories,id'
        ]);

        $note->fill($request->all());
        $note->save();

        return [
            'success' => true,
            'note' => $note
        ];
    }

    public function destroy(Note $note)
    {
        //
        $note->delete();
        return [
            'success' => true,
        ];
    }

    public function listNotesAndCategories()
    {
        $notes = Note::all();
        $categories = Category::all();

        return [
            'success' => true,
            'data' => compact('notes', 'categories')
        ];
    }
}
