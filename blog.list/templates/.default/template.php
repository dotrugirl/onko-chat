<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="chat-info">
        <?foreach ($arResult["CHAT_LIST"] as $item):?>
        <div class="question">
            <?if (!empty($item["EXPERT_PHOTO"])):?>
            <div class="chat-expert-photo"><img src="<?=$item["EXPERT_PHOTO"]?>" width="100" alt="<?=$item["EXPERT_NAME"]?>" title="<?=$item["EXPERT_NAME"]?>" /></div>
            <?endif?>
            <div class="chat-information">
            <div class="chat-header"><strong><?=$item["EXPERT_NAME"]?></strong></div>
            <div><?=GetMessage("BLG_LIST_DATE_CREATED")?>: <?=$item["DATE_CREATE"]?></div>
            <div><?=$item["LAST_MESSAGE_TEXT"]?></div>
            </div>
            <div class="right" style="clear: both;">
                <a href="<?=$item["MESSAGES_URL"]?>" style="color:#f6921e"><?=GetMessage("BLG_LIST_DETAILS")?></a>
                <a href="<?=$item["MESSAGES_URL"]?>"><img src="/bitrix/templates/<? echo SITE_TEMPLATE_ID;?>/images/hurt-red-question-details.png" align="right" width="21" style="margin-left: 10px;" /></a>
            </div>
        </div>
        <?endforeach;?>
</div>