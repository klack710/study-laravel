@extends('user._layouts.default')
@section('title', 'TOPページ')

@section('content')
<div>
    <h1>TOPページ</h1>
</div>
<div>
    <p>以下に勉強のために使ったページのリンクをかきます</p>
    <ul>
        <li><a href="{{ route('user.request.index') }}">リクエスト</a></li>
    </ul>
</div>
@endsection