<?php

/**
	ACF Name: MODULE - Tabs
*/

if ( ! empty( $section_counter ) ) :
	// Module Name Prefix
	$module_prefix = 'module-tabs-';

	// Available fields
	$module = array(
		'section_class'   => $module_prefix . 'section_class',
		'container_class' => $module_prefix . 'container_class',
		'row_class'       => $module_prefix . 'row_class',
		'type'            => $module_prefix . 'type',
		'nav_class'       => $module_prefix . 'nav_col_class',
		'content_class'   => $module_prefix . 'content_col_class',
		'tabs'            => $module_prefix . 'tabs',
		'tab_title'       => $module_prefix . 'tab_title',
		'tab_content'     => $module_prefix . 'tab_content',
	);

	// $section_counter is passed from the layout function
	$section_id = 'section-' . $section_counter;

	// ACF Data
	$section_class   = get_sub_field( $module['section_class'] ) ?: 'section';
	$container_class = get_sub_field( $module['container_class'] ) ? 'container ' . get_sub_field( $module['container_class'] ) : 'container';
	$row_class       = get_sub_field( $module['row_class'] ) ? 'row ' . get_sub_field( $module['row_class'] ) : 'row';

	// ACF Data
	$tab_type      = get_sub_field( $module['type'] );
	$nav_class     = get_sub_field( $module['nav_class'] ) ?: 'col-4';
	$content_class = get_sub_field( $module['content_class'] ) ?: 'col-8';

	?>

	<section id="<?php echo esc_attr( $section_id ); ?>" class="<?php echo esc_attr( $section_class ); ?>">
		<div  class="<?php echo esc_attr( $container_class ); ?>">
			<div class="<?php echo esc_attr( $row_class ); ?>">

				<?php if ( 'horizontal' === $tab_type ) : ?>

					<div class="col-12">

						<?php
						if ( have_rows( $module['tabs'] ) ) :
							$tab_counter   = 0;
							$panel_counter = 0;
							?>
							<nav>
								<div class="nav nav-pills mb-3" role="tablist">
									<?php
									while ( have_rows( $module['tabs'] ) ) {
										the_row();
										// Incrase counter
										$tab_counter++;
										// Create ID
										$tab_id = 'nav-' . $section_id . '-' . $tab_counter;
										// Check if it's first loop to activate 1st tab
										$tab_class_active = 1 === $tab_counter ? ' active' : null;
										$tab_aria_active  = 1 === $tab_counter ? 'true' : 'false';
										// Get the Tab Title
										$tab_title = get_sub_field( $module['tab_title'] );
										// Echo tab HTML
										echo sprintf(
											'<a class="nav-item nav-link%s" id="%s-tab" data-toggle="tab" href="#%s" role="tab" aria-controls="%s" aria-selected="%s">%s</a>',
											esc_html( $tab_class_active ),
											esc_html( $tab_id ),
											esc_html( $tab_id ),
											esc_html( $tab_id ),
											esc_html( $tab_aria_active ),
											esc_html( $tab_title )
										);
									}
									?>
								</div>
							</nav>

							<div class="tab-content">
								<?php
								while ( have_rows( $module['tabs'] ) ) {
									the_row();
									// Incrase counter
									$panel_counter++;
									// Create ID
									$panel_id = 'nav-' . $section_id . '-' . $panel_counter;
									// Check if it's first loop to activate 1st tab
									$panel_class_active = 1 === $panel_counter ? ' show active' : null;
									// Get the Tab Content
									$tab_content = get_sub_field( $module['tab_content'] );
									// Echo tab HTML
									echo sprintf(
										'<div class="tab-pane fade%s" id="%s" role="tabpanel" aria-labelledby="%s-tab">%s</div>',
										esc_html( $panel_class_active ),
										esc_html( $panel_id ),
										esc_html( $panel_id ),
										$tab_content
									);
								}
								?>
							</div>

						<?php endif; ?>

					</div>

				<?php elseif ( 'vertical' === $tab_type ) : ?>

					<?php
					if ( have_rows( $module['tabs'] ) ) :
						$tab_counter   = 0;
						$panel_counter = 0;
						?>

						<div class="<?php echo esc_attr( $nav_class ); ?>">
							<div class="list-group" id="list-tab" role="tablist">
								<?php
								while ( have_rows( $module['tabs'] ) ) {
									the_row();
									// Incrase counter
									$tab_counter++;
									// Create ID
									$tab_id = 'list-' . $section_id . '-' . $tab_counter;
									// Check if it's first loop to activate 1st tab
									$tab_class_active = 1 === $tab_counter ? ' active' : null;
									$tab_aria_active  = 1 === $tab_counter ? 'true' : 'false';
									// Get the Tab Title
									$tab_title = get_sub_field( $module['tab_title'] );
									// Echo tab HTML
									echo sprintf(
										'<a class="list-group-item list-group-item-action%s" id="%s-list" data-toggle="list" href="#%s" role="tab" aria-controls="%s" aria-selected="%s">%s</a>',
										esc_html( $tab_class_active ),
										esc_html( $tab_id ),
										esc_html( $tab_id ),
										esc_html( $tab_id ),
										esc_html( $tab_aria_active ),
										esc_html( $tab_title )
									);
								}
								?>
							</div>
						</div>

						<div class="<?php echo esc_attr( $content_class ); ?>">
							<div class="tab-content" id="nav-tabContent">
								<?php
								while ( have_rows( $module['tabs'] ) ) {
									the_row();
									// Incrase counter
									$panel_counter++;
									// Create ID
									$panel_id = 'list-' . $section_id . '-' . $panel_counter;
									// Check if it's first loop to activate 1st tab
									$panel_class_active = 1 === $panel_counter ? ' show active' : null;
									// Get the Tab Content
									$tab_content = get_sub_field( $module['tab_content'] );
									// Echo tab HTML
									echo sprintf(
										'<div class="tab-pane fade%s" id="%s" role="tabpanel" aria-labelledby="%s-list">%s</div>',
										esc_html( $panel_class_active ),
										esc_html( $panel_id ),
										esc_html( $panel_id ),
										$tab_content
									);
								}
								?>
							</div>
						</div>

				<?php endif; ?>

			<?php endif; ?>

			</div>
		</div>
	</section>

	<?php

endif;
