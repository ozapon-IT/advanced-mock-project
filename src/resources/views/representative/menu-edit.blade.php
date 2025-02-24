@extends('layouts.representative')

@section('title', '店舗メニュー編集ページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/representative/menu-edit.css') }}">
@endsection

@section('main')
<main>
    <div class="menu-edit">
        <h1 class="menu-edit__heading">メニュー</h1>

        <div class="menu-edit__contents">
            <section class="menu-edit__section">
                <h2 class="menu-edit__subheading">作成</h2>

                <div class="menu-edit__form menu-edit__form--create">
                    <form action="{{ route('representative.shop.menu.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="action" value="create">

                        <div class="menu-edit__form-group">
                            <label class="menu-edit__form-label" for="name">メニュー名</label>

                            <input class="menu-edit__form-input" id="name" type="text" name="name" value="{{ old('name') }}">
                        </div>

                        <x-validation-error field="name" yellow="true" />

                        <div class="menu-edit__form-group">
                            <label class="menu-edit__form-label" for="price">価格</label>

                            <input class="menu-edit__form-input menu-edit__form-input--price" id="price" type="number" name="price" value="{{ old('price') }}">
                            <span class="menu-edit__form-yen-sign">¥</span>
                        </div>

                        <x-validation-error field="price" yellow="true" />

                        <button class="menu-edit__form-button" type="submit">作成する</button>
                    </form>
                </div>
            </section>

            <section class="menu-edit__section">
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

                                        <x-validation-error field="{{ 'name_' . $menu->id }}" />

                                        <x-validation-error field="{{ 'price_' . $menu->id }}" />
                                    </form>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</main>
@endsection