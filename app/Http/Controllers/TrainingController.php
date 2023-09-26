<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Training;


class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $training = Training::getAllOrderByUpdated_at();
       return response()->view('training.index',compact('training'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('training.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      // バリデーション
      $validator = Validator::make($request->all(), [
        'training' => 'required | max:191',
        'comment' => 'required',
      ]);
        // バリデーション:エラー
      if ($validator->fails()) {
        return redirect()
          ->route('training.create')
          ->withInput()
          ->withErrors($validator);
      }
        // create()は最初から用意されている関数
        // 戻り値は挿入されたレコードの情報
      $result = Training::create($request->all());
        // ルーティング「todo.index」にリクエスト送信（一覧ページに移動）
      return redirect()->route('training.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $training = Training::find($id);
        return response()->view('training.show', compact('training'));
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
