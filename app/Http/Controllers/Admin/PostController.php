<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Category;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $posts = Post::all();
        $request_info = $request->all();

        $show_deleted_message = isset($request_info['deleted']) ? $request_info['deleted'] : null;

        $data = [
            'posts'=> $posts,
            'show_deleted_message' => $show_deleted_message
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
        $categories = Category::all();

        $data = [
            'categories' => $categories
        ];

        return view('admin.posts.create', $data);
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

        if(isset($form_data['image'])){
            $img_path = Storage::put('post-covers', $form_data['image']);
            $form_data['cover'] = $img_path;
            
        }


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
        // dd($post->category);
        // data odierna
        // $now = Carbon::now();

        // metodo preso dalla doc, restituisce il tempo trascorso tra
        // la data che gli dici tu (creazione post) e la data odierna
        // esplicitato human friendly
        $diff_date = $post->created_at->diffForHumans();

        $data = [
            'post' => $post,
            'diff_date' => $diff_date
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
        $categories = Category::all();

        $data = [
            'post' => $post,
            'categories' => $categories
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

        // ottengo il post da modificare con il Model
        $post_to_update = Post::findOrFail($id);

        if(isset($form_data['image'])){
            if($post_to_update->cover){
                Storage::delete($post_to_update->cover);
            }
            $img_path = Storage::put('post-covers', $form_data['image']);
            $form_data['cover'] = $img_path;

        }

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

        if($post_to_delete->cover) {
            Storage::delete($post_to_delete->cover);
        }

        // e lo elimino con delete
        $post_to_delete->delete();

        // poi torniamo alla index
        return redirect()->route('admin.posts.index', ['deleted' => 'yes']);
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
            'content' => 'required|max:60000',
            // controlla che il valore che passiamo a category_id
            // esista (e può essere anche null) nella tabella e nella colonna indicati
            'category_id' => 'nullable:categories, id',
            'image' => 'image|max:1024|nullable'
        ];
    }
}
