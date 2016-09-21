<!--
searchform.php defines the behaviour of the WP search box. Its results are in search.php.
-->

<form role="search" method="get" id="searchform"
    class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div>
        <label class="screen-reader-text" for="s"><?php _x( 'Search for:', 'label' ); ?></label>
        <!-- We leave the search input as a placeholder. -->
        <input type="text" value="" name="s" id="s" placeholder="<?php echo get_search_query(); ?>" >
        <input type="submit" id="searchsubmit"
            value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>" />
    </div>
</form>