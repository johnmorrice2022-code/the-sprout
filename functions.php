<?php
/**
 * Green Sprout & Growler (Astra Child Theme)
 * -----------------------------------------
 * This file:
 * - Enqueues the Growler CSS file
 * - Defines shortcode output functions
 * - Registers shortcodes for use in Gutenberg
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* =========================================================
   1) ASSETS (CSS)
   ========================================================= */

function gsg_enqueue_assets() {

  $css_rel_path = '/assets/css/growler.css';

  wp_enqueue_style(
    'gsg-growler',
    get_stylesheet_directory_uri() . $css_rel_path,
    array(),
    filemtime( get_stylesheet_directory() . $css_rel_path )
  );
}

add_action( 'wp_enqueue_scripts', 'gsg_enqueue_assets' );
add_action( 'enqueue_block_editor_assets', 'gsg_enqueue_assets' );


/* =========================================================
   2) HELPER FUNCTIONS
   ========================================================= */

/**
 * Build a URL to a file inside the child theme.
 * Example: gsg_asset_url('assets/images/foo.png')
 */
function gsg_asset_url( $relative_path ) {
  return trailingslashit( get_stylesheet_directory_uri() ) . ltrim( $relative_path, '/' );
}


/* =========================================================
   3) SHORTCODE OUTPUT FUNCTIONS
   ========================================================= */

/**
 * [gsg_hero]
 */
function gsg_shortcode_hero( $atts = array() ) {

  $atts = shortcode_atts(
    array(
      'title' => "Welcome to The Green<br />Sprout and Growler",
      'video' => 'assets/media/hero-video.mp4',
    ),
    $atts,
    'gsg_hero'
  );

  ob_start(); ?>
  <section class="hero">
    <video class="hero-video" autoplay muted loop playsinline>
      <source src="<?php echo esc_url( gsg_asset_url( $atts['video'] ) ); ?>" type="video/mp4" />
    </video>

    <div class="hero-overlay"></div>

    <div class="hero-content">
      <h1><?php echo wp_kses_post( $atts['title'] ); ?></h1>
    </div>
  </section>
  <?php
  return ob_get_clean();
}


/**
 * [gsg_history]...[/gsg_history]
 */
function gsg_shortcode_history( $atts = array(), $content = null ) {

  $atts = shortcode_atts(
    array(
      'title'       => 'Our History',
      'button_text' => 'Book a Table',
      'button_url'  => '#',
    ),
    $atts,
    'gsg_history'
  );

  $text = $content ? wpautop( wp_kses_post( $content ) ) : '';

  ob_start(); ?>
  <section class="history">
    <div class="history-container">

      <h2 class="history-title"><?php echo esc_html( $atts['title'] ); ?></h2>

      <div class="history-text">
        <?php echo $text ?: '<p>For over 250 years, The Green Sprout & Growler has been a place of welcome at the heart
         of the community. Originally established as a coaching inn in the late 18th century, it became a natural gathering
          point for travellers and locals alike. Through centuries of change, the pub has remained a constant — a space shaped 
          by conversation, shared stories, and the simple pleasure of good food and drink enjoyed at an unhurried pace.
          <br><br>

          Today, The Green Sprout & Growler continues that tradition while embracing a fully vegan identity rooted in care and sustainability.
           Our plant-based kitchen celebrates seasonal ingredients and comforting, flavour-led dishes, served in a relaxed and inclusive setting. 
           Whether you join us for a meal, a drink, or a moment of calm, you’ll find a pub that honours its past while looking
            thoughtfully towards the future.  </p>'; ?>
      </div>

      <a class="food-menu-button history-book-button" href="<?php echo esc_url( $atts['button_url'] ); ?>">
        <?php echo esc_html( $atts['button_text'] ); ?>
      </a>

    </div>
  </section>
  <?php
  return ob_get_clean();
}


/**
 * [gsg_drinks]...[/gsg_drinks]
 */
function gsg_shortcode_drinks( $atts = array(), $content = null ) {

  $atts = shortcode_atts(
    array(
      'title'       => 'Our Drinks',
      'button_text' => 'Drinks Menu',
      'button_url'  => '#',

      'img1' => 'assets/images/Logo.png',
      'img2' => 'assets/images/menu-drinks/5.png',
      'img3' => 'assets/images/menu-drinks/6.png',
      'img4' => 'assets/images/menu-drinks/7.png',
    ),
    $atts,
    'gsg_drinks'
  );

  $text = $content ? wpautop( wp_kses_post( $content ) ) : '';

  ob_start(); ?>
  <section class="drink-section">
    <div class="drink-container">

      <div class="drink-text-column">
        <h2 class="drink-title"><?php echo esc_html( $atts['title'] ); ?></h2>

        <div class="drink-description">
          <?php echo $text ?: '<p> Our bar features a rotating range of vegan-friendly craft beers and ales, 
          alongside carefully selected lagers that balance refreshment with depth of flavour. We work 
          with independent brewers wherever possible, favouring producers who value sustainability, creativity, 
          and consistency in every pour. From crisp, sessionable beers to richer, more full-bodied options, there’s 
          always something worth discovering.
          <br><br>
          Wine lovers will find a small but considered list of vegan wines, chosen for balance and drinkability rather than trend. 
          Our wines pair easily with food or stand comfortably on their own, whether you prefer something light and fresh or deeper 
          and more rounded.   </p>'; ?>
        </div>

        <a class="drink-menu-button" href="<?php echo esc_url( $atts['button_url'] ); ?>">
          <?php echo esc_html( $atts['button_text'] ); ?>
        </a>
      </div>

      <div class="drink-images">
        <img src="<?php echo esc_url( gsg_asset_url( $atts['img1'] ) ); ?>" class="drink-img" alt="Drink item" />
        <img src="<?php echo esc_url( gsg_asset_url( $atts['img2'] ) ); ?>" class="drink-img" alt="Drink item" />
        <img src="<?php echo esc_url( gsg_asset_url( $atts['img3'] ) ); ?>" class="drink-img" alt="Drink item" />
        <img src="<?php echo esc_url( gsg_asset_url( $atts['img4'] ) ); ?>" class="drink-img" alt="Drink item" />
      </div>

    </div>
  </section>
  <?php
  return ob_get_clean();
}


/**
 * [gsg_food]...[/gsg_food]
 */
function gsg_shortcode_food( $atts = array(), $content = null ) {

  $atts = shortcode_atts(
    array(
      'title'       => 'Our Food',
      'button_text' => 'Food Menu',
      'button_url'  => '#',

      'img1' => 'assets/images/Logo.png',
      'img2' => 'assets/images/menu-drinks/1.png',
      'img3' => 'assets/images/menu-drinks/2.png',
      'img4' => 'assets/images/menu-drinks/3.png',
    ),
    $atts,
    'gsg_food'
  );

  $text = $content ? wpautop( wp_kses_post( $content ) ) : '';

  ob_start(); ?>
  <section class="food-section">
    <div class="food-container">

      <div class="food-images">
        <img src="<?php echo esc_url( gsg_asset_url( $atts['img1'] ) ); ?>" class="food-img" alt="Food item" />
        <img src="<?php echo esc_url( gsg_asset_url( $atts['img2'] ) ); ?>" class="food-img" alt="Food item" />
        <img src="<?php echo esc_url( gsg_asset_url( $atts['img3'] ) ); ?>" class="food-img" alt="Food item" />
        <img src="<?php echo esc_url( gsg_asset_url( $atts['img4'] ) ); ?>" class="food-img" alt="Food item" />
      </div>

      <div class="food-text-column">
        <h2 class="food-title"><?php echo esc_html( $atts['title'] ); ?></h2>

        <div class="food-description">
          <?php echo $text ?: '<p>Food at The Green Sprout & Growler is rooted in comfort, flavour, and thoughtful cooking. 
          Our kitchen celebrates vegetarian and vegan food as it should be: satisfying, generous, and full of character. 
          Every dish is designed to feel familiar yet considered, offering the kind of food you want to sit with and enjoy.
          <br><br>
          Our menus change with the seasons, making the most of fresh ingredients and letting natural flavours lead the way. 
          Hearty pub classics are reimagined with a plant-based approach, alongside lighter dishes that are perfect for sharing or 
          pairing with a drink. Whether you’re joining us for a full meal or a relaxed bite, the focus is always on balance and 
          depth rather than novelty.
         
          <br><br>
         We believe good food should be inclusive and unpretentious. Many of our dishes are naturally vegan, while others offer vegetarian 
         comfort without compromise. Care is taken in every stage of preparation, from sourcing to presentation, to ensure each plate feels 
         both welcoming and well considered.
          </p>'; ?>
        </div>

        <a class="food-menu-button" href="<?php echo esc_url( $atts['button_url'] ); ?>">
          <?php echo esc_html( $atts['button_text'] ); ?>
        </a>
      </div>

    </div>
  </section>
  <?php
  return ob_get_clean();
}


/**
 * [gsg_book_now]
 */
function gsg_shortcode_book_now( $atts = array() ) {

  $atts = shortcode_atts(
    array(
      'title' => 'Book Now',
    ),
    $atts,
    'gsg_book_now'
  );

  ob_start(); ?>
  <section class="book-now-section">
    <div class="book-now-container">
      <div class="book-now-main">
        <h2 class="book-now-title"><?php echo esc_html( $atts['title'] ); ?></h2>
      </div>
    </div>
  </section>
  <?php
  return ob_get_clean();
}


/**
 * [gsg_test]
 * Simple debug shortcode
 */
function gsg_shortcode_test() {
  return '<div style="padding:20px; background:#cbd5c0;">gsg_test is working ✅</div>';
}


/* =========================================================
   4) REGISTER SHORTCODES (INDEX)
   =========================================================
   - [gsg_hero]
   - [gsg_history]...[/gsg_history]
   - [gsg_drinks]...[/gsg_drinks]
   - [gsg_food]...[/gsg_food]
   - [gsg_book_now]
   - [gsg_test]
   ========================================================= */

add_shortcode( 'gsg_hero',     'gsg_shortcode_hero' );
add_shortcode( 'gsg_history',  'gsg_shortcode_history' );
add_shortcode( 'gsg_drinks',   'gsg_shortcode_drinks' );
add_shortcode( 'gsg_food',     'gsg_shortcode_food' );
add_shortcode( 'gsg_book_now', 'gsg_shortcode_book_now' );
add_shortcode( 'gsg_test',     'gsg_shortcode_test' );
