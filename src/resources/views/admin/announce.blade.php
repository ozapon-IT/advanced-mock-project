@extends('layouts.admin')

@section('title', 'お知らせメール作成ページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/announce.css') }}">
@endsection

@section('main')
<main>
    <div class="announce">
        <h1 class="announce__heading">お知らせメール</h1>

        <div class="announce__contents">
            <div class="announce__create">
                <h2 class="announce__subheading">作成</h2>

                <form class="announce__form" action="{{ route('admin.users.announcements.send') }}" method="POST">
                    @csrf

                    <div class="announce__form-group">
                        <label class="announce__label" for="mail-title">タイトル</label>

                        <input class="announce__input" type="text" name="title" id="mail-title" value="{{ old('title') }}">

                        <x-validation-error field="title" yellow="true" />
                    </div>

                    <div class="announce__form-group">
                        <label class="announce__label" for="mail-body">本文</label>

                        <textarea class="announce__textarea" name="body" id="mail-body">{{ old('body') }}</textarea>

                        <x-validation-error field="body" yellow="true" />
                    </div>

                    <button class="announce__button" type="submit">送信</button>
                </form>
            </div>

            <div class="announce__history">
                <h2 class="announce__subheading">履歴</h2>

                <div class="announce__pagination">
                    {{ $announces->links('vendor.pagination.custom')}}
                </div>

                <table class="announce__table">
                    <thead>
                        <tr class="announce__table-row">
                            <th>タイトル</th>
                            <th>詳細</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($announces as $announce)
                            <tr class="announce__table-row">
                                <td>{{ $announce->title }}</td>
                                <td><a class="announce__link" href="{{ route('admin.users.announcements.show', $announce) }}">詳細</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection