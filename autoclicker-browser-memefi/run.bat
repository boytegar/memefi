@echo off
chcp 65001  

echo Установка библиотек...
python -m venv venv
venv\Scripts\python.exe -m pip install --upgrade pip
venv\Scripts\python.exe -m pip install -r source\requirements.txt

echo Запуск скрипта...
venv\Scripts\python.exe source\run.py

pause 
