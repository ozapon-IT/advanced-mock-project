@extends('layouts.user')

@section('title', 'サンクスページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/thanks.css') }}">
@endsection

@section('header')
<x-header />
@endsection

@section('main')
<main>
    <div class="thanks">
        <div class="thanks__wrapper">
            <p class="thanks__message">会員登録ありがとうございます</p>
            <a class="thanks__login" href="/login">ログインする</a>
            <p class="thanks__indication">
                *登録したメールアドレスを確認するために、送信されたリンクをクリックしてください。
                <form class="thanks__form" action="{{ route('verification.resend') }}" method="POST">
                    @csrf
                    <button class="thanks__resend" type="submit">再送信</button>
                </form>

                <x-session-message :errors="$errors" />
            </p>
        </div>
    </div>
</main>
@endsection