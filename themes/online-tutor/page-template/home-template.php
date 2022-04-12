<?php
/**
 * Template Name: Home Template
 */

get_header(); ?>

<main id="skip-content">
  <section id="top-slider">
    <?php $online_tutor_slide_pages = array();
      for ( $count = 1; $count <= 3; $count++ ) {
        $mod = intval( get_theme_mod( 'online_tutor_top_slider_page' . $count ));
        if ( 'page-none-selected' != $mod ) {
          $online_tutor_slide_pages[] = $mod;
        }
      }
      if( !empty($online_tutor_slide_pages) ) :
        $args = array(
          'post_type' => 'page',
          'post__in' => $online_tutor_slide_pages,
          'orderby' => 'post__in'
        );
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) :
          $i = 1;
    ?>
    <div class="owl-carousel" role="listbox">
      <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
        <div class="slider-box">
          <img src="<?php esc_url(the_post_thumbnail_url('full')); ?>"/>
          <div class="slider-inner-box">
            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            <p class="post"><?php echo wp_trim_words( get_the_content(), 10 ); ?></p>
            <div class="slider-box-btn mt-4">
              <a href="<?php the_permalink(); ?>"><?php esc_html_e('Learn More','online-tutor'); ?></a>
            </div>
          </div>
        </div>
      <?php $i++; endwhile;
      wp_reset_postdata();?>
    </div>
    <?php else : ?>
      <div class="no-postfound"></div>
    <?php endif;
    endif;?>
  </section>

  <?php if(get_theme_mod('online_tutor_search_on_off') != ''){ ?>

  <div class="container">
    <div class="searchbox">
      <h3><?php esc_html_e('Find A Tutor','online-tutor'); ?></h3>
      <?php get_search_form(); ?>
    </div>
  </div>

<?php }?>

  <section id="projects" class="py-5">
    <div class="container">
      <?php if(get_theme_mod('online_tutor_projects_title') != ''){ ?>
        <h2 class="text-center"><?php echo esc_html(get_theme_mod('online_tutor_projects_title')); ?></h2>
      <?php }?>
      <div class="row mt-5">
        <?php $online_tutor_other_project_section = array();
          $project_loop = get_theme_mod('online_tutor_project_loop');
          for ($i=1; $i <= $project_loop; $i++) { 
            $mod = intval( get_theme_mod( 'online_tutor_other_project_section' .$i));
            if ( 'page-none-selected' != $mod ) {
              $online_tutor_other_project_section[] = $mod;
            }
          }
          if( !empty($online_tutor_other_project_section) ) :
          $args = array(
            'post_type' => 'post',
            'post__in' => $online_tutor_other_project_section,
            'orderby' => 'post__in'
          );
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) :
            $i = 1;
        ?>
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
          <div class="col-lg-4 col-md-6">
            <div class="box mb-4">
              <img src="<?php esc_url(the_post_thumbnail_url('full')); ?>" class="w-100"/>
              <div class="price-box text-right mr-3">
                <?php if(get_theme_mod('online_tutor_projects_price'.$i) != ''){ ?>
                  <h5><?php echo esc_html(get_theme_mod('online_tutor_projects_price'.$i)); ?></h5>
                <?php }?>
              </div>
              <div class="p-2">
                <h3><?php the_title(); ?></h3>
                <div class="readmore">
                  <a href="<?php the_permalink(); ?>"><?php esc_html_e('Enroll Now','online-tutor'); ?></a>
                </div>
              </div>
              <div class="box-content">
                <h3 class="title"><?php the_title(); ?></h3>
                <p class="post"><?php echo wp_trim_words( get_the_content(), 30 ); ?></p>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-6 align-self-center">
                    <div class="readmore">
                      <a href="<?php the_permalink(); ?>"><?php esc_html_e('Enroll Now','online-tutor'); ?></a>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-6 text-right align-self-center">
                    <?php if(get_theme_mod('online_tutor_projects_price'.$i) != ''){ ?>
                      <h5><?php echo esc_html(get_theme_mod('online_tutor_projects_price'.$i)); ?></h5>
                    <?php }?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php $i++; endwhile;
        wp_reset_postdata();?>
        <?php else : ?>
          <div class="no-postfound"></div>
        <?php endif;
        endif;?>
      </div>
    </div>
  </section>

  <section id="page-content">
    <div class="container">
      <div class="py-5">
        <?php
          if ( have_posts() ) :
            while ( have_posts() ) : the_post();
              the_content();
            endwhile;
          endif;
        ?>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>