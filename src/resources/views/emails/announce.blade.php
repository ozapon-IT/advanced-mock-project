<x-mail::message>
{{-- タイトル --}}
# {{ $announce->title }}

{{-- 挨拶 --}}
{{ $user->name }} 様

---

{{-- 本文 --}}
{!! nl2br(e($announce->body)) !!}

---

いつもご利用ありがとうございます。

</x-mail::message>