@extends('layout')

@section('contents')

<div>
		<!-- ここだけタイトルを入れましょう。 -->
    <h1>場所詳細</h1>

    <form action="{{ route('places.update', compact('place')) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <table>
            <tr>
                <th>写真</th>
                <td>
                    <img src="{{ asset('storage/' . $place->img) }}">
                    <input type="file" name="img" accept="image/png, image/jpeg">
                    <div>{{ $errors->first('img') }}</div>
                </td>
            </tr>
            <tr>
                <th>名称</th>
                <td>
                    <input type="text" name="name" value="{{ old('name') ?? $place->name }}" required>
                    <div>{{ $errors->first('name') }}</div>
                </td>
            </tr>
            <tr>
                <th>説明</th>
                <td>
                    <textarea name="description" required>{{ old('description') ?? $place->description }}</textarea>
                    <div>{{ $errors->first('description') }}</div>
                </td>
            </tr>
            <tr>
                <th>マップURL</th>
                <td>
                    <input type="text" name="map_url" value="{{ old('map_url') ?? $place->map_url }}" required>
                    <div>{{ $errors->first('map_url') }}</div>
                </td>
            </tr>
        </table>

        <button type="submit">保存</button>
    </form>
</div>

@endsection
