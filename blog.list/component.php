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

// ������������ ���������� � ������� �����
$isUserExpert = false;
// ����� �� �������� ���������
$objCurUser = CUser::GetByID($USER->GetID());
$curUser = $objCurUser->Fetch();
if ($curUser["UF_EXPERT_DOCTOR"] == 1)
{
    $isUserExpert = true;
}

$chatList = array();

if ($isUserExpert)
{
    // ������� �� ����������� ��������������� ������ �� ���� �������������, ��� ������ ��� �������
    $arFilter = Array("IBLOCK_ID"=>26, "?PREVIEW_TEXT" => sprintf("%s:", $USER->GetID()));
    $res = CIBlockElement::GetList(Array(), $arFilter, Array("PREVIEW_TEXT"), false);
    $conversWith = array();
    while ($ob = $res->GetNextElement()) 
    {
        $tmpFields = $ob->GetFields();
        $conversWith[] = str_replace($USER->GetID() . ":", "", $tmpFields["PREVIEW_TEXT"]);
    }
    arsort($conversWith); // ��������� �������������� ������������� � �������� �������, ����� ������ ������������������ � �����
    
    // ������ ������� �� ������ � �� ��������� � ������� ���������
    foreach ($conversWith as $userID)
    {
        $objUser = $USER->GetByID($userID);
        $artUser = $objUser->Fetch();
        //echo "<pre>"; print_r($artUser); echo "</pre>";
        
        $arFilter = Array("IBLOCK_ID"=>26, "?PREVIEW_TEXT" => sprintf("(%s) && (%s)",$USER->GetID(), $userID));
        $currentChat = getMessagesForUser($arFilter, $artUser);
        if (!empty($currentChat))
       {
           $currentChat["MESSAGES_URL"] = "/helpers/questions/answer/" . $userID . "/";
           $chatList[] = $currentChat;
       }
    }// foreach $userID
}
else
{
    // ���������� ��� ��� ����������� � ������
    $urlPath = "needhelp";
    if (strpos($APPLICATION->GetCurDir(),"helpers") !== false)
    {
        $urlPath = "helpers";
    }
    // ������ ������� �� ��������� � �� ��������� � ������� �������������
    $objExpertList = CUser::GetList(($by="LAST_NAME"), ($order="asc"), array("GROUPS_ID"=>7, "UF_EXPERT_DOCTOR" => 1));

    while ($arUser = $objExpertList->Fetch()) 
    {
        // ���� �� ������� �������� � ������� ���� �� � ��� ���������
       $arFilter = Array("IBLOCK_ID"=>26, "?PREVIEW_TEXT" => sprintf("(%s) && (%s)",$arUser["ID"], $USER->GetID()));
       $currentChat = getMessagesForUser($arFilter, $arUser);
       if (!empty($currentChat))
       {
           $currentChat["MESSAGES_URL"] = "/".$urlPath."/questions/question/" . $arUser["ID"] . "/";
           $chatList[] = $currentChat;
       }
    }
}//$isUserExpert

$arResult["CHAT_LIST"] = $chatList;

function getMessagesForUser($arFilter, $arUser)
{
    $arSelect = Array("ID", "DATE_CREATE", "DETAIL_TEXT");
    $res = CIBlockElement::GetList(Array("created" => "DESC"), $arFilter, false, Array("nTopCount"=>1), $arSelect);
       $ob = $res->GetNextElement();
       if (!empty($ob))
       {
           $arFields = $ob->GetFields();
           $expPhoto = null;
           // ������� ��� ����������� - ���� ������������
            if (intval($arUser["PERSONAL_PHOTO"]) > 0)
            {
              $imageFile = CFile::GetFileArray($arUser["PERSONAL_PHOTO"]);
                if ($imageFile !== false)
                  {
                     $expPhoto = $imageFile["SRC"];
                  }
            } 
           $chatList = array(
               "EXPERT_ID" => $arUser["ID"],
               "EXPERT_NAME" => $arUser["LAST_NAME"] . " " . $arUser["NAME"] . " " . $arUser["SECOND_NAME"],
               "DATE_CREATE" => $arFields["DATE_CREATE"],
               "EXPERT_PHOTO" => $expPhoto,
               "LAST_MESSAGE_TEXT" => $arFields["DETAIL_TEXT"]
           );
       }
       return $chatList;
}


$this->IncludeComponentTemplate();
?>