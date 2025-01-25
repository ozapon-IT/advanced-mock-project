@extends('layouts.representative')

@section('title', 'メニュー編集ページ(店舗代表者) - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/representative/menu-edit.css') }}">
@endsection

@section('header')
<header class="header">
    <div class="header__container">
        <div class="header__menu">
            <a class="menu__button" href="#modal-menu">
                <i class="bi bi-list"></i>
            </a>
            <h1 class="menu__service-name">Rese</h1>
        </div>
    </div>
</header>
@endsection

@section('main')
<main>
    <div class="menu-edit">
        <h2 class="menu-edit__title">メニュー</h2>

        <div class="menu-edit__contents">
            <div class="contents__create">
                <h3 class="create__title">作成</h3>

                <div class="create__form">
                    <form action="{{ route('create.menu') }}" method="POST">
                        @csrf
                        <input type="hidden" name="action" value="create">

                        <section class="form__section">
                            <h4 class="section__title">メニュー名</h4>

                            <input class="section__input" type="text" name="name" value="{{ old('name') }}">
                        </section>

                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror

                        <section class="form__section">
                            <h4 class="section__title">価格</h4>

                            <input class="section__input section__input--price" type="number" name="price" value="{{ old('price') }}">
                            <span class="section__input--yen-sign">¥</span>
                        </section>

                        @error('price')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                        <button class="form__button" type="submit">作成する</button>
                    </form>
                </div>
            </div>

            <div class="contents__update">
                <h3 class="update__title">更新</h3>

                <div class="update__form">
                    <table class="form__table">
                        <thead>
                            <tr class="table__row">
                                <th colspan="3">Menu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($menus)
                                @foreach ($menus as $menu)
                                    <form action="{{ route('update.menu', $menu) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action" value="update">

                                        <tr class="table__row">
                                            <td>
                                                <input class="table__input table__input--name" type="text" name="name_{{ $menu->id }}" value="{{ old('name_' . $menu->id, $menu->name) }}">
                                            </td>
                                            <td>
                                                <input class="table__input table__input--price" type="number" name="price_{{ $menu->id }}" value="{{ old('price_' . $menu->id, $menu->price) }}">
                                                <span class="table__input--yen-sign">¥</span>
                                            </td>
                                            <td>
                                                <button class="table__button" type="submit">更新</button>
                                            </td>
                                        </tr>
                                        @error('name_' . $menu->id)
                                            <span class="error-message--red">{{ $message }}</span>
                                        @enderror
                                        @error('price_' . $menu->id)
                                            <span class="error-message--red">{{ $message }}</span>
                                        @enderror
                                    </form>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection