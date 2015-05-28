<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div id="red-news-main-list">
    <?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?if(count($arResult["ITEMS"])>0):?>
    <?$cnt=0;?>
    <?foreach($arResult["ITEMS"] as $arItem):?>
    <?$cnt++;?>
        <div class="clear red-news-main-list-item<?if($cnt!=1) echo ' margin-top-20';?><?if($cnt==count($arResult["ITEMS"])) echo ' last';?>">
            <div class="red-news-picture">
            <div class="corner-news"></div>
                </div>
            <div class="motion red-news-info list">
                    <?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
                    <p class="news-date"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></p>
                    <?endif?>
                    <p><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></p>
                </div>
        </div>
    <?endforeach;?>
<?endif?>
    <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
