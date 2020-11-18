<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}

	public function upload_file()
	{
		$client = \Config\Services::curlrequest();
		$response = $client->request('GET', 'http://localhost:8080/photo');

		print_r($response);
	}

	//--------------------------------------------------------------------

}
