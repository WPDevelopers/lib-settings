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
       * Whether or not to hash option keys before saving
       *
       * @var bool
       */
      private $hash_keys = false;

      /**
       * Defaults storage
       *
       * @var array
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
       * @param type                           $defaults
       * @param bool|\UsabilityDynamics\type   $force_save
       * @param string|\UsabilityDynamics\type $prefix
       * @param bool|\UsabilityDynamics\type   $hash_keys
       */
      public function __construct( $defaults, $force_save = false, $prefix = '', $hash_keys = false ) {

        $this->defaults  = $defaults;
        $this->prefix    = $prefix;
        $this->hash_keys = $hash_keys;

        $this->_load();

        if ( $force_save ) $this->save();

      }

      /**
       * Load options from DB
       *
       * @return \UsabilityDynamics\Settings
       */
      private function _load() {

        foreach( (array) $this->defaults as $option_key => $default_value ) {
          $this->data[ $option_key ] = get_option( $this->_option_key( $option_key ), $default_value );
        }

        return $this;

      }

      /**
       * Option key wrapper
       *
       * @param type $key
       * @return type
       */
      private function _option_key( $key ) {

        if ( !$this->hash_keys ) return $this->prefix.'_'.$key;

        return md5( $this->prefix.'_'.$key );

      }

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
       * @param type                         $key
       * @param type                         $value
       * @param bool|\UsabilityDynamics\type $force_save
       *
       * @return \UsabilityDynamics\Settings
       */
      public function set( $key, $value, $force_save = false ) {

        $this->data[ $key ] = $value;

        if ( $force_save ) return $this->save();

        return $this;

      }

      /**
       * Set option by assoc array
       *
       * @param array $assoc_array_values
       * @param bool $force_save
       * @return \UsabilityDynamics\Settings
       */
      public function set_array( $assoc_array_values, $force_save = false ) {

        if ( !empty( $assoc_array_values ) && is_array( $assoc_array_values ) ) {
          foreach( $assoc_array_values as $option_key => $option_value ) {
            $this->set( $option_key, $option_value );
          }

          if ( $force_save ) return $this->save();
        }

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