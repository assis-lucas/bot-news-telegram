# Telegram BOT de Notícias em Laravel

Projeto desenvolvido em Laravel 7.0 e PHP 7+, com intuito de automatizar minha leitura de notícias, através de palavras-chaves cadastradas no banco de dados, utilizando a API https://newsapi.org/ para buscar notícias, e enviando por um BOT no Telegram. Também vale ressaltar que não envia notícias repetidas, e pega as notícias de no máximo dois dias atrás (Pode ser alterado).

Para rodar o projeto corretamente, após a instalação das dependências via composer, é necessário utilizar um banco de dados mysql, e rodar as migrations com seeds.
```
php artisan migrate --seed
```

O projeto precisará de algumas variáveis na sua **.env** para funcionar corretamente.
```
TELEGRAM_BOT_TOKEN=YOUR-BOT-TOKEN
TELEGRAM_CHAT_ID=-YOUR-CHAT-ID
TELEGRAM_BOT_USERNAME=YOUR-BOT-USERNAME
NEWS_API_TOKEN=YOUR-NEWS-API-TOKEN
```

Também será necessário obter o TOKEN do seu BOT que foi criado, via Telegram. [Tutorial criando BOT Telegram](https://core.telegram.org/bots#creating-a-new-bot)

Será necessário também obter o CHAT_ID, que é o ID do Chat onde o BOT irá enviar as notícias, pode ser um grupo, ou usuário. 
Pode ser pegado utilizando a própria API do Telegram, ou utilizando a API que eu criei dentro do Laravel. 

```
Laravel
php artisan serve
[GET] localhost:8000/api/bot/getupdates

API Telegram
https://api.telegram.org/bot<YOUR-TOKEN>/getUpdates
```

O Bot precisará de um nome também, basta colocar um nome desejado, ou o próprio nome do BOT no Telegram.

Por fim, será necessário um [TOKEN da NEWS API](https://newsapi.org/) para obtê-lo, basta se cadastrar, e será gerado um token que você poderá utilizar.


Para utilizar, basta rodar o comando:
```
php artisan sendNews:send
```

O Comando pode ser executado por um JOB, basta configurá-lo no projeto da maneira desejada. Não configurei, pois isso é opcional de cada um, e cada um pode desejar receber as noticias nos horários, e dias que quiserem. 

O projeto é OPEN SOURCE, e está aberto a sugestões de melhorias, novas idéias, e por ai vai! Espero seu pull request 😊

Sugestões ou contato - lucasassistomaz@gmail.com

