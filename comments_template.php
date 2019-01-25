<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><style type="text/css">
    div.instore { color: #007240; font-family: Arial; margin-top: 10px; }
    div.instore i { display: block; background: url('/images/pm.png'); width: 26px; height: 26px; float: left; margin-right: 5px; position: relative; top: -5px; }
    div.instore div.plus i { background-position:0 0; }
    div.instore div.pminus i,    div.instore div.minus i { background-position:-25px 0; }
    .hidden { display: none; }
    .font12, .font12 p, .font12 p font {
        font-size: 12px;
    }
</style>

<?if($arResult['ITEMS']):?>
<?
$isCraftmann = $arResult["IS_CRAFTMANN"];
if ($isCraftmann) {
	$Prefix = "Универсальный внешний аккумулятор" . " ";
	$CraftmanMainProperties = array('CAPACITY', 'WARRANTY', 'COLOR_UNIVERSAL', 'ARTICLE', 'COMPLECT');
	$CraftmanAllProperties = array(
		'ARTICLE', 
		'CAPACITY',
		'POWER',
		'VOLTAGE',
		'CURRENT',
		'CAPACITY_COEFF',
		'COLOR_UNIVERSAL',
		'WEIGHT',
		'SIZE',
		'MATERIAL',
		'TYPE',
		'CERTIFICATION',
		'WARRANTY',
		'COMPLECT',
		'SERIES',
		'EAN_13',
		'DISCONTINUED'
	);
    $APPLICATION->SetPageProperty("title", $arResult['~UF_TITLE']);
$APPLICATION->SetPageProperty("description", $arResult['~UF_DESCRIPTION']);
$APPLICATION->SetPageProperty("keywords", $arResult['~UF_KEYWORDS']);
}
else {
$Prefix = "Аккумулятор для" . " ";
}
?>

<?/*
    global $arPreviewSizes, $arPreviewSectionSizes, $ShowPropInTable, $APPLICATION;
    $FirstSize = $arPreviewSizes['PREVIEW_PICTURES_1']['arSizes'];
    $SecondSize = $arPreviewSizes['PREVIEW_PICTURES_2']['arSizes'];
    $SectionSize = $arPreviewSectionSizes['DETAIL_PICTURES']['arSizes'];
*/?>

<?
global $USER;
$arGroups1 = $USER->GetUserGroupArray();
if($isCraftmann){$cursb=file_get_contents($_SERVER['DOCUMENT_ROOT']."/inc/banner_switcher_c.php");}else{
$cursb=file_get_contents($_SERVER['DOCUMENT_ROOT']."/inc/banner_switcher.php");
}
if((in_array(1,$arGroups1)||in_array(10,$arGroups1))){
	if($_POST['submit_bsettings']){
		if($isCraftmann){
			file_put_contents($_SERVER['DOCUMENT_ROOT']."/inc/banner_switcher_c.php", $_POST['showbanner']);
		}else{file_put_contents($_SERVER['DOCUMENT_ROOT']."/inc/banner_switcher.php", $_POST['showbanner']);}
		$cursb=$_POST['showbanner'];
	}	
	?>
	<form method="post">
	Показывать баннер (<a href="http://www.craftmann.ru/bitrix/admin/fileman_admin.php?PAGEN_1=1&SIZEN_1=20&lang=ru&site=s1&path=%2Fupload%2Fcatalog_banners&show_perms_for=0&" target="_blank">/upload/catalog_banners/<?=($isCraftmann?"craftmann_promo_2.png":"craftmann_promo_1.png")?></a>)<br/><br/><input type="checkbox" name="showbanner" value="1" <?=($cursb==1?"checked":"")?> />
	<input type="submit" name="submit_bsettings" value="сохранить">
	</form>
	<?
}
?>

<div id="Detail">
<?
    $AccI = -1;
    foreach($arResult['ACTIVE'] as $k=>$arItem):
$AccI++;
?>

<div class="Acc" style="padding-bottom: 20px;">

<div>
<div itemscope itemtype="http://schema.org/Product" class="DetailDescription">
    <a name="M<?=$arItem['ID']?>"></a>
    <?if(!$AccI):?><h1 itemprop="name" class="no_print"><?else:?><h2 itemprop="name" class="no_print h1"><?endif;?><?=$Prefix?><?=$arItem['NAME']?><?if(!$AccI):?></h1><?else:?></h2><?endif;?>
<div style="margin-bottom: 30px;margin-top:-25px">
	<?if ($isCraftmann): ?>
            <div itemprop="description" class="visual-wrapper"><?=$arItem["PROPERTIES"]["UNI_TOP_BLOCK"]["~VALUE"]["TEXT"]?></div>
<?else:?>
	<div itemprop="description" style="color:#000"><?=$arItem["DETAIL_TEXT"]?><br /></div>
	<div itemprop="description" style="color:#000">Аккумулятор <span itemprop="brand">CRAFTMANN</span> аналогичен штатному элементу питания (<span itemprop="model"><?=$arItem["DISPLAY_PROPERTIES"]["ORIGINAL_CODE"]["VALUE"]?></span>) и полностью совместим с <?=$arItem['NAME']?>. В комплект поставки входят: <?=$arItem["DISPLAY_PROPERTIES"]['COMPLECT']["VALUE"]?>.<br/>
		<?/*$APPLICATION->IncludeFile("/inc/battery_promo_desc.php", 
                    array(), 
                    array(
                        "MODE" => "html",                            // будет редактировать в веб-редакторе
                        "NAME" => "Промо описание батареи",          // текст всплывающей подсказки на иконке
                        "TEMPLATE" => "section_include_template.php" // имя шаблона для нового файла
                    )
);*/?>
		<?/*if ($arResult["SHOW_BRAND_MODEL_IN_DESCRIPTION"]): */?>
		<?/*$APPLICATION->IncludeFile("/inc/battery_model_style.php", 
                        array(
                            "TEXT" => $arItem["NAME"]
                        ), 
                        array(
                            "MODE" => "php",                            // будет редактировать в веб-редакторе
                            "NAME" => "Вывод модели и производителя",          // текст всплывающей подсказки на иконке
                            "TEMPLATE" => "section_include_template.php" // имя шаблона для нового файла
                        )
);*/?> 
		<?/*endif;*/?>  
                <?$APPLICATION->IncludeFile("/inc/battery_promo_desc2.php", 
                    array(), 
                    array(
                        "MODE" => "html",                            // будет редактировать в веб-редакторе
                        "NAME" => "Промо описание батареи, продолжение",          // текст всплывающей подсказки на иконке
                        "TEMPLATE" => "section_include_template.php" // имя шаблона для нового файла
                    )
                );?> 
            </div>
        <?endif;?>
	</div>
    <?if (!$isCraftmann&&0): ?>
    <div id="DMainFeature"><?=ShowIImage('/images/light_change.gif')?></div>
    <?endif;?>
	<?if ($arResult["RATING"][$arItem["ID"]][SHOW]): ?>
        <!--Голосование за рейтинг-->
	<?$APPLICATION->IncludeComponent(
	"bitrix:iblock.vote", 
	"stars_new", 
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "2",
		"ELEMENT_ID" => $arItem["ID"],
		"MAX_VOTE" => "5",
		"VOTE_NAMES" => array(
			0 => "0",
			1 => "1",
			2 => "2",
			3 => "3",
			4 => "4",
			5 => "5",
			6 => "",
		),
		"SET_STATUS_404" => "N",
		"DISPLAY_AS_RATING" => "vote_avg",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "3600",
		"READ_ONLY" => ($arResult["RATING"][$arItem["ID"]]["VOTE_RIGHTS"])?"N":"Y",
		"ELEMENT_CODE" => $_REQUEST["code"],
		"COMPONENT_TEMPLATE" => "stars_new",
		"MESSAGE_404" => ""
	),
	false
);?>
      <?endif;?>
    <?if(strlen($arItem['PROPERTIES']['PRICE']['VALUE']) > 0):?>

    <style type="text/css">.BuyAreaBlock {  }</style>
    
    <div itemprop="offers" itemscope itemtype="http://schema.org/Offer" id="DBuyArea" style="background-color:#dfefff; padding:12px 18px 15px 18px;margin-bottom:15px; position:relative;">
<?
# -------------- ПОДКЛЮЧЕНИЕ ФОРМЫ - УЗНАТЬ О НАЧАЛЕ ПРОДАЖ ---------------

global $USER, $APPLICATION, $CurCatalogSection;
// if($USER->GetID()==7):

$article = $arItem["PROPERTIES"]["ARTICLE"]["VALUE"];

?>

<div id="request<?=$arItem['ID']?>" class="hidden">

    <div class="RequestForm" style="width:430px; top: 0; left: -2px;">
        <div class="big_star_block form-style">
            <div class="cn tl"></div>
            <div class="cn tr"><a onclick="$(this).parent().parent().parent().parent().hide(); return false;" class="complaint_close" style="position: relative;top:10px;right:10px;text-decoration: none;" href="#">X</a></div>
            <div class="content">
                <div class="content form-content">

                    <?$Producer = '';
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
                    $NUMBER = 0
                    ?>

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
                    "FIELD_FOR_NAME" => "EMAIL",
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

                    <!--component2></component2-->

                </div>
            </div>
            <div class="cn bl"></div>
            <div class="cn br"></div>
        </div>
    </div>

</div>

<? //endif;
# -------------- /ПОДКЛЮЧЕНИЕ ФОРМЫ - УЗНАТЬ О НАЧАЛЕ ПРОДАЖ ---------------
?>
    <!-- <div id="buynone<?=$arItem["ID"];?>" class="buynone"></div> -->
    <?
# -------------- НАЛИЧИЕ - 1 часть ---------------
$nal = $arItem['PROPERTIES']['STORE']['VALUE'];

	if($nal == 'в наличии'||$nal == 'есть')
	{
		$class = 'plus';
		$text = 'В наличии';
	}
	else if($nal == 'планируется'||$nal=='скоро')
	{
		$class = 'pminus';
		$text = 'Ожидается, подробнее у Консультанта';
	}
	else 
	{
		$class = 'minus';
		$text = 'Планируется, подробнее у Консультанта';
	}
# -------------- /НАЛИЧИЕ - 1 часть ---------------
?>
    <div id="buyone<?=$arItem["ID"];?>" <?=($class=='minus'?'class="hidden"':'')?>>
    <a class="Btn" <?=((time()>strtotime("28.12.14 15:00:00")||$USER->GetID()=="7")&&0?" href=\"/personal/cart/new_year/\" target=\"_blank\"":"href=\"javascript: void(0);\" onclick=\"$.post('/accumulators/basket_add.php', {q: $(this).attr('data-quantity'), pid: $(this).attr('data-item')}, function() { document.location.href='/personal/cart/'; });\" ")?>" id="item<?=$arItem["ID"]?>" data-item="<?=$arItem["ID"]?>" data-quantity="1">ДОБАВИТЬ В КОРЗИНУ&nbsp;&nbsp;&nbsp;<span style="position: absolute; margin-top: -1px;"><img src="/images/rightArr.png" alt="" /></span></a>
</div>
<?# -------------- ЕСЛИ НЕТ ТОВАРА, ВЫВОДИМ ССЫЛКУ НА ФОРМУ ---------------?>
<div id="buynone<?=$arItem["ID"];?>"  <?=($class=='minus'?'':'class="hidden"')?>>
<a class="Btn disabled" href="javascript: void(0);" id="item<?=$arItem["ID"]?>" onclick="$('#request<?=$arItem["ID"]?>').show();">Узнать о начале продаж</a>
</div>
<div id="buyabsnone<?=$arItem["ID"];?>"  class="hidden">
<a class="Btn absdisabled" href="javascript: void(0);" id="item<?=$arItem["ID"]?>">Нет в продаже</a>
</div>


<div id="DPrice" style="color: #000000 !important;"><span  itemprop="price" class="DAmmount"><?=$arItem['PROPERTIES']['PRICE']['VALUE']?></span> <span class="DCurrency" style="font-size: 20px; padding-top: 10px;"><?if(0){?><?}?><img src="/bitrix/templates/.default/components/individ/phone.list/.default/images/ruble.png" style="border:0px"><span  itemprop="priceCurrency" class="ruble" style="opacity: 0;"></span></span><div class="DSub">Цена производителя</div></div>
<div class="clear"></div>

<?php
global $USER;
# -------------- НАЛИЧИЕ 2 часть ---------------

//include($_SERVER['DOCUMENT_ROOT']."/inc/request-form.php?article=".$Article."&marka=".$Producer."&model=".$Model);


//include('/inc/request-form.php');

$sARTICLE = '';

$sARTICLE = $arItem['PROPERTIES']['ARTICLE']['VALUE'];
?>

<script type="text/javascript">
    $(document).ready(function() {
        //Подключаем сервис проверки наличия:
        $.post('/inc/availability.php', { ARTICLE:'<?=$sARTICLE;?>' }, function(text) { if(text != '') { $('#<?=$arItem["ID"];?>').fadeOut('fast'); $('#<?=$arItem["ID"];?>').html(text); $('#<?=$arItem["ID"];?>').fadeIn('slow');
            if($('#<?=$arItem["ID"]?>').find('div').hasClass('minus')&&$('#<?=$arItem["ID"]?>').find('div').hasClass('abs')){  $('#buyone<?=$arItem["ID"];?>').hide();$('#buynone<?=$arItem["ID"];?>').hide();$('#buyabsnone<?=$arItem["ID"];?>').show();}else if($('#<?=$arItem["ID"]?>').find('div').hasClass('minus')){ $('#buyone<?=$arItem["ID"];?>').hide(); $('#buynone<?=$arItem["ID"];?>').show(); $('#buyabsnone<?=$arItem["ID"];?>').hide();}else{$('#buyone<?=$arItem["ID"];?>').show(); $('#buynone<?=$arItem["ID"];?>').hide();$('#buyabsnone<?=$arItem["ID"];?>').hide();}
}
});
});
</script>
<!--
<a href="javascript: void(0)" onclick="$.post('/inc/availability.php', { ARTICLE:'<?=$sARTICLE;?>' }, function(text) { /*alert(text);*/ $('.instore').html(text); });">Обновить</a>
-->

<?
echo '<div itemprop="availability" id="'.$arItem["ID"].'" class="instore"><div class="'.$class.'">'.$text.'</div></div>';

//endif;
# -------------- /НАЛИЧИЕ 2 часть ---------------
//if($USER->GetID()=="7"):

# -------------- ДОСТАВКА ---------------
//        echo "<p><strong>Доставка</strong><br>";
//echo "<p>";
CModule::IncludeModule("sale");

$db_dtype = CSaleDelivery::GetList(
        array(
                "SORT" => "ASC",
        "NAME" => "ASC"

),
array(
        "LID" => SITE_ID,
        "ACTIVE" => "Y"
),
false,
        false,
        array()
);
if ($ar_dtype = $db_dtype->Fetch())
{
    //echo "Вам доступны следующие способы доставки:<br>";
/*
    do
    {
        if($ar_dtype["ID"]!="4"&&$ar_dtype["ID"]!="5"&&$ar_dtype["ID"]!="6"&&$ar_dtype["ID"]!="7"):
        ?>
    <?=$ar_dtype["NAME"] . " ";?>
    <?if($ar_dtype["PERIOD_TO"] > 3):?>
    <?=($ar_dtype["PERIOD_FROM"] > 0 ? $ar_dtype["PERIOD_FROM"] : '') . ($ar_dtype["PERIOD_TO"] > 0 ? '-' . $ar_dtype["PERIOD_TO"] . ' дней' : '')?>
    <?endif?>
    <?=' - ' . ($ar_dtype["PRICE"] > 0 ? CurrencyFormat($ar_dtype["PRICE"], $ar_dtype["CURRENCY"]) . '.' : 'бесплатно' ) . '<br>';?>
    <?
        //echo $ar_dtype["NAME"]." - стоимость ".CurrencyFormat($ar_dtype["PRICE"], $ar_dtype["CURRENCY"])."<br>";
            endif;
    }
    while ($ar_dtype = $db_dtype->Fetch());
*/
}
else
{
    echo "Доступных способов доставки не найдено<br>";
}

# -------------- /ДОСТАВКА ---------------
        ?>
    <div class="font12">
        <?$APPLICATION->IncludeFile("/inc/work_time.php", Array(), Array(
                        "MODE"      => "html",                                           // будет редактировать в веб-редакторе
                "NAME"      => "Оплата и Время работы",      // текст всплывающей подсказки на иконке
                "TEMPLATE"  => "section_include_template.php"                    // имя шаблона для нового файла
        ));?>
    </div>
</div>
<?endif;?>
<?
        $BUrl = $APPLICATION->GetCurPageParam('ACTION=ADD&ElSc='.$arItem['ID'].'.'.$arItem['IBLOCK_SECTION_ID'],array('ACTION', 'ElSc'));
?>
<div class="clear"></div>
<?
//echo "<pre>"; print_r($arItem); echo "</pre>";
//$detailNewField = $arItem["DETAIL_TEXT"];
?>
<?if(1 == 2):?>
    <div class="choose"><div class="block_left"><a href="?" class="active">Основные характеристики</a></div> <div class="block_right"><a class="OtherProp" href="?" onclick="_gaq.push(['_trackPageview', '/virtual/detail']);
	yaCounter9291454.reachGoal('detail');
	return true;">Подробно</a></div><div class="clear"></div></div>
    <table class="DProp">
        <?if ($isCraftmann): //Свойства для Craftmann?>
        <?foreach ($CraftmanAllProperties as $propertyCode):
                    $arrPropertyValue = $arItem["PROPERTIES"][$propertyCode];
                ?>
        <tr <?if (!in_array($propertyCode, $CraftmanMainProperties)): ?>class="DHidePropTr"<?endif;?>>
        <td class="DNameTD">
            <div class="DName"><?=$arrPropertyValue['NAME']?></div>
            <div class="Dsep"></div>
        </td>
        <td class="DValueTD"><?=$arrPropertyValue['VALUE']?></td>
        </tr>
        <?endforeach;?>
        <?else://Свойства для остальных разделов?>
        <?$p = 0;
				foreach($arItem["DISPLAY_PROPERTIES"] as $pid => $pval):
        if(!in_array($pid, $ShowPropInTable))
        $TrClass = 'DHidePropTr';
        else
        $TrClass = '';
        ?>
        <tr class="<?=$TrClass?>">
            <td class="DNameTD"><div class="DName"><?=$pval['NAME']?></div><div class="Dsep"></div></td>
            <td class="DValueTD"><?=$pval['DISPLAY_VALUE']?></td>
        </tr>
        <?if($p==11):?>
        <tr class="DHidePropTr">
            <td class="DNameTD"><div class="DName"><?=$arItem["PROPERTIES"]["EAN_13"]["NAME"]?></div><div class="Dsep"></div></td>
            <td class="DValueTD"><?=$arItem["PROPERTIES"]["EAN_13"]["VALUE"]?></td>
        </tr>
        <?endif;?>
        <?$p++;?>
        <?endforeach;?>
        <?endif;?>
    </table>
<?endif;?>

<br />
<div style="width:100%">
<div style="float:right;padding-top:4px"><a href="/reviews/"  target="_blank">Все отзывы</a></div>
<h2 style="margin:0;display: block;color: #1f1f1f;font-size: 17px;text-decoration: none;font-weight:bold;">Отзыв о магазине</h2>
<?$APPLICATION->IncludeComponent(
	"webdebug:reviews2.list", 
	"template_for_goods", 
	array(
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "28000",
		"INTERFACE_ID" => "1",
		"TARGET" => "SHOP_REVIEWS",
		"COUNT" => "5",
		"SORT_BY_1" => "DATE_MODIFIED",
		"SORT_ORDER_1" => "DESC",
		"SORT_BY_2" => "ID",
		"SORT_ORDER_2" => "DESC",
		"FILTER_NAME" => "",
		"DATE_FORMAT" => "d.m.Y",
		"SHOW_AVATARS" => "Y",
		"SHOW_ANSWERS" => "Y",
		"SHOW_ANSWER_DATE" => "Y",
		"USER_ANSWER_NAME" => "#NAME# #LAST_NAME#",
		"SHOW_ANSWER_AVATAR" => "Y",
		"ALLOW_VOTE" => "Y",
		"MANUAL_CSS_INCLUDE" => "Y",
		"AUTO_LOADING" => "Y",
		"SHOW_ALL_IF_ADMIN" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Отзывы",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"TARGET_SUFFIX" => "",
		"COMPONENT_TEMPLATE" => "template_for_goods"
	),
	false
);?>
</div>
<div class="clear"></div>
	<?if ($isCraftmann): ?>
        <div class="visual-wrapper"><?=$arItem["PROPERTIES"]["UNI_BOTTOM_BLOCK"]["~VALUE"]["TEXT"];?></div>
	<?endif;?>
<?

        $FirstPic = $arItem['PICTURES'][0];
        $ar_result=CIBlockSection::GetList(Array(), Array("IBLOCK_ID"=>"2", "ID"=>$arResult["ID"]),false, Array("UF_ALT"));
    $res = $ar_result->GetNext();
    if ($isCraftmann)
    {
    $imgalt = $imgtitle = $arResult['~UF_ALT'];
    } else
    {
    //$imgalt = $Prefix . strtolower($arItem['NAME']) .' производства CRAFTMANN';
    $catname = explode(' ', $arItem['NAME']);
    $imgalt = 'CRAFTMANN '.$arItem["PROPERTIES"]["ARTICLE"]["VALUE"].' - Батарея для '.$catname[0].' '.strtolower($arItem['NAME']).' ('.$arItem["PROPERTIES"]["ORIGINAL_CODE"]["VALUE"].')';
    $imgtitle = 'Аккумулятор для '.strtolower($arItem['NAME']);
    }
    ?>
<img src="<?=$FirstPic['BIG']['SRC']?>" itemprop="image" class="for_print"/>
	<div class="clear"></div>
<!--<div class="DShare">
<div class="DShareLong">
	<?/*$APPLICATION->IncludeFile('/inc/share2.php');*/?>
</div>
<div class="DAddNotepad">
	<?/*$APPLICATION->IncludeFile('/inc/share.php');*/?>
<div class="clear"></div>
</div>
<div id="hid666" style="display:none">
</div>
<div class="clear"></div>
<?/*if($arItem['SUGGEST']):*/?>
<div class="DSuggest">

<div class="hint_block">
<div class="hint_star_block">
<div class="cn tl"></div>
<div class="cn tr"></div>
<div class="content">
<div class="content">
<div class="content">
<?/*=$arItem['SUGGEST']['PREVIEW_TEXT']*/?>
</div>
</div>
</div>
<div class="cn bl"></div>
<div class="cn br"></div>
</div>
</div>
<a href="?" class="DIcons2"></a>
<a href="?" class="Suggest"><?/*=$arItem['SUGGEST']['NAME']*/?></a>
</div>
<?/*endif;*/?>
</div>-->
<div class="clear"></div>
</div>

<?
//echo "<pre>"; print_r($arItem); echo "</pre>";
?>

<?
$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
$arSelect = Array("PROPERTY_PHONE_IMG");
$arFilter = Array("IBLOCK_ID"=>2, "ID"=>$arItem["ID"]);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($ob = $res->GetNextElement())
{
$arFields = $ob->GetFields();
$img_path = CFile::GetPath($arFields["PROPERTY_PHONE_IMG_VALUE"]);
}
?>

<div class="DetailPictureList">
    <?if(!$AccI):?><h1 class="for_print"><?else:?><h2 class="for_print h1"><?endif;?>  <span><?=$arItem['NAME']?></span><?=(0 && $AccI > 0 && strlen($arItem['PROPERTIES']['ORIGINAL_CODE']['VALUE']) >0 ? ' ('.$arItem['PROPERTIES']['ORIGINAL_CODE']['VALUE'].')' : '')?><?if(!$AccI):?></h1><?else:?></h2><?endif;?>
	<?if($arItem['PICTURES']):?>
    <?

	$FirstPic = $arItem['PICTURES'][0];
        $ar_result=CIBlockSection::GetList(Array(), Array("IBLOCK_ID"=>"2", "ID"=>$arResult["ID"]),false, Array("UF_ALT"));
    $res = $ar_result->GetNext();
    if ($isCraftmann)
    {
    $imgalt = $imgtitle = $arResult['~UF_ALT'];
    } else
    {
    //$imgalt = $Prefix . strtolower($arItem['NAME']) .' производства CRAFTMANN';
    $catname = explode(' ', $arItem['NAME']);
    $imgalt = 'CRAFTMANN '.$arItem["PROPERTIES"]["ARTICLE"]["VALUE"].' - Батарея для '.$catname[0].' '.strtolower($arItem['NAME']).' ('.$arItem["PROPERTIES"]["ORIGINAL_CODE"]["VALUE"].')';
    $imgtitle = 'Аккумулятор для '.strtolower($arItem['NAME']);
    }
    ?>
    <div class="DetailPictureBlock">

        <div class="DetailPicture no_print">
            <?
            $statusPicture = false;
            if (!empty($arItem["PROPERTIES"]["STATUS"]["VALUE"])){
		$statusPicture = strtolower($arItem["PROPERTIES"]["STATUS"]["VALUE"]).'.png';
		if($statusPicture=='new.png'){$statusPictureAlt='Новая модель CRAFTMANN';}elseif($statusPicture=='pop.png'){$statusPictureAlt='Популярная модель CRAFTMANN';}elseif($statusPicture=='hit.png'){$statusPictureAlt='Лидер продаж CRAFTMANN';}else{$statusPictureAlt='Выбор профессионалов CRAFTMANN';}
            }else{
		$statusPicture = 'prof.png';
		$statusPictureAlt='Выбор профессионалов CRAFTMANN';
	    }
//$statusPicturePath = $templateFolder . "/images/" . $statusPicture;
$statusPicturePath = "/upload/catalog_banners/" . $statusPicture;
?>

            <?if($statusPicture):?>
                <img id="status_<?=$arItem['ID']?>" width="210px" height="30px" style="margin-bottom: -124px;position: absolute;z-index: 10;left:233px;" src="<?=$statusPicturePath?>" alt="<?=$statusPictureAlt?>" />
            <?endif;?>
            <a onclick="_gaq.push(['_trackPageview', '/virtual/click_image']); yaCounter9291454.reachGoal('click_image'); return true;" href="<?=$FirstPic['BIG']['SRC']?>" rel="0" id="toprp_<?=$arItem['ID']?>" class="AccPic ">
                <?/*=ShowIImage($FirstPic['MEDIUM'], $FirstSize['width'], $FirstSize['height'], $res["UF_ALT"])*/?>

                <img src="<?=$FirstPic['MEDIUM']['SRC']?>" alt="<?=$imgalt?>" title="<?=$imgtitle?>" width="<?=$FirstSize['width']?>" height="<?=$FirstSize['height']?>" style="max-width: 420px;" />
            </a><!-- 298x391 -->
            <?/*$FirstPic['MEDIUM']
$img_path = $img_path?$img_path:$FirstPic['MEDIUM'];*/
                ?>
            <?/*if($arResult['DETAIL_PICTURE']):?>
            <?=ShowIImage($arResult['DETAIL_PICTURE'], $SectionSize['width'], $SectionSize['height'], $res["UF_ALT"], "class=PhonePic", "")?>
            <?endif;*/?>
            <?
                $talt = $arItem['NAME'];
                $ttitle = $arItem['NAME'];
                ?>
				<?
				if($cursb==1){
				?>
            <img  src="/upload/catalog_banners/<?=($isCraftmann?"craftmann_promo_2.png":"craftmann_promo_1.png")?>" alt="CRAFTMANN - Заряжает положительно!" width="210px" height="70px" style="margin-bottom: -124px;margin-top: 35px;position: absolute;left:233px;"/>
				<?}?>
            <?if($arFields["PROPERTY_PHONE_IMG_VALUE"]):?>
            <?$file = CFile::ResizeImageGet($arFields["PROPERTY_PHONE_IMG_VALUE"], array('width'=>70, 'height'=>100), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
            <?/*=ShowIImage($img_path, $SectionSize['width'], $SectionSize['height'], $res["UF_ALT"], "class=PhonePic", "")*/?>
            <img src="<?=$img_path?>" width="<?=$file['width']//$SectionSize['width']?>" height="<?=$file['height']//$SectionSize['height']?>" alt="<?=$talt?>" title="<?=$ttitle?>" class="PhonePic" style="max-height: 100px;max-width: 70px;"/>		
			<?elseif($arResult['DETAIL_PICTURE']):?>
            <?/*=ShowIImage($arResult['DETAIL_PICTURE'], $SectionSize['width'], $SectionSize['height'], $res["UF_ALT"], "class=PhonePic", "")*/
                $img_p = CFile::GetPath($arResult['DETAIL_PICTURE']);
                ?>
            <img src="<?=$img_p?>" width="<?=$SectionSize['width']?>" height="<?=$SectionSize['height']?>" alt="<?=$talt?>" title="<?=$ttitle?>" class="PhonePic" style="max-height: 100px;max-width: 70px;"/>
			<?endif;?>
            <div class="clear"></div>
        </div>
        <?if(count($arItem['PICTURES'])>4):?>
        <button class="prev no_print" id="prev<?=$arItem['ID']?>"></button>
        <button class="next no_print" id="next<?=$arItem['ID']?>"></button>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#OtherPictures_<?=$arItem['ID']?>").jCarouselLite({
                    btnNext: "#next<?=$arItem['ID']?>",
                    btnPrev: "#prev<?=$arItem['ID']?>",
                    visible: 4
                });
            });
        </script>
        <?endif;?>
        <div id="OtherPictures_<?=$arItem['ID']?>" class="OtherPictures no_print">
            <ul>
                <?
                    $PicI = -1;
                    $hrefs = array();
                    foreach($arItem['PICTURES'] as $arPicture):
                        $PicI++;
                        $PiCClass = ($PicI == 0) ? 'toprp current' : 'toprp';
                        $hrefs[] = '<a class="' . $PiCClass . '" id="toprp_'.$arItem['ID'].'_'.$PicI.'" href="'.$arPicture['BIG']['SRC'].'" rel="prettyPhoto['.$arItem['ID'].']"></a>';
                ?>
                <li>
                    <a class="c" href="<?=$arPicture['BIG']['SRC']?>"  rev="Index:'<?=$PicI?>', Mhref:'<?=$arPicture['MEDIUM']['SRC']?>', Mwidth:'420', Mheight:'400'">
						<!--<img <?/*if ($PicI == 0): ?>class="current"<?endif;?> src="<?=$arPicture['MEDIUM']['SRC']?>" width="59" height="53" alt="<?=$imgalt?>" title="<?=$imgtitle*/?>" />-->
						<span style="width:59px; height:53px; background-image:url('<?=$arPicture['SMALL']['SRC']?>');  background-size:100%; display: inline-block;">&nbsp;</span>
                   </a>
                </li>
                <?
                    endforeach;
                    ?>
            </ul><?=implode("\n", $hrefs);?>
        </div>
    </div>
    <?endif;?>
    <div class="DetailDescription" style="width: 470px; padding: 15px 0; padding-top: 40px; float: none;">
    <div class="choose"><div class="block_left"><a href="?" class="active">Основные характеристики</a></div> <div class="block_right"><a class="OtherProp" href="?" onclick="_gaq.push(['_trackPageview', '/virtual/detail']);
	yaCounter9291454.reachGoal('detail');
	return true;">Подробно</a></div><div class="clear"></div></div>

<?
//echo "<pre>"; print_r($arItem["DISPLAY_PROPERTIES"]); echo "</pre>";
//echo "<pre>"; print_r($ShowPropInTable); echo "</pre>";
$ShowPropInTable = Array("ARTICLE", "CAPACITY", "ORIGINAL_CODE", "CERTIFICATION", "WARRANTY");

?>
    <table class="DProp">
        <?if ($isCraftmann): //Свойства для Craftmann?>
        <?foreach ($CraftmanAllProperties as $propertyCode):
                    $arrPropertyValue = $arItem["PROPERTIES"][$propertyCode];
                ?>
        <tr <?if (!in_array($propertyCode, $CraftmanMainProperties)): ?>class="DHidePropTr"<?endif;?>>
        <td class="DNameTD">
            <div class="DName"><?=$arrPropertyValue['NAME']?></div>
            <div class="Dsep"></div>
        </td>
        <td class="DValueTD"><?=$arrPropertyValue['VALUE']?></td>
        </tr>
        <?endforeach;?>
        <?else://Свойства для остальных разделов?>
<?
$TrClass = '';
?>

        <tr class="<?=$TrClass?>">
            <td class="DNameTD"><div class="DName">Емкость (mAh)</div><div class="Dsep"></div></td>
            <td class="DValueTD"><?=$arItem["DISPLAY_PROPERTIES"]["CAPACITY"]["VALUE"]?></td>
        </tr>
        <tr class="<?=$TrClass?>">
            <td class="DNameTD"><div class="DName">Оригинальный код</div><div class="Dsep"></div></td>
            <td class="DValueTD"><?=$arItem["DISPLAY_PROPERTIES"]["ORIGINAL_CODE"]["VALUE"]?></td>
        </tr>
        <tr class="<?=$TrClass?>">
            <td class="DNameTD"><div class="DName">Сертификация</div><div class="Dsep"></div></td>
            <td class="DValueTD"><?=$arItem["DISPLAY_PROPERTIES"]["CERTIFICATION"]["VALUE"]?></td>
        </tr>
        <tr class="<?=$TrClass?>">
            <td class="DNameTD"><div class="DName">Гарантия, мес.</div><div class="Dsep"></div></td>
            <td class="DValueTD"><?=$arItem["DISPLAY_PROPERTIES"]["WARRANTY"]["VALUE"]?></td>
        </tr>
        <tr class="<?=$TrClass?>">
            <td class="DNameTD"><div class="DName">Артикул</div><div class="Dsep"></div></td>
            <td class="DValueTD"><?=$arItem["DISPLAY_PROPERTIES"]["ARTICLE"]["VALUE"]?></td>
        </tr>

        <?$p = 0;
				foreach($arItem["DISPLAY_PROPERTIES"] as $pid => $pval):
        if(!in_array($pid, $ShowPropInTable))
        $TrClass = 'DHidePropTr';
        else
        $TrClass = '';
        ?>
<?if($TrClass == "DHidePropTr"):?>
        <tr class="<?=$TrClass?>">
            <td class="DNameTD"><div class="DName"><?=$pval['NAME']?></div><div class="Dsep"></div></td>
            <td class="DValueTD"><?=$pval['DISPLAY_VALUE']?></td>
        </tr>
<?endif;?>
        <?if($p==11):?>
        <tr class="DHidePropTr">
            <td class="DNameTD"><div class="DName"><?=$arItem["PROPERTIES"]["EAN_13"]["NAME"]?></div><div class="Dsep"></div></td>
            <td class="DValueTD"><?=$arItem["PROPERTIES"]["EAN_13"]["VALUE"]?></td>
        </tr>
        <?endif;?>
        <?$p++;?>
        <?endforeach;?>
        <?endif;?>
    </table>
    </div>
</div>
</div>

<?if($arItem["PROPERTIES"]["UNI_TOP_BLOCK"]["VALUE"]):?>

<?endif;?>

<?endforeach; /*Active*/ ?>

<?$APPLICATION->IncludeFile('/inc/print_detail.php');?>

<?if($arResult['DISCONTINUED']):?>
<div id="DShowDiscontinued"><a href="#Discontinued">Снятые с производства аккумуляторы</a> <span></span><div class="clear"></div></div>
<a name="Discontinued"></a>
<script type="text/javascript">
$(document).ready(function(){
    setTimeout('$(".Discontinued").css({"display": "none"})', 1000);
});
</script>
<?
    $DccI = -1;
    foreach($arResult['DISCONTINUED'] as $arItem):
        $DccI++;
        ?>


<div class="Discontinued" style="display: block">
    <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
    ?>
    <div class="DetailPictureList">
        <h2 class="for_print h1"><?=$Prefix?><br/>  <span><?=$arResult['NAME']?></span> <?=(strlen($arItem['PROPERTIES']['ORIGINAL_CODE']['VALUE']) >0 ? ' ('.$arItem['PROPERTIES']['ORIGINAL_CODE']['VALUE'].')' : '')?></h2>


        <?
//echo "<pre>"; print_r($arItem); echo "</pre>";
        ?>
        <?if($arItem['PICTURES']):?>
        <?
            $FirstPic = $arItem['PICTURES'][0];
            ?>
        <div class="DetailPictureBlock">
			<img src="<?=$FirstPic['BIG']['SRC']?>" id="toprp_<?=$arItem['ID']?>_fp" class="for_print" />
            <div class="DetailPicture no_print">
                <a href="<?=$FirstPic['BIG']['SRC']?>" rel="0" id="toprp_<?=$arItem['ID']?>" class="AccPic " ><img src="<?=$FirstPic['MEDIUM']['SRC']?>" alt="<?=$imgalt?>" title="<?=$imgtitle?>" width="<?=$FirstSize['width']?>" height="<?=$FirstSize['height']?>" style="max-width: 420px;" /></a><!-- 298x391 -->


                <?if($arItem["PROPERTIES"]["PHONE_IMG"]["VALUE"]):?><img src="<?=CFile::GetPath($arItem["PROPERTIES"]["PHONE_IMG"]["VALUE"])?>" alt="<?=$talt?>" title="<?=$ttitle?>" class="PhonePic" style="max-height: 100px;max-width: 70px;"/><?endif;?>

                <?if($arResult["DETAIL_PICTURE"]):?>
                <?=ShowIImage($arResult['DETAIL_PICTURE'], $SectionSize['width'], $SectionSize['height'], $arResult['NAME'], ' id="" class="PhonePic" ')?>
                <?endif;?>
                <div class="clear"></div>
            </div>
            <?if(count($arItem['PICTURES'])>4):?>
            <button class="prev no_print" id="prev<?=$arItem['ID']?>"></button>
            <button class="next no_print" id="next<?=$arItem['ID']?>"></button>
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#OtherPictures_<?=$arItem['ID']?>").jCarouselLite({
                        btnNext: "#next<?=$arItem['ID']?>",
                        btnPrev: "#prev<?=$arItem['ID']?>",
                        visible: 4
                    });
                });
            </script>
            <?endif;?>
            <div id="OtherPictures_<?=$arItem['ID']?>" class="OtherPictures no_print">
                <ul>
                    <?
                        $PicI = -1;
                        $hrefs = array();
                        foreach($arItem['PICTURES'] as $arPicture):
                            $PicI++;
                            $PiCClass = ($PicI == 0) ? 'toprp current' : 'toprp';
                            $hrefs[] = '<a class="' . $PiCClass . '" id="toprp_'.$arItem['ID'].'_'.$PicI.'" href="'.$arPicture['BIG']['SRC'].'" rel="prettyPhoto['.$arItem['ID'].']"></a>';
                    ?>
                    <li>
                    <a class="c" href="<?=$arPicture['BIG']['SRC']?>"  rev="Index:'<?=$PicI?>', Mhref:'<?=$arPicture['MEDIUM']['SRC']?>', Mwidth:'420', Mheight:'400'">
						<!--<img <?/*if ($PicI == 0): ?>class="current"<?endif;?> src="<?=$arPicture['MEDIUM']['SRC']?>" width="59" height="53" alt="<?=$imgalt?>" title="<?=$imgtitle*/?>" />-->
						<span style="width:59px; height:53px; background-image:url('<?=$arPicture['SMALL']['SRC']?>');  background-size:100%; display: inline-block;">&nbsp;</span>
                   </a>
                </li>
                    <?
                        endforeach;
                        ?>
                </ul><?=implode("\n", $hrefs);?>
            </div>
        </div>
        <?endif;?>
    </div>
    <div class="DetailDescription">
        <h2 class="no_print"><?=$Prefix?><br/>  <span><?=$arItem['NAME']?></span> </h2>
        <div class="choose"><div class="block_left"><a href="?" class="active">Основные характеристики</a></div> <div class="block_right"><a class="OtherProp" href="?">Подробно</a></div><div class="clear"></div></div>

        <table class="DProp">
            <?if ($isCraftmann): ?>
            <?foreach ($CraftmanAllProperties as $propertyCode):
                        $arrPropertyValue = $arItem["PROPERTIES"][$propertyCode];
                    ?>
            <tr <?if (!in_array($propertyCode, $CraftmanMainProperties)): ?>class="DHidePropTr"<?endif;?>>
            <td class="DNameTD">
                <div class="DName"><?=$arrPropertyValue['NAME']?></div>
                <div class="Dsep"></div>
            </td>
            <td class="DValueTD"><?=$arrPropertyValue['VALUE']?></td>
            </tr>
            <?endforeach;?>
            <?else:?>
            <?foreach($arItem["DISPLAY_PROPERTIES"] as $pid => $pval):
            if(!in_array($pid, $ShowPropInTable))
            $TrClass = 'DHidePropTr';
            else
            $TrClass = '';
            ?>
            <tr class="<?=$TrClass?>">
                <td class="DNameTD"><div class="DName"><?=$pval['NAME']?></div><div class="Dsep"></div></td>
                <td class="DValueTD"><?=$pval['DISPLAY_VALUE']?></td>
            </tr>
            <?endforeach;?>
            <?endif;?>

        </table>
<div id="hid777" style="display:none">
<pre>
<?
print_r($arItem['SUGGEST']);
?>
</pre>
</div>
        <?if($arItem['SUGGEST']):?>
        <div class="DSuggest">

            <div class="hint_block">
                <div class="hint_star_block">
                    <div class="cn tl"></div>
                    <div class="cn tr"></div>
                    <div class="content">
                        <div class="content">
                            <div class="content">
                                <?=$arItem['SUGGEST']['PREVIEW_TEXT']?>
                            </div>
                        </div>
                    </div>
                    <div class="cn bl"></div>
                    <div class="cn br"></div>
                </div>
            </div>
            <a href="?" class="DIcons2"></a>
            <a href="?" class="Suggest"><?=$arItem['SUGGEST']['NAME']?></a>
        </div>
        <?endif;?>
    </div>
    <div class="clear"></div>
</div>

<?if($arItem["PROPERTIES"]["UNI_TOP_BLOCK"]["VALUE"]):?>
<div style="padding: 20px 0;"><?=$arItem["DETAIL_TEXT"]?></div>
<?endif;?>
<?endforeach;?>


<div class="clear"></div>


<?endif;?>
<!--noindex-->


<?/*if(!$isCraftmann):?>
<?$APPLICATION->IncludeComponent("INSIDE:phone.list.tabs", ".default", $arResult["TABS_PARAMETERS"])?>
<?else:?>
<div><?=$arResult['~DESCRIPTION'];?></div>
<?endif;*/?>
<!--/noindex-->
<?$APPLICATION->IncludeComponent("INSIDE:phone.list.tabs", ".default", array(
	
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);?>
</div>


<?endif;?>