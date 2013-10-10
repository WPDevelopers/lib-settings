<?php
  /**
   * Settings Library
   *
   */
  namespace UsabilityDynamics {

    if( class_exists( '\UsabilityDynamics\Settings' ) ) {
      return;
    }

    class Settings extends Utility {

      /**
       * Settings Class version.
       *
       * @public
       * @static
       * @property $version
       * @type {Object}
       */
      public static $version = '0.1.2';

    }

  }