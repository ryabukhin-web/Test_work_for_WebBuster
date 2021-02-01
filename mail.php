<?php
    $msg_box = "";
    $errors = array();
    if ($_POST['name'] == "") $errors[] = "Поле 'Имя' не заполнено!";
    if ($_POST['phone'] == "") $errors[] = "Поле 'Телефон' не заполнено!";
    if ($_POST['email'] == "") $errors[] = "Поле 'E-mail' не заполнено!";
    if ($_POST['product'] == "") $errors[] = "Поле 'Название товара' не заполнено!";

    if (empty($errors)) {     
        $message  = "Имя: " . $_POST['name'] . "<br/>";
        $message .= "Телефон: " . $_POST['phone'] . "<br/>";
        $message .= "E-mail пользователя: " . $_POST['email'] . "<br/>";
        $message .= "Заказанный продук: " . $_POST['product'];      
        send_mail($message);
        $msg_box = "<span style='color: green;'>Заказ приянят! В ближайшее время с Вами свяжется менеджер</span>";
    } else {
        $msg_box = "";
        foreach($errors as $one_error){
            $msg_box .= "<span style='color: red;'>$one_error</span><br/>";
        }
    }

    echo $msg_box;
     
    function send_mail($message){
        $mail_to = "ryabukhinikita@yandex.ru"; 

        $subject = "Проверка формы";
 
        $headers= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "From: Проверки формы <no-reply@test.com>\r\n";
          
        mail($mail_to, $subject, $message, $headers);
    }
     
?>