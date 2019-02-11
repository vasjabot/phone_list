<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

require_once('include_functions.php');

global $APPLICATION; global $USER; global $CurCatalogSection;
$arResult["RATING"] = array();
$cp = $this->__component; // объект компонента
//////////////млдефикация заголовков///////////
if (is_object($cp))
   $cp->SetResultCacheKeys(array('TIMESTAMP_X'));
//////////////////////////////////////////////
    foreach($arResult['ACTIVE'] as $s=>$arItem):
		$ItemId = $arItem["ID"];

		if ($arItem["PROPERTIES"]["USE_RATING"]["VALUE_XML_ID"] == "yes") 
		{
			$arResult["RATING"][$arItem["ID"]]["SHOW"] = true;
			$arResult["RATING"][$arItem["ID"]]["VOTE_RIGHTS"] = false;
			if ($USER->IsAuthorized()) 
			{
				$cnt = CSaleBasket::GetList(array(), array("!ORDER_ID" => null, "USER_ID" => $USER->GetID(), "PRODUCT_ID" => $ItemId), array());
				if ($cnt > 0) {
					$arResult["RATING"][$arItem["ID"]]["VOTE_RIGHTS"] = true;
				}
			}
		} else {
			$arResult["RATING"][$arItem["ID"]]["SHOW"] = false;
		}

        /*seo*/
		$i=0;
        foreach($arItem["DISPLAY_PROPERTIES"] as $pid => $pval):
            $i++;
            if($i==1) {$aprop = $pval["VALUE"];}
            if($i==2) {$mprop = $pval["VALUE"];}
            if($i==8) {$lprop = $pval["VALUE"];}
        endforeach;
        $catname = explode(' ', $arItem['NAME']);

	if (is_object($cp)){
	    $title = "";
	    $keywords = "";
	    $description = "";
		$array_of_devtypes = "";

		/*Имя телефона Производитель+Модель*/
		$Dev = ''; // - Производитель
		$Mod = ''; // - Модель
                        if($CurCatalogSection['DEPTH_LEVEL'] == 1)
                            $Dev = $CurCatalogSection['NAME'];
                        $Mod = htmlspecialchars($_REQUEST['ModelName']);
                        if($CurCatalogSection['DEPTH_LEVEL'] == 2 && strlen($Dev) <= 0)
                        {
                            $res = CIBlockSection::GetByID($CurCatalogSection['IBLOCK_SECTION_ID']);
                            if($ar_res = $res->GetNext())
                                $Dev =  $ar_res['NAME'];
                            $Mod = $CurCatalogSection['NAME'];
                            $My_ArSectionId = $CurCatalogSection['ID'];
                        }

//$title = "Аккумулятор для ".$Dev." ".$Mod." (".$mprop.")";


$res_inside = CIBlockSection::GetByID($arItem['IBLOCK_SECTION_ID']);

if($ar_res_inside = $res_inside->GetNext())
{
//echo '<pre>';
//print_r($arItem['ID']);
//echo '</pre>';
}

$res_iblock_id = CIBlockElement::GetIBlockByID($arItem['ID']);
//print_r($res_iblock_id); 

$ar_result_my_sec = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>$res_iblock_id, "ID"=>$ar_res_inside['ID']),true, Array("UF_BATTERYTYPE", "UF_DEVTYPE")); 

if($res_my_sec = $ar_result_my_sec->GetNext())
{
	//print_r($res_my_sec['UF_DEVTYPE']);
}



if($res_my_sec['UF_DEVTYPE'] === "PDA")
{
	$array_of_devtypes = "смартфон";
	$device_type_in_desc_1 = "со смартфоном";
	$device_type_in_desc_2 = "сматрфона";
	$flag_apply = TRUE;
}
else if($res_my_sec['UF_DEVTYPE'] === "MOBILE PHONES")
	{
		$array_of_devtypes = "телефон";
		$device_type_in_desc_1 = "с телефоном";
		$device_type_in_desc_2 = "телефона";
		$flag_apply = TRUE;
	}
	else if($res_my_sec['UF_DEVTYPE'] === "TABLET PC")
		{
			$array_of_devtypes = "планшет";
			$device_type_in_desc_1 = "с планшетом";
			$device_type_in_desc_2 = "планшета";
			$flag_apply = TRUE;
		}
		else if($res_my_sec['UF_DEVTYPE'] === "ROUTER")
			{
				$array_of_devtypes = "роутер";
				$device_type_in_desc_1 = "с роутером";
				$device_type_in_desc_2 = "роутера";
				$flag_apply = TRUE;
			}
				else
				{
					$array_of_devtypes = "устройств";
					$device_type_in_desc_1 = "с устройством";
					$device_type_in_desc_2 = "устройства";
					$flag_apply = FALSE;
				}

		//$title = "Аккумулятор для ".$array_of_devtypes."а ".$Dev." ".$Mod."";
		//$title = "Аккумулятор для ".$array_of_devtypes."а ".$Dev." ".$Mod." (".$res_my_sec['UF_BATTERYTYPE'].")";
		//$keywords = "аккумулятор для ".$Dev." ".$Mod.", купить, ".$mprop.", батарея, аккумулятор CRAFTMANN, АКБ,";
		//$keywords = "аккумулятор для ".$Dev." ".$Mod.", купить, ".$res_my_sec['UF_BATTERYTYPE'].", батарея, АКБ,";
		//$description = "Аккумуляторная батарея ".$mprop." производства CRAFTMANN для ".$Dev." ".$Mod.". Характеристики, гарантия, цена.";	
		//$description = "Аккумулятор ".$res_my_sec['UF_BATTERYTYPE']." производства Craftmann позаботится о стабильной и производительной работе ".$array_of_devtypes."а ".$Dev." ".$Mod.". Батарея ".$res_my_sec['UF_BATTERYTYPE']." для ".$array_of_devtypes."а ".$Dev." ".$Mod.". Купить мощную надёжную аккумуляторную батарею для ".$Dev." ".$Mod.".";
		$original_type = $res_my_sec['UF_BATTERYTYPE'];
		$device_type = $array_of_devtypes;
		$device_model = $Mod;
		$device_brand =  $Dev;
		$DEVICE = $device_brand . " " . $device_model;
		$desc_phase_1 = $device_type_in_desc_1 . " " . $DEVICE;
		$desc_phase_2 = $device_type_in_desc_2 . " " . $DEVICE;

		//$description = "Аккумулятор аналогичен штатной батарее питания ".$original_type." и полностью совместим ".$desc_phase_1.". Купить батарею для ".$device_model." за наличный и безналичный расчет. Бесплатная доставка АКБ ".$device_brand." по России оптом или при заказе оптом или из приложения."
		//."Аккумулятор ".$original_type." производства Craftmann позаботится о стабильной и производительной работе ".$desc_phase_2.". Батарея ".$original_type." для ".$device_type_in_desc_2.". Купить мощную надёжную аккумуляторную батарею для ".$DEVICE.".";

		//new update 22.01.2019
		if ($flag_apply)
		{
			$title = "Аккумулятор для ".$DEVICE." | Купить батарею совместимую ".$original_type."";
			$keywords = "купить аккумулятор ".$DEVICE." батарея батарейка АКБ ".$original_type."";
			$description = "Аккумулятор для ".$DEVICE." аналогичен штатной батарее питания ".$original_type.". Технические свойства аккумулятора соответствуют требованиям, определенным производителем ".$desc_phase_2.".";
		}
		else
		{
			$description = $arItem['UF_DESCRIPTION'];
		}
		//end of new update 22.01.2019

	    $cp->arResult['MY_TITLE'] = $title;
	    $cp->arResult['MY_KEYWORDS'] = $keywords;
	    $cp->arResult['MY_DESCRIPTION'] = $description;
		$cp->arResult['MY_ARDEV'] = $array_of_devtypes;
	    $cp->arResult['IS_OBJECT'] = 'Y';
	    $cp->arResult['IS_OBJECT_K'] = 'Y';
	    $cp->arResult['IS_OBJECT_D'] = 'Y';
	    $cp->SetResultCacheKeys(array('MY_TITLE','IS_OBJECT'));
	    $cp->SetResultCacheKeys(array('MY_KEYWORDS','IS_OBJECT_K'));
		$cp->SetResultCacheKeys(array('MY_DESCRIPTION','IS_OBJECT_D'));

	    if (!isset($arResult['MY_TITLE'])){
	        $arResult['MY_TITLE'] = $cp->arResult['MY_TITLE'];
	        $arResult['IS_OBJECT'] = $cp->arResult['IS_OBJECT'];
	    }
	    if (!isset($arResult['MY_KEYWORDS'])){
	        $arResult['MY_KEYWORDS'] = $cp->arResult['MY_KEYWORDS'];
	        $arResult['IS_OBJECT_K'] = $cp->arResult['IS_OBJECT_K'];
	    }
	    if (!isset($arResult['MY_DESCRIPTION'])){
			$arResult['MY_DESCRIPTION'] = $cp->arResult['MY_DESCRIPTION'];
			$arResult['IS_OBJECT_D'] = $cp->arResult['IS_OBJECT_D'];
	    }
		if (!isset($arResult['MY_ARDEV'])){
			$arResult['MY_ARDEV'] = $cp->arResult['MY_ARDEV'];
	    }
	}    
        /*seo*/
	endforeach;
	?>
<?
$arResult["IS_CRAFTMANN"] = false;
//Определение того, является ли страница разделом универсального аккумулятора Craftmann
foreach ($arResult['ITEMS'] as $arItem)
{
	$nav = CIBlockSection::GetNavChain(
		false, 
		$arItem['IBLOCK_SECTION_ID'], 
		array('ID', 'IBLOCK_SECTION_ID', 'CODE')
	);
	if ($ar_nav = $nav->Fetch())
	{
		if($ar_nav['CODE'] == 'craftmann')
		{
			$arResult["IS_CRAFTMANN"] = true;
			//$APPLICATION->SetPageProperty("description", $arResult['UF_DESCRIPTION']);
			break;
		}
	}
	
}


if ($arResult["IS_CRAFTMANN"]) 
{
    $arResult["PREFIX"] = getCraftmannPrefix();
    $arResult["CRAFTMANN_MAIN_PROPERTIES"] = getCraftmannMainProperties();
    $arResult["CRAFTMANN_ALL_PROPERTIES"] = getCraftmanAllProperties();
    $APPLICATION->SetPageProperty("title", $arResult['~UF_TITLE']);
	$APPLICATION->SetPageProperty("description", $arResult['UF_DESCRIPTION']);
    $APPLICATION->SetPageProperty("keywords", $arResult['~UF_KEYWORDS']);
}



$arResult["SHOW_BRAND_MODEL_IN_DESCRIPTION"] = (($arParams["SHOW_BRAND_MODEL_IN_DESCRIPTION"] == "Y") && !$arResult["IS_CRAFTMANN"]);
$arResult["TABS_PARAMETERS"] = ($arResult["IS_CRAFTMANN"]) ? array("SHOW_ONLY_WARRANTY" => "Y") : array("PARAMS" => "NO_PARAMS");
if ($arResult["IS_CRAFTMANN"]) 
{//Проверка прав на выставление рейтинга
	# code...
	$arResult["HAS_VOTE_RIGHTS"] = false;
	global $USER;
	if ($USER->IsAuthorized()) 
	{
		$cnt = CSaleBasket::GetList(array(), array("!ORDER_ID" => null, "USER_ID" => $USER->GetID(), "PRODUCT_ID" => $ItemId), array());
		$arResult["HAS_VOTE_RIGHTS"] = false;
		if ($cnt > 0) {
			$arResult["HAS_VOTE_RIGHTS"] = true;
		}
	}
}
?>
