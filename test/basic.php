<?php

// Instantiate and load Settings.
$this->_settings  = new Settings(array(
  "store" => "options",
  "key" => "settings_test",
  "format" => "object"
));

$this->set( 'make', 'Chevy' );
$this->set( 'model', 'Tahoe' );
$this->set( 'features', array(
  'ac',
  'stuff'
));

$this->set( 'features', array(
  'dvd',
  'sunroof'
));

$this->set( 'options', array(
  "rims" => '24',
  "towing" => true,
  "onstar" => 'active'
));

$this->set( 'options', array(
  "gps" => 'standard'
));

//echo '<br />get all: <pre>' . print_r( $this->get(), true ) . '</pre>';
echo '<br />get make: ' . print_r( $this->get( 'make' ), true );
echo '<br />get options.gps: ' . print_r( $this->get( 'options.gps' ), true );
echo '<br />get features: ' . print_r( $this->get( 'features' ), true );
die( '<pre>get all' . print_r( $this->get(), true ) . '</pre>' );
