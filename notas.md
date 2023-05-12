Al usar el comando "*php artisan make:component MovieCard*" se nos crea una nueva carpeta en view llamada "components" y una vista con el nombre dado, de igual forma se nos crea una clase en la ruta:

namespace App\View\Components;

Esto nos facilita ya que se puede usar un controlador especifico de un componente.


## LIVE WIRE | Instalar: composer require livewire/livewire ##
"*Laravel Livewire es un paquete de Laravel que permite construir interfaces de usuario dinámicas e interactivas utilizando técnicas de programación en vivo (live programming) y sin la necesidad de escribir JavaScript."*

Con Laravel Livewire, puedes crear componentes de interfaz de usuario de manera sencilla y rápida, utilizando PHP y HTML sin tener que preocuparte por manipular el DOM directamente o escribir código JavaScript complejo. 2*Livewire maneja automáticamente la interacción con el servidor a través de una conexión HTTP de forma transparente al usuario.*"

# Creación de un "*componente liveware*": php artisan mike:livewire <name>

# COMO AGREGAR EL SPINNER: https://github.com/aniftyco/tailwindcss-spinner


# --------- UI Interactivity w/ Alpine.js - Part 5 -------- #
 INSTALL CDN: <script src="//unpkg.com/alpinejs" defer></script>

 - ALPINE JS: *Es un framework de JavaScript liviano* que se utiliza para *agregar interactividad y funcionalidad* a las páginas web *sin la necesidad de escribir una gran cantidad de código JavaScript complejo*.
 
 # DOCS: https://alpinejs.dev/start-here
 *¿Como lo usaremos?*
 En nuestro caso lo que haremos es que al momento en que demos click fuera del componente "search-dropdown" este se oculte


 # ------------ Spatie/ Larvel View Models ------------#
 INSTALL LINK: https://github.com/spatie/laravel-view-models
 INSTALL COMPOSER: composer require spatie/laravel-view-models

 Es una *biblioteca* útil ara Laravel que *mejora la organización y claridad del codigo al encasular la lógica de la vista en modelos dedicados y reutilizables*, lo que facilita la realización de pruebas unitarias de la lógica de la vista.

 Crear un view-model: php artisan make:view-model HomepageViewModel
 *INTERESANTE, ME HIZO REDUCIR MUCHO CODIGO EN LA VISTA, YA QUE TRAZLADE LA LOGICA DE LA VISTA A UN MODELO CENTRALIZADO*