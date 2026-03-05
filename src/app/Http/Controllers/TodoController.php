<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;

use function PHPUnit\Framework\directoryExists;

class TodoController extends Controller
{
    public function index()
    {
        // $todos = Todo::all();
        $todos = Todo::with('category')->get(); //一緒にカテゴリも持っていく
        $categories = Category::all();
        return view('index', compact('todos', 'categories'));
    }
    public function store(TodoRequest $request)
    {
        $todo = $request->only(['content', 'category_id']); #受け取り
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

    public function search(Request $request)
    {
        $todos = Todo::with('category')
        ->CategorySearch($request->category_id)
        ->KeywordSearch($request->keyword)
        ->get();
        $categories = Category::all();

        return view('index', compact('todos', 'categories'));
    }
}
