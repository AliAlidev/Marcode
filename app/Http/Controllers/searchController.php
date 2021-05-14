<?php

namespace App\Http\Controllers;

use App\Http\Requests\searchRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\search;
use Exception;
use Illuminate\Support\Facades\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\Foreach_;
use SebastianBergmann\Environment\Console;
use Symfony\Component\Console\Logger\ConsoleLogger;

class searchController extends Controller
{
    public function searchGifArray(searchRequest $request)
    {
        $request->validated();

        search::create([
            'searched_text' => $request->searched_text,
            'user_id' => Auth::user()->id
        ]);
        // request api to git gify

        $offset = $request->get("offset", 0);
        $limit = $request->get("limit", 10);

        $response = Http::get('http://api.giphy.com/v1/gifs/search', [
            'api_key' => 'UtkmBH2j9kzFZz4cf3FYCr68lCneVp1R',
            'Content-Type' => 'application/json',
            'q' => $request->searched_text,
            'offset' => $offset,
            'limit' => $limit,
        ]);
        $res = [
            "images" => [],
            "total_count" => $response->json()['pagination']['total_count'],
            "count" => $response->json()['pagination']['count'],
            "offset" => $offset
        ];
        foreach ($response->json()['data'] as $key => $value) {
            $res["images"][] = $value['images']['downsized']['url'];
        }
        return $res;
    }

    public function searchGif(searchRequest $request)
    {
        try {
            $res = $this->searchGifArray($request);
            return view('home', ['results' => $res]);
        } catch (Exception $ex) {
            return response()->json($ex->getMessage(), 404);
        }
    }

    public function searchGifAjax(searchRequest $request)
    {
        $res = $this->searchGifArray($request);
        return response()->json($res, 200);
    }

    public function getAutocomplete(Request $request)
    {

        $search = $request->search;
        if ($search == '') {
            $autocomplate = search::orderby('created_at', 'asc')->select('searched_text')->limit(5)->get();
        } else {
            $autocomplate = search::where('user_id', Auth::user()->id)->orderby('created_at', 'asc')->where('searched_text', 'like', $search['term'] . '%')->select('searched_text')->limit(5)->get();
        }
        $response = array();
        foreach ($autocomplate as $autocomplate) {
            $response[] = array("value" => $autocomplate->searched_text);
        }

        echo json_encode($response);
        exit;
    }
}
