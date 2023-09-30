<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\User;


class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // ? �󔒍폜
        $keyword = trim($request->keyword);
        $users  = User::where('name', 'like', "%{$keyword}%")->pluck('id')->all();
        $trainings = Training::query()
            ->where('training', 'like', "%{$keyword}%")
            ->orWhere('comment', 'like', "%{$keyword}%")
            ->orWhereIn('user_id', $users)
            ->get();
        return response()->view('training.index', compact('trainings'));

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return response()->view('search.input');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
