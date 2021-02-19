<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article as Article;
use App\Models\Like;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Util\Json;

class ArticleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return(Article::all());

        return response(Article::with('category')->withCount('likes')->get(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation =  $this->validate($request, [
            'title' => 'required',
            'id_category' => 'required',
            'slug' => 'required',
            'short_text' => 'required',
        ]);


        return  $user = Article::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Article::with('category')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = Article::find($id);
        $user->update($request->except(['password', 'email']));
        if ($request->password) {
            $user->password =   Hash::make($request->password);
            $user->update();
        }
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return   Article::find($id)->delete();
    }
    public function like(Request $request)
    {
        $exist = Like::where('id_article', $request->id_article)
            ->where('id_user', $request->user_id)->first();

        if (!$exist) {
            $new_like = new Like();
            $new_like->id_article = $request->id_article;
            $new_like->id_user = $request->user_id;
            $new_like->save();
        }

        return Like::where('id_article', $request->id_article)->count();
    }
    public function picture(Request $request)
    {
        if ($request->picture) {
            $request->picture->storeAs(
                'picture',
                $request->picture->getClientOriginalName(),
                ['disk' => 'public_uploads']
            );
            $article = Article::find($request->id_article);
            $article->picture = $request->picture->getClientOriginalName();
            $article->save();
        }

        return true;
    }
}
