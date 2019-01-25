<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<style type="text/css">
    div.instore { color: #007240; font-family: "ArialNarrowRegular", Arial, sans-serif; margin-top: 10px; margin-bottom: 10px;}
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
        $Prefix = "Внешний аккумулятор" . " ";
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
		$APPLICATION->SetPageProperty("description", $arResult['UF_DESCRIPTION']);
        $APPLICATION->SetPageProperty("keywords", $arResult['~UF_KEYWORDS']);

    }
    else 
	{

		if($arResult['~UF_DESCRIPTION']=='test description') 
		{
			$APPLICATION->SetPageProperty("description", $arResult['MY_DESCRIPTION']);
		}
		else
		{
			$APPLICATION->SetPageProperty("description", $arResult['~UF_DESCRIPTION']);
		}

    }
    ?>


    <div id="Detail">

        <?
        $AccI = -1;
        foreach($arResult['ITEMS'] as $k=>$arItem):
            $AccI++;
            ?>

            <div class="Acc" style="padding-bottom: 20px;">

                <div>

					<div itemscope itemtype="http://schema.org/Product" class="DetailDescription" style="padding-right: 0px;">
                        <a name="<?=$arItem['ID']?>"></a>
                        <?global $CurCatalogSection;?>
                        <?$Dev = '';
                        $Mod = '';
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
                        ?>
						<?
						$res_inside = CIBlockSection::GetByID($arItem['IBLOCK_SECTION_ID']);
						if($ar_res_inside = $res_inside->GetNext())
						{

						}
						$res_iblock_id = CIBlockElement::GetIBlockByID($arItem['ID']);
						$ar_result_my_sec = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>$res_iblock_id, "ID"=>$ar_res_inside['ID']),true, Array("UF_BATTERYTYPE")); 
						if($res_my_sec = $ar_result_my_sec->GetNext())
						{

						}
						?>
						<?if ($isCraftmann):?><?// Название для универсальных АКБ ?>
						<h1 <?/*itemprop="name"*/?> class="no_print" title="Купить <?=$Prefix?><?=$Dev?> <?=$Mod?>"><?=$Mod?></h1>
						<?else:?>
						<?// Название для всех остальных АКБ ?>
                        <?if(!$AccI):?>
						<span style="display:none;"><?=$Dev?><?$modified_Mod = str_replace('+', 'plus', $Mod);?> <?=$modified_Mod?></span>
						<h1 <?/*itemprop="name"*/?> class="no_print" title="Купить <?=$Prefix?><?=$Dev?> <?=$Mod?>">
						<?else:?>
							<h2 <?/*itemprop="name"*/?> title="Купить <?=$Prefix?><?=$Dev?> <?=$Mod?>" class="no_print h1">
						<?endif;?>
						<?=$Prefix?><?=$Dev?> <?=$Mod?> 
						<?if ($isCraftmann):?>
						<?else:?>
						<?endif;?>
						<?if(!$AccI):?>
						</h1>
						<?else:?>
						</h2>
						<?endif;?>
						<?endif;?>
                        <!--<div style="margin-bottom: 30px;margin-top:-25px">--><div>
<?$Article_tmp = str_replace('.','',$arItem["DISPLAY_PROPERTIES"]["ARTICLE"]["VALUE"]);?>
<span itemprop="name" style="display:none;"><?=$Article_tmp?></span>
<?if ($isCraftmann):$Prefix = "";?>
<?else:$Prefix = "аналогичен штатной батареи питания " . $res_my_sec['UF_BATTERYTYPE'] . " и полностью совместим с " . $Dev . " " . $Mod;?>
<?endif;?>
<span itemprop="description" style="display:none;">Акуумулятор <?=$Article_tmp?> ёмкостью <?=$arItem["DISPLAY_PROPERTIES"]["CAPACITY"]["VALUE"]?> мАч. <?=$Prefix?></span>
<?$Prefix = "Аккумулятор для" . " ";?>
							<?if ($isCraftmann):?>
						<div <?/*itemprop="description"*/?> class="visual-wrapper"><?=$arItem["PROPERTIES"]["UNI_TOP_BLOCK"]["~VALUE"]["TEXT"]?></div>
							<?else:?>
						<div <?/*itemprop="description"*/?>>
							<?if ($arItem["DETAIL_TEXT"] != NULL):?>
							<p><?=$arItem["DETAIL_TEXT"]?></p>
							<?else:?>
							<p>
								Аккумулятор <span itemprop="brand">CRAFTMANN</span> ёмкостью <?=$arItem["DISPLAY_PROPERTIES"]["CAPACITY"]["VALUE"]?> мАч. аналогичен штатной батарее питания (<b class="seo"><?=$res_my_sec['UF_BATTERYTYPE']?></b>) и полностью совместим с <?=$arResult['MY_ARDEV']?>ом <span <?/*itemprop="model"*/?>><?=$Dev?> <?=$Mod?></span>. В комплект поставки входят: <?=$arItem["DISPLAY_PROPERTIES"]['COMPLECT']["VALUE"]?>.</p>
								<?endif;?>
								<p style="display:none;">Аккумулятор Craftmann позаботится о стабильной и производительной работе Вашего <?=$arResult['MY_ARDEV']?>а <?=$Dev?> <?=$Mod?>. Емкость батареи составляет <?=$arItem["DISPLAY_PROPERTIES"]["CAPACITY"]["VALUE"]?> мАч, благодаря чему Вы сможете достаточно длительный срок не перезаряжать аккумулятор при соблюдении условия умеренного использования <?=$arResult['MY_ARDEV']?>а. Внушительным плюсом аккумулятора является безопасность его использования. Этому способствует микросхема, которая контролирует уровень температуры батареи, а также не допускает ее перезаряда, что существенно продлит срок ее службы. <br/>Купить мощную надёжную <b>аккумуляторную батарею для <?=$arResult['MY_ARDEV']?>а <?=$Dev?> <?=$Mod?></b> ёмкостью <?=$arItem["DISPLAY_PROPERTIES"]["CAPACITY"]["VALUE"]?> мАч.
									</p>
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
<!--Список совместимых устройств-->
                        <?if (!$isCraftmann&&0): ?>
                            <div id="DMainFeature"><?=ShowIImage('/images/light_change.gif')?></div>
                        <?endif;?>

                        <?if(strlen($arItem['PROPERTIES']['PRICE']['VALUE']) > 0):?>

                            <style type="text/css">.BuyAreaBlock {  }</style>
                            <div  itemprop="offers" itemscope itemtype="http://schema.org/Offer">
<?if ($isCraftmann):
$Prefix = "";
$Prefix1 = "";
$Suffix = "";
?>
<?else:
$Prefix = " для ";
$Prefix1 = "Аккумулятор ";
$Suffix = " (" . $res_my_sec['UF_BATTERYTYPE'] . ")";
$Article_tmp = str_replace('.','',$arItem["DISPLAY_PROPERTIES"]["ARTICLE"]["VALUE"]);
?>
<?endif;?>
<span itemprop="name" style="display:none;"><?=$Article_tmp?></span> <span itemprop="price" style="display:none;"><?=$arItem['PROPERTIES']['PRICE']['VALUE']?></span><span itemprop="priceCurrency" class="ruble" style="display:none;">RUB</span>
<span itemprop="description" style="display:none;"><?=$Prefix1?><?=$Article_tmp?> <?=$Prefix?><?=$Dev?> <?=$Mod?><?=$Suffix?> при заказе из приложения доставляется бесплатно, при заказе через сайт 300 рублей.</span>
<?$Prefix = "Аккумулятор для" . " ";?>
                                <div id="DBuyArea" style="background-color:#dfefff; padding:12px 18px 15px 18px;margin-bottom:15px; position:relative;">
                                    <?
                                    # -------------- ПОДКЛЮЧЕНИЕ ФОРМЫ - УЗНАТЬ О НАЧАЛЕ ПРОДАЖ ---------------

                                    global $USER, $APPLICATION, $CurCatalogSection;
                                    // if($USER->GetID()==7):

                                    $article = $arItem["PROPERTIES"]["ARTICLE"]["VALUE"];

                                    ?>
									<div id="request<?=$arItem['ID']?>" class="hidden">

                                        <div class="RequestForm" style="width:300px; top: 0; left: -2px;background: #fff;">
                                            <div class="big_star_block form-style">
                                                <div class="cn tl"></div>
                                                <div class="cn tr"><a onclick="

$(this).parent().parent().parent().parent().hide(); 

return false;

" 

class="complaint_close" 

style="position: relative;top:10px;right:10px;text-decoration: none;" 
href="#">X</a></div>
                                                <div class="content">
                                                    <div class="content form-content">
                                                        <?$Producer = '';
                                                        $Model = '';

                                                        if($CurCatalogSection['DEPTH_LEVEL'] == 1)
														{
                                                            $Producer = $CurCatalogSection['NAME'];
															$Model = htmlspecialchars($_REQUEST['ModelName']);
															//print_r("Here1");
														}
                                                        if($CurCatalogSection['DEPTH_LEVEL'] == 2 && strlen($Producer) <= 0)
                                                        {
                                                            $res = CIBlockSection::GetByID($CurCatalogSection['IBLOCK_SECTION_ID']);
                                                            if($ar_res = $res->GetNext())
                                                                $Producer =  $ar_res['NAME'];
                                                            $Model = $CurCatalogSection['NAME'];
															//print_r("Here2");

                                                        }

                                                        CModule::IncludeModule('iblock');
                                                        $NUMBER = 0
                                                        ?>

					<?$APPLICATION->IncludeComponent(
	"nsandrey:mailform", 
	"REQUEST_FORM", 
	array(
		"FORM_ID" => "REQUEST".$arItem["ID"],
		"EMAIL_TO" => "shop@craftmann.ru",
		"EVENT_ID" => "REQUEST",
		"JQUERY" => "N",
		"EVENT_MESSAGE_ID" => array(
			0 => "71",
			1 => "72",
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
		"SIGN" => "N",
		"COMPONENT_TEMPLATE" => "REQUEST_FORM",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
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

                                    <?
                                    # -------------- НАЛИЧИЕ - 1 часть ---------------
                                    $nal = $arItem['PROPERTIES']['STORE']['VALUE'];

                                    if($nal == 'в наличии'||$nal == 'есть')
                                    {
                                        $class = 'plus';
                                        $text = 'В наличии';
                                    }
                                    else
                                    {
                                        $class = 'minus';
                                        $text = 'Планируется, подробнее у Консультанта';
                                    }
                                    # -------------- /НАЛИЧИЕ - 1 часть ---------------
                                    ?>




                                    <div id="buyone<?=$arItem["ID"];?>" <?=($class=='minus'?'class="hidden"':'')?>>
										<a rel="nofollow" class="Btn" <?=((time()>strtotime("28.12.17 15:00:00")||$USER->GetID()=="7866")&&0?
" href=\"/personal/cart/new_year/\" 
	target=\"_blank\"":

"href=\"javascript: void(0);\" 
	onclick=\"
\" ")?>" 
	id="item<?=$arItem["ID"]?>" title="Купить <?=$Prefix?><?=$Dev?> <?=$Mod?>" data-item="<?=$arItem["ID"]?>" 
	data-quantity="1">КУПИТЬ
	<span name="<?php echo $class;?>" style="position: absolute; margin-top: -1px;">
	<img src="/images/rightArr.png" alt="Купить" />
	</span>
</a>



									</div>
                                    <?# -------------- ЕСЛИ НЕТ ТОВАРА, ВЫВОДИМ ССЫЛКУ НА ФОРМУ ---------------?>
                                    <div id="buynone<?=$arItem["ID"];?>"  <?=($class=='minus'?'':'class="hidden"')?>>
                                        <a class="Btn disabled" href="javascript: void(0);" id="item<?=$arItem["ID"]?>" onclick="


$('#request<?=$arItem["ID"]?>').show();

"

>УЗНАТЬ О НАЧАЛЕ ПРОДАЖ</a>
                                    </div>
                                    <div id="buyabsnone<?=$arItem["ID"];?>"  class="hidden">
                                        <a class="Btn absdisabled" href="javascript: void(0);" id="item<?=$arItem["ID"]?>">Нет в продаже</a>
                                    </div>


<div id="DPrice" style="color: #000000 !important;"><span  <?/*itemprop="price"*/?> class="DAmmount"><? $price=$arItem['PROPERTIES']['PRICE']['VALUE']; print rtrim(rtrim($price, '0'), '.');?></span> <span class="DCurrency" style="font-size: 20px; padding-top: 10px;"><?if(0){?><?}?><img src="/bitrix/templates/.default/components/individ/phone.list/.default/images/ruble.png" style="border:0px" alt="RUB"><span <?/*itemprop="priceCurrency"*/?> class="ruble" style="display:none;">RUB</span></span><div class="DSub">Цена производителя</div></div>
                                    <div class="clear"></div>

                                    <?php
                                    global $USER;
                                    # -------------- НАЛИЧИЕ 2 часть ---------------
                                    $sARTICLE = '';

                                    $sARTICLE = $arItem['PROPERTIES']['ARTICLE']['VALUE'];
                                    ?>
							<?if ($isCraftmann):?>
                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            //Подключаем сервис проверки наличия только для универсальных:
												$.post('/inc/availability.php', { ARTICLE:'<?=$sARTICLE;?>' }, function(text) { if(text != '') { $('#<?=$arItem["ID"];?>').fadeOut('fast'); $('#<?=$arItem["ID"];?>').html(text); $('#<?=$arItem["ID"];?>').fadeIn('slow');
												if($('#<?=$arItem["ID"]?>').find('div').hasClass('minus')&&$('#<?=$arItem["ID"]?>').find('div').hasClass('abs')){  $('#buyone<?=$arItem["ID"];?>').hide();$('#buynone<?=$arItem["ID"];?>').hide();$('#buyabsnone<?=$arItem["ID"];?>').show();}else if($('#<?=$arItem["ID"]?>').find('div').hasClass('minus')){ $('#buyone<?=$arItem["ID"];?>').hide(); $('#buynone<?=$arItem["ID"];?>').show(); $('#buyabsnone<?=$arItem["ID"];?>').hide();}else{$('#buyone<?=$arItem["ID"];?>').show(); $('#buynone<?=$arItem["ID"];?>').hide();$('#buyabsnone<?=$arItem["ID"];?>').hide();}
                                            }
                                            });
                                        });
                                    </script>
							<?else:?>
							<?endif;?>




<?
                                    echo '<div id="'.$arItem["ID"].'" class="instore"><div class="'.$class.'">'.$text.'</div></div>';


                                    # -------------- /НАЛИЧИЕ 2 часть ---------------


                                    # -------------- ДОСТАВКА ---------------
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
                                    }
                                    else
                                    {
                                        echo "Доступных способов доставки не найдено<br>";
                                    }

                                    # -------------- /ДОСТАВКА ---------------
                                    ?>
                                    <div>
									<?if($nal == 'в наличии'||$nal == 'есть' || $isCraftmann)
                                    {
                                        $APPLICATION->IncludeFile("/inc/work_time.php", Array(), Array(
                                            "MODE"      => "html",                                           // будет редактировать в веб-редакторе
                                            "NAME"      => "Оплата и Время работы",      // текст всплывающей подсказки на иконке
                                            "TEMPLATE"  => "section_include_template.php"                    // имя шаблона для нового файла
                                        ));
                                    }
                                    elseif($nal != 'в наличии'||$nal != 'есть' and $arItem['DISPLAY_PROPERTIES']['CAPACITY']['VALUE']>=2000 and !$AccI and !$isCraftmann)
                                    {
										echo 'Стандартного аккумулятора для  '.$Dev.' '.$Mod.' сейчас нет в наличии. Оставьте предзаказ и мы сообщим Вам о поступлении. Чтобы как-то компенсировать ваше неудобство мы можем предложить Вам скидку 5% на <a href="/power_bank/" title="Power Bank для '.$Dev.' '.$Mod.'">внешний аккумулятор</a> любой ёмкости или <a href="/charger/" title="СЗУ для '.$Dev.' '.$Mod.'">USB зарядное устройство 3.4 A</a> для '.$Dev.' '.$Mod.'. Внешний аккумулятор и зарядное устройство не смогут восстановить потерянную ёмкость, но поддерживая свой штатный аккумулятор в заряженном состоянии, вы сможете замедлить его дальнейшую деградацию. Штатный аккумулятор рано или поздно придется менять, но мы надеемся, что вы все-таки дождетесь прихода нашего аккумулятора.';
                                    }
                                    elseif($nal != 'в наличии'||$nal != 'есть' and $arItem['DISPLAY_PROPERTIES']['CAPACITY']['VALUE']<2000 and !$AccI and !$isCraftmann)
                                    {
                                        echo ' Стандартного аккумулятора для '.$Dev.' '.$Mod.' сейчас нет в наличии. Оставьте предзаказ и мы сообщим Вам о поступлении. Чтобы как-то компенсировать ваше разочарование мы можем предложить Вам скидку 5% на <a href="/power_bank/" title="Power Bank для '.$Dev.' '.$Mod.'">внешний аккумулятор</a> любой ёмкости или <a href="/charger/" title="СЗУ для '.$Dev.' '.$Mod.'">USB зарядное устройство 2.1 A</a> для '.$Dev.' '.$Mod.'. Конечно, внешним аккумулятором нельзя полностью компенсировать штатный аккумулятор, он только частично компенсирует деградирующую ёмкость. Соответственно, штатный аккумулятор рано или поздно придется менять... или менять придется мобильное устройство. Хорошая новость состоит в том, что внешний аккумулятор и USB зарядное устройство являются универсальными, то есть могут использоваться для заряда других мобильных устройств.';
                                    }
                                    elseif($nal != 'в наличии'||$nal != 'есть' and $arItem['DISPLAY_PROPERTIES']['CAPACITY']['VALUE']>=2000 and $AccI and !$isCraftmann)
                                    {
                                        echo 'Стандартного аккумулятора для '.$Dev.' '.$Mod.' сейчас нет в наличии. Оставьте предзаказ и мы сообщим Вам о поступлении. Чтобы как-то компенсировать ваше неудобство мы можем предложить Вам скидку 5% на <a href="/power_bank/" title="Power Bank для '.$Dev.' '.$Mod.'">внешний аккумулятор</a> для '.$Dev.' '.$Mod.'. Внешний аккумулятор не сможет восстановить потерянную ёмкость, но поддерживая свой штатный аккумулятор в заряженном состоянии, вы сможете замедлить его дальнейшую деградацию. Штатный аккумулятор рано или поздно придется менять, но мы надеемся, что вы все-таки дождетесь прихода нашего аккумулятора.';
                                    }
                                    elseif($nal != 'в наличии'||$nal != 'есть' and $arItem['DISPLAY_PROPERTIES']['CAPACITY']['VALUE']<2000 and $AccI and !$isCraftmann)
                                    {
                                        echo 'Стандартного аккумулятора для '.$Dev.' '.$Mod.' сейчас нет в наличии. Оставьте предзаказ и мы сообщим Вам о поступлении. Чтобы как-то компенсировать ваше разочарование мы можем предложить Вам скидку 5% на <a href="/power_bank/" title="Power Bank для '.$Dev.' '.$Mod.'">внешний аккумулятор</a> для '.$Dev.' '.$Mod.'. Конечно, внешним аккумулятором нельзя полностью компенсировать штатный аккумулятор, он только частично компенсирует деградирующую ёмкость. Соответственно, штатный аккумулятор рано или поздно придется менять... или менять придется мобильное устройство. Хорошая новость состоит в том, что внешний аккумулятор являются универсальными, то есть может использоваться для заряда других мобильных устройств.';
                                    }
									?>
                                    </div>
                                </div>
                            </div>
                        <?endif;?>
						<?
                        $BUrl = $APPLICATION->GetCurPageParam('ACTION=ADD&ElSc='.$arItem['ID'].'.'.$arItem['IBLOCK_SECTION_ID'],array('ACTION', 'ElSc'));
						?>
                        <div class="clear"></div>
                        <?if(1 == 2):?>
                            <div class="choose"><div class="block_left"><a rel="nofollow" href="?" class="active">Основные характеристики</a></div> <div class="block_right"><a class="OtherProp" href="?" onclick="_gaq.push(['_trackPageview', '/virtual/detail']);
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
						
                        <div style="width:100%">
<?if($nal == 'в наличии'||$nal == 'есть'  and !$isCraftmann and !$AccI):?>
<?if ($arItem['DISPLAY_PROPERTIES']['CAPACITY']['VALUE']>=2000):?>
Рекомендуем приобрести стабилизированное <a href="/charger/" title="СЗУ для <?=$Dev?> <?=$Mod?>">USB зарядное устройство 3.4 A</a> для <?=$Dev?> <?=$Mod?>, которое обеспечит быстрый и полноценный заряд аккумулятора. Это мощное зарядное устройство оборудовано 2 USB разъемами, позволяющими заряжать смартфон и планшет одновременно.
<?else:?>
Рекомендуем приобрести стабилизированное <a href="/charger/" title="СЗУ для <?=$Dev?> <?=$Mod?>">USB зарядное устройство 2.1 A</a> для <?=$Dev?> <?=$Mod?>, которое обеспечит быстрый и полноценный заряд аккумулятора. Это мощное зарядное устройство оборудовано 2 USB разъемами, позволяющими заряжать телефон и смартфон одновременно. 
<?endif;?>
<?else:?>
                            <div style="float:right;padding-top:4px"><a rel="nofollow" href="/reviews/"  target="_blank">Все отзывы</a></div>
                            <h2 style="margin:0;display: block;color: #1f1f1f;font-size: 17px;text-decoration: none;font-weight:bold;">Отзыв о магазине</h2>
                            <?$APPLICATION->IncludeComponent(
	"webdebug:reviews2.list", 
	"template_for_goods", 
	array(
		"CACHE_TYPE" => "Y",
		"CACHE_TIME" => "1780",
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
		"COMPONENT_TEMPLATE" => "template_for_goods",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
<?endif;?>
                        </div>
                        <div class="clear"></div>
                        <?if ($isCraftmann): ?>
                            <div class="visual-wrapper"><?=$arItem["PROPERTIES"]["UNI_BOTTOM_BLOCK"]["~VALUE"]["TEXT"];?></div>
						<?else:?>
								<ul style="display:none;">
										<li>Если Ваш <b>аккумулятор <?=$res_my_sec['UF_BATTERYTYPE']?> вздулся</b> – его нужно срочно заменить, так как испорченая батарея может повредить Ваш <?=$arResult['MY_ARDEV']?>.</li>
										<li>Если при интенсивном использовании <?=$arResult['MY_ARDEV']?>а <?=$Mod?> <b>акб быстро разряжается</b> и садится в самое неподходящее время, 
										Вам просто необходимо купить аккумулятор <b>для <?=$Mod?></b>.</li>
									</ul>
						<?endif;?>
                        <?

                        $FirstPic = $arItem['PICTURES'][0];
                        $ar_result=CIBlockSection::GetList(Array(), Array("IBLOCK_ID"=>"12", "ID"=>$arResult["ID"]),false, Array("UF_ALT"));
                        $res = $ar_result->GetNext();
                        if ($isCraftmann)
                        {
                            $imgalt = $imgtitle = $arResult['~UF_ALT'];
                        } else
                        {
                            //$imgalt = $Prefix . strtolower($arItem['NAME']) .' производства CRAFTMANN';
                            $catname = explode(' ', $arItem['NAME']);
                            $imgalt = 'CRAFTMANN '.$arItem["PROPERTIES"]["ARTICLE"]["VALUE"].' - Купить батарею '.$arItem["PROPERTIES"]["ORIGINAL_CODE"]["VALUE"].'';
                            $imgtitle = 'CRAFTMANN '.strtolower($arItem['NAME']);
                        }
						?>


<?
$img0 = filesize($_SERVER['DOCUMENT_ROOT'].$arItem['PICTURES'][0]['BIG']['SRC']);
$img1 = filesize($_SERVER['DOCUMENT_ROOT'].$arItem['PICTURES'][1]['BIG']['SRC']);
$img2 = filesize($_SERVER['DOCUMENT_ROOT'].$arItem['PICTURES'][2]['BIG']['SRC']);
$img3 = filesize($_SERVER['DOCUMENT_ROOT'].$arItem['PICTURES'][3]['BIG']['SRC']);
$imgtime = $img0+$img1+$img2+$img3;
?>


                        <div class="clear"></div>
                        <img src="<?=$FirstPic['BIG']['SRC']?>?<?=$imgtime?>" alt="<?=$Prefix?> <?=$Dev?> <?=$Mod?> <?=$arItem["NAME"]?>" class="for_print"/>
                    </div>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));

                    $arFilter = Array("IBLOCK_ID"=>12, "ID"=>$arItem["ID"]);
                    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
                    while($ob = $res->GetNextElement())
                    {
                        $arFields = $ob->GetFields();
                        //$img_path = CFile::GetPath($arFields["PROPERTY_PHONE_IMG_VALUE"]);
                        $img_path = CFile::GetPath($arSection["PICTURE"]["SRC"]);
                    }
                    ?>
                    <div class="DetailPictureList">
                        <?if(!$AccI):?><h1 class="for_print"><?else:?><h2 class="for_print h1"><?endif;?>  <span><?=$Dev?> <?=$Mod?></span><?=(0 && $AccI > 0 && strlen($arItem['PROPERTIES']['ORIGINAL_CODE']['VALUE']) >0 ? ' ('.$arItem['PROPERTIES']['ORIGINAL_CODE']['VALUE'].')' : '')?><?if(!$AccI):?></h1><?else:?></h2><?endif;?>
                        <?if($arItem['PICTURES']):?>
                            <?

                            $FirstPic = $arItem['PICTURES'][0];
                            $ar_result=CIBlockSection::GetList(Array(), Array("IBLOCK_ID"=>"12", "ID"=>$arResult["ID"]),false, Array("UF_ALT"));
                            $res = $ar_result->GetNext();
                            if ($isCraftmann)
                            {
                                $imgalt = $imgtitle = $arResult['~UF_ALT'];
                            } else
                            {
                                $catname = explode(' ', $arItem['NAME']);
                                $imgalt = 'CRAFTMANN '.$arItem["PROPERTIES"]["ARTICLE"]["VALUE"].' - Купить батарею '.$arItem["PROPERTIES"]["ORIGINAL_CODE"]["VALUE"].'';
                                $imgtitle = 'CRAFTMANN '.$arItem['NAME'];
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

                                    $statusPicturePath = "/upload/catalog_banners/" . $statusPicture;
                                    ?>

                                    <?if($statusPicture):?>
                                        <img id="status_<?=$arItem['ID']?>" width="210px" height="30px" style="margin-bottom: -124px;position: absolute;z-index: 10;left:233px;" src="<?=$statusPicturePath?>" alt="<?=$statusPictureAlt?>" />
                                    <?endif;?>

                                    <a rel="nofollow" href="<?=$FirstPic['BIG']['SRC']?>?<?=$imgtime?>" rel="0" id="toprp_<?=$arItem['ID']?>" data-title="<?=$Prefix?> <?=$Dev?> <?=$Mod?>. <?=$imgtitle?>" class="AccPic">
                                        <img style="margin:0px;" src="<?=$FirstPic['BIG']['SRC']?>?<?=$imgtime?>" alt="Аккумулятор <?=$res_my_sec['UF_BATTERYTYPE']?>" title="Аккумулятор <?=$res_my_sec['UF_BATTERYTYPE']?>" width="400" />
                                    </a><!-- 298x391 -->
                                    <?
                                    $talt = $arItem['NAME'];
                                    $ttitle = $arItem['NAME'];
                                    ?>
                                    <?
                                    if($cursb==1){
                                        ?>
                                        <img style="margin:0px;"  src="/upload/catalog_banners/<?=($isCraftmann?"craftmann_promo_2.png":"craftmann_promo_1.png")?>" alt="CRAFTMANN - Заряжает положительно!" width="210px" height="70px" style="margin-bottom: -124px;margin-top: 35px;position: absolute;left:233px;"/>
                                    <?}?>
<?
		 $My_id_section = $My_ArSectionId;
		 $My_arSecFilter = array('IBLOCK_ID' => 12, 'ID'=>$My_id_section);
		 $My_rsSections = CIBlockSection::GetList(array(), $My_arSecFilter);
		 if ($My_arSection = $My_rsSections->Fetch())
		 {
			if($My_arSection['PICTURE']!== NULL)
			{
				$My_file = CFile::GetPath($My_arSection['PICTURE']);
				$Patch_file = $_SERVER['DOCUMENT_ROOT'].$My_file;
				$Phoneimgsize = filesize($Patch_file);
				$Phoneimg = getimagesize($Patch_file);
				if($Phoneimg[0] == '400'){
					$PhonePicClass = 'width: 100px;height: 100px;margin-left: -80px;position: relative;vertical-align: bottom;';
				}
				else{
					$PhonePicClass = 'width: 50px;height: 100px;margin-left: -50px;position: relative;vertical-align: bottom;';
				}
				if ($PhoneUrl == TRUE) {
					//Ссылка на статью о телефоне
					echo '<a href="/support/devices/'.$arResult["CODE"].'/"><img src="'.$My_file.'?'.$Phoneimgsize.'" alt="Купить '.$Prefix.' '.$Dev.' '.$Mod.'" title="'.$Dev.' '.$Mod.'" style="'.$PhonePicClass.'"/></a>';
				}else
				{
					echo '<img src="'.$My_file.'?'.$Phoneimgsize.'" alt="Купить '.$Prefix.' '.$Dev.' '.$Mod.'" title="'.$Dev.' '.$Mod.'" style="'.$PhonePicClass.'"/>';
				}
			}
		}
?>
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
                                            $hrefs[] = '<a class="' . $PiCClass . '" id="toprp_'.$arItem['ID'].'_'.$PicI.'" href="'.$arPicture['BIG']['SRC'].'?'.$imgtime.'" rel="prettyPhoto['.$arItem['ID'].']"></a>';
                                            ?>
                                            <li>

                                                <a rel="nofollow" class="c" href="<?=$arPicture['BIG']['SRC']?>?<?=$imgtime?>"  rev="Index:'<?=$PicI?>', Mhref:'<?=$arPicture['BIG']['SRC']?>', Mwidth:'400'">
                                                    <span style="width:80px; height:73px; background-image:url('<?=$arPicture['BIG']['SRC']?>?<?=$imgtime?>'); background-repeat: no-repeat; background-size:100%; display: inline-block;"></span>
                                                </a>
                                            </li>
                                            <?
                                        endforeach;
                                        ?>
                                    </ul><?=implode("\n", $hrefs);?>
                                </div>
                            </div>
                        <?endif;?>
<?
$My_id_section = $My_ArSectionId;
$arFilterArt = Array('IBLOCK_ID'=>12, 'GLOBAL_ACTIVE'=>'Y', "ID"=>$My_id_section);
$db_listArt = CIBlockSection::GetList(Array($by=>$order), $arFilterArt, true, Array('UF_ARTICLE'));
if($ar_resultArt = $db_listArt->GetNext())
{
}
if ($FirstPic['BIG']['SRC']==NULL)
{
echo '<img width="400" src="/bitrix/components/esfull/FirstUploadFull/acupic/'.$arItem["DISPLAY_PROPERTIES"]["ARTICLE"]["VALUE"].'/',$arItem["DISPLAY_PROPERTIES"]["ARTICLE"]["VALUE"].'_1.jpg">';
	echo '<img src="/bitrix/components/esfull/FirstUploadFull/telpic/'.$ar_resultArt['UF_ARTICLE'].'.jpg" alt="Купить '.$Prefix.' '.$Dev.' '.$Mod.'" title="'.$Dev.' '.$Mod.'" class="PhonePic" style="max-height: 100px;max-width: 70px; margin:0px 0px -270px -30px;"/>';
}


?>
                        <div class="DetailDescription" style="width: 470px; padding: 15px 0; padding-top: 40px; float: none;">

                            <div class="choose"><div class="block_left"><a rel="nofollow" href="" class="active">Основные характеристики</a></div> <div><a class="OtherProp" href="">Подробно</a></div><div class="clear"></div></div>

                            <?
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
                                        <td class="DValueTD"><?=$arItem["DISPLAY_PROPERTIES"]["CAPACITY"]["VALUE"]?> mAh</td>
                                    </tr>
                                    <tr class="<?=$TrClass?>">
                                        <td class="DNameTD"><div class="DName">Оригинальный код</div><div class="Dsep"></div></td>
										<td class="DValueTD">
											<?
											echo ''.$arItem['DISPLAY_PROPERTIES']['ORIGINAL_CODE']['VALUE'].'</a>';
											?>											
										</td>
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
                                    <tr class="<?=$TrClass?>">
                                            <td class="DNameTD"><div class="DName"><?=$arItem["PROPERTIES"]["EAN_13"]["NAME"]?></div><div class="Dsep"></div></td>
                                            <td class="DValueTD"><?=$arItem["PROPERTIES"]["EAN_13"]["VALUE"]?></td>
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
            </div>

        <?endforeach; /*Active*/ ?>



        <?$APPLICATION->IncludeComponent("INSIDE:phone.list.tabs", "tabs", array(

        ),
            false,
            array(
                "ACTIVE_COMPONENT" => "N"
            )
        );
?>

    </div>


<?endif;?>


<script>
$(document).ready(function() 
{
	var Btn_add_to_cart_by_id = document.getElementById('Btn');
	var Mass_tagname = document.getElementsByTagName("*");

	for (var Mass_count = 0; Mass_count < Mass_tagname.length; Mass_count++) 
		{

			if(Mass_tagname[Mass_count].getAttribute('class') == "Btn") 
			{

				var Btn_span_inside_mass = Mass_tagname[Mass_count].getElementsByTagName('span')[0];
				var Btn_instock = "minus";

				if (Btn_span_inside_mass == "[object HTMLSpanElement]")
				{
					Btn_instock = Btn_span_inside_mass.getAttribute('name');
				}
				else
				{
					Btn_instock = "minus";
				}

				if(Btn_instock == "plus")
				{
	 				Mass_tagname[Mass_count].onclick = function() 
					{
						var Acc_name_js = document.getElementById('Detail').getElementsByTagName('span')[0].firstChild.nodeValue;
						var Acc_id_mass_result = '';

						for (var Mass_count_inside = 0; Mass_count_inside < Mass_tagname.length; Mass_count_inside++) 
						{
							if(Mass_tagname[Mass_count_inside].getAttribute('class') == "Acc") 
							{
								Acc_id_mass_result += ';' + Mass_tagname[Mass_count_inside].getElementsByTagName('a')[0].getAttribute('name');
							}
						}

						$.post
						(
							'/akkumulyator/basket_add.php', 
							{
								q: $(this).attr('data-quantity'), 
								pid: $(this).attr('data-item'),
								qpid: Acc_name_js,
								wpid: Acc_id_mass_result
							},

							function() 
							{
								document.location.href='/personal/cart/';
							}

						);
    				}
				}
			}
		}
});

</script>
