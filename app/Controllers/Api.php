<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Api extends ResourceController
{
	public function upload()
	{
		$photo = $this->request->getFile('photo');

		helper(['form']);

		$rules = [
			'photo' => 'uploaded[photo]|max_size[photo, 1024]|is_image[photo]'
		];

		if(!$this->validate($rules))
		{
			return $this->fail($this->validator->getErrors());
		}
		else
		{
			if(!$photo->isValid())
			{
				return $this->fail($photo->getErrorString());
			}

			$photo->move('./uploads');

			$data = [
				'success' => true,
				'message' => "Berhasil upload file image.",
				'file_name' => $photo->getName()
			];

			return $this->response->setJSON($data);
		}
	}
}