<?php

namespace App\Http\Controllers;
// データベースとやりとりするためのコード
use App\Diary; 
use Illuminate\Http\Request;
use App\Http\Requests\CreateDiary; // 追加
use Illuminate\Support\Facades\Auth;

class DiaryController extends Controller
{
    public function index()
    {
        //diariesテーブルのデータを全件取得
        //useしてるDiaryのallメソッドを実施
        //all()はテーブルのデータを全て取得するメソッド
        // $diaries = Diary::all();
        $diaries = Diary::orderBy('id', 'desc')->get();

        // dd($diaries);  //var_dump()とdie()を合わせたメソッド。変数の確認 + 処理のストップ
        return view('diaries.index',['diaries' => $diaries]);
    }

    public function create()
    {
        // views/diaries/create.blade.phpを表示する
        return view('diaries.create');
    }

    public function store(CreateDiary $request)
{
    $diary = new Diary(); //Diaryモデルをインスタンス化
    // dd('ここに保存処理');

    $diary->title = $request->title;
    $diary->body = $request->body;
    $diary->user_id = Auth::user()->id; //追加 ログインしてるユーザーのidを保存
    $diary->save();
    return redirect()->route('diary.index');
}



 public function destroy(Diary $diary)
{
    if (Auth::user()->id !== $diary->user_id) {
        abort(403);
    }
    //Diaryモデルを使用して、diariesテーブルから$idと一致するidをもつデータを取得
    // $diary = Diary::find($id); 

    //取得したデータを削除
    $diary->delete();

    return redirect()->route('diary.index');
}

public function edit(Diary $diary)
{
    if (Auth::user()->id !== $diary->user_id) {
        abort(403);
    }
     //Diaryモデルを使用して、diariesテーブルから$idと一致するidをもつデータを取得
    // $diary = Diary::find($id); 

    return view('diaries.edit', [
        'diary' => $diary,
    ]);
}

public function update(Diary $diary)
{
    if (Auth::user()->id !== $diary->user_id) {
        abort(403);
    }
    // $diary = Diary::find($id);

    $diary->title = $request->title; //画面で入力されたタイトルを代入
    $diary->body = $request->body; //画面で入力された本文を代入
    $diary->save(); //DBに保存

    return redirect()->route('diary.index'); //一覧ページにリダイレクト
}

// likeの後ろの（）ないがintのままでokなわけはいいねは誰でもできないと意味ないから diaryにしたのはログインした人だけ編集できるようにするため
// laravelアップデートのためコード変更
// public function like(int $id)
// {
//     $diary = Diary::where('id', $id)->with('likes')->first();

//     $diary->likes()->attach(Auth::user()->id);
// }


// １１いいねが押されたらデータとして残り数字が変更するようにした
public function like(int $id)
{
    $diary = Diary::where('id', $id)->with('likes')->first();
    $diary->likes()->attach(Auth::user()->id);
    // 通信が成功したことを返す
    return response()
        ->json(['success' => 'いいね完了！']);
}

// ２２いいねの取り消し
public function dislike(int $id)
{
    $diary = Diary::where('id', $id)->with('likes')->first();
    $diary->likes()->detach(Auth::user()->id);
    // 通信が成功したことを返す
    return response()->json(['success' => 'いいね完了！']);
}

}


