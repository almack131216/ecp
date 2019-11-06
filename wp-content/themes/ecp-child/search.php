<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package ecp
 */
$showDebugOutput = false;

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
						$searchTitle = 'Search Results for ';
						$searchTitleOtherLang = 'We also found results on our Czech site';

						if($lang === 'cs'){
							$searchTitle = 'Výsledky hledání pro ';
							$searchTitleOtherLang = 'Výsledky hledání v anglické verzi';
						}
						printf( esc_html__( $searchTitle.'\'%s\'', 'ecp' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
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

			// 191106 - search the other language...
			$newLang = $lang === 'cs' ? $lang = 'en' : $lang = 'cs';

			if ($newLang) {				
				$debugOutput = '';
				$debugOutput .= '<div style="background:black;color:white;padding:20px;">';
				$debugOutput .= '<strong>debugOutput: lang vars...</strong>';
				$debugOutput .= '<br>[bef] 1. '.$GLOBALS['wp_query']->query['lang'];
				$debugOutput .= '<br>[bef] 2. '.$GLOBALS['wp_query']->query_vars['lang'];
				$GLOBALS['wp_query']->query['lang'] = $newLang;
				$GLOBALS['wp_query']->query_vars['lang'] = $newLang;
				$debugOutput .= '<br>[aft] 1. '.$GLOBALS['wp_query']->query['lang'];
				$debugOutput .= '<br>[aft] 2. '.$GLOBALS['wp_query']->query_vars['lang'];
				$debugOutput .= '</div>';

				if($showDebugOutput) echo $debugOutput;

				// English only
				// $->set('lang', array('post','page','en') );
				$the_query = $GLOBALS['wp_query']->request;//new WP_Query( array($GLOBALS['wp_query']->request, 'lang' => 'en') );
				$featuredPosts = new WP_Query( array($GLOBALS['wp_query']->request, 'lang' => $newLang) );//'type=post&posts_per_page=5'
                
                if( $featuredPosts->have_posts() ):
					
					$altResults = '<h2>'.$searchTitleOtherLang.'</h2>';
                    $altResults .= '<ul class="ul-posts">';
                    
                    while ( $featuredPosts->have_posts() ): $featuredPosts->the_post();                    
                        $thisPost = get_post();
                        $altResults .= '<li class="li-post">';
                        $altResults .= '<div>';
                        $altResults .= '<h5>';
                        $altResults .= '<a href="'. esc_url( get_the_permalink() ) .'" title="Link to '.get_the_title().'">';
                        $altResults .= get_the_title();
                        $altResults .= '</a>';
                        $altResults .= '</h5>';
                        $altResults .= '</div>';                
                        $altResults .= '</li>';
                    endwhile;
                    
                    $altResults .= '</ul>';
                    echo $altResults;                  
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
