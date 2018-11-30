<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sayidan
 */

?>

                    <div class="blog-post-content">
                        <!--Blog Post-->
                        <div class="blog-post post-content " >
                            <?php if ( has_post_thumbnail() ) : ?>
                            <div class="area-img">
                               <a href="<?php echo get_the_permalink(); ?>"><?php the_post_thumbnail('sayidan-blog', array('class' => 'img-responsive')); ?></a>
                            </div>
                            <?php endif; ?>
                            <div class="area-content">
                                <h2 class="text-regular text-uppercase"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                                <div class="stats">
                                    <span class="clock">
                                        <span class="icon clock-icon stats-item"></span>
                                        <span class="text-center text-light stats-item"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_date(); ?></a></span>
                                    </span>
                                    <span class="comment">
                                        <span class="icon comment-icon stats-item"></span>
                                        <span class="text-center text-light stats-item"><?php echo comments_number( esc_html__( 'no comments', 'sayidan' ), esc_html__( 'one comment', 'sayidan' ), '% ' . esc_html__( 'comments', 'sayidan' ) ); ?></span>
                                    </span>
                                    <span class="user">
                                        <span class="icon user-icon stats-item"></span>
                                        <span class="text-content text-light stats-item"><?php echo get_the_author(); ?></span>
                                    </span>
                                </div>
                                <div class="clearfix" ></div>
                                <div class="post-content-body">
                                <?php
                                the_content( sprintf(
                                         /* translators: %s: Name of current post. */
                                        wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'sayidan' ), array( 'span' => array( 'class' => array() ) ) ),
                                        the_title( '<span class="screen-reader-text">"', '"</span>', false )
                                ) );
                                ?>
                                </div>
                                <?php    
                                //pagination
                                wp_link_pages( array(
                                                     'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'sayidan' ) . '</span>',
                                                     'after'       => '</div>',
                                                     'link_before' => '<span>',
                                                     'link_after'  => '</span>',
                                                     'pagelink'    => '<span class="screen-reader-text">%</span>',
                                                     'separator'   => '',
                                                     ) );
                              
                                ?>

                            </div>
                        </div>

                        <!--Share-->
                        <?php sayidan_sharing( $type = 'blog' );
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif; ?>
                    </div>
