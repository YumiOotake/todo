<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;

use function PHPUnit\Framework\directoryExists;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return view('index', compact('todos'));
    }
    public function store(TodoRequest $request)
    {
        $todo = $request->only(['content']); #受け取り
        Todo::create($todo); #保存
        return redirect('/')->with('message', 'Todoを作成しました'); #戻る
    }
    public function update(TodoRequest $request)
    {
        $todo = $request->only(['content']);
        // unset($todo['_token']); 不要
        Todo::findOrFail($request->id)->update($todo);
        return redirect('/')->with('message', 'Todoを更新しました');
    }
    public function destroy(Request $request)
    {
        Todo::findOrFail($request->id)->delete();
        return redirect('/')->with('message', 'Todoを削除しました');
    }
}
