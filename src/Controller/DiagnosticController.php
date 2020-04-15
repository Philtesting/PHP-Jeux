<?php
namespace App\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class DiagnosticController  extends AbstractController
{
    /**
     * @Route("/diagnostic",name="diagnostic")
     */
    public function firstImage()
        {
            $api_key = "philippefidalgo@gmail.com";
            $secret_key = "q2RKr48PdHs6n9DBk";
            $requested_uri ="https://sandbox-authservice.priaid.ch/login";
            $hashed_credentials = base64_encode(hash_hmac ( 'md5' , $requested_uri , $secret_key, true ));
            $authorization = 'Authorization: Bearer '.$api_key.':'.$hashed_credentials;

            $ch = curl_init();
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, '');
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
			curl_setopt($ch, CURLOPT_URL, $requested_uri );
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

			$result = curl_exec($ch);
            $obj = json_decode($result);
            
            $curl = curl_init();

            $auth= $obj->{'Token'};
        
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://sandbox-healthservice.priaid.ch/symptoms?token=".$auth."&format=json&language=fr-fr",
                CURLOPT_RETURNTRANSFER => true,
            ));
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            $data = json_decode($response);

            return $this->render('diagnostic/index.html.twig',[
                'data' => $data
            ]); 
            
        }

    /**
     * @Route("/diagnostic/id={id}/", name="diagnostic.2")
     */
    public function secondImage($id)
        {
            return $this->render('diagnostic/second.html.twig',[
                'id' => $id,
            ]); 
            
        }
    /**
     * @Route("/diagnostic/id={id}/sexe={sexe}/", name="diagnostic.3")
     */
    public function thirdImage($id, $sexe)
        {
            return $this->render('diagnostic/third.html.twig',[
                'id' => $id,
                'sexe' => $sexe
            ]); 
            
        }
    /**
     * @Route("/diagnostic/id={id}/sexe={sexe}/age={age}/",name="diagnostic.end")
     */
    public function results($id, $sexe, $age)
        {
            $curl = curl_init();
            if($sexe = "M"){
                $sexe = "male";
            }
            else{
                $sexe = "female";
            }
            $auth="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InBoaWxpcHBlZmlkYWxnb0BnbWFpbC5jb20iLCJyb2xlIjoiVXNlciIsImh0dHA6Ly9zY2hlbWFzLnhtbHNvYXAub3JnL3dzLzIwMDUvMDUvaWRlbnRpdHkvY2xhaW1zL3NpZCI6IjY2NzEiLCJodHRwOi8vc2NoZW1hcy5taWNyb3NvZnQuY29tL3dzLzIwMDgvMDYvaWRlbnRpdHkvY2xhaW1zL3ZlcnNpb24iOiIyMDAiLCJodHRwOi8vZXhhbXBsZS5vcmcvY2xhaW1zL2xpbWl0IjoiOTk5OTk5OTk5IiwiaHR0cDovL2V4YW1wbGUub3JnL2NsYWltcy9tZW1iZXJzaGlwIjoiUHJlbWl1bSIsImh0dHA6Ly9leGFtcGxlLm9yZy9jbGFpbXMvbGFuZ3VhZ2UiOiJlbi1nYiIsImh0dHA6Ly9zY2hlbWFzLm1pY3Jvc29mdC5jb20vd3MvMjAwOC8wNi9pZGVudGl0eS9jbGFpbXMvZXhwaXJhdGlvbiI6IjIwOTktMTItMzEiLCJodHRwOi8vZXhhbXBsZS5vcmcvY2xhaW1zL21lbWJlcnNoaXBzdGFydCI6IjIwMjAtMDMtMjEiLCJpc3MiOiJodHRwczovL3NhbmRib3gtYXV0aHNlcnZpY2UucHJpYWlkLmNoIiwiYXVkIjoiaHR0cHM6Ly9oZWFsdGhzZXJ2aWNlLnByaWFpZC5jaCIsImV4cCI6MTU4Njk4MjY3MywibmJmIjoxNTg2OTc1NDczfQ.9f4xVPlsCDqw7Cqzs8AfkJVfysSEadOouLktsnEPsIo";
            
            
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://sandbox-healthservice.priaid.ch/diagnosis?symptoms='.$id.'&gender='.$sexe.'&year_of_birth='.$age.'&token='.$auth.'&format=json&language=fr-fr',
                CURLOPT_RETURNTRANSFER => true,
            ));
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            $data = json_decode($response);

            if ($err) {
                echo "cURL Error #:" . $err;
                dump($err);
            }
            else {
                dump($data);
            }

            return $this->render('diagnostic/final.html.twig',[
                'data' => $data,
            ]); 
        }
}
