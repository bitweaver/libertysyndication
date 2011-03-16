<?php
global $gBitSystem, $gBitSmarty, $gBitThemes;

define( 'LIBERTY_SERVICE_SYNDICATION', 'syndication' );

$registerHash = array(
	'package_name' => 'libertysyndication',
	'package_path' => dirname(__FILE__).'/',
	'homeable' => FALSE,
);
$gBitSystem->registerPackage($registerHash);

if( $gBitSystem->isPackageActive( 'libertysyndication' ) ) {
	$gLibertySystem->registerService ( 
		LIBERTY_SERVICE_SYNDICATION, 
		LIBERTYSYNDICATION_PKG_NAME, 
		array(
			'content_store_function'  	=> 'libertysyndication_content_store',
		),
		array( 
			'description' => tra( 'Tracks replicated content' ),	
		)
	);

	function libertysyndication_content_store( &$pObject, &$pParamHash ) {
		global $gBitUser, $gBitSystem;
		$errors = NULL;
		// If the syndication system is active, let's call it
		if( $gBitSystem->isPackageActive( 'libertysyndication' ) ) {
			if( !empty( $pParamHash['syndication_url'] ) ) {
				$newUrl = trim( $pParamHash['syndication_url'] );
				if( $syndicationUrl = $pObject->mDb->getOne( "SELECT `syndication_url` FROM `".BIT_DB_PREFIX."liberty_syndication` WHERE `content_id`=?", array( $pObject->mContentId ) ) ) {
					if( $newUrl != $syndicationUrl ) {
						$pObject->mDb->query( "UPDATE `".BIT_DB_PREFIX."liberty_syndication` SET `syndication_url`=? WHERE `content_id`=?", array( $newUrl, $pObject->mContentId ) );
					}
				} else {
					$pObject->mDb->query( "INSERT INTO `".BIT_DB_PREFIX."liberty_syndication` ( `syndication_url`, `content_id` ) VALUES (?,?)", array( $newUrl, $pObject->mContentId ) );
				}
			}
		}
		return( $errors );
	}

}
?>
