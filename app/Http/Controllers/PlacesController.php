<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::paginate();
	  return view('places.index', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('places.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1. リクエストバリデーション
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'map_url' => 'required|url',
            'img' => 'required|file',
        ]);

        // 2. ファイル保存＆パス取得 → $data['img']にファイルパス代入
        $path = Storage::putFile('places', $data['img']);
        $data['img'] = $path;

        // 3. $data['user_id']としてログインしているユーザーのIDを代入
        $data['user_id'] = Auth::user()->id;

        // 4. モデルを使ってデータをデータベースに格納
        $place = Place::create($data);

        // 5. その後、場所詳細ページに遷移させる
        return redirect()->to(route('places.show', compact('place')));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
        return view('places.show', compact('place'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function edit(Place $place)
    {
        return view('places.modify', compact('place'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Place $place)
    {
        // 1. リクエストバリデーション
        $data = $request->validate([
        'name' => 'required|string',
        'description' => 'required|string',
        'map_url' => 'required|url',
        'img' => 'file',
        ]);

        // 2. ファイルがあったら：以前のファイル削除＆ファイル保存＆パス取得 → $data['img']にファイルパス代入
		if (isset($data['img'])) {
		    Storage::delete($place->img);
		    $path = Storage::putFile('places', $data['img']);
		    $data['img'] = $path;
		}

        // 4. モデルを使ってデータベースのデータをアップデート
        $place->update($data);

        // 5. その後、場所詳細ページに遷移させる
        return redirect()->to(route('places.show', compact('place')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        $place->delete();
        return redirect()->to(route('places.index'));
    }
}
