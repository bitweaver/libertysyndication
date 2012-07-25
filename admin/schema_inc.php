<?php
$tables = array(
  'liberty_syndication' => "
    content_id I4 PRIMARY,
    syndication_url X NOTNULL
    CONSTRAINT ', CONSTRAINT `liberty_syndication_content_ref` FOREIGN KEY (`content_id`) REFERENCES `".BIT_DB_PREFIX."liberty_content` ( `content_id` )'
  "
);

global $gBitInstaller;

foreach( array_keys( $tables ) AS $tableName ) {
	$gBitInstaller->registerSchemaTable( LIBERTYSYNDICATION_PKG_NAME, $tableName, $tables[$tableName] );
}

$gBitInstaller->registerPackageInfo( LIBERTYSYNDICATION_PKG_NAME, array(
	'description' => "A simple Liberty Service that any package can use to track syndication from another site.",
	'license' => '<a href="http://www.gnu.org/licenses/licenses.html#LGPL">LGPL</a>',
) );


