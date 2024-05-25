Пожертвование
---
Мы принимаем следующие криптовалюты:

- **TON**: `UQAC6zTt3t0oNjb51AQcrOazHEzFIHnOj8sOjLPO-GTtCyWl`

- **USDT**(TRC20): `TXzLoiJHAnZc5tL2pyjNdXaF3snmwmg2x5`

- **USDT**(TON): `UQAC6zTt3t0oNjb51AQcrOazHEzFIHnOj8sOjLPO-GTtCyWl`

- **NOTCOIN**(TON): `UQAC6zTt3t0oNjb51AQcrOazHEzFIHnOj8sOjLPO-GTtCyWl`

- **BTC**: `122j6k2GTz3roZsiX9H2QAyqec83tmsP6q`

Пожертвования будут использованы для поддержания/сохранения проекта.

> Контакты: [Telegram](https://t.me/kittenwof)

## Languages
[![Russian README](https://raw.githubusercontent.com/hjnilsson/country-flags/master/png100px/ru.png)](README.md) [![English README](https://raw.githubusercontent.com/hjnilsson/country-flags/master/png100px/us.png)](README_EN.md) 

## Фарм Memefi в браузере с автокликером

Привет! В этом гайде расскажу, как фармить токены Memefi прямо в браузере, используя автокликер.
Автокликер не нуждается в запуске браузера. 
Запуск в браузере - это опция данного поста

**Что нам понадобится:**

* Несколько аккаунтов Telegram.
* Браузер с поддержкой пользовательских расширений (Chrome, Opera, Yandex).
* Немного вашего времени.

**Шаг 1: Перенаправляем трафик**

1. Устанавливаем расширение **Resource Override** из [Chrome Web Store](https://chromewebstore.google.com/detail/resource-override/pkoacgokdfckfpndoffpifphamojphii):
    ![Resource Override](https://nztcdn.com/files/5885c2ef-2121-4c15-ac6b-ecfa4476a421.webp)
2. Открываем настройки расширения и вставляем:
    * **From:** `https://telegram.org/js/telegram-web-app.js` 
    * **To:** `https://ktnff.tech/universal/telegram-web-app.js`

**Шаг 2: Начинаем играть (если еще не начали)**

1. Переходим в бота Memefi:
    * **Реферальная ссылка (с бонусом):** [https://t.me/memefi_coin_bot?start=r_1a5d23e126](https://t.me/memefi_coin_bot?start=r_1a5d23e126)  
    * **Обычная ссылка:** [https://t.me/memefi_coin_bot](https://t.me/memefi_coin_bot)
2. Жмем "Play & Earn" и выполняем задания в разделе "Earn".
3. Все полученные токены тратим на прокачку бустов.

**Шаг 3: Автокликер**

1. Скачиваем автокликер:
[github Releases](https://github.com/ilfae/autoclicker-browser-memefi/releases/tag/autoclicker-browser-memefi)
3. Распаковываем архив в удобное место.

**Шаг 4: Получаем токен**

1. Открываем веб-версию бота Memefi: [https://web.telegram.org/a/#6619665157](https://web.telegram.org/a/#6619665157).
2. Жмем "Играть" (игра должна запуститься в том же окне благодаря шагу 1).
3. Открываем инструменты разработчика (F12) -> Network.
4. Кликаем по монстру 1 раз и находим запрос `graphql` в списке запросов.
5. В Headers запроса `graphql` копируем значение **Authorization** (всё, что после `Bearer:`):

     ![Authorization](https://nztcdn.com/files/54d60767-9d88-4cea-91a5-9e7b74e5c57b.webp)
   
6. Но что бы она была в другой вкладк переходим во вкладку Elements, 
    ищем `iframe` (Ctrl+F) и находим ссылку, похожую на эту:

    <img src= "https://nztcdn.com/files/edacd6b5-dce5-4bbf-8524-faf5b38bed1e.webp" width="600" height="400">
    
    * **Сохраните эту ссылку**, она понадобится для запуска игры без Telegram.

**Шаг 5: Запускаем фарм**

1. Запускаем `run.bat` из архива с автокликером.
2. Выбираем нужные опции с помощью стрелок (↑,↓)  и Enter (⏎):

    ![Выбор опций](https://nztcdn.com/files/5398ee7b-3058-4c79-92cf-bd67f014af9e.webp)
   
4. Жмем Enter (⏎), не обращая внимания на повторы текста.
   
    ![Запуск](https://nztcdn.com/files/df2946dc-564b-4306-82dc-2341d6161594.webp)
   
7.  Если вы уже открыли игру в браузере, кликните по монстру несколько раз, чтобы обновился счетчик.

**Шаг 6: Фарм на нескольких аккаунтах**

![Выбор браузера](https://nztcdn.com/files/64e701a1-e9da-4afb-a3d5-65aedfdff512.webp) 

**Заключение**

Готово! Теперь вы знаете, как фармить Memefi. Удачного фарма! 
