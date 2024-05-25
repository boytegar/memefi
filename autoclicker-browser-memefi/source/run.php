<?php

// Функция для отправки GraphQL запросов
function sendGraphQLRequest($token, $accountId, &$totalTaps, &$totalCoins, &$totalEnergy, &$requestCount) {
    // Генерируем случайную строку для nonce
    $nonce = bin2hex(random_bytes(32)); // 32 байта * 2 (шестнадцатеричный) = 64 символа

    // Определяем количество нажатий в зависимости от уровня энергии
    $tapsCount = rand(2, 50);

    // Создаем данные полезной нагрузки в соответствии с запрашиваемым форматом
    $payload = array(
        "operationName" => "MutationGameProcessTapsBatch",
        "variables" => array(
            "payload" => array(
                "nonce" => $nonce,
                "tapsCount" => $tapsCount
            )
        ),
        "query" => "mutation MutationGameProcessTapsBatch(\$payload: TelegramGameTapsBatchInput!) {\n  telegramGameProcessTapsBatch(payload: \$payload) {\n    coinsAmount\n    currentEnergy\n  }\n}"
    );

    // Конвертируем данные полезной нагрузки в формат JSON
    $jsonPayload = json_encode($payload);

    // URL конечной точки
    $url = "https://api-gw-tg.memefi.club/graphql";

    // Создаем HTTP заголовки
    $headers = array(
        "Authorization: Bearer $token",
        "Content-Type: application/json"
    );

    // Инициализируем cURL
    $ch = curl_init();

    // Устанавливаем опции cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPayload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Выполняем cURL
    $response = curl_exec($ch);

    // Проверяем наличие ошибок
    if (curl_errno($ch)) {
        echo "Аккаунт $accountId: нажатия закончились\n";
    } else {
        $responseData = json_decode($response, true);
        if (isset($responseData['data']['telegramGameProcessTapsBatch'])) {
            $coinsAmount = $responseData['data']['telegramGameProcessTapsBatch']['coinsAmount'];
            $currentEnergy = $responseData['data']['telegramGameProcessTapsBatch']['currentEnergy'];
            echo "\n";
            echo "*************************************** \n";
            echo "Аккаунт - $accountId:\n";
            echo "Всего ударов: $tapsCount раз\n";
            echo "Осталось энергии: $currentEnergy\n";
            echo "Осталось здоровья у монстра: $coinsAmount\n";
            echo "*************************************** \n";
            $totalTaps += $tapsCount;
            $totalCoins += $coinsAmount;
            $totalEnergy += $currentEnergy;
            $requestCount++;
        } else {
            echo "Аккаунт $accountId: нажатия закончились\n";
        }
    }

    // Закрываем cURL
    curl_close($ch);
}

// Основная программа
$totalTaps = 0;
$totalCoins = 0;
$totalEnergy = 0;
$requestCount = 0;

// Массив для хранения токенов
$tokens = array();
echo "********************************************************************** \n";
echo "Ссылки на мои соц. сети:\n";
echo "TT: https://www.tiktok.com/@gafurus \n";
echo "TGK: https://t.me/kittenwof \n";
echo "********************************************************************** \n";


echo "Выберите опцию:\n";
echo "1. Новый токен\n";
echo "2. Использовать существующий токен\n";
echo "выберите: ";
$option = trim(fgets(STDIN));

if ($option == '1') {
    echo "Введите количество токенов: ";
    $numTokens = intval(trim(fgets(STDIN)));
    for ($i = 0; $i < $numTokens; $i++) {
        echo "Введите Bearer токен " . ($i + 1) . ": ";
        $token = trim(fgets(STDIN));
        $tokens[] = $token;
    }
    file_put_contents('tokens.json', json_encode($tokens));
} elseif ($option == '2') {
    if (!file_exists('tokens.json')) {
        echo "Токены не найдены. Пожалуйста, введите новые токены.\n";
        exit();
    }
    $tokens = json_decode(file_get_contents('tokens.json'), true);
} else {
    echo "Неверная опция.\n";
    exit();
}

// Используем while loop, пока приложение не будет остановлено
$tokenIndex = 0;
while (true) {
    $currentToken = $tokens[$tokenIndex];
    $accountId = $tokenIndex + 1;
    sendGraphQLRequest($currentToken, $accountId, $totalTaps, $totalCoins, $totalEnergy, $requestCount);
    $tokenIndex = ($tokenIndex + 1) % count($tokens);
    sleep(5); // Ожидание 5 секунд перед отправкой следующего запроса

    // Вывод статистики каждые 10 запросов
    if ($requestCount % 10 == 0) {
        $averageCoins = $totalCoins / $requestCount;
        $averageEnergy = $totalEnergy / $requestCount;
        echo "\n";
        echo "Всего ударов: $totalTaps\n";
        echo "Среднее количество монет: $averageCoins\n";
        echo "Средний уровень энергии: $averageEnergy\n";
        echo "\n";
    }
}
