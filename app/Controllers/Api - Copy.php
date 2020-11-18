<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Api extends ResourceController
{
	protected $modelName = 'App\Models\Photo';
	protected $format    = 'json';

	public function __construct()
	{
	}

	public function index()
	{
		return $this->respond($this->model->findAll());
	}

	public function upload()
	{
		$description = $this->request->getPost('description');
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
				'description' => $description,
				'file_name' => $photo->getName()
			];

			return $this->response->setJSON($data);
		}
	}
}