<?
global $MESS;
IncludeModuleLangFile(__FILE__);

Class kit_easycart extends CModule
{
    var $MODULE_ID = 'kit.easycart';
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;
	var $MODULE_GROUP_RIGHTS = 'Y';

	function kit_easycart()
	{
		$arModuleVersion = array();

		$path = str_replace('\\', '/', __FILE__);
		$path = substr($path, 0, strlen($path) - strlen('/index.php'));
		include($path.'/version.php');
	
        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        } else {
            $this->MODULE_VERSION = '1.0.0';
            $this->MODULE_VERSION_DATE = '2014.01.01';
        }

		$this->MODULE_NAME = GetMessage('RS.EC.INSTALL_NAME');
		$this->MODULE_DESCRIPTION = GetMessage('RS.EC.INSTALL_DESCRIPTION');
		$this->PARTNER_NAME = GetMessage('RS.EC.COPMPANY_NAME');
        $this->PARTNER_URI  = 'https://asdaff.github.io/';
	}

	// Install functions
	function InstallDB()
	{
		global $DB, $DBType, $APPLICATION;
		RegisterModule('kit.easycart');
		return TRUE;
	}

	function InstallEvents()
	{
		RegisterModuleDependences('main', 'OnBeforeLocalRedirect', 'kit.easycart', 'CRSEasyCartMain', 'OnBeforeLocalRedirect');
		return TRUE;
	}

	function InstallOptions()
	{
		COption::SetOptionString('kit.easycart', 'service_url', '/personal/' );
		return TRUE;
	}

	function InstallFiles()
	{
		CopyDirFiles($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/kit.easycart/install/components', $_SERVER['DOCUMENT_ROOT'].'/bitrix/components', true, true);
		CopyDirFiles($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/kit.easycart/install/templates', $_SERVER['DOCUMENT_ROOT'].'/bitrix/templates', true, true);
		return TRUE;
	}

	function InstallPublic()
	{
		return TRUE;
	}

	// UnInstal functions
	function UnInstallDB()
	{
		global $DB, $DBType, $APPLICATION;
		UnRegisterModule('kit.easycart');
		return TRUE;
	}

	function UnInstallEvents()
	{
		UnRegisterModuleDependences('main', 'OnBeforeLocalRedirect', 'kit.easycart', 'CRSEasyCartMain', 'OnBeforeLocalRedirect');
		return TRUE;
	}

	function UnInstallOptions()
	{
		COption::RemoveOption('kit.easycart');
		return TRUE;
	}

	function UnInstallFiles()
	{
		return TRUE;
	}

	function UnInstallPublic()
	{
		return TRUE;
	}

    function DoInstall()
    {
		global $APPLICATION, $step;
		$keyGoodDB = $this->InstallDB();
		$keyGoodEvents = $this->InstallEvents();
		$keyGoodOptions = $this->InstallOptions();
		$keyGoodFiles = $this->InstallFiles();
		$keyGoodPublic = $this->InstallPublic();
		$APPLICATION->IncludeAdminFile(GetMessage('SPER_INSTALL_TITLE'), $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/kit.easycart/install/install.php');
    }

    function DoUninstall()
    {
		global $APPLICATION, $step;
		$keyGoodFiles = $this->UnInstallFiles();
		$keyGoodEvents = $this->UnInstallEvents();
		$keyGoodOptions = $this->UnInstallOptions();
		$keyGoodDB = $this->UnInstallDB();
		$keyGoodPublic = $this->UnInstallPublic();
		$APPLICATION->IncludeAdminFile(GetMessage('SPER_UNINSTALL_TITLE'), $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/kit.easycart/install/uninstall.php');
    }
}