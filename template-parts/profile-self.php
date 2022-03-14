<?php
/**
 * Govpack profile template.
 *
 * @package Newspack
 */

// $profile_data is defined elsewhere.
// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable

$classes = join(
	' ',
	array_filter(
		[ 
			'wp-block-govpack-profile-self', 
			$attributes['className'],
			( isset( $attributes['align'] ) ? 'align' . $attributes['align'] : false ),
		] 
	) 
);

$available_widths = [
	'small'  => [
		'label'    => 'Small',
		'value'    => 'small',
		'maxWidth' => '300px',
	],
	'medium' => [
		'label'    => 'Medium',
		'value'    => 'medium',
		'maxWidth' => '400px',
	],
	'large'  => [
		'label'    => 'Large',
		'value'    => 'large',
		'maxWidth' => '600px',
	],
	'full'   => [
		'label'    => 'Full',
		'value'    => 'full',
		'maxWidth' => '100%',
	],
];


$styles = join(
	' ',
	[
		'max-width:' . $available_widths[ $attributes['width'] ?? 'full' ]['maxWidth'] . ';',
	]
);



$container_classes = join(
	' ',
	array_filter(
		[ 
			'wp-block-govpack-profile-self__container', 
			( isset( $attributes['avatarAlignment'] ) && 'right' === $attributes['avatarAlignment'] ? 'wp-block-govpack-profile-self__container--right' : false ),
			( isset( $attributes['avatarAlignment'] ) && 'left' === $attributes['avatarAlignment'] ? 'wp-block-govpack-profile-self__container--left' : false ),
			( isset( $attributes['align'] ) && ( 'center' === $attributes['align'] ? 'wp-block-govpack-profile-self__container--align-center' : false ) ),
			( 'is-styled-center' === $attributes['className'] ? 'wp-block-govpack-profile-self__container--center' : false ),
		] 
	) 
);


$show_photo = ( has_post_thumbnail( $profile_data['id'] ) && $attributes['showAvatar'] );

?>

<aside class="<?php echo esc_attr( $classes ); ?>" style="<?php echo esc_attr( $styles ); ?>">
	<div class="<?php echo esc_attr( $container_classes ); ?>">
	   
		<?php if ( $show_photo ) { ?>
		<div class="wp-block-govpack-profile-self__avatar">
			<figure>
				<?php echo wp_kses_post( GP_Maybe_Link( get_the_post_thumbnail( $profile_data['id'] ), $profile_data['link'], false ) ); ?>
			</figure>
		</div>
		<?php } ?>

		<div class="wp-block-govpack-profile-self__info">
			<h1> <?php echo esc_html( $profile_data['name'] ); ?></h1>
			<?php
				Row( $profile_data['legislative_body'], $attributes['showLegislativeBody'] );
				Row( $profile_data['position'] ?? null, $attributes['showPosition'] );
				Row( $profile_data['party'], $attributes['showParty'] );
				Row( $profile_data['state'], $attributes['showState'] );
				Row( GP_Contacts( $profile_data, $attributes ), ( $attributes['showEmail'] || $attributes['showSocial'] && $profile_data['hasSocial'] ) );
				Row( $profile_data['address'], $attributes['showAddress'] );
				
			?>
		</div>
	</div> <!-- end __container -->
</aside>
