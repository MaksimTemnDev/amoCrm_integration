<!doctype html>
<html lang="ru">
<?php
//обработка данных из формы
if(!empty($_POST)){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $price=$_POST['price'];
    require("../api/lead-create.php");
    //создадим сделку
    $lead = new Lead;
    $lead->add($name, $email, $phone, $price);
}
?>
<head>
    <!-- Кодировка веб-страницы -->
    <meta charset="utf-8">
    <!-- Настройка viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>...</title>

    <!-- Bootstrap CSS (jsDelivr CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Bootstrap Bundle JS (jsDelivr CDN) -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</head>

<body>
    <!-- Контент страницы (форма) -->
    <div class="container">
        <div class="row" style="padding-top: 40px;">
            <div class="col-md-6 mx-auto">
                <form action="/newSite/api/form.php" method="post">
                    <div class="mb-3">
                        <label for="nameInput" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="nameInput">
                    </div>
                    <div class="mb-3">
                        <label for="emailInput" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="emailInput">
                    </div>
                    <div class="mb-3">
                        <label for="phoneInput" class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" id="phoneInput">
                    </div>
                    <div class="mb-3">
                        <label for="priceInput" class="form-label">Price</label>
                        <input type="text" name = "price" class="form-control" id="priceInput">
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>