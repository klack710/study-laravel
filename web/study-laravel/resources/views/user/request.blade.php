@extends('user._layouts.default')
@section('title', 'リクエスト')

@section('content')
<div>
    <h1>リクエスト</h1>
</div>
<div>
    <p>Hello!</p>
    <form method="POST" action="{{ route('user.request.store') }}">
        {{-- 以下でトークンを追加しないと、Laravelの機能を使っていないと判断されて、POSTでエラーが出る --}}
        {{-- 参考.CSRF保護 https://readouble.com/laravel/5.5/ja/routing.html --}}
        {{ csrf_field() }}
        <input type="text" name="message">
        <button>ここに送信</button>
    </form>
    <p>ここに入力結果が出ます:@isset($message){{ $message }}@endif</p>

    <form method="POST" action="{{ route('user.request_receive.store') }}">
        {{-- 以下でトークンを追加しないと、Laravelの機能を使っていないと判断されて、POSTでエラーが出る --}}
        {{-- 参考.CSRF保護 https://readouble.com/laravel/5.5/ja/routing.html --}}
        {{ csrf_field() }}
        <input type="text" name="message">
        <button>request_receiveに送信</button>
    </form>


    <p><a href="{{ route('user.index') }}">トップに戻る</a></p>
</div>
@endsection