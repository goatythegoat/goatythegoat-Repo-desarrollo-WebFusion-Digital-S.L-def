<?php
/* Template Name: Pagina Principal Ejercicio */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

    <div style='background: #0073aa; color: white; padding: 20px; text-align: center; font-family: sans-serif;'>
        <h1>Holacomostan</h1>
        <p>probando probando.</p>
        <p>texto editado 2</p>
    </div>

    <div style="max-width: 800px; margin: 20px auto; padding: 20px;">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                the_title('<h2>', '</h2>');
                the_content();
            endwhile;
        endif;
        ?>
    </div>

    <?php wp_footer(); ?>
</body>
</html>
