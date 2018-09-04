@extends('user._layouts.default')
@section('title', 'リクエストを受け取ったページ')

@section('content')
<div>
    <h1>リクエストを受け取ったページ</h1>
</div>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div>
    <p>以下のパターンを試してみよう！</p>
    <ol>
        <li>なにかを書いてpostする</li>
        <li>クエリを付与してGETで開く(all、method、queryに注目)</li>
        <li>クエリを付与せずGETで開く(inputとhasとfilledに注目)</li>
        <li>何も書かずにpostする(hasとfilledに注目)</li>
    </ol>
    <p><a href="{{ route('user.request_receive.store') }}">クエリを付与せずGETで開く</a></p>
    <p><a href="{{ route('user.request_receive.store') }}?message='query_message'">?message='query_message'を付与してGETで開く</a></p>
    <form method="POST" action="{{ route('user.request_receive.store') }}" enctype="multipart/form-data">
        {{-- 以下でトークンを追加しないと、Laravelの機能を使っていないと判断されて、POSTで419エラーが出る --}}
        {{-- 参考.CSRF保護 https://readouble.com/laravel/5.5/ja/routing.html --}}
        {{ csrf_field() }}
        <p>message: <input type="text" name="message" value="{{ old('message') }}"></p>
        <p>cookie: <input type="text" name="for_cookie"></p>
        <p>encrypt_cookie: <input type="text" name="encrypted_cookie"></p>
        <p><input type="file" name="upfile"/></p>
        <button>ここに送信</button>
    </form>
    <p><a href="{{ route('user.dl_jpeg') }}">アップロードしたファイルをダウンロード</a></p>

    <table>
        <tr>
            <th>$request->flashOnly(['message']); + old('message'):</th>
            <th>{{ old('message') }}</th>
        </tr>
        <tr>
            <th>$request->all():</th>
            <th>
                @foreach($all as $key => $item)
                {{ $key . '=>' . $item }}<br>
                @endforeach
            </th>
        </tr>
        <tr>
            <th>$request->upfile: </th>
            <th>{{ $upfile }}</th>
        </tr>
        <tr>
            <th>$request->file('upfile'): </th>
            <th>{{ $file_upfile }}</th>
        </tr>
        <tr>
            <th>$request->hasfile('upfile'): </th>
            <th>{{ $hasfile }}</th>
        </tr>
        @if($hasfile)
            <tr>
                <th>$request->file('photo')->isValid(): </th>
                <th>{{ $isValid }}</th>
            </tr>
            <tr>
                <th>$request->upfile->path(): </th>
                <th>{{ $path }}</th>
            </tr>
            <tr>
                <th>$request->upfile->store('images', 'public'): </th>
                <th>{{ $store }}</th>
            </tr>
            <tr>
                <th>$request->upfile->storeAs('images', 'upfile.jpeg', 'public'): </th>
                <th>{{ $storeAs }}</th>
            </tr>
            <tr>
                <th>$request->upfile->extension(): </th>
                <th>{{ $extension }}</th>
            </tr>
        @endif
        <tr>
            <th>$request->message:</th>
            <th>{{ $message }}</th>
        </tr>
        <tr>
            <th>$request->has('message'):</th>
            <th>{{ $message_has }}</th>
        </tr>
        <tr>
            <th>$request->filled('message'):</th>
            <th>{{ $message_filled }}</th>
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
        <tr>
            <th>$request->cookie('cookie_name'):</th>
            <th>{{ $cookie }}</th>
        </tr>
        <tr>
            <th>$request->cookie('encrypted_cookie_name'):</th>
            <th>{{ $encrypted_cookie }}</th>
        </tr>
        </table>

    <p><a href="{{ route('user.index') }}">トップに戻る</a></p>
</div>
@endsection