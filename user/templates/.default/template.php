<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="user-info">
    <? if (isset($arResult["USER"]["PHOTO_SRC"])): ?>
    <div class="user-photo">
        <img src="<?=$arResult["USER"]["PHOTO_SRC"]?>" width="100%" />
        <div class="expert-ask-question">
            <a href="<?=$arResult["USER"]["QUESTION_LINK"]?>">
                Задать вопрос 
                <img src="/bitrix/templates/<? echo SITE_TEMPLATE_ID;?>/images/hurt-dark-red-21.png" width="21" align="right" style="margin-left: 10px;">
            </a>
        </div>
    </div>
    <?endif?>
    
    <div class="user-information">
        <h1><?=$arResult["USER"]["LAST_NAME"]?> <?=$arResult["USER"]["NAME"]?> <?=$arResult["USER"]["SECOND_NAME"]?></h1>
        <h2><?=$arResult["USER"]["CLINIC_NAME"]?></h2>
        <div class="user-work-position"><?=$arResult["USER"]["WORK_POSITION"]?></div>
        <div class="user-work-department"><?=$arResult["USER"]["WORK_DEPARTMENT"]?></div>
        <div class="user-work-profile"><?=$arResult["USER"]["WORK_PROFILE"]?></div>
    </div>
    
</div>