<?php namespace App\Controllers;

class Fileuploadnative extends BaseController
{
	public function index()
	{
		return view('form_upload_native');
	}

	public function upload()
	{
		$description = $this->request->getPost('description');
		$file = $this->request->getFile('photo');
		$data = array(
			'description' => $description,
			'file' => $file
		);
		$field_file = "photo";
		$test = $this->curl_upload(base_url().'/api/upload',$data, $field_file);

		print_r($test);
	}

    public function curl_upload($url, $data, $field_file)
    {

		helper(['form']);

    	$file = $data['file'];
    	if($file->getSize() <= 0)
    	{
    		return $file->getErrorString();
    	}
    	else
    	{
    		if (function_exists('curl_file_create')) 
    		{ 
			// php 5.5+
    			$cFile = curl_file_create($file->getTempName(), $file->getMimeType(), $file->getName());
    		} else { 
    			$cFile = '@' . realpath($file->getTempName(), $file->getMimeType(), $file->getName());
    		}
    	}

    	unset($data['file']);
    	$data[$field_file] = $cFile;

        $post = $data;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $output=curl_exec ($ch);
        if($output == false)
        {
            $errno = curl_errno($ch);
            $error_message = curl_strerror($errno);
            $messages =  "cURL error ({$errno}): {$error_message}";
            $callBack = [
                'success' => 'false',
                'message' => $messages,
            ];
            echo json_encode($callBack, true);
            exit;
        }
        curl_close($ch);

        return $output;
    }
}
