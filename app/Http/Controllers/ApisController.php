<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;
use Response;
use DB;
use Exception;


class ApisController extends Controller
{
    //return unique visitors
    public function getuniquevisitors()
    {
        ini_set('memory_limit', '-1');
try{
    //SELECT ip , COUNT(*) As count FROM logs GROUP BY ip HAVING count = 1
    $unique_visitors=Log::select(array('logs.ip', DB::raw('COUNT(logs.ip) as count')))->groupBy('ip')->havingRaw('count = 1')->get();



    return Response::json( $unique_visitors);
}
 catch (Exception $e) {
return Response::json(['errors' => 'Bad Request'], 400);


}


//// return number of hits of each url
    }
    public function numofhits()
    {
        ini_set('memory_limit', '-1');

//SELECT url , COUNT(*) As hits FROM logs GROUP BY url
        try {
        	  $num_hits=Log::select(array('logs.url', DB::raw('COUNT(logs.url) as hits')))->groupBy('url')->get();
        	  return Response::json( $num_hits);

        } catch (Exception $e) {
            return Response::json(['errors' => 'Bad Request'], 400);


        }








    }
//return top hits
     public function tophits()
    {

        ini_set('memory_limit', '-1');

//SELECT url , COUNT(*) As hits FROM logs GROUP BY url ORDER BY `hits` DESC
try
{
    $top_hits=Log::select(array('logs.url', DB::raw('COUNT(logs.url) as hits')))->groupBy('url')->orderBy('hits', 'DESC')->get();



    return Response::json( $top_hits);
}
catch (Exception $e) {
    return Response::json(['errors' => 'Bad Request'], 400);


}




    }
}
