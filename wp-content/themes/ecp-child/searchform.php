
<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="search">Search in <?php echo home_url( '/' ); ?></label>
    <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
    <input type="submit" id="searchsubmit" class="" value="" />
</form>
