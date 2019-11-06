<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package ecp
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: \'%s\'', 'ecp' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );
			endwhile;

			if ( $lang === 'cs') {
				global $wp_query;

				echo '<h2>???'.var_dump($wp_query).'!!!</h2>';

				echo '<h2>Search results in English</h2>';
				echo the_search_query();
				echo '<div style="background:black;color:white;">';
				// var_dump($GLOBALS['wp_query']);
				var_dump($GLOBALS['wp_query']->query);
				echo '<br>1. '.$GLOBALS['wp_query']->query['lang'];
				echo '<br>2. '.$GLOBALS['wp_query']->query_vars['lang'];
				echo '<br>3. '.$GLOBALS['wp_query']->query_vars['taxonomy']['language'];
				$GLOBALS['wp_query']->query['lang'] = 'en';
				$GLOBALS['wp_query']->query_vars['lang'] = 'en';
				echo '<br>'.$GLOBALS['wp_query']->query['lang'];
				var_dump($GLOBALS['wp_query']->query);
				echo '</div>';
				echo '<h1>???</h1>';

				// English only
				// $->set('lang', array('post','page','en') );
				$the_query = $GLOBALS['wp_query']->request;//new WP_Query( array($GLOBALS['wp_query']->request, 'lang' => 'en') );
				$featuredPosts = new WP_Query( array($GLOBALS['wp_query']->request, 'lang' => 'en') );//'type=post&posts_per_page=5'
                
                if( $featuredPosts->have_posts() ):
                    
                    $catPosts = '<ul class="ul-posts">';
                    
                    while ( $featuredPosts->have_posts() ): $featuredPosts->the_post();                    
                        $thisPost = get_post();
                        $catPosts .= '<li class="li-post">';
                        // $tmp = get_the_category($thisPost->ID);
                        // print_r($tmp);
                        // $catPosts .= '<h2>catName? '.$tmp[sizeof($tmp)-1]->cat_name.' ('.sizeof($tmp).')</h2>';
                        // print_r($tmp);             
                        // echo '<div class="row">';
                        // echo '<div class="col-xs-12">';
                        $catPosts .= '<div>';
                        // get_template_part('content');
                        // $catPosts .= get_template_part('content', 'list-item');
                        $catPosts .= '<h5>';
                        $catPosts .= '<a href="'. esc_url( get_the_permalink() ) .'" title="Link to '.get_the_title().'">';
                        // if( has_post_thumbnail() ):
                        //     $catPosts .= get_the_post_thumbnail( $thisPost->ID, 'thumbnail' );
                        // endif;
                        $catPosts .= get_the_title();
                        // $catPosts .= .' ('.$thisPost->ID.')';
                        $catPosts .= '</a>';
                        $catPosts .= '</h5>';
                        // $catPosts .= 'x';

                        // $catPosts .= $featuredPosts->post_title;
                        // $catPosts .= do_shortcode('[display-posts id="7200" include_content="true" image_size="thumbnail" wrapper="div"]');
                        // print_r($featuredPosts);
                        $catPosts .= '</div>';                
                        // echo '</div>';
                        // echo '</div>';
                        $catPosts .= '</li>';
                    endwhile;
                    
                    $catPosts .= '</ul>';
                    echo $catPosts;                  
                endif;
			}else{
				echo '<h2>Search results in Czech</h2>';
				echo get_search_query();
			}

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
