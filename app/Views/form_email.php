<?php
	helper(['form']);
	$table = new \CodeIgniter\View\Table();

	echo form_open_multipart(base_url().'/mymail/send_mail');
	
	$to_data = [
		'type'    => 'text',
		'name'    => 'to',
		'id'      => 'to',
		'style' => 'width : 50%'
	];
	$to = form_input($to_data);

	$cc_data = [
		'type'    => 'text',
		'name'    => 'cc',
		'id'      => 'cc',
		'style' => 'width : 50%'
	];
	$cc = form_input($cc_data);

	$bcc_data = [
		'type'    => 'text',
		'name'    => 'bcc',
		'id'      => 'bcc',
		'style' => 'width : 50%'
	];
	$bcc = form_input($bcc_data);

	$subject_data = [
		'type'    => 'text',
		'name'    => 'subject',
		'id'      => 'subject',
		'style' => 'width : 50%'
	];
	$subject = form_input($subject_data);

	$message_data = [
		// 'type'    => 'textarea',
		'name'    => 'message',
		'id'      => 'message',
		'style' => 'width : 50%'
	];
	$message = form_textarea($message_data);

	$attach_data = [
		'type'    => 'file',
		'name'    => 'file',
		'id'      => 'file'
	];
	$attach = form_input($attach_data);

	$button =  form_submit('btnUpload', 'Upload');

	$template = [
		'table_open'  => '<table class="mytable" width="100%">'
	];

	$table->setTemplate($template);

	$table->addRow(['TO : ', $to]);
	$table->addRow(['CC : ', $cc]);
	$table->addRow(['BCC : ', $bcc]);
	$table->addRow(['SUBJECT : ', $subject]);
	$table->addRow(['MESSAGE : ', $message]);
	$table->addRow(['ATTACH FILE : ', $attach]);
	$table->addRow(['data' => $button, 'colspan' => 2]);
	echo $table->generate();

	echo form_close();
?>