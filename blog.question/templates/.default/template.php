<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$delim = "-";?>
<?if ($arResult["USER"]["EXPERT"] == "N"):?>
<?$delim = ":";?>
<?endif;?>
<div class="user-info">
    <? if (isset($arResult["USER"]["PHOTO_SRC"])): ?>
    <div class="user-photo">
        <img src="<?=$arResult["USER"]["PHOTO_SRC"]?>" width="100%" />
    </div>
    <?endif?>
    
    <div class="user-information">
        <?if ($arResult["USER"]["EXPERT"] == "N"):?>
        <h1><?=$arResult["USER"]["LAST_NAME"]?> <?=$arResult["USER"]["NAME"]?> <?=$arResult["USER"]["SECOND_NAME"]?></h1>
        <h2><?=$arResult["USER"]["CLINIC_NAME"]?></h2>
        <?endif;?>
        
        <?foreach ($arResult["CHAT_MESSAGES"] as $message):?>
        <div class="<?if ($message["TYPE"] =="U") echo 'question'; else echo 'answer';?> user-message">
            <div class="user-message-header"><strong><?if ($message["TYPE"] =="U") echo $message["USER_NAME"]; else echo $message["EXPERT_NAME"]; ?></strong> <?=$message["DATE_CREATE"]?> <?if ($message["ACTIVE"] == "Y") echo 'прочитано';?></div>
            <div class="user-message-body"><?=$message["DETAIL_TEXT"]?></div>
            <?if ($message["TYPE"] =="U"):?>
            <img src="/bitrix/templates/<? echo SITE_TEMPLATE_ID;?>/images/hurt-red-question-details.png" align="right" width="21" />
            <?endif;?>
        </div>
        
        <?endforeach;?>
        
        <?$APPLICATION->IncludeComponent(
	"dotrusite:expert.chat.element.add",
	"",
	Array(
		"IBLOCK_TYPE" => "chat",
		"IBLOCK_ID" => "26",
		"STATUS_NEW" => "ANY",
		"LIST_URL" => "",
                  "EXPERT_ID" => $arResult["USER"]["ID"],
                  "SPECIAL_ID" => $arResult["USER"]["SPECIAL_ID"],
                  "CONVERSATION_DELIMETER" => $delim,
		"USE_CAPTCHA" => "N",
		"USER_MESSAGE_EDIT" => "Ваше сообщение успешно отправлено. Спасибо!",
		"USER_MESSAGE_ADD" => "Ваше сообщение успешно отправлено. Спасибо!",
		"DEFAULT_INPUT_SIZE" => "20",
		"RESIZE_IMAGES" => "N",
		"PROPERTY_CODES" => array(0=>"DETAIL_TEXT", 1=> "NAME", 2 => "PREVIEW_TEXT"),
		//"PROPERTY_CODES" => array(),
		"PROPERTY_CODES_REQUIRED" => array(0=>"DETAIL_TEXT"),
		"GROUPS" => array(0=>"2",),
		"STATUS" => "ANY",
		"ELEMENT_ASSOC" => "CREATED_BY",
		"MAX_USER_ENTRIES" => "100000",
		"MAX_LEVELS" => "100000",
		"LEVEL_LAST" => "Y",
		"MAX_FILE_SIZE" => "0",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
		"SEF_MODE" => "N",
		"CUSTOM_TITLE_NAME" => "",
		"CUSTOM_TITLE_TAGS" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "Вопрос коротко",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
		"CUSTOM_TITLE_DETAIL_TEXT" => "Сообщение",
		"CUSTOM_TITLE_DETAIL_PICTURE" => ""
	)
);?>
    </div>
    
</div>