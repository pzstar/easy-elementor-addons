<?php
/**
 * Weekly, Daily and Hourly weather forecast for Elementor
 *
 * @encoding        UTF-8
 * @version         1.0.0
 **/

/** Register plugin custom autoloader. */
spl_autoload_register(function ($class) {

	$namespace = 'JsonMachine\\';

	/** Bail if the class is not in our namespace. */
	if (0 !== strpos($class, $namespace)) {
		return;
	}

	/** Build the filename. */
	$file = realpath(__DIR__);
	$file = $file . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

	/** If the file exists for the class name, load it. */
	if (file_exists($file)) {
		/** @noinspection PhpIncludeInspection */
		include($file);
	}

});