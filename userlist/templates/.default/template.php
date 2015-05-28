<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?//echo "<pre>"; print_r($arResult); echo "</pre>";?>

<div class="user-list">
<?foreach ($arResult["USERS"] as $user):?>
<div class="user-list-item">
    <div class="motion" style="position: relative; height: 100%;">
        <?if (isset($user['PHOTO_SRC'])):?>
                <a href="<?=$user['EDIT_LINK']?>">
                    <img src="<?=$user['PHOTO_SRC']?>" width="100%" alt="<?=$user['LAST_NAME']?> <?=$user['NAME']?> <?=$user['SECOND_NAME']?>" title="<?=$user['LAST_NAME']?> <?=$user['NAME']?> <?=$user['SECOND_NAME']?>" />
                </a>
                <img class="corner widget-img" src="/bitrix/templates/<? echo SITE_TEMPLATE_ID;?>/images/corner-red-deep-16.png" width="16" align="left" style="position: absolute; top:0; left:0;"  />
        <?endif;?>
    <h3><a href="<?=$user['EDIT_LINK']?>"><?=$user['LAST_NAME']?><br /><?=$user['NAME']?> <?=$user['SECOND_NAME']?></a></h3>
    <p class="margins-vert-20"><?=$user['WORK_POSITION']?></p>
    <p><?=$user['WORK_DEPARTMENT']?></p>
    <div class="expert-ask-question">
            <a href="<?=$user["QUESTION_LINK"]?>">
                Задать вопрос 
                <img src="/bitrix/templates/<? echo SITE_TEMPLATE_ID;?>/images/hurt-dark-red-21.png" width="21" align="right" style="margin-left: 10px;">
            </a>
        </div>
</div>
</div>
<?endforeach;?>
</div>
