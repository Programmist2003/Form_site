<!-- подключение констант -->
<?php require_once("includes/connect.php") ?>
 <?php
   if(isset($_POST['submit'])) {
       if (!empty($_POST['username']) && !empty($_POST['password'])) {
           $username = htmlspecialchars($_POST['username']);
           $password = htmlspecialchars($_POST['password']);
      
           
            // проверка на правильность заполнения форм
            $query = mysqli_query($con, "SELECT * FROM users WHERE username='".$username."'");
            $numrows = mysqli_num_rows($query);

            if($numrows == 0) {
                $sql = "INSERT INTO users (username, password) 
                VALUES ('$username', '$password')";
                $result = mysqli_query($con, $sql);
                
                // Валидация
                if($result) {
                    $message = 'Аккаунт успешно создан';
                } else {
                    $message = 'Невозможно добавить в БД';
                }
            } else {
                $message = 'Введённое имя уже есть в БД. Нужно другое';
            }
        } else {
            $message = 'Все поля необходимо заполнить';
        }
    }
?>
<!-- Отображение валидации -->
<?php
    if(!empty($message)) {
        echo ('<p class="error">' . 'ВАЛИДАЦИЯ: ' . $message . '</p>');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<aside>
        <h1>Gmail</h1>
        <ul>
            <a href=""><li><i class="fa-solid fa-house-user"></i> Почта</li></a>
             <a href=""><li><i class="fa-solid fa-face-smile"></i>Диск</li></a>
             <a href=""><li><i class="fa-solid fa-phone"></i>Документы</li></a>
             <a href=""><li><i class="fa-solid fa-cart-shopping"></i>Презентация</li></a>
             <a href=""><li><i class="fa-solid fa-heart"></i>Формы</li></a>
        </ul>
    </aside>
    <main>
        <h3>Авторизация</h3>
        <form action="" method="post">
            <label for="username">Логин</label>
            <input type="text" id="username" name="username" placeholder="Введите логин: ">
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" placeholder="Введите пароль: " required>
            <button type="submit" name="submit">Войти</button>
        </form>
        
    </main>
</body>
</html>