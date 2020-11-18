<?php namespace App\Controllers;

class Fileupload extends BaseController
{
	public function index()
	{
		return view('form_upload');
	}

	public function upload()
	{
		$file = $this->request->getFile('photo');

		if(!$file->isValid())
		{
			print_r($file->getErrorString());
			exit();
		}

		$file_temp = $file->getTempName();
		$file_type = $file->getMimeType();
		$file_name = $file->getRandomName();
		$cFile = new \CURLFile($file_temp, $file_type, $file_name);

		try
		{
			$url = base_url()."/api/upload";
			$client = \Config\Services::curlrequest();
			$response = $client->request('POST', $url, [
				'headers' => [
					'Content-Type' => 'multipart/form-data',
				],
				'multipart' => [
					'photo' => $cFile
				]
			]);
		}
		catch (\Exception $e)
		{
			die($e->getMessage());
		}

		$data = json_decode($response->getBody());

		if($data->success == true)
		{
			echo "<center>";
			echo "Status code : ". $response->getStatusCode();
			echo "<br>";
			echo "Reason : ". $response->getReason();
			echo "<br>";
			echo "Message : ". $data->message;
			echo "<br> <br>";
			echo "<img src='http://ci4_tutorial.test/uploads/".$data->file_name."'>";
			echo "</center>";
		}
	}
}
