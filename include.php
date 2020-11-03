<?
global $DBType, $DB, $MESS, $APPLICATION;
IncludeModuleLangFile(__FILE__);

CModule::AddAutoloadClasses(
	'kit.easycart',
	array(
		'CRSEasyCartMain' => "classes/general/main.php",
	)
);