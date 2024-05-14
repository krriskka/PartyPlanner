<?php


// Подключение к базе данных
$servername = "sql11.freemysqlhosting.net"; // Имя сервера БД
$username = "sql11705022"; // Имя пользователя БД
$password = "YImWifSKV7"; // Пароль к БД
$dbname = "sql11705022"; // Имя вашей БД

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение UserID из сессии
if(isset($_SESSION['UserID'])) {
    $userid = $_SESSION['UserID'];
} else {
    // Если UserID не найден в сессии, можете принять какое-то стандартное значение или выполнить другие действия по вашему усмотрению
    die("UserID not found in session.");
}

// Подготовка запроса на получение заказанных услуг для пользователя с определенным UserID
$sql = "SELECT * FROM Orders WHERE UserID = '$userid'";
$result = $conn->query($sql);

// Проверка наличия результатов
if ($result->num_rows > 0) {
    // Вывод данных о заказанных услугах
    echo "<ul>";
    while($row = $result->fetch_assoc()) {
        echo "<li>" . $row["Service"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "У вас еще нет заказов.";
}

// Закрытие соединения
$conn->close();
?>
