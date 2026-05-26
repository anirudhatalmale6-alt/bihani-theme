<?php
function my_script_init(){ 
	// 標準のjQueryをCDNで読み込み
	wp_enqueue_script( 'jQuery_cdn', '//code.jQuery.com/jQuery-3.7.1.min.js');
}
add_action('wp_enqueue_scripts', 'my_script_init');


function bihani_support() {
	// コアブロックの追加分のCSSを読み込む
	add_theme_support( 'wp-block-styles' );

	// テーマのCSS（style.css）をエディターに読み込む
	add_editor_style('style.css');

}
add_action( 'after_setup_theme', 'bihani_support' );

function bihani_enqueue() {
	// テーマのCSS（style.css）をフロントに読み込む
	wp_enqueue_style( 
		'bihani-style', 
		get_stylesheet_uri(),
		array(),
		filemtime( get_theme_file_path('style.css') )
	);

}
add_action( 'wp_enqueue_scripts', 'bihani_enqueue' );

function my_scripts_method() {
	// jsを読み込む
	wp_enqueue_script(
		'custom_script',
		get_template_directory_uri() . '/common.js',
	);
}
add_action('wp_enqueue_scripts', 'my_scripts_method');

// slick-slider cdn
function add_my_styles() {
	//css
	wp_enqueue_style(
	'slick-slider_css',  //$handle
	'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.css',  //$src
	);
}

add_action( 'wp_enqueue_scripts', 'add_my_styles' );

function add_my_styles_theme() {
	//theme-css
	wp_enqueue_style(
	'slick-slider_theme-css',  //$handle
	'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.min.css'
	);
}

add_action( 'wp_enqueue_scripts', 'add_my_styles_theme' );

function add_my_script() {
	//js
	wp_enqueue_script(
	'slick-slider_js',  //$handle
	'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',  //$src
	array(),  //$deps
	null,  //$ver
	true  //$in_footer
	);
}

add_action( 'wp_enqueue_scripts', 'add_my_script' );


// ブロックスタイル
function bihani_register_block_styles() {

	// 見出し： 星マーク
	register_block_style(
		'core/heading',
		array(
			'name' => 'star',
			'label' => '星マーク'
		)
	);

	// カテゴリー一覧： リストマークなし
	register_block_style(
		'core/categories',
		array(
			'name' => 'no-listmark',
			'label' => 'リストマークなし'
		)
	);

	// 投稿日： 時計アイコン
	register_block_style(
		'core/post-date',
		array(
			'name' => 'clock-icon',
			'label' => '時計アイコン'
		)
	);

	// 次の投稿： ラベル逆配置
	register_block_style(
		'core/post-navigation-link',
		array(
			'name' => 'reverse',
			'label' => 'ラベル逆配置'
		)
	);

	// テンプレートパーツ： 上マージン削除
	register_block_style(
		'core/template-part',
		array(
			'name' => 'rm-margin-top',
			'label' => '上マージン削除'
		)
	);

	// 段落： スクロールダウン
	register_block_style(
		'core/paragraph',
		array(
			'name' => 'scroll-down',
			'label' => 'スクロールダウン'
		)
	);

	// カラム： モバイル逆順
	register_block_style(
		'core/columns',
		array(
			'name' => 'reverse',
			'label' => 'モバイル逆順'
		)
	);

}
add_action( 'init', 'bihani_register_block_styles' );


// ブロックパターン
function bihani_block_pattern() {

	// My Themeカテゴリーを追加
	register_block_pattern_category(
		'bihani',
		array( 'label' => 'Bihani' )
	);

	// My Page Baseカテゴリーを追加
	register_block_pattern_category(
		'mypagebase',
		array( 'label' => 'My Page Base' )
	);

	// デフォルトで用意されたパターンを削除
	remove_theme_support('core-block-patterns');

}
add_action( 'init', 'bihani_block_pattern' );


// 使用するブロック
// function bihani_allowed_block_types ( $allowed_block_types, $editor_context ) {
// 
// 	if ( $editor_context->post  ) {
// 		$allowed_block_types = array(
// 			'core/paragraph',
// 			'core/heading',
// 			'core/image'
// 		);
// 	}
// 
// 	return $allowed_block_types;
// }
// add_filter( 'allowed_block_types_all', 'bihani_allowed_block_types', 10, 2 );


// メタデータ
function bihani_meta() {

	// サイト名
	$site_name = esc_attr( get_bloginfo( 'name' ) );

	// ページのタイトル
	$title = esc_attr( wp_get_document_title() );

	// 代替アイキャッチ画像
	$image_url = esc_url( get_theme_file_uri( 'assets/images/ogp.png' ) );
	$image_w = '1800';
	$image_h = '1196';

	// トップページ
	if ( is_front_page() ) {
		// URL、説明、種類
		$url = esc_url( home_url('/') );
		$description = esc_attr( get_bloginfo('description') );
		$type = 'website';
	}

	// 記事・固定ページ（サイト型トップページにした固定ページは除く）
	if( is_singular() && ! is_front_page()) {
		// URL、説明、種類
		$url = esc_url( get_permalink() );
		$description = esc_attr( get_the_excerpt() );
		$type = 'article';

		// アイキャッチ画像
		$image_id = get_post_thumbnail_id();
		if ($image_id) {
			$image_url = esc_url( wp_get_attachment_url( $image_id ) );
			$image_w = esc_attr( wp_get_attachment_metadata( $image_id )['width'] );
			$image_h = esc_attr( wp_get_attachment_metadata( $image_id )['height'] );
		}
	}

	if( is_front_page() ||  is_singular() ) {
	?>
		<meta property="og:site_name" content="<?php echo $site_name; ?>" />
		<meta property="og:locale" content="ja_JP" />

		<meta property="og:title" content="<?php echo $title; ?>" />
		<meta property="og:url" content="<?php echo $url; ?>" />
		<meta property="og:description" content="<?php echo $description; ?>" />
		<meta property="og:type" content="<?php echo $type; ?>" />

		<meta property="og:image" content="<?php echo $image_url; ?>" />
		<meta property="og:image:width" content="<?php echo $image_w; ?>" />
		<meta property="og:image:height" content="<?php echo $image_h; ?>" />
		<meta name="twitter:card" content="summary_large_image" />
	<?php
	}
}
add_action('wp_head', 'bihani_meta');


// テーブルスタイル
function my_enqueue_block_editor_assets_new() {
  $script = <<<SCRIPT
  wp.blocks.registerBlockStyle('core/table', {
    name: 'original',
    label: 'オリジナル'
  });
  SCRIPT;
  wp_add_inline_script( 'wp-blocks', $script );
}
add_action( 'enqueue_block_editor_assets', 'my_enqueue_block_editor_assets_new' );

// ページスラッグがcontactのとき以外、「reCAPTCHA」を読み込ませない
function load_recaptcha_js() {
	if ( ! is_page( 'contact' ) ) {
		wp_deregister_script( 'google-recaptcha' );
	}
}
add_action( 'wp_enqueue_scripts', 'load_recaptcha_js',100);

