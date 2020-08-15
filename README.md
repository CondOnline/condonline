<h1 align="center"><img src="http://condonline.esy.es/adminlte/dist/img/CondOnlineLogo.png" width="80"> CondOnline</h1>


## Sobre CondOnline

Sistema desenvolvido para gestão de condomínios.
<br><br>
Algumas das principais funções:

- Gestão de moradores
- Gestão de prestadores de serviços
- Gestão de encomendas
- Gestão de circulares

## Pacotes utilizados

- Framework Laravel
- Dashboard AdminLTE V3
- Laravel UI

## Requisitos

- PHP: ^7.0
- MySQL
- Composer

## Instalação

1. Clonar o diretório:

   ```sh
   git clone https://github.com/diogofm7/condonline.git
   ```

2. Instalar dependencias composer:

   ```sh
   composer install --no-dev --optimize-autoloader
   ```
   
2. Criar arquivo .env:

      ```sh
      cp .env.example .env
      ```
   
3. Fazer as devidas configurações no .env:

    - APP_ENV=production
    - APP_DEBUG=false
    - APP_URL=URL_DA_APLICAÇÂO
    - Configurar toda parte de banco de dados
    
4. Gerar chave:

      ```sh
      php artisan key:generate
      ```
   
5. Rodar as migrations:

      ```sh
      php artisan migrate
      ```

## Usuário Inicial

<b>Email: </b>admin@admin.com.br
<br>
<b>Senha: </b>12345678
