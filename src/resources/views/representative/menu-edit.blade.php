@extends('layouts.representative')

@section('title', 'メニュー編集ページ(店舗代表者) - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/representative/menu-edit.css') }}">
@endsection

@section('header')
<header class="header">
    <div class="header__wrapper">
        <div class="header__menu">
            <a class="header__menu-toggle" href="#modal-menu">
                <i class="bi bi-list"></i>
            </a>
            <span class="header__service-name">Rese</span>
        </div>
    </div>
</header>
@endsection

@section('main')
<main>
    <div class="menu-edit">
        <h1 class="menu-edit__heading">メニュー</h1>

        <div class="menu-edit__contents">
            <div class="menu-edit__contents-wrapper">
                <h2 class="menu-edit__subheading">作成</h2>

                <div class="menu-edit__form menu-edit__form--create">
                    <form action="{{ route('representative.shop.menu.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="action" value="create">

                        <div class="menu-edit__form-group">
                            <p>メニュー名</p>

                            <input class="menu-edit__form-input" type="text" name="name" value="{{ old('name') }}">
                        </div>

                        @error('name')
                            <span class="error-message error-message--yellow">{{ $message }}</span>
                        @enderror

                        <div class="menu-edit__form-group">
                            <p>価格</p>

                            <input class="menu-edit__form-input menu-edit__form-input--price" type="number" name="price" value="{{ old('price') }}">
                            <span class="menu-edit__form-yen-sign">¥</span>
                        </div>

                        @error('price')
                            <span class="error-message error-message--yellow">{{ $message }}</span>
                        @enderror
                        <button class="menu-edit__form-button" type="submit">作成する</button>
                    </form>
                </div>
            </div>

            <div class="menu-edit__contents-wrapper">
                <h2 class="menu-edit__subheading">更新</h2>

                <div class="menu-edit__form menu-edit__form--update">
                    <table class="menu-edit__table">
                        <thead>
                            <tr class="menu-edit__table-row">
                                <th colspan="3">Menu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($menus)
                                @foreach ($menus as $menu)
                                    <form action="{{ route('representative.shop.menu.update', $menu) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action" value="update">

                                        <tr class="menu-edit__table-row">
                                            <td>
                                                <input class="menu-edit__table-input menu-edit__table-input--name" type="text" name="name_{{ $menu->id }}" value="{{ old('name_' . $menu->id, $menu->name) }}">
                                            </td>
                                            <td>
                                                <input class="menu-edit__table-input menu-edit__table-input--price" type="number" name="price_{{ $menu->id }}" value="{{ old('price_' . $menu->id, $menu->price) }}">
                                                <span class="menu-edit__table-yen-sign">¥</span>
                                            </td>
                                            <td>
                                                <button class="menu-edit__table-button" type="submit">更新</button>
                                            </td>
                                        </tr>
                                        @error('name_' . $menu->id)
                                            <span class="error-message">{{ $message }}</span>
                                        @enderror
                                        @error('price_' . $menu->id)
                                            <span class="error-message">{{ $message }}</span>
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