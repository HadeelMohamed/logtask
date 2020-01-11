<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;

class UploadFileController extends Controller
{

    function uploadfile()
    {
        set_time_limit(1000000);
        ini_set('memory_limit', '-1');





        $file1 = "NASA_access_log_Jul95/lookup";
        $lines = file($file1);
        $insert_data=collect();


        for ($i = 0; $i < count($lines)-1; $i++) {



                $parts = explode('"', $lines[$i]);
                $ip_date = explode(" - - ", $parts[0]);


if(count($parts)==4)
{
    $statusCode=substr($parts[3], 0, 4);
    $bytes = 0;
    $url=$parts[1].$parts[2];

}
elseif (count($parts)==5)
{
    $statusCode=substr($parts[4], 0, 4);
    $bytes = 0;
    $url=$parts[1].$parts[2].$parts[3];
}
else
{
    $statusCode = substr($parts[2], 0, 4);
    $bytes = substr($parts[2], 4, 5);
    $url=$parts[1];
}

            if (strpos($bytes, '-') == 1) {
                $bytes=0;

            }

                $data =
                    ['ip'=>$ip_date[0],'hit_date'=>$ip_date[1],'url'=>utf8_decode($url),'bytes'=>$bytes,'status'=> $statusCode]
                ;
    $insert_data->push($data) ;



            }




        $chunks = $insert_data->chunk(500);
        foreach ($chunks as $chunk)
        {
              Log::insert($chunk->toArray());
        }

        return Response::json( 'finish');

    }
}
