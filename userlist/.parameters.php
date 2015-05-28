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
			"NAME" => "¬ыберите сайт, пользователей которого нужно вывести",
			"TYPE" => "LIST",
			"VALUES" => $arSites,
			"REFRESH" => "N",
		),
        "GROUPS" => array(
			"PARENT" => "BASE",
			"NAME" => "¬ыберите группы, которые нужно вывести",
			"TYPE" => "LIST",
			"VALUES" => $arGroups,
            "MULTIPLE"	=> "Y",
			"REFRESH" => "N",
		),
        "USER_LINK" => array(
			"PARENT" 	=> "BASE",
			"NAME" 		=> "—сылка страницы детального просмотра профил€",
			"TYPE" 		=> "STRING",
			"MULTIPLE"	=> "N",
			"DEFAULT"	=> "/needhelp/questions/#ID#/",
			"REFRESH"	=> "N",
		),
        "QUESTION_LINK" => array(
			"PARENT" 	=> "BASE",
			"NAME" 		=> "—сылка страницы задать вопрос",
			"TYPE" 		=> "STRING",
			"MULTIPLE"	=> "N",
			"DEFAULT"	=> "/needhelp/questions/question/#ID#/",
			"REFRESH"	=> "N",
		),
        "USERS_PER_PAGE" => Array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => " оличество пользователей на одной странице",
			"TYPE" => "STRING",
			"DEFAULT" => "20"),
	),
	
);
?>