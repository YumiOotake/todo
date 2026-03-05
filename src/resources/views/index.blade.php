@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
    @if (session('message'))
        <div class="todo__alert">
            <div class="todo__alert--success">
                {{ session('message') }}
            </div>
        </div>
    @endif
    @if ($errors->any())
        <div class="todo__alert--danger">
            {{-- @error('content')
                    {{ $message }}
                @enderror --}}
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="todo__content">
        <div class="todo__content-header">
            <h2 class="todo__content-title">新規作成</h2>
        </div>
        <form action="/todos" class="create-form" method="post">
            @csrf

            <div class="create-form__item">
                <input class="create-form__item-input" type="text" name="content">
            </div>
            <div class="create-form__category">
                <select class="create-form__item-select" name="category_id">
                    <option value="">カテゴリ</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="create-form__button">
                <button class="create-form__button-submit" type="submit">作成</button>
            </div>

        </form>
        <div class="todo__content-header">
            <h2 class="todo__content-title">Todo検索</h2>
        </div>
        <form action="/todos/search" class="create-form" method="get">
            @csrf

            <div class="create-form__item">
                <input class="create-form__item-input" type="text" name="keyword" value="{{ old('keyword') }}">
            </div>
            <div class="create-form__category">
                <select class="create-form__item-select" name="category_id">
                    <option value="">カテゴリ</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="create-form__button">
                <button class="create-form__button-submit" type="submit">検索</button>
            </div>
        </form>

        <div class="todo-table">
            <table class="todo-table__inner">
                <tr class="todo-table__row">
                    <span class="todo-table__header todo-table__header-span">Todo</span>
                    <span class="todo-table__header todo-table__header-span">カテゴリ</span>
                </tr>
                @foreach ($todos as $todo)
                    <tr class="todo-table__row">
                        <td class="todo-table__item">
                            <form action="/todos/update" class="update-form" method="post">
                                @method('PATCH')
                                @csrf
                                <div class="update-form__item">
                                    <input class="update-form__item-input" type="text" name="content"
                                        value="{{ $todo['content'] }}">
                                    <input type="hidden" name="id" value="{{ $todo['id'] }}">
                                </div>
                                <div class="form__category">
                                    <p class="form__category-item">{{ $todo['category']['name'] }}</p>
                                </div>
                                <div class="update-form__button">
                                    <button class="update-form__button-submit" type="submit">更新</button>
                                </div>
                            </form>
                        </td>
                        <td class="todo-table__item">
                            <form action="/todos/delete" class="delete-form" method="post">
                                @method('DELETE')
                                @csrf
                                <input type="hidden" name="id" value="{{ $todo['id'] }}">
                                <div class="delete-form__button">
                                    <button class="delete-form__button-submit" type="submit">削除</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
                {{-- <tr class="todo-table__row">
                    <td class="todo-table__item">
                        <form action="/todos/update" class="update-form" method="post">
                            @csrf
                            <div class="update-form__item">
                                <input class="update-form__item-input" type="text" name="content" value="test">
                            </div>
                            <div class="update-form__button">
                                <button class="update-form__button-submit" type="submit">更新</button>
                            </div>
                        </form>
                    </td>
                    <td class="todo-table__item">
                        <form action="/todos/delete" class="delete-form" method="post">
                            @csrf
                            <div class="delete-form__button">
                                <button class="delete-form__button-submit" type="submit">削除</button>
                            </div>
                        </form>
                    </td>
                </tr> --}}
            </table>
        </div>
    </div>
@endsection
