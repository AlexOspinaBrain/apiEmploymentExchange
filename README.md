<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>



<h1>Api para una bolsa de empleos</h1>
    
</h2>Es una API desarrollada en Laravel.</h2>

<h3>Instalación :</h3>

<ul>
<li>Clonar el repositorio</li>

<li>Crear una base de datos</li>

<li>Despues puede hacer una copia del archivo .env.example con el nombre .env y en la seccion DB configurar el acceso a la base de datos creada</li>

<li>Ahora debe ejecutar los siguientes comandos: </li>

<ul>
<li><code>composer install</code></li>
<li><code>php artisan key:generate</code></li>
<li><code>php artisan migrate --seed</code></li>
<li><code>php artisan jwt:secret</code></li>
</ul>
</ul>
    
<h3>Listo, la base de datos ya contendra información de prueba pre fabricada</h3>

<h2>Endpoints</h2>

<h3>POST http://sudominio/public/api/addUser </h3>
<p> Con este endpoint podemos crear usuario nuevos al sistema, asi; </p>
<h5>
JSON para insertar usuarios:
</h5>
<code>
{
    "tipoId": "CC",
    "id": "800EE00",
    "nombre": "Omar Herrera",
    "email": "algo1@gmail.com",
    "password": "Porahora"
}
</code>
<br>
    <br>
    
<h3>POST http://sudominio/public/api/login </h3>
<p> Con este endpoint podemos loguearnos, retornara un token JWT para poder consumir los siguientes endpoints, así; </p>
<h5>
JSON para loguear usuarios:
</h5>
<code>
{
    "email": "algo1@gmail.com",
    "password": "Porahora"
}
</code>
<br>
    <br>

<h3>GET http://sudominio/public/api/offers </h3>
<p> Con este endpoint podemos recuperar un JSON con los usuarios y las ofertas aplicadas por éste, así; </p>
<h5>
OJO:
</h5>
<code>
<strong>Token valido bearer en el encabezado de la solicitud</strong>
</code>
<br>
    <br>

<h3>POST http://sudominio/public/api/addOffer </h3>
<p> Con este endpoint podemos loguearnos, retornara un token JWT para poder consumir los siguientes endpoints, así; </p>
<h5>
JSON para insertar usuarios:
</h5>
<code>
    <strong>Token valido bearer en el encabezado de la solicitud</strong>
    
{
    "oferta": "Conductor",
    "usuarios": [
        "algo1@gmail.com", 
        "algo@gmail.com"
    ]
}
</code>
<br>
    <br>

    
<h3>Acá lo puede ver en acción, http://alexdeploys.info/apiemploymentexchange/public/api/addUser</h3>
<h4>Este ejemplo esta desplegado en Google Cloud en una VM Ubuntu con PHP7.4 FCM, Nginx y una instancia MySQL</h4>

<br>
    <br>

<h3>Dudas con laravel? revise lo siguiente :</h3>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
