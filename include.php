<?
global $DBType, $DB, $MESS, $APPLICATION;
IncludeModuleLangFile(__FILE__);

CModule::AddAutoloadClasses(
	'collected.easycart',
	array(
		'CRSEasyCartMain' => "classes/general/main.php",
	)
);