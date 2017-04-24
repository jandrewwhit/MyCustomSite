<?php get_template_part('partials/head'); ?>
<html>
  <body <?php body_class(); ?>>
<?php get_template_part('partials/header'); ?>
<div class="container-override">
<h1 class="custom-heading">Top Rated</h1>


</div>
<?php the_posts_navigation(); ?>

<?php get_template_part('partials/footer'); ?>

  </body>
</html>
