<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//echo"<pre>";print_r($arParams);echo"</pre>";

// устанавливаем сайт
if (!isset($arParams["SITE_LID"])) {
    //сайт не выбран, установим сайт по умолчанию
    $lid = SITE_ID;
}else{
    $lid = $arParams["SITE_LID"];}

$group_array = $arParams["GROUPS"];

foreach ($arParams["GROUPS"] as $group ):
    
    $arGroup = CGroup::GetByID($group, "Y")->Fetch(); 
    $arResult["GROUPS"][$arGroup['ID']] = $arGroup['NAME'];

endforeach;

$arParams["ELEMENT_ID"] = intval($arParams["~ELEMENT_ID"]);

if($arParams["ELEMENT_ID"] > 0 && $arParams["ELEMENT_ID"]."" != $arParams["~ELEMENT_ID"])
{
	ShowError(GetMessage("T_USER_DETAIL_NF"));
	@define("ERROR_404", "Y");
	if($arParams["SET_STATUS_404"]==="Y")
		CHTTP::SetStatus("404 Not Found");
	return;
}

$filter = Array
(
    "GROUPS_ID"                  => $group_array,
    "UF_EXPERT_DOCTOR" => "1"
);

$rsUser = $USER->GetByID($arParams["ELEMENT_ID"]);
$arUser = $rsUser->Fetch();
//echo "<pre>"; print_r($arUser); echo "</pre>";

if($arUser["ACTIVE"] == "N")
{
	ShowError(GetMessage("T_USER_NOT_ACTIVE"));
	return 0;
}

if ($arUser['LID'] != $lid)
{
        ShowError(GetMessage("T_USER_NOT_ON_SITE"));
        return 0;
}

$resUser = array();

$resUser["LAST_NAME"] = $arUser["LAST_NAME"];
$resUser["NAME"] = $arUser["NAME"];
$resUser["SECOND_NAME"] = $arUser["SECOND_NAME"];
$resUser["WORK_POSITION"] = $arUser["WORK_POSITION"];
$resUser["WORK_DEPARTMENT"] = $arUser["WORK_DEPARTMENT"];
$resUser["WORK_PROFILE"] = $arUser["WORK_PROFILE"];
$resUser["QUESTION_LINK"] = str_replace(array("#ID#"), array($arUser['ID']),$arParams["QUESTION_LINK"]);

// определяем учреждение, в котором работает доктор
$res = CIBlockSection::GetByID($arUser["UF_HELPER_OFFICE"]);
$section = $res->GetNext();

if (isset($section["NAME"])) {
    $resUser["CLINIC_NAME"] = $section["NAME"];
}

if (intval($arUser["PERSONAL_PHOTO"]) > 0)
{
  $imageFile = CFile::GetFileArray($arUser["PERSONAL_PHOTO"]);
    if ($imageFile !== false)
      {
         $resUser['PHOTO_SRC'] = $imageFile["SRC"];
      }
} 

$arResult["USER"] = $resUser;

$this->IncludeComponentTemplate();
?>