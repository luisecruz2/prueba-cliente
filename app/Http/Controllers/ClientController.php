<?php

namespace App\Http\Controllers;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allClient()
    {
      $clientes = Client::all();
        return $clientes;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registerClient(Request $request)
    {
      print_r('ok');
      die();

      $client = new App\Client;
      $firstname = $request['firstname'];
      $lastname = $request['lastname'];
      $email = $request['email'];
      $city = $request['city'];
      $client = Client::create($request->all());
      return response(['client'=>$client],201);

    }
    public function saveDataFirestore($firestore_data,$collection,$identifier){
      $result=false;
      $idProject ="";  //id cliente de firestore
      $data = ["fields" => (object)$firestore_data];
      $json = json_encode($data);
      if ($identifier == null) {
        $identifier = random_int(1,300);
      }

      $url = "https://firestore.googleapis.com/v1beta1/projects/".$idProject."/databases/(default)/documents/".$collection."/".$identifier;
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array('Content-Type: application/json',
            'Content-Length: ' . strlen($json),
            'X-HTTP-Method-Override: PATCH'),
       CURLOPT_URL => $url . '?key='. Constantes::CLAVE_API_WEB,
       CURLOPT_USERAGENT => 'cURL',
       CURLOPT_POSTFIELDS => $json
     ));
     $response = curl_exec( $curl );
     curl_close( $curl );

     return $result;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function detailClient(Request $request)
    {
      $idCliente = $request['idClient'];
      $cliente = Client::find($idCliente);
      if ($cliente) {
        return response(['client'=>$cliente],201);
      }else{
        return response(['client'=>NULL],201);
      }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteClient(Request $request)
    {
      $idCliente = $request['idClient'];
      $cliente = Client::find($idCliente);
      if ($cliente) {
        $cliente->delete();
        return response(['client'=>'deleted'],201);
      }else{
        return response(['client'=>'not found'],201);
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editClient(Request $request)
    {
      $idCliente = $request['idClient'];
      $cliente = Client::find($idCliente);
      if ($cliente) {

        return response(['client'=>'deleted'],201);
      }else{
        return response(['client'=>'not found'],201);
      }
    }


}
