@extends('user._layouts.default')
@section('title', 'セッション情報を取得するページ')

@section('content')
<div>
    <h1>セッション情報を取得するページ</h1>
</div>
@if (session('session_flash'))
    <div class="alert alert-success">
        {{ session('session_flash') }}
    </div>
@endif
<div>
    <form method="POST" action="{{ route('user.session_request.store') }}">
        {{ csrf_field() }}
        <p>session_flash: <input type="text" name="session_flash"></p>
        <button>ここに送信</button>
    </form>

    <table>
        <tr>
            <th>$request->session()->get('request_key'):</th>
            <th>{{ $get_key }}</th>
        </tr>
        <tr>
            <th>$request->session()->get('request_key', 'default'):</th>
            <th>{{ $get_key_default }}</th>
        </tr>
        <tr>
            <th>$request->session()->all():</th>
            <th>{!! var_dump($all) !!}</th>
        </tr>
        <tr>
            <th>session('session_key'):</th>
            <th>{{ $session_key }}</th>
        </tr>
        <tr>
            <th>session('session_key', 'default'):</th>
            <th>{{ $session_key_default }}</th>
        </tr>
    </table>

    <p><a href="{{ route('user.index') }}">トップに戻る</a></p>
</div>
@endsection