<?php

use Collective\Annotations\Routing\Annotations\Scanner;

class RoutingAnnotationScannerTest extends PHPUnit_Framework_TestCase {

	public function testProperRouteDefinitionsAreGenerated()
	{
		require_once __DIR__.'/fixtures/annotations/BasicController.php';
		$scanner = $this->makeScanner( ['App\Http\Controllers\BasicController'] );

		$definition = str_replace(PHP_EOL, "\n", $scanner->getRouteDefinitions());
		$this->assertEquals(trim(file_get_contents(__DIR__.'/results/annotation-basic.php')), $definition);
	}

	public function testAnyAnnotation()
	{
		require_once __DIR__.'/fixtures/annotations/AnyController.php';
		$scanner = $this->makeScanner( ['App\Http\Controllers\AnyController'] );

		$definition = str_replace(PHP_EOL, "\n", $scanner->getRouteDefinitions());
		$this->assertEquals(trim(file_get_contents(__DIR__.'/results/annotation-any.php')), $definition);
	}

	/**
	 * Construct a route annotation scanner
	 *
	 * @param  array $paths
	 * @return
	 */
	protected function makeScanner( $paths )
	{
		$scanner = Scanner::create( $paths );

		$scanner->addAnnotationNamespace(
			'Collective\Annotations\Routing\Annotations\Annotations',
			realpath(__DIR__.'/../../src/Routing/Annotations/Annotations')
		);

		return $scanner;
	}
}
