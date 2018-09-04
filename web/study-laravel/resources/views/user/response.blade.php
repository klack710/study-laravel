@extends('user._layouts.default')
@section('title', 'レスポンス')

@section('content')
<div>
    <h1>レスポンス</h1>
</div>
<div>
    <p><a href="{{ route('user.response.123') }}">123</a></p>
    <p><a href="{{ route('user.response.hello') }}">hello</a></p>
    <p><a href="{{ route('user.response.redirect') }}">クッキーを付与してリダイレクト</a></p>
    <p><a href="{{ route('user.response.redirect_2') }}">クッキーを付与してリダイレクト2</a></p>
    <p><a href="{{ route('user.response.redirect_google') }}">Googleへリダイレクト</a></p>
    <p><a href="{{ route('user.response.json') }}">json</a></p>
    <p><a href="{{ route('user.response.echo_md') }}">echo_md</a></p>
    <p><a href="{{ route('user.response.foo') }}">foo</a></p>

    <p><a href="{{ route('user.index') }}">トップに戻る</a></p>
</div>
@endsection