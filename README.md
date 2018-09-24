## Тестовое задание

##### Задача
    Реализовать заливку, хранение, разбор и вывод PDF документов в виде
    HTML-страниц. 
    Спроектировать архитектуру БД и классов. 
    Запросы без использования ООПшных декораторов, чистый SQL. 
    Продумать механизм разбора PDF-файла с момента загрузки в форме и попаданием в базу.
    
    Из представлений:
    1. Страница с формой заливки PDF-файла. Нужна проверка на тип.
    2. Страница-каталог со списком разобранных PDF-файлов + ссылками на
    прямое скачивание файла-исходника.
    3. Персональная страница разобранной PDFки. Должна быть навигация по
    страницам.

- PHP7
- MVC
- DI (Service Provider)
- Repository
- PDO(MySQL)
- Database migrations.
- Twig template engine

## Требования
1. Poppler-Utils (`apt-get install poppler-utils`)
2. PHP конфигурация предполагающий доступ скриптов к шеллу