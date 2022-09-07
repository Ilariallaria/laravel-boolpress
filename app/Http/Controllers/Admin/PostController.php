<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $posts = Post::all();
        $data = [
            'posts'=> $posts
        ];
        // dd($posts);
        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->getValidationRules());

        $form_data = $request->all();

        $new_post = new Post();
        $new_post->fill($form_data);

        $new_post->slug = $this->getFreeSlugFromTitle($new_post->title);

        $new_post->save();

        return redirect()->route('admin.posts.show', ['post' => $new_post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        $data = [
            'post' => $post
        ];
        return view ('admin.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        $data = [
            'post' => $post
        ];
        return view ('admin.posts.edit', $data);
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
        $request->validate($this->getValidationRules());

        //ottengo i dati dal form compilato dall'utente
        $form_data = $request->all();

        // otengo il post da modificare con il Model
        $post_to_update = Post::findOrFail($id);

        //aggiungo lo slug all'array form_data 
        if($form_data['title'] !== $post_to_update->title) {
            // MA lo modifico solo se il titolo è stato modificato
            $form_data['slug'] = $this->getFreeSlugFromTitle($form_data['title']);
        } else {
            // altrimenti lo tengo
            $form_data['slug'] = $post_to_update->slug;
        }

        // modifico il post con update
        $post_to_update->update($form_data);

        // rimando alla show del post aggiornato
        return redirect()->route('admin.posts.show', ['post' => $post_to_update->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // qui ho a disposizione il post appena 'cancellato', lo prendo con il model
        $post_to_delete = Post::findOrFail($id);
        // e lo elimino con delete
        $post_to_delete->delete();

        // poi torniamo alla index
        return redirect() -> route('admin.posts.index');
    }

    // funzione che controlla eventuali duplicati dello slug
    protected function getFreeSlugFromTitle($title) {
        // Assegnare lo slug
        $slug_to_save = Str::slug($title, '-');
        // salvo slug base
        $slug_base = $slug_to_save;
        // Verifico se esiste già nel db
        $existing_slug_post = Post::where('slug', '=', $slug_to_save)->first();

        // se esiste gli appendo un numero che lo diversifica
        $counter = 1;
        while($existing_slug_post) {
            // Proviamo ad creare un nuovo slug con $counter
            $slug_to_save = $slug_base . '-' . $counter;

            // Verifico se esiste nel db
            $existing_slug_post = Post::where('slug', '=', $slug_to_save)->first();

            $counter++;
        }
        // torna lo slug che può essere salvato
        return $slug_to_save;
    }

    // funzione per le validazioni
    protected function getValidationRules() {
        return [
            'title' => 'required|max:255',
            'content' => 'required|max:60000'
        ];
    }
}
