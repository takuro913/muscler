<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Training;
use Auth;
use App\Models\User;


class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $trainings = Training::getAllOrderByUpdated_at();
       return response()->view('training.index',compact('trainings'));
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
      // �o���f�[�V����
      $validator = Validator::make($request->all(), [
        'training' => 'required | max:191',
        'comment' => 'required',
      ]);
        // �o���f�[�V����:�G���[
      if ($validator->fails()) {
        return redirect()
          ->route('training.create')
          ->withInput()
          ->withErrors($validator);
      }
        // ? �ҏW �t�H�[�����瑗�M����Ă����f�[�^�ƃ��[�UID���}�[�W���CDB��insert����
      $data = $request->merge(['user_id' => Auth::user()->id])->all();
      $result = Training::create($data);
        // ���[�e�B���O�utodo.index�v�Ƀ��N�G�X�g���M�i�ꗗ�y�[�W�Ɉړ��j
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
    public function edit($id)
    {
        $training = Training::find($id);
        return response()->view('training.edit', compact('training'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
            //�o���f�[�V����
      $validator = Validator::make($request->all(), [
        'training' => 'required | max:191',
        'comment' => 'required',
      ]);
      //�o���f�[�V����:�G���[
      if ($validator->fails()) {
        return redirect()
          ->route('training.edit', $id)
          ->withInput()
          ->withErrors($validator);
      }
      //�f�[�^�X�V����
      $result = Training::find($id)->update($request->all());
      return redirect()->route('training.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $result = Training::find($id)->delete();
        return redirect()->route('training.index');

    }
    public function mydata()
    {
       // User���f���ɒ�`���������[�V�������g�p���ăf�[�^���擾����D
      $trainings = User::query()
        ->find(Auth::user()->id)
        ->userTrainings()
        ->orderBy('created_at','desc')
        ->get();
      return response()->view('training.index', compact('trainings'));
    }
}
