<?php get_header();
?><main>
    <div class="blocky-child--narrow-page--boxed">
        <h1><?php the_title(); ?></h1>
        <p><strong><?php the_field('date_and_time', get_the_ID()); ?></strong><p>
        <p><?php the_content(); ?></p>
    </div>
</main>
<?php get_footer();
