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

      /**
       * Prefix for option keys to unique
       *
       * @var string
       */
      private $prefix = '';

      /**
       * Defaults storage
       *
       * @var type
       */
      private $defaults = array();

      /**
       * Data storage
       *
       * @var array
       */
      private $data = array();

      /**
       * Constructor
       *
       * @param array $data Settings
       * @author peshkov@UD
       */
      public function __construct( $defaults, $prefix = '', $force_save = false ) {

        $this->defaults = $defaults;
        $this->prefix   = $prefix;

        $this->_load();

        if ( $force_save ) $this->save();

      }

      /**
       *
       */
      private function _load() {

        foreach( (array) $this->defaults as $option_key => $default_value ) {
          $this->data[ $option_key ] = get_option( $this->_option_key( $option_key ), $default_value );
        }

        return $this;

      }

      /**
       *
       * @param type $key
       * @return type
       */
      private function _option_key( $key ) { return $this->prefix.'_'.$key; }

      /**
       * Getter for options
       *
       * @param type $key
       * @return type
       */
      public function get( $key ) {

        return !empty( $this->data[ $key ] ) ? $this->data[ $key ] : false;

      }

      /**
       * Setter for options
       *
       * @param type $key
       * @param type $value
       * @param type $force_save
       * @return \UsabilityDynamics\Settings
       */
      public function set( $key, $value, $force_save = false ) {

        $this->data[ $key ] = $value;

        if ( $force_save ) return $this->save();

        return $this;

      }

      /**
       * Save settings to database
       *
       * @return \UsabilityDynamics\Settings
       */
      public function save() {

        foreach( $this->data as $option_key => $option_value ) {
          update_option( $this->_option_key( $option_key ), $option_value );
        }

        return $this;
      }

      /**
       * Set all settings to default values
       *
       * @return \UsabilityDynamics\Settings
       */
      public function flush() {

        foreach( $this->defaults as $option_key => $option_value ) {
          update_option( $this->_option_key( $option_key ), $option_value );
        }

        return $this;
      }

      /**
       * Remove all current settings from database
       *
       * @return \UsabilityDynamics\Settings
       */
      public function clear() {

        foreach( $this->data as $option_key => $v ) {
          delete_option( $this->_option_key( $option_key ) );
        }

        return $this;
      }

    }

  }

}