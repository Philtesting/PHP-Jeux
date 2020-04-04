<?php
namespace App\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class DiagnosticController  extends AbstractController
{
    /**
     * @Route("/diagnostic",name="diagnostic")
     */
    public function home()
        {
            $curl = curl_init('https://sandbox-healthservice.priaid.ch/diagnosis?symptoms=[9,10,12]&gender=female&year_of_birth=1994&token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImRpZXluYmFseTk0QGdtYWlsLmNvbSIsInJvbGUiOiJVc2VyIiwiaHR0cDovL3NjaGVtYXMueG1sc29hcC5vcmcvd3MvMjAwNS8wNS9pZGVudGl0eS9jbGFpbXMvc2lkIjoiNjY3MCIsImh0dHA6Ly9zY2hlbWFzLm1pY3Jvc29mdC5jb20vd3MvMjAwOC8wNi9pZGVudGl0eS9jbGFpbXMvdmVyc2lvbiI6IjIwMCIsImh0dHA6Ly9leGFtcGxlLm9yZy9jbGFpbXMvbGltaXQiOiI5OTk5OTk5OTkiLCJodHRwOi8vZXhhbXBsZS5vcmcvY2xhaW1zL21lbWJlcnNoaXAiOiJQcmVtaXVtIiwiaHR0cDovL2V4YW1wbGUub3JnL2NsYWltcy9sYW5ndWFnZSI6ImVuLWdiIiwiaHR0cDovL3NjaGVtYXMubWljcm9zb2Z0LmNvbS93cy8yMDA4LzA2L2lkZW50aXR5L2NsYWltcy9leHBpcmF0aW9uIjoiMjA5OS0xMi0zMSIsImh0dHA6Ly9leGFtcGxlLm9yZy9jbGFpbXMvbWVtYmVyc2hpcHN0YXJ0IjoiMjAyMC0wMy0yMSIsImlzcyI6Imh0dHBzOi8vc2FuZGJveC1hdXRoc2VydmljZS5wcmlhaWQuY2giLCJhdWQiOiJodHRwczovL2hlYWx0aHNlcnZpY2UucHJpYWlkLmNoIiwiZXhwIjoxNTg0OTYxMjc4LCJuYmYiOjE1ODQ5NTQwNzh9.xYFz_meBT9N0omJ3uMKmUdF9Ej5T5bwCM5saOBDu6wQ&format=json&language=en-gb');
           /* $params = [

                'symptome' => 'maux de téte',
                'genre'   => 'feminin',
                'date de naissance' => '07/06/96'

            ];
            $params_string = http_build_query($params);*/

            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,false);
            curl_setopt ($curl, CURLOPT_RETURNTRANSFER,true);
           
            $data = curl_exec($curl);
            dump($data);
    
            return $this->render('diagnostic.html.twig',[
                'data' => $data
                
            ]);
            
            curl_close($curl);
            
        }
}
