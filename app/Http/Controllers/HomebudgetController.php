<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\HomeBudget;
use Illuminate\Support\Facades\Validator;

class HomebudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$categories = Category::all();
        $homebudgets = HomeBudget::with('category')->orderBy('date', 'desc')->paginate(3);
        return view('homebudget.index', compact('homebudgets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //バリデーション
        $validated = $request->validate([
            'date' => 'required|date',
            'category' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        //データベースに登録
        $result = HomeBudget::create([
            'date' => $request->date,
            'category_id' => $request->category,
            'price' => $request->price,
        ]);

        //フラッシュメッセージを表示
        if(!empty($result)) {
            session()->flash('flash_message', '支出を登録しました');
        } else {
            session()->flash('flash_message', '支出を登録できませんでした');
        }

        // 支出一覧ページにリダイレクト
        return redirect('/');
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
        $homebudget = HomeBudget::find($id);
        $categories = Category::all();
        return view('homebudget.edit', compact('homebudget', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //バリデーション
        $validated = $request->validate([
            'date' => 'required|date',
            'category_id' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        //データベースに登録
        $hasDate = HomeBudget::where('id', '=', $request->id);
        if ($hasDate->exists()) {
            $hasDate->update([
                'date' => $request->date,
                'category_id' => $request->category_id,
                'price' => $request->price,
            ]);
            session()->flash('flash_message', '支出を更新しました');
        } else {
            session()->flash('flash_error_message', '支出を更新できませんでした');
        }

        // 支出一覧ページにリダイレクト
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
