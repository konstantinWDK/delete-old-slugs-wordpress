<?php
/**
 * Plugin Name: Eliminar Slugs Categoria/Tag Antiguos
 * Plugin URI: https://webdesignerk.com/
 * Description: Este plugin permite mostrar y eliminar slugs viejos de categorias y tags. Tambien detecta los slugs bugueados.
 * Version: 1.0
 * Author: Desarrollado por KonstantinWDK.
 * Author URI: https://webdesignerk.com/
**/

// Aquí va el código del plugin

function delete_category_with_slug( $slug ) {
    // Comprobar si el slug existe en categorías
    $term = get_term_by( 'slug', $slug, 'category' );
    if ( $term ) {
        wp_delete_term( $term->term_id, 'category' );
        return true;
    }
    // Si no se encuentra en categorías, comprobar si existe en etiquetas
    $term = get_term_by( 'slug', $slug, 'post_tag' );
    if ( $term ) {
        wp_delete_term( $term->term_id, 'post_tag' );
        return true;
    }
    return false; // Si no se encuentra en ninguna taxonomía, retornar falso
}

function deletter_old_slug_options() {
    add_options_page( 'Delete Category Options', 'Taxonomy Slug Repair', 'manage_options', 'delete-category-options', 'deletter_old_slug_options_page' );
}
add_action( 'admin_menu', 'deletter_old_slug_options' );

function display_categories_list() {
    // Obtener todas las categorías y etiquetas
    $categories = get_terms( array(
        'taxonomy' => 'category',
        'hide_empty' => false,
    ) );
    $tags = get_terms( array( 
        'taxonomy' => 'post_tag',
        'hide_empty' => false,
    ) );

    // Mostrar los términos en columnas separadas
    if ( count($categories) > 0 || count($tags) > 0 ) {
        echo '<h2>Lista de categorías y etiquetas</h2>';
        echo '<div style="float: left;width: 45%;" class="categories-list">';
        if (count($categories) > 0) {
            echo '<h3>Categorías:</h3><ul>';
            foreach ($categories as $category) {
                echo '<li><strong>' . $category->name . '</strong>: ' . $category->slug . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No se encontraron categorías.</p>';
        }
        echo '</div>';

        echo '<div style="float: left;width: 45%;" class="tags-list">';
        if (count($tags) > 0) {
            echo '<h3>Etiquetas:</h3><ul>';
            foreach ($tags as $tag) {
                echo '<li><strong>' . $tag->name . '</strong>: ' . $tag->slug . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No se encontraron etiquetas.</p>';
        }
        echo '</div>';
    } else {
        echo '<p>No se encontraron categorías o etiquetas.</p>';
    }
}

function deletter_old_slug_options_page() {
    // Verificar si el usuario tiene permisos
    if (!current_user_can('manage_options')) {
        return;
    }

    // Verificar si se ha enviado el formulario y si el nonce es válido
    if ( isset( $_POST['delete-category'] ) && check_admin_referer('delete_category_nonce_action', 'delete_category_nonce') ) {
        $slug = sanitize_text_field( $_POST['category-slug'] );
        if (delete_category_with_slug( $slug )) {
            echo '<div class="notice notice-success"><p>Categoría o etiqueta eliminada con éxito</p></div>';
        } else {
            echo '<div class="notice notice-error"><p>No se encontró la categoría o etiqueta con el slug proporcionado</p></div>';
        }
    }

    ?>
    <div class="wrap">
        <h1>Encuentra y elimina viejos slugs de Categoría y Tags</h1>
        <p>Este pequeño plugin se encarga de mostrarte TODAS las categorías y tags junto a sus slugs. El error típico al que da solución es <strong>El slug «mi-slug-antiguo» ya lo está utilizando otro</strong>.</p>
        <p>Muestra listado de categorías que no aparecen en la lista de Posts -> Categorías.</p>
        <p>Elimina las redirecciones 301 del slug antiguo al nuevo.</p>
        <p>Encuentra y elimina slugs de categoría/tags bugueados incluso los que no están en <strong>meta_key = _wp_old_slug</strong>.</p>
        <form method="post" action="">
            <?php wp_nonce_field('delete_category_nonce_action', 'delete_category_nonce'); ?>
            <label for="category-slug">Slug para eliminar:</label>
            <input type="text" name="category-slug" id="category-slug">
            <button type="submit" name="delete-category" class="button-primary">Eliminar</button>
        </form>

        <?php display_categories_list(); ?>

    </div>
    <?php
}
?>
