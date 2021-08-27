<?php

namespace App\Http\Controllers;

use App\Movie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class MovieController extends Controller
{
    public function index()
    {
        return view('movies.index');
    }

    public function datatable(Request $request)
    {
        return DataTables::of(Movie::where('user_id', Auth::id()))
            ->editColumn('release_date', function ($row) {
                return Carbon::createFromFormat('Y-m-d', $row->release_date)->format('d/m/Y');
            })
            ->editColumn('watched', function ($row) {
                return '<span class="badge badge-' . ($row->watched ? "success" : "danger") . '">' . ($row->watched ? "" : "Não ") . 'Assisitdo</span>';
            })
            ->addColumn('actions', function ($row) {
                $html = '<form action="'.route('movies.destroy', $row->id).'" method="POST">'.csrf_field().method_field('DELETE');
                $html .= '<a href="'.route('movies.edit', $row->id).'" class="btn btn-warning px-2 mr-2"><i class="fa fa-edit"></i></a>';
                $html .= '<a class="btn btn-danger px-2 mr-2 delete_movie" onclick="deleteMovie($(this))"><i class="fa fa-trash"></i></a>';
                $html .= '</form>';
                return $html;
            })
            ->escapeColumns(['*'])
            ->make(true);
    }

    public function listMovies()
    {
        $movies = $this->searchTop(['language' => 'pt-BR']);
        return view('movies.list', compact('movies'));
    }

    public function search(Request $request)
    {
        if($request->search == null){
            $movies = $this->searchTop(['language' => 'pt-BR']);
        }else{
            $movies = $this->searchMovies($request->search, ['language' => 'pt-BR']);
        }
        $html = '';
        foreach ($movies->results as $movie){
            $html .= '<div class="card col-2 m-3 movie">';
            $html .= '    <a href="'.route('movies.create', $movie->id).'">';
            $html .= '        <img src="'.env('TMDB_URL_IMAGE').$movie->poster_path.'" class="card-img-top"';
            $html .= '             alt="...">';
            $html .= '        <div class="card-body">';
            $html .= '            <h5 class="card-title">'.$movie->title.'</h5>';
            $html .= '        </div>';
            $html .= '    </a>';
            $html .= '</div>';
        }
        return response()->json(['status'=>true, 'data'=>$html]);
    }

    public function create($idtmdb)
    {
        $movie = $this->searchMovieId($idtmdb, ['language' => 'pt-BR']);
//        dd($movie);
        return view('movies.create', compact('movie'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $movie = Movie::create($request->only(['user_id', 'title', 'tmdb_id', 'poster_path', 'watched_date', 'release_date', 'watched']));
            Session::flash('success_message', 'Filme adicionado com sucesso');
            DB::commit();
        }catch (\Exception $e){
            Session::flash('error_message', 'Falha ao adicionar Filme');
            DB::rollBack();
        }
        return redirect()->route('movies.index');
    }

    public function edit($movie)
    {
        $movie = Movie::find($movie);
        $movie_tmdb = $this->searchMovieId($movie->tmdb_id, ['language' => 'pt-BR']);
        $movie->overview = $movie_tmdb->overview;
        $movie->original_title = $movie_tmdb->original_title;
        $movie->homepage = $movie_tmdb->homepage;
        $movie->imdb_id = $movie_tmdb->imdb_id;
        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, $movie)
    {
        $movie = Movie::find($movie);
        DB::beginTransaction();
        try {
            $movie->update($request->only(['user_id', 'title', 'tmdb_id', 'poster_path', 'watched_date', 'release_date', 'watched']));
            Session::flash('success_message', 'Filme editado com sucesso');
            DB::commit();
        }catch (\Exception $e){
            Session::flash('error_message', 'Falha ao editar Filme');
            DB::rollBack();
        }
        return redirect()->route('movies.index');
    }

    public function destroy($movie)
    {
        $movie = Movie::find($movie);
        DB::beginTransaction();
        try {
            $movie->delete();
            Session::flash('success_message', 'Filme excluido com sucesso');
            DB::commit();
        }catch (\Exception $e){
            Session::flash('error_message', 'Falha ao editar Filme');
            DB::rollBack();
        }
        return redirect()->route('movies.index');
    }
}
