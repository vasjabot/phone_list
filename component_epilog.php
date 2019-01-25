<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?
//////////////млдефикация заголовков///////////
GLOBAL $lastModified;
if (!$lastModified)
   $lastModified = MakeTimeStamp($arResult['TIMESTAMP_X']);
else
   $lastModified = max($lastModified, MakeTimeStamp($arResult['TIMESTAMP_X']));
//////////////////////////////////////////////
?>
<?
global $APPLICATION;


if (!$isCraftmann) 
{
	if (isset($arResult['MY_TITLE']))
	$APPLICATION->SetPageProperty("title", $arResult['MY_TITLE']);

	if (isset($arResult['MY_KEYWORDS']))
	$APPLICATION->SetPageProperty("keywords", $arResult['MY_KEYWORDS']);

	if (isset($arResult['MY_DESCRIPTION']))
	$APPLICATION->SetPageProperty("description", $arResult['MY_DESCRIPTION']);
}
else
{
	if (isset($arResult['UF_DESCRIPTION']))
	$APPLICATION->SetPageProperty("description", $arResult['UF_DESCRIPTION']);
}



?>

<?global $USER, $APPLICATION, $CurCatalogSection;

//if($USER->GetID()=="7"):

$Producer = '';
$Model = '';
if($CurCatalogSection['DEPTH_LEVEL'] == 1)
	$Producer = $CurCatalogSection['NAME'];
$Model = htmlspecialchars($_REQUEST['ModelName']);
if($CurCatalogSection['DEPTH_LEVEL'] == 2 && strlen($Producer) <= 0)
{
	$res = CIBlockSection::GetByID($CurCatalogSection['IBLOCK_SECTION_ID']);
	if($ar_res = $res->GetNext())
		$Producer =  $ar_res['NAME'];
		$Model = $CurCatalogSection['NAME'];
}


CModule::IncludeModule('iblock');
$NUMBER=0
//ob_start();
?>
<div style="display:none">
<?$APPLICATION->IncludeComponent("nsandrey:mailform", "REQUEST_FORM", array(
	"FORM_ID" => "REQUEST",
	"EMAIL_TO" => "shop@craftmann.ru",
	"EVENT_ID" => "REQUEST",
	"JQUERY" => "N",
	"EVENT_MESSAGE_ID" => array(
		0 => "72",
		1 => "71",
	),
	"OK_TEXT" => "Спасибо за заявку!",
	"USE_CAPTCHA" => "N",
	"ENABLE_HIDDEN_ANTISPAM_FIELDS" => "Y",
	"FILE_EXT" => "",
	"FILE_SAVE" => "N",
	"REQUIRED_FIELDS" => array(
		0 => "FIRST_NAME",
		1 => "CITY1",
		2 => "EMAIL",
		3 => "PHONE_NUMBER",
	),
	"NUMBER" => "HIDDEN",
	"NUMBER_HIDDEN_VALUE" => $NUMBER,
	"ARTICLE" => "STRING",
	"ARTICLE_MASK" => $article,
	"PRODUCER" => "STRING",
	"PRODUCER_MASK" => $Producer,
	"MODEL_PHONE" => "STRING",
	"MODEL_PHONE_MASK" => $Model,
	"ARTICLE_HIDDEN" => "HIDDEN",
	"ARTICLE_HIDDEN_HIDDEN_VALUE" => $article,
	"PRODUCER_HIDDEN" => "HIDDEN",
	"PRODUCER_HIDDEN_HIDDEN_VALUE" => $Producer,
	"MODEL_PHONE_HIDDEN" => "HIDDEN",
	"MODEL_PHONE_HIDDEN_HIDDEN_VALUE" => $Model,
	"FIRST_NAME" => "STRING",
	"FIRST_NAME_MASK" => "",
	"CITY1" => "STRING",
	"CITY1_MASK" => "",
	"EMAIL" => "EMAIL",
	"PHONE_NUMBER" => "STRING",
	"PHONE_NUMBER_MASK" => "",
	"COMMENT" => "TEXTAREA",
	"STATUS_HIDDEN" => "HIDDEN",
	"STATUS_HIDDEN_HIDDEN_VALUE" => "41",
	"SAVE_TO_IBLOCK" => "Y",
	"IBLOCK_TYPE" => "auxiliary",
	"IBLOCK_ID" => "11",
	"FIELD_FOR_NAME" => "NUMBER",
	"FIELD_FOR_SECTION" => "0",
	"NUMBER_TO_IBLOCK" => "89",
	"ARTICLE_TO_IBLOCK" => "0",
	"PRODUCER_TO_IBLOCK" => "0",
	"MODEL_PHONE_TO_IBLOCK" => "0",
	"ARTICLE_HIDDEN_TO_IBLOCK" => "85",
	"PRODUCER_HIDDEN_TO_IBLOCK" => "82",
	"MODEL_PHONE_HIDDEN_TO_IBLOCK" => "83",
	"FIRST_NAME_TO_IBLOCK" => "78",
	"CITY1_TO_IBLOCK" => "88",
	"EMAIL_TO_IBLOCK" => "80",
	"PHONE_NUMBER_TO_IBLOCK" => "81",
	"COMMENT_TO_IBLOCK" => "PREVIEW_TEXT",
	"STATUS_HIDDEN_TO_IBLOCK" => "84",
	"SIGN" => "N"
	),
	false
);?>

	<?//$sTemplate2Result = ob_get_clean();
//$arResult['TEMPLATE_RESULT'] = str_replace("<component2></component2>", $sTemplate2Result, $arResult['TEMPLATE1_RESULT']);
//echo $arResult['TEMPLATE_RESULT'];
?>

</div>
<?//endif;
//$APPLICATION->SetAdditionalCSS('/bitrix/templates/.default/components/bitrix/iblock.vote/stars_new/style.css');
//$APPLICATION->AddHeadScript('/bitrix/templates/.default/components/bitrix/iblock.vote/stars_new/script.js');
?>