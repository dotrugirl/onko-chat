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
                    "NAME" => GetMessage("T_SITE_ID"),
                    "TYPE" => "LIST",
                    "VALUES" => $arSites,
                    "REFRESH" => "N",
            ),
            "ELEMENT_ID" => array(
                    "PARENT" => "BASE",
                    "NAME" => GetMessage("T_ELEMENT_ID"),
                    "TYPE" => "STRING",
                    "DEFAULT" => '={$_REQUEST["ELEMENT_ID"]}',
		),
            "EXPERT" => array(
                    "PARENT" => "BASE",
                    "NAME" => GetMessage("T_EXPERT"),
                    "TYPE" => "STRING",
                    "DEFAULT" => 'N',
		),
    )
);
?>