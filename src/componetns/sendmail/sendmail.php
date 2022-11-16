<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('ru', 'phpmailer/language/');
	$mail->IsHTML(true);

	//От кого письмо
	$mail->setFrom('hainantsentrzdorovya@yandex.ru', 'Hainan'); // Указать нужный E-mail
	//Кому отправить
	$mail->addAddress('hainantsentrzdorovya@yandex.ru'); // Указать нужный E-mail
	//Тема письма
	$mail->Subject = 'Запись на прием';

	//Тело письма
	$body = "
<h2>Новое письмо</h2>
<b>Имя:</b> $name<br>
<b>Номер телефона:</b> $tel<br><br>
<b>Сообщение:</b><br>$text
";

	//if(trim(!empty($_POST['name']))){
		//$body.='';
	//}	
	
	/*
	//Прикрепить файл
	if (!empty($_FILES['image']['tmp_name'])) {
		//путь загрузки файла
		$filePath = __DIR__ . "/files/sendmail/attachments/" . $_FILES['image']['name']; 
		//грузим файл
		if (copy($_FILES['image']['tmp_name'], $filePath)){
			$fileAttach = $filePath;
			$body.='<p><strong>Фото в приложении</strong>';
			$mail->addAttachment($fileAttach);
		}
	}
	*/

	$mail->Body = $body;

	//Отправляем
	if (!$mail->send()) {
		$message = 'Ошибка';
	} else {
		$message = 'Данные отправлены!';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>