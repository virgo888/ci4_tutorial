<?php
	helper(['form']);
	$table = new \CodeIgniter\View\Table();

	echo form_open_multipart(base_url().'/fileupload/upload');

	$dataDescription = [
		'type'    => 'text',
		'name'    => 'description',
		'id'      => 'description'
	];
	$description = form_input($dataDescription);
	$dataFile = [
		'type'    => 'file',
		'name'    => 'photo',
		'id'      => 'photo'
	];
	$file = form_input($dataFile);

	$button =  form_submit('btnUpload', 'Upload');

	$table->addRow(['Deskripsi : ', $description]);
	$table->addRow(['File : ', $file]);
	$table->addRow(['data' => $button, 'colspan' => 2]);
	echo $table->generate();

	echo form_close();
?>