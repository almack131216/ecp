<div class="list-item">
    <div class="col-img" style="display:none;">
        <a href="<?php echo esc_url( get_permalink() ) ?>" title="Link to <?php the_title();?>">
            <?php
                if( has_post_thumbnail() ):
                    the_post_thumbnail( 'thumbnail', array(
                        'class' => 'img-fluid rounded mb-3 mb-md-0'
                        )
                    );
                else:
                    echo 'xxx';
                endif;
            ?>
        </a>
    </div>
    <div class="col-text">
        <h3>
            <a href="<?php echo esc_url( get_permalink() ) ?>" title="Link to <?php the_title();?>">
                <?php the_title();?>
            </a>
        </h3>
        <?php
            // $tmpCat = get_the_category();
            // echo '<h4><a href="category/'.$tmpCat[0]->slug.'">'.$tmpCat[0]->name.'</a></h4>';
            // the_post();
            // get_template_part('content', get_post_format());
            // the_category();
            // echo get_first_paragraph( array('readmore' => true) );
        ?>
    </div>
</div>