  <header id="masthead" role="banner" <?php if (get_header_image()) : ?>class="image"<?php endif; ?>>
    <hgroup>
    <?php if ( (is_front_page()) && ($paged < 1) ) : ?>
      <h1 id="site-title"><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></h1>
    <?php else : ?>
      <h1 id="site-title"><a href="<?php echo esc_url( home_url('/') ); ?>" rel="home" title="<?php _e('Go to the front page', 'onemozilla'); ?>"><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></a></h1>
    <?php endif; ?>
    <?php if (get_bloginfo('description','display')) : ?>
      <div id="site-description"><?php echo esc_attr( get_bloginfo('description', 'display') ); ?></div>
    <?php endif; ?>
    </hgroup>
    <a href="http://www.mozilla.org/" id="tabzilla">Mozilla</a>
  </header><!-- #masthead -->
