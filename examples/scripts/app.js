/**
 *
 */
require( [ 'udx.settings' ], function onLoaded() {

  var Settings = require( 'udx.settings' ).create( 'test' );

  // Load CSS
  require.loadStyle( 'styles/app.css' );

  //Settings.set( 'name', 'Andy' );

  console.log( 'name', Settings.get( 'name' ) );

  console.log( 'settings.keys', Settings.keys() );
  console.log( 'settings.data', Settings.data() );


});
