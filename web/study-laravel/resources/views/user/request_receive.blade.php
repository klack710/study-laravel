@extends('user._layouts.default')
@section('title', 'リクエストを受け取ったページ')

@section('content')
<div>
    <h1>リクエストを受け取ったページ
    </h1>
</div>
<div>
    <p>Hello!</p>
    <p><a href="{{ route('user.request_receive.store') }}">クエリを付与せずGETで開く</a></p>
    <p><a href="{{ route('user.request_receive.store') }}?message='query_message'">?message='query_message'を付与してGETで開く</a></p>
    <form method="POST" action="{{ route('user.request_receive.store') }}">
        {{-- 以下でトークンを追加しないと、Laravelの機能を使っていないと判断されて、POSTで419エラーが出る --}}
        {{-- 参考.CSRF保護 https://readouble.com/laravel/5.5/ja/routing.html --}}
        {{ csrf_field() }}
        <input type="text" name="message">
        <button>ここに送信</button>
    </form>

    <table>
        <tr>
            <th>$request->all():</th>
            <th>
                @foreach($all as $key => $item)
                {{ $key . '=>' . $item }}<br>
                @endforeach
            </th>
        </tr>
        <tr>
            <th>$request->message:</th>
            <th>{{ $message }}</th>
        </tr>
        <tr>
            <th>$request->has('message'):</th>
            <th>{{ $message_has }}</th>
        </tr>
        <tr>
            <th>$request->input('message', 'messageがないよ！'):</th>
            <th>{{ $message_input }}</th>
        </tr>
        <tr>
            <th>$request->query('message', 'queryにmessageがないよ！'):</th>
            <th>{{ $message_query }}</th>
        </tr>
        <tr>
            <th>$request->path():</th>
            <th>{{ $request_uri }}</th>
        </tr>
        <tr>
            <th>$request->url():</th>
            <th>{{ $request_url }}</th>
        </tr>
        <tr>
            <th>$request->fullUrl():</th>
            <th>{{ $request_url_with_query }}</th>
        </tr>
        <tr>
            <th>$request->is('request_*'):</th>
            <th>{{ $is_to_request }}</th>
        </tr>
        <tr>
            <th>$request->method():</th>
            <th>{{ $method }}</th>
        </tr>
        <tr>
            <th>$request->isMethod('post'):</th>
            <th>{{ $is_post_method }}</th>
        </tr>
    </table>

    <p><a href="{{ route('user.index') }}">トップに戻る</a></p>
</div>
@endsection