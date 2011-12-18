<?php
define( 'HEADER_IMAGE', CHILD_URL . '/images/header.png' );
define( 'NO_HEADER_TEXT', true );
define( 'HEADER_TEXTCOLOR', '' );
define( 'HEADER_IMAGE_WIDTH', 960 );
define( 'HEADER_IMAGE_HEIGHT', 120 );

/**
 * The site header CSS, output via wp_head()
 */
function tapestry_header_style() {
	
	if ( HEADER_IMAGE == get_header_image() )
		return;

	printf( '<style type="text/css">.header-image #header { background: url(%s) no-repeat; }</style>', esc_url( get_header_image() ) ); 

}

/**
 * The admin header image CSS.
 */
function tapestry_admin_header_style() {
?>

	<style type="text/css">
		.appearance_page_custom-header #headimg {
			background-repeat: no-repeat;
			height: <?php echo HEADER_IMAGE_HEIGHT ?>px;
			width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
		}
	</style>

<?php
}