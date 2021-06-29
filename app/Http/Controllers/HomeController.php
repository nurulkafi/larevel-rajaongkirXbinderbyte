<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\City;
use App\Models\Courier;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request; //new Laravel 7 HTTP Client

class HomeController extends Controller
{
    public function index()
    {
        $province = $this->getProvince();
        $courier = $this->getCourier();
        $result_cost =null;
        $city_origin = null;
        $type_origin = null;
        $province_origin = null;
        $city_destination = null;
        $type_destination = null;
        $province_destination = null;
        $active = 1;
        $no_resi = null;
        $status = null;
        return view('home', compact('status','no_resi','province','active', 'courier', 'result_cost', 'city_origin', 'type_origin', 'province_origin', 'city_destination', 'type_destination', 'province_destination'));

    }
    private function postData($key, $url, $data_origin, $data_destination, $data_weight, $data_courier)
    {
        //retry() maskudnya function untuk retry hit API jika time out sebanyak parameter pertama dan range interval pada parameter kedua dalam milisecon
        //asForm() maksudnya menggunakan application/x-www-form-urlencoded content type biasanya untuk method POST
        //withHeaders() maksudnya parameter header (Jika diminta, masing2 API punya header masing-masing dan yang tidak pakai header)
        return Http::retry(10, 200)->asForm()->withHeaders([
            'key' => $key
        ])->post($url, [
            'origin' => $data_origin,
            'destination' => $data_destination,
            'weight' => $data_weight,
            'courier' => $data_courier
        ]);
        //setelah $url itu adalah array yaitu parameter wajib yg dibutuhkan ketika meminta POST request
    }
    public function store(Request $request){
        $key = 'e9cf1dd907c39459883d47f851ea7b86'; //Buat akun atau pakai API akun Tahu Coding
        $cost_url = 'https://api.rajaongkir.com/starter/cost';

        $data_origin = $request->origin_city;
        $data_destination = $request->city_destination;
        $data_weight = $request->weight;
        $data_courier = $request->courier;

        //logic untuk calculate cost
        $cost = $this->postData($key, $cost_url, $data_origin, $data_destination, $data_weight, $data_courier);
        //$cost->throw();
        $result_cost = $cost['rajaongkir']['results'][0]['costs'];
        $city_origin = $cost['rajaongkir']['origin_details']['city_name'];
        $type_origin = $cost['rajaongkir']['origin_details']['type'];
        $province_origin = $cost['rajaongkir']['origin_details']['province'];
        $city_destination = $cost['rajaongkir']['destination_details']['city_name'];
        $type_destination = $cost['rajaongkir']['destination_details']['type'];
        $province_destination = $cost['rajaongkir']['destination_details']['province'];
        $province = $this->getProvince();
        $courier = $this->getCourier();
        $active = 1;
        $no_resi = null;
        $status = null;
        return view('home', compact('status','no_resi','province','active', 'courier', 'result_cost','city_origin','type_origin','province_origin', 'city_destination', 'type_destination', 'province_destination'));

    }
    public function storeResi(Request $request){
        $response = Http::get('https://api.binderbyte.com/v1/track', [
            'api_key' => 'b86a38cec88f9fa967c516e0e3c8374a455609c1315d00cbfa763b3e5e19eba0',
            'courier' => $request->courier,
            'awb' => $request->awb
        ]);


        if($response->json() == null){
            $status = 400;
        }else{
            $status = $response->json()['status'];
        }

        if($status == 200){
            $detail = $response->json()['data']['detail'];
            $history = array_reverse($response->json()['data']['history']);
            // $history = $history->reverse();
            $no_resi = $response->json()['data']['summary'];
        }else{
            $detail = null;
            $history = null;
            // $history = $history->reverse();
            $no_resi = null;
        }

        $active = 2;
        $province = $this->getProvince();
        $courier = $this->getCourier();
        $result_cost = null;
        $city_origin = null;
        $type_origin = null;
        $province_origin = null;
        $city_destination = null;
        $type_destination = null;
        $province_destination = null;
        return view('home', compact('status','province','history', 'active', 'courier', 'result_cost', 'city_origin', 'type_origin', 'province_origin', 'city_destination', 'type_destination', 'province_destination','no_resi','detail'));
    }
    public function getProvince(){
        return Province::pluck('title','code');
    }
    public function getCourier()
    {
        return Courier::all();
    }
    public function getCities($id){
        return City::where('province_code',$id)->pluck('title','code');
    }
}
