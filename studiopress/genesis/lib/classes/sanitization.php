<?php
/**
 * The Genesis settings sanitizer class
 *
 * @package Genesis
 */

class Genesis_Settings_Sanitizer {
	static $instance;
	var $options = array();

	function Genesis_Settings_Sanitizer() {
		self::$instance =& $this;
		// Annouce that the sanitizer is ready, and pass the object (for advanced use)
		do_action_ref_array( 'genesis_settings_sanitizer_init', array( &$this ) );
	}

	function add_filter( $filter, $option, $suboption = null ) {
		if ( is_array( $suboption ) ) {
			foreach( $suboption as $so ) {
				$this->options[$option][$so] = $filter;
			}
		} elseif ( is_null( $suboption ) ) {
			$this->options[$option] = $filter;
		} else {
			$this->options[$option][$suboption] = $filter;
		}
		add_filter( 'sanitize_option_' . $option, array( $this, 'sanitize' ), 10, 2 );
		return true;
	}

	function do_filter( $filter, $new_value, $old_value ) {
		$available_filters = $this->get_available_filters();
		if ( !in_array( $filter, array_keys( $available_filters ) ) )
			return $new_value;
			return call_user_func( $available_filters[$filter], $new_value, $old_value );
	}

	function get_available_filters() {
		$default_filters = array(
			'one_zero'                 => array( $this, 'one_zero'                 ),
			'no_html'                  => array( $this, 'no_html'                  ),
			'safe_html'                => array( $this, 'safe_html'                ),
			'requires_unfiltered_html' => array( $this, 'requires_unfiltered_html' ),
			);
		// Child themes can add their own callbacks
		return apply_filters( 'genesis_available_sanitizer_filters', $default_filters );
	}

	function sanitize( $new_value, $option ) {
		if ( !isset( $this->options[$option] ) ) {
			return $new_value; // We are not filtering this option at all
		} elseif ( is_string( $this->options[$option] ) ) {
			return $this->do_filter( $this->options[$option], $new_value, get_option( $option ) );
		} elseif ( is_array( $this->options[$option] ) ) {
			$old_value = get_option( $option );
			foreach ( $this->options[$option] as $suboption => $filter ) {
				$old_value[$suboption] = isset( $old_value[$suboption] ) ? $old_value[$suboption] : '';
				$new_value[$suboption] = isset( $new_value[$suboption] ) ? $new_value[$suboption] : '';
				$new_value[$suboption] = $this->do_filter( $filter, $new_value[$suboption], $old_value[$suboption] );
			}
			return $new_value;
		} else {
			// Should never hit this, but:
			return $new_value;
		}
	}

	// Now, our filter methods
	function one_zero( $new_value ) {
		// Double casting. First, we cast to bool, then to integer. returns 1 or 0
		return (int) (bool) $new_value;
	}

	function no_html( $new_value ) {
		return strip_tags( $new_value );
	}

	function safe_html( $new_value ) {
		return wp_kses_post( $new_value );
	}

	// This one keeps the option from being updated if the user lacks unfiltered_html
	function requires_unfiltered_html( $new_value, $old_value ) {
		if ( current_user_can( 'unfiltered_html' ) ) {
			return $new_value;
		} else {
			return $old_value;
		}
	}

}
