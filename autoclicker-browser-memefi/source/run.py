
import requests
import json
import time
import random
import os
from inquirer import list_input, text
import urllib3

# Отключение InsecureRequestWarning
urllib3.disable_warnings(urllib3.exceptions.InsecureRequestWarning)

# Функция для отправки GraphQL запросов
def send_graphql_request(token, account_id, stats):
    # Генерируем случайную строку для nonce
    nonce = os.urandom(32).hex()  # 32 байта * 2 (шестнадцатеричный) = 64 символа

    # Определяем количество нажатий в зависимости от уровня энергии
    taps_count = random.randint(20, 50)

    # Создаем данные полезной нагрузки в соответствии с запрашиваемым форматом
    payload = {
        "operationName": "MutationGameProcessTapsBatch",
        "variables": {
            "payload": {
                "nonce": nonce,
                "tapsCount": taps_count
            }
        },
        "query": """mutation MutationGameProcessTapsBatch($payload: TelegramGameTapsBatchInput!) {
                      telegramGameProcessTapsBatch(payload: $payload) {
                          coinsAmount
                          currentEnergy
                      }
                    }"""
    }

    # URL конечной точки
    url = "https://api-gw-tg.memefi.club/graphql"

    # Создаем HTTP заголовки
    headers = {
        'Authorization': f'Bearer {token}',
        'Content-Type': 'application/json',
        'Accept-Charset': 'utf-8'
    }

    response = requests.post(url, json=payload, headers=headers, verify=False)  # Отключение проверки SSL
    response_data = response.json()

    if response.status_code == 200 and 'data' in response_data:
        if 'telegramGameProcessTapsBatch' in response_data['data']:
            coins_amount = response_data['data']['telegramGameProcessTapsBatch']['coinsAmount']
            current_energy = response_data['data']['telegramGameProcessTapsBatch']['currentEnergy']

            print("\n")
            print("***************************************")
            print(f"Аккаунт - {account_id}:")
            print(f"Всего ударов: {taps_count} раз")
            print(f"Осталось энергии: {current_energy}")
            print(f"Осталось здоровья у монстра: {coins_amount}")
            print("***************************************")

            stats['total_taps'] += taps_count
            stats['total_coins'] += coins_amount
            stats['total_energy'] += current_energy
            stats['request_count'] += 1
        else:
            print(f"Аккаунт {account_id}: нажатия закончились")
    else:
        print(f"Аккаунт {account_id}: нажатия закончились: {response.text}")

# Основная программа
stats = {
    'total_taps': 0,
    'total_coins': 0,
    'total_energy': 0,
    'request_count': 0
}

tokens = []
print("**********************************************************************")
print("Ссылки на мои соц. сети:")
print("TT: https://www.tiktok.com/@gafurus")
print("TGK: https://t.me/kittenwof")
print("**********************************************************************")


option = list_input("Выберите опцию:", choices=['Новый токен', 'Использовать существующий токен'])

if option == 'Новый токен':
    num_tokens = int(text("Введите количество токенов:"))
    for i in range(num_tokens):
        token = text(f"Введите Bearer токен {i + 1}:")
        tokens.append(token)
    with open('tokens.json', 'w') as f:
        json.dump(tokens, f)
elif option == 'Использовать существующий токен':
    if not os.path.exists('tokens.json'):
        print("Токены не найдены. Пожалуйста, введите новые токены.")
        exit()
    with open('tokens.json', 'r') as f:
        tokens = json.load(f)
else:
    print("Неверная опция.")
    exit()
    
# Используем while loop, пока приложение не будет остановлено
token_index = 0
while True:
    current_token = tokens[token_index]
    account_id = token_index + 1
    send_graphql_request(current_token, account_id, stats)
    token_index = (token_index + 1) % len(tokens)
    time.sleep(5)  # Ожидание 5 секунд перед отправкой следующего запроса

    # Вывод статистики каждые 10 запросов
    # if stats['request_count'] % 10 == 0:
    #     average_coins = stats['total_coins'] / stats['request_count']
    #     average_energy = stats['total_energy'] / stats['request_count']
    #     print("\n")
    #     print(f"Всего ударов: {stats['total_taps']}")
    #     print(f"Среднее количество монет: {average_coins}")
    #     print(f"Средний уровень энергии: {average_energy}")
    #     print("\n")
