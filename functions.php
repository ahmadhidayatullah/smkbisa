<?php
// Untuk memudahkan pemanggilan path dan url di tema
define('tpath', get_template_directory());
define('turi', get_template_directory_uri());

// Inisisasi tema. Semua setting awal yang dibutuhkan oleh tema
if (!function_exists('theme_setup')) {
  function theme_setup(){
    load_theme_textdomain( 'smkn1nabire', tpath. '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));
    add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		));
    add_theme_support( 'post-thumbnails' );
    register_nav_menus(
			array(
				'primary-menu' => esc_html__( 'Primary', 'rentalcar' ),
			)
		);
  }

  add_image_size('logo',100,100,false);
  add_image_size('banner',304,120,false);
  add_image_size('greet-img',600,175,false);
  add_image_size('j-img',192,100,false);
}
add_action('after_setup_theme','theme_setup'); //Mode inisiasi function di atas agar dieksekusi oleh wordpress

add_action('header-meta','header_meta');
function header_meta(){
  ?>
  <!DOCTYPE html>
  <html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
  <?php
}
add_action('footer-meta','footer_meta');
function footer_meta(){
  wp_footer();
  ?>
  </body>
  </html>
  <?php
}

// inisisasi widget yang mau dipake
add_action('widgets_init','theme_widgtes_setup');
function theme_widgtes_setup(){
  register_sidebar( array(
    'name'          => __( 'Sidebar', 'raudid' ),
    'id'            => 'raudid-sidebar',
    'description'   => __( 'Tambah widget sidebar', 'raudid' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ));
}

// inisiasi script yang mau dipake
if (!function_exists('theme_scripts')) {
  function theme_scripts(){
    wp_enqueue_style( 'animate', turi.'/assets/css/animate.css');
    wp_enqueue_style( 'icomoon', turi.'/assets/css/icomoon.css');
    wp_enqueue_style( 'bootstrap', turi.'/assets/css/bootstrap.css');
    wp_enqueue_style( 'owl.carousel.min', turi.'/assets/css/owl.carousel.min.css');
    wp_enqueue_style( 'pricing', turi.'/assets/css/pricing.css');
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css');
    wp_enqueue_style( 'ionicons', 'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css');
    wp_enqueue_style( 'theme-style', get_stylesheet_uri());

    wp_deregister_script('jquery');
    wp_register_script('jquery', turi.'/assets/js/jquery.min.js', array(), null);
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-easing',turi.'/assets/js/jquery.easing.1.3.js',array('jquery'),'',true);
    wp_enqueue_script('jquery-stellar',turi.'/assets/js/jquery.stellar.min.js',array('jquery'),'',true);
    wp_enqueue_script('owl-carousel',turi.'/assets/js/owl.carousel.min.js',array('jquery'),'',true);
    wp_enqueue_script('bootstrap',turi.'/assets/js/bootstrap.min.js',array('jquery'),'',true);
    wp_enqueue_script('jquery-waypoint',turi.'/assets/js/jquery.waypoints.min.js',array('jquery'),'',true);
    wp_enqueue_script('jquery-flexslider',turi.'/assets/js/jquery.flexslider-min.js',array('jquery'),'',true);
    wp_enqueue_script('jquery-counTo',turi.'/assets/js/jquery.countTo.js',array('jquery'),'',true);
    wp_enqueue_script('jquery-magnific-popup',turi.'/assets/js/jquery.magnific-popup.min.js',array('jquery'),'',true);
    wp_enqueue_script('magnific-popup-options',turi.'/assets/js/magnific-popup-options.js',array('jquery'),'',true);
    wp_enqueue_script('simplyCountdown',turi.'/assets/js/simplyCountdown.js',array('jquery'),'',true);
    wp_enqueue_script('jquery-lightbox',turi.'/assets/js/jquery.lightbox-0.5.min.js',array('jquery'),'',true);
    wp_enqueue_script('theme-script',turi.'/assets/js/main.js',array('jquery'),'',true);
  }
}
add_action('wp_enqueue_scripts','theme_scripts');

function footer_script(){
    ?>
    <script>
		$(function () {
			$('#gallery a').lightBox();
		});
	</script>


	<script>
		// $(function () {
		// 	$(".tabeldata").DataTable({
		// 		"language": {
		// 			"zeroRecords": "Data tidak ditemukan",
		// 			"processing": true,
		// 			"serverSide": true,
		// 			"ajax": "scripts/server_processing.php",
		// 			"infoEmpty": "Tidak ada catatan yang tersedia"
		// 		}
		// 	});
		// 	$(".select2").select2();
		// 	$(":file").filestyle({ buttonName: "btn-primary" });
		// });

		$('#myModal').modal('show');

		$('#myModal').on('shown.bs.modal', function () {
			$('#myInput').focus()
		})

	</script>

	<script>
		var d = new Date(new Date().getTime() + 50 * 120 * 120 * 2000);

		// default example
		simplyCountdown('.simply-countdown-one', {
			year: d.getFullYear(),
			month: d.getMonth() + 1,
			day: d.getDate()
		});

		//jQuery example
		$('#simply-countdown-losange').simplyCountdown({
			year: d.getFullYear(),
			month: d.getMonth() + 1,
			day: d.getDate(),
			enableUtc: false
		});
	</script>


	<script type="text/javascript">
		function showTime() {
			var a_p = "";
			var today = new Date();
			var curr_hour = today.getHours();
			var curr_minute = today.getMinutes();
			var curr_second = today.getSeconds();
			if (curr_hour < 12) {
				a_p = "AM";
			} else {
				a_p = "PM";
			}
			if (curr_hour == 0) {
				curr_hour = 12;
			}
			if (curr_hour > 12) {
				curr_hour = curr_hour - 12;
			}
			curr_hour = checkTime(curr_hour);
			curr_minute = checkTime(curr_minute);
			curr_second = checkTime(curr_second);
			document.getElementById('#time').innerHTML = curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
		}

		function checkTime(i) {
			if (i < 10) {
				i = "0" + i;
			}
			return i;
		}
		setInterval(showTime, 500);
	</script>

	<script>
		var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
		var date = new Date();
		var day = date.getDate();
		var month = date.getMonth();
		var yy = date.getYear();
		var year = (yy < 1000) ? yy + 1900 : yy;

		document.getElementById("date").innerHTML = " " + day + " " + months[month] + " " + year;
	</script>
    <?php
}
add_action('wp_footer','footer_script',100);

?>
