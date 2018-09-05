@extends('user._layouts.default')
@section('title', 'プロフィール')

@section('content')
<div>
    <h1>プロフィール</h1>
</div>
<div>
    <p>ユーザー情報です</p>
    <table>
        <tr>
            <th>id</th>
            <th>{{ $user->id }}</th>
        </tr>
        <tr>
            <th>name</th>
            <th>{{ $user->name }}</th>
        </tr>
        <tr>
            <th>email</th>
            <th>{{ $user->email }}</th>
        </tr>
    </table>

    <p><a href="{{ route('user.index') }}">トップに戻る</a></p>
</div>
@endsection