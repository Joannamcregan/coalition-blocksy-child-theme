<?php get_header();
global $wpdb;
$posts_table = $wpdb->prefix . "posts";
$postmeta_table = $wpdb->prefix . "postmeta";

?><main>
    <div class="blocky-child--narrow-page">
        <h1>Upcoming Events</h1>
        <?php $query = 'select posts.id, posts.post_title, postmeta.meta_value as time_and_date 
        from %i posts join %i postmeta on posts.id = postmeta.post_id and postmeta.meta_key = "date_and_time" 
        where posts.post_type = "event" and posts.post_status = "publish" and postmeta.meta_value > now()
        order by postmeta.meta_value ASC';
        $results = $wpdb->get_results($wpdb->prepare($query, $posts_table, $postmeta_table), ARRAY_A);
        if ($results){
            echo '<div class="blocksy-child--event-result-container">';
            for ($i=0; $i < count($results); $i++){
                echo '<div class="blocksy-child--event-result">';
                echo '<h2><a href="' . get_permalink($results[$i]['id']) . '">' . $results[$i]['post_title'] . '</a></h2>';
                echo '<p><strong>';
                echo the_field('date_and_time', $results[$i]['id']);
                echo '</strong></p>';
                echo '<p>' . get_the_excerpt($results[$i]['id']) . '</p>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<div class="blocksy-child--event-result-container">';
            echo '<p class="blocksy-child--centered-text">There are no upcoming events at this time.</p>';
            echo '<p class="blocksy-child--centered-text"><a href="' . esc_url(site_url('/what-weve-done')) . '">Read about our past events.</a></p>';
            echo '</div>';
        }
    ?></div>
</main>

<?php get_footer();