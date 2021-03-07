
@extends('layout')

@section('contents')

<div>
    <h1>場所追加</h1>
    <form action="{{ route('places.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <table>
            <tr>
                <th>写真</th>
                <td>
                    <input type="file" name="img" accept="image/png, image/jpeg" required>
                    <div>{{ $errors->first('img') }}</div>
                </td>
            </tr>
            <tr>
                <th>名称</th>
                <td>
                    <input type="text" name="name" value="{{ old('name') }}" required>
                    <div>{{ $errors->first('name') }}</div>
                </td>
            </tr>
            <tr>
                <th>説明</th>
                <td>
                    <textarea name="description" required>{{ old('description') }}</textarea>
                    <div>{{ $errors->first('description') }}</div>
                </td>
            </tr>
            <tr>
                <th>マップURL</th>
                <td>
                    <input type="text" name="map_url" value="{{ old('map_url') }}" required>
                    <div>{{ $errors->first('map_url') }}</div>
                </td>
            </tr>
        </table>

        <button type="submit">保存</button>
    </form>
</div>

@endsection
