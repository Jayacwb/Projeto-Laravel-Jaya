<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function searchMovies($query, $parameters = [])
    {

        $query = str_replace(' ', '+', $query);
        $url = env('TMDB_URL_API') . 'search/movie?api_key=' . env('TMDB_API_KEY') . '&query=' . $query . (isset($parameters['language']) ? "&language=" . $parameters['language'] : "") . (isset($parameters['page']) ? "&page=" . $parameters['page'] : "");
        $request = file_get_contents($url);
        $response = json_decode($request);
        return $response;
    }

    public function searchMovieId($id, $parameters = [])
    {
        $url = env('TMDB_URL_API') . 'movie/' . $id . '?api_key=' . env('TMDB_API_KEY') . (isset($parameters['language']) ? "&language=" . $parameters['language'] : "");
        $request = file_get_contents($url);
        $response = json_decode($request);
        return $response;
    }

    public function searchTop($parameters = [])
    {
        $url = env('TMDB_URL_API') . 'movie/top_rated?api_key=' . env('TMDB_API_KEY') . (isset($parameters['language']) ? "&language=" . $parameters['language'] : "") . (isset($parameters['page']) ? "&page=" . $parameters['page'] : "");
        $request = file_get_contents($url);
        $response = json_decode($request);
        return $response;
    }
}
