<?php

// Big thanks to Brett Mason (https://github.com/brettsmason) for the awesome walker
class Menu_Walker extends Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = array() ) {

		$indent  = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul class=\"menu\">\n";

	}

}
