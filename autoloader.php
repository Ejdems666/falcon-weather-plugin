<?php
spl_autoload_register( function ( $class ) {
	$class                     = str_replace( '_', '-', strtolower( $class ) );
	$fragments                 = explode( '\\', $class );
	$class_index               = count( $fragments ) - 1;
	$fragments[ $class_index ] = 'class-' . $fragments[ $class_index ];
	$path                      = __DIR__ . '/' . implode( $fragments, '/' );
	if ( file_exists( $path . '.php' ) ) {
		require $path . '.php';
	}
} );