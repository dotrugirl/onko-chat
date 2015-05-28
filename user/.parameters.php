<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// достаем список сайтов
$rsSites = CSite::GetList($by="sort", $order="desc", Array());
while ($arSite = $rsSites->Fetch())
{
  $arSites[$arSite['LID']] = $arSite['LID'];
}


// достанем группы, которые есть на сайтах
$rsGroups = CGroup::GetList(($by="c_sort"), ($order="desc"), $filter); // выбираем группы
//$is_filtered = $rsGroups->is_filtered; // отфильтрована ли выборка ?
$rsGroups->NavStart(50); // разбиваем постранично по 50 записей
echo $rsGroups->NavPrint(GetMessage("PAGES")); // печатаем постраничную навигацию
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
            "GROUPS" => array(
                    "PARENT" => "BASE",
                    "NAME" => GetMessage("T_GROUPS_LIST_ID"),
                    "TYPE" => "LIST",
                    "VALUES" => $arGroups,
                    "MULTIPLE"	=> "Y",
                    "REFRESH" => "N",
            ),
            "ELEMENT_ID" => array(
                    "PARENT" => "BASE",
                    "NAME" => GetMessage("T_ELEMENT_ID"),
                    "TYPE" => "STRING",
                    "DEFAULT" => '={$_REQUEST["ELEMENT_ID"]}',
            ),
            "QUESTION_LINK"  => array(
			"PARENT" 	=> "BASE",
			"NAME" 		=> GetMessage("T_QUESTION_LINK"),
			"TYPE" 		=> "STRING",
			"MULTIPLE"	=> "N",
			"DEFAULT"	=> "/needhelp/questions/question/#ID#",
			"REFRESH"	=> "N",
		),
    )
);
?>