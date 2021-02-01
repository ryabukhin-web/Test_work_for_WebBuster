<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тестовое задание для ВебБустер</title>
    <link rel="stylesheet" href="style/style.min.css">
</head>
<body>
    <section class="products">
        <div class="wrapper">
            <ul class="products__list">
                <?php

                    $json = file_get_contents('product.json');

                    $data = json_decode($json, true);

                    foreach ($data['product'] as $item) {
                        $name = $item['name'];
                        $img = $item['img'];
                        $price =$item['price'];
                ?>

                <li class="products__item product-item">
                    <img src="<?=$img?>" alt="<?=$name?>" class="product-item__image">
                    <h3 class="product-item__title"><?=$name?></h3>
                    <span class="product-item__prise"><?=$price?></span>
                    <a onclick="modalOpen(this)" class="product-item__button button">Купить</a>
                </li>
                <?php } ?>
                
            </ul>
        </div>
    </section>

    <div id="_modal" class="modal">
        <div class="modal__wrapper">
        <span class="modal__close">×</span>
        <form class="modal__form form" method="post" id="_ajax_form" action="#">
            <label class="form__answer" id="_answer"></label>
            <input class="form__text" type="text" id="_name" name="name" placeholder="имя">
            <input class="form__text" type="text" id="_phone" name="phone" placeholder="телефон">
            <input class="form__text" type="text" id="_email" name="email" placeholder="e-mail">
            <input class="form__text" type="text" id="_product" name="title-product" placeholder="Название товара">
            <input class="form__button button" type="button" id="_btn-form" value="Заказать">
        </form>
        </div>
    </div>

    <script>
        let modal = document.getElementById("_modal");
        let span = document.getElementsByClassName("modal__close")[0];
        
        function modalOpen(e) {
            modal.style.display = "block";
            let block = e.parentElement;
            let activeProduct = block.getElementsByClassName("product-item__title")[0].innerHTML;
            document.getElementById('_product').value = activeProduct;
            document.getElementById("_answer").innerHTML="";
        }

        span.onclick = function () {
            modal.style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        let btnForm = document.getElementById("_btn-form");

        btnForm.onclick = function () {
            let name = document.getElementById("_name").value,
                phone = document.getElementById("_phone").value,
                email = document.getElementById("_email").value,
                product = document.getElementById("_product").value;

            const request = new XMLHttpRequest();

            const url = "mail.php";
            let params = "name=" + name + "&phone=" + phone + "&email=" + email + "&product=" + product;

            request.open("POST", url, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.addEventListener("readystatechange", () => {
                if(request.readyState === 4 && request.status === 200) {    
                    document.getElementById("_answer").innerHTML=request.responseText;//"<label class='form__answer' id='answer'>Спасибо за заказ. В ближайшее время с вами свяжутся.</label>";
                } else {
                    document.getElementById("_answer").innerHTML=request.responseText;//"Проверьте введенные данные";
                    document.getElementById("_answer").style.color="red";
                }
            });

            request.send(params);
        }
    </script>
</body>
</html>