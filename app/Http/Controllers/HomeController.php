<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
	public function index()
	{


		$response = Http::withOptions(['verify' => false,])->get('https://manage.maunikahnih.com/api/website/getAllUcapan');
		// dd($response->json()['data']);
		$dats = $response['data'];
		$listing = [];
		// dd($dats);
		foreach ($dats as $list) {
			if($list['ucapan'] != ""){
				array_push($listing, $list);
			}
		}
		
		// dd(count($listing));
		if (count($listing) == 1) {
			$list1 = ['name' => 'John Doe', 'ucapan' => 'Selamat Menikah dan Berbahagia selalu'];
			array_push($listing, $list1);
		}
		// dd($listing);
		// $data['data'] = $response->json()['data'];
		$data['data'] = $listing;
		return view('home', $data);
	}
}
