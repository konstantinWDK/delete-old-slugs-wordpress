
=== Eliminar Slugs Categoria/Tag Antiguos ===
Contributors: KonstantinWDK
Tags: slugs, eliminar slugs, categorías, etiquetas, taxonomías, WordPress
Requires at least: 5.0
Tested up to: 6.3
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Este plugin permite listar y eliminar slugs antiguos de categorías y etiquetas que ya no se usan, eliminando redirecciones innecesarias y solucionando errores comunes de WordPress relacionados con los slugs antiguos.

== Descripción ==

Este plugin tiene como objetivo principal la detección y eliminación de slugs antiguos o erróneos que puedan estar causando problemas en tu instalación de WordPress. Algunas de las funciones clave del plugin son:

* Mostrar todas las categorías y etiquetas junto con sus slugs asociados.
* Eliminar slugs de categorías o etiquetas que ya no se utilicen.
* Corregir errores comunes relacionados con slugs antiguos, como el mensaje de "El slug ya está siendo utilizado por otra entrada".
* Detectar y eliminar slugs bugueados que no aparecen en la base de datos correctamente.
  
== Instalación ==

1. Sube el archivo del plugin a la carpeta `/wp-content/plugins/` o instala el plugin directamente a través del repositorio de plugins de WordPress.
2. Activa el plugin a través del menú "Plugins" en WordPress.
3. Ve a la sección "Ajustes" -> "Taxonomy Slug Repair" para ver y eliminar los slugs antiguos.

== Preguntas Frecuentes ==

= ¿Cómo elimino un slug específico? =
Ve a la página de administración del plugin, introduce el slug que deseas eliminar en el campo correspondiente y haz clic en el botón "Eliminar".

= ¿Qué sucede si el slug no se encuentra? =
Si el slug no se encuentra en ninguna categoría o etiqueta, se mostrará un mensaje indicándote que no se pudo eliminar.

= ¿Puedo restaurar un slug eliminado? =
No, una vez eliminado un slug no puede ser restaurado. Asegúrate de eliminar solo los slugs que realmente no necesites.

== Changelog ==

= 1.0 =
* Versión inicial del plugin.

== Futuros Desarrollos ==
- Mejorar la interfaz de usuario.
- Añadir la opción de eliminar slugs automáticamente que cumplan ciertos criterios.
- Añadir la verificación de nonce para mayor seguridad.
