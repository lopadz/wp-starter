<?php


// Echo the current date
add_shortcode( 'current_date', 'wps_current_date' );

function wps_current_date( string $date_params = 'Y' ) {

	echo esc_html( date( $date_params ) );

}


// Site Info
add_shortcode( 'site_info', 'wps_site_info' );

function wps_site_info( $atts ) {

	$site = shortcode_atts(
		[
			'info' => null,
		],
		$atts
	);

	if ( class_exists( 'acf' ) && true === is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {

		if ( 'address' === $site['info'] ) {

			$address = get_field( 'theme-site-address', 'options' );
			return $address;

		} elseif ( 'phone_1' === $site['info'] ) {

			$phone_1 = get_field( 'theme-site-phone_1', 'options' );
			return esc_html( $phone_1 );

		} elseif ( 'phone_2' === $site['info'] ) {

			$phone_2 = get_field( 'theme-site-phone_2', 'options' );
			return esc_html( $phone_2 );

		} elseif ( 'fax' === $site['info'] ) {

			$fax = get_field( 'theme-site-fax', 'options' );
			return esc_html( $fax );

		} elseif ( 'email_address' === $site['info'] ) {

			$email_address = get_field( 'theme-site-email_address', 'options' );
			return esc_html( $email_address );

		} elseif ( 'email_link' === $site['info'] ) {

			$email_address = get_field( 'theme-site-email_address', 'options' );
			$email_link    = '<a href="mailto:' . $email_address . '" target="_blank" rel="nofollow">' . $email_address . '</a>';
			return $email_link;

		}
	}

}
