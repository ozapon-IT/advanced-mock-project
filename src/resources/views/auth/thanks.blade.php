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
            <a class="thanks__button" href="/login">ログインする</a>
        </div>
    </div>
</main>
@endsection