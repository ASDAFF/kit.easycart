<?
IncludeModuleLangFile(__FILE__);
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/options.php");

CModule::IncludeModule('kit.easycart');

$aTabs = array(
	array('DIV' => 'kit_edit1', 'TAB' => GetMessage('RSEC.TAB1_NAME'), 'ICON' => '', 'TITLE' => GetMessage('RSEC.TAB1_TITLE')),
);

$tabControl = new CAdminTabControl('tabControl', $aTabs);

if( (isset($_REQUEST['save']) || isset($_REQUEST['apply'])) && check_bitrix_sessid())
{
	COption::SetOptionString('kit.easycart', 'service_url', $_REQUEST['service_url'] );
}

$tabControl->Begin();

?><form method="post" name="kit_easycart_options" action="<?=$APPLICATION->GetCurPage()?>?mid=<?=urlencode($mid)?>&amp;lang=<?=LANGUAGE_ID?>"><?
echo bitrix_sessid_post();





$tabControl->BeginNextTab();
$service_url = COption::GetOptionString('kit.easycart', 'service_url', '');
?><tr><?
	?><td width="50%" valign="top"><?=GetMessage('RSEC.SERVICE_URL')?>:</td><?
	?><td width="50%"><input type="text" name="service_url" value="<?=$service_url?>"/></td><?
?></tr><?





$tabControl->Buttons(array());
$tabControl->End();
?></form>