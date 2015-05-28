<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div id="widget-specials-top">онлайн обучение</div>
<div id="widget-specials">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
        <div class="motion widget-specials-record"  id="<?=$this->GetEditAreaId($arItem['ID']);?>"> <img class="corner widget-img" src="/bitrix/templates/<? echo SITE_TEMPLATE_ID;?>/images/corner-green-16.png" width="16" align="left"  /> 
        <div class="widget-corned"> 
            <?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<p class="news-date"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></p>
		<?endif?>
            <?if($arItem["NAME"]):?>
                    <?
                    if ($arItem["IBLOCK_ID"] == 24) {
                        $currHref = "/helpers/magazine/";
                    }
                    else {
                        $currHref = $arItem["DETAIL_PAGE_URL"] . "/";
                    }
                    ?>
                <p><a href="<?=$currHref?>"><?echo $arItem["NAME"]?></a></p>
		<?endif;?>
         </div>
       </div>
<?endforeach;?>
</div>
