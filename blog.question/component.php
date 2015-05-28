<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//echo"<pre>";print_r($arParams);echo"</pre>";

// ������������� ����
if (!isset($arParams["SITE_LID"])) {
    //���� �� ������, ��������� ���� �� ���������
    $lid = SITE_ID;
}else{
    $lid = $arParams["SITE_LID"];
}

// ������������� ���������� ������������ � ��������
$arParams["ELEMENT_ID"] = intval($arParams["~ELEMENT_ID"]);
$currentUserID = $USER->GetID();

if($arParams["ELEMENT_ID"] > 0 && $arParams["ELEMENT_ID"]."" != $arParams["~ELEMENT_ID"])
{
	ShowError(GetMessage("T_USER_DETAIL_NF"));
	@define("ERROR_404", "Y");
	if($arParams["SET_STATUS_404"]==="Y")
		CHTTP::SetStatus("404 Not Found");
	return;
}

    
if ($arParams["EXPERT"] == "Y")
{
    // ������ ���� ���������� ������������ � ��������
    $arTemp = $arParams["ELEMENT_ID"];
    $arParams["ELEMENT_ID"] = $currentUserID;
    $currentUserID = $arTemp;
}

// ��������� ���������� �������������� ���������� �������� � ������� ������������
if($arParams["ELEMENT_ID"] == $currentUserID)
{
    ShowError(GetMessage("T_USER_SAME"));
    return;
}

$filter = Array
(
    "UF_EXPERT_DOCTOR" => "1"
);

$rsUser = $USER->GetByID($arParams["ELEMENT_ID"]);
$arUser = $rsUser->Fetch();
//echo "<pre>"; print_r($arUser); echo "</pre>";

// ��������� ����������� ��������
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

$resUser["ID"] = $arUser["ID"];
$resUser["LAST_NAME"] = $arUser["LAST_NAME"];
$resUser["NAME"] = $arUser["NAME"];
$resUser["SECOND_NAME"] = $arUser["SECOND_NAME"];

if ($arParams["EXPERT"] == "N")
{
    // ���������� ����������, � ������� �������� ������
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
    $resUser["SPECIAL_ID"] = $USER->GetID();
}
else
{
    $resUser["SPECIAL_ID"] = $currentUserID; 
}

$resUser["EXPERT"] = $arParams["EXPERT"];


// ���������� ���� �� �������� � ������
$arResult["USER"] = $resUser;

// ����������� ���������� ��������� ����� ������������ �������� �������

$arSelect = Array("ID", "DETAIL_TEXT", "ACTIVE", "DATE_CREATE", "PREVIEW_TEXT");
$arFilter = Array("IBLOCK_ID"=>26, "?PREVIEW_TEXT" => sprintf("(%s) && (%s)",$resUser["ID"], $currentUserID));
$res = CIBlockElement::GetList(Array("created_date" => "ASC"), $arFilter, false, false, $arSelect);
$messages = array();
while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    $arData = array();
    
    // ������� ����������� ��������� (������� - ������������ ��� ������� : ������������)
    if (strpos($arFields["PREVIEW_TEXT"], ":"))
    {
        // ������������ ������� ��������
        $arData["TYPE"] = "U";
    }
    else
    {
        // ������� ������� ������������
        $arData["TYPE"] = "E";
    }
    
    $arData["EXPERT_NAME"] = $arUser["LAST_NAME"] . " " . $arUser["NAME"] . " " . $arUser["SECOND_NAME"];
    
    
    $sUser = CUser::GetByID($currentUserID);
    $urUser = $sUser->Fetch();
    
    $arData["USER_NAME"] = $urUser["LAST_NAME"]. " " . $urUser["NAME"] . " " . $urUser["SECOND_NAME"];
    
            
 $messages[] = array_merge($arFields, $arData);
}
$arResult["CHAT_MESSAGES"] = $messages;



$this->IncludeComponentTemplate();
?>