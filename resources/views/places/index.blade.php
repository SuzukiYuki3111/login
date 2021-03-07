@extends('layout')

@section('contents')

<div>
    <h1>場所一覧</h1>
    <div>
        <a href="{{ route('places.create') }}">場所追加</a>
    </div>
    @if (count($places) > 0)
    <table>
        <tr>
            <th>写真</th>
            <th>名称</th>
            <th>登録者</th>
            <th>操作</th>
        </tr>
        @foreach ($places as $place)
        <tr>
            <td><img src="{{ asset('storage/' . $place->img) }}" width="100" height="100"></td>
            <td>{{ $place->name }}</td>
            <td>{{ $place->user->name }}</td>
            <td></td>
        </tr>
        @endforeach

        {{ $places->links() }}
    </table>
    @else
    <p>登録されている場所がありません。</p>
    @endif
</div>

@endsection
