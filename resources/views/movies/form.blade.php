{{Form::hidden('tmdb_id', $movie->tmdb_id??$movie->id)}}
{{Form::hidden('poster_path', $movie->poster_path)}}
{{Form::hidden('user_id', \Illuminate\Support\Facades\Auth::id())}}
<div class="row">
    <div class="col-3">
        <img src="{{env('TMDB_URL_IMAGE')}}{{$movie->poster_path}}" class="img-thumbnail" alt="...">
    </div>
    <div class="col-8">
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    {{Form::label('title', 'Título do Filme')}}
                    {{Form::text('title', $movie->title, ['class'=>'form-control'])}}
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    {{Form::label('original_title', 'Título original')}}
                    {{Form::text('original_title', $movie->original_title, ['class'=>'form-control'])}}
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    {{Form::label('watched_date', 'Data Assisitida')}}
                    {{Form::date('watched_date', isset($movie->watched_date)?\Carbon\Carbon::createFromFormat('Y-m-d', $movie->watched_date):\Carbon\Carbon::now(), ['class'=>'form-control'])}}
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    {{Form::label('release_date', 'Data de Lançamento')}}
                    {{Form::date('release_date', \Carbon\Carbon::createFromFormat('Y-m-d', $movie->release_date), ['class'=>'form-control', 'readonly'=>'readonly'])}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    {{Form::label('overview', 'Sinopse')}}
                    {{Form::textarea('overview', $movie->overview, ['class'=>'form-control'])}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    {{Form::label('watched', 'Status Assitido')}}
                    {{Form::select('watched', [''=>'', '1'=>'Assitido', '0'=>'Não assitido'], $movie->watched??'', ['class'=>'form-control'])}}
                </div>
            </div>
            <div class="col-3">
                <div class="form-group mt-4">
                    <a target="_blank" href="{{$movie->homepage}}">Ir para a página do filme <i class="fa fa-share-square"></i></a>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group mt-4">
                    <a target="_blank" href="{{env('IMDB_PAGE')}}{{$movie->imdb_id}}">Ir para a página do IMDB <i class="fa fa-share-square"></i></a>
                </div>
            </div>
            <div class="col-3">
                <div class="mt-3">
                    <span style="font-size: 20px"><i class="fa fa-star text-yellow"></i>{{$movie->vote_average}}</span>
                </div>
            </div>
        </div>
        <div class="card-action">
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="{{route('movies.index')}}" class="btn btn-danger">Cancelar</a>
        </div>
    </div>
</div>
