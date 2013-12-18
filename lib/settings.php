<?php
/**
 * Settings Library
 *
 * @namespace UsabilityDynamics
 */
namespace UsabilityDynamics {

  if( !class_exists( 'UsabilityDynamics\Settings' ) ) {

    /**
     * Class Settings
     *
     * @package UsabilityDynamics
     */
    class Settings {

      /**
       * Settings Class version.
       *
       * @public
       * @static
       * @property $version
       * @type {Object}
       */
      public $version = '0.1.3';
      
      private $data = array();
      
      /**
       * Constructor
       * 
       * @param array $data Settings
       * @author peshkov@UD
       */
      public function __construct( $key, $defaults = array() ) {
        
        $this->data = (array)$defaults;
        
      }
      
      /**
       * 
       * 
       * @param type $key
       * @return type
       * @author peshkov@UD
       */
      public function get( $key ) {
        return !empty( $this->data[ $key ] ) ? $this->data[ $key ] : false;
      }
      
      public function set( $key ) {
        
      }

    }

  }

}