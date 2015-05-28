<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// ������� ������ ������
$rsSites = CSite::GetList($by="sort", $order="desc", Array());
while ($arSite = $rsSites->Fetch())
{
  $arSites[$arSite['LID']] = $arSite['LID'];
}


// �������� ������, ������� ���� �� ������
$rsGroups = CGroup::GetList(($by="c_sort"), ($order="desc"), $filter); // �������� ������
//$is_filtered = $rsGroups->is_filtered; // ������������� �� ������� ?
$rsGroups->NavStart(50); // ��������� ����������� �� 50 �������
echo $rsGroups->NavPrint(GetMessage("PAGES")); // �������� ������������ ���������
while($rsgrs = $rsGroups->NavNext(true, "f_")) :
	if ($rsgrs['ID']!== "1")
    $arGroups[$rsgrs['ID']] = "[".$rsgrs['ID']."] ".$rsgrs['NAME'];	
endwhile;



$arComponentParameters = array(
	"GROUPS" => array(),
	"PARAMETERS" => array(
		"SITE_LID" => array(
			"PARENT" => "BASE",
			"NAME" => "�������� ����, ������������� �������� ����� �������",
			"TYPE" => "LIST",
			"VALUES" => $arSites,
			"REFRESH" => "N",
		),
        "GROUPS" => array(
			"PARENT" => "BASE",
			"NAME" => "�������� ������, ������� ����� �������",
			"TYPE" => "LIST",
			"VALUES" => $arGroups,
            "MULTIPLE"	=> "Y",
			"REFRESH" => "N",
		),
        "USER_LINK" => array(
			"PARENT" 	=> "BASE",
			"NAME" 		=> "������ �������� ���������� ��������� �������",
			"TYPE" 		=> "STRING",
			"MULTIPLE"	=> "N",
			"DEFAULT"	=> "/needhelp/questions/#ID#/",
			"REFRESH"	=> "N",
		),
        "QUESTION_LINK" => array(
			"PARENT" 	=> "BASE",
			"NAME" 		=> "������ �������� ������ ������",
			"TYPE" 		=> "STRING",
			"MULTIPLE"	=> "N",
			"DEFAULT"	=> "/needhelp/questions/question/#ID#/",
			"REFRESH"	=> "N",
		),
        "USERS_PER_PAGE" => Array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => "���������� ������������� �� ����� ��������",
			"TYPE" => "STRING",
			"DEFAULT" => "20"),
	),
	
);
?>