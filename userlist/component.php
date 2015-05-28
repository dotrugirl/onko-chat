<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//echo"<pre>";print_r($arParams);echo"</pre>";

// устанавливаем сайт с которого выводим пользователей
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

$arParams["USERS_PER_PAGE"] = (intVal($arParams["USERS_PER_PAGE"]) > 0 ? intVal($arParams["USERS_PER_PAGE"]) : 20);

$filter = Array
(
    "GROUPS_ID"                  => $group_array,
    "UF_EXPERT_DOCTOR" => "1"
    //"LID"                        => "s2"
    
);

//$arSelect["SELECT"] = array("*");

$rsUsers = CUser::GetList(($by="UF_SORT"), ($order="asc"), $filter, array("SELECT"=>array("UF_*"))); // выбираем пользователей
$is_filtered = $rsUsers->is_filtered; // отфильтрована ли выборка ?
$rsUsers->NavStart($arParams["USERS_PER_PAGE"]); // разбиваем постранично по 50 записей
echo $rsUsers->NavPrint(GetMessage("PAGES")); // печатаем постраничную навигацию

while($rsus = $rsUsers->NavNext(true, "f_")) :
	
    $arUsers[] = $rsus;
  
endwhile;

foreach ($arUsers as $User):
    foreach ($User as $key => $val)
{
        //var_dump($key);
    }
    if ($User['LID'] == $lid):

       $arUserNew['ID'] = $User['ID'];
       $arUserNew['NAME'] = $User['NAME'];
       $arUserNew['LAST_NAME'] = $User['LAST_NAME'];
       $arUserNew['SECOND_NAME'] = $User['SECOND_NAME'];
       $arUserNew['EDIT_LINK'] = str_replace(array("#ID#"), array($arUserNew['ID']),$arParams["USER_LINK"]);
       $arUserNew['QUESTION_LINK'] = str_replace(array("#ID#"), array($arUserNew['ID']),$arParams["QUESTION_LINK"]);
       
       // создаем тег изображения - фото пользователя
         if (intval($User["PERSONAL_PHOTO"]) > 0)
         {
           $imageFile = CFile::GetFileArray($User["PERSONAL_PHOTO"]);
             if ($imageFile !== false)
               {
                  $arUserNew['PHOTO_SRC'] = $imageFile["SRC"];
               }
         } 
         
         
         $arUserNew['WORK_POSITION'] = $User["WORK_POSITION"];
          $arUserNew['WORK_DEPARTMENT'] = $User["WORK_DEPARTMENT"];
       
    
    $arResult["USERS"][] = $arUserNew;
    endif;
endforeach;
//echo "<pre>"; print_r($arResult); echo "</pre>";


$this->IncludeComponentTemplate();
?>