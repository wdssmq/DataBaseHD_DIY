<?php

// 注册函数名须匹配 DataBaseHD_DIY_文件名_Register
function DataBaseHD_DIY_DelPostByConLess_Register(&$fnList)
{
  $fnList[] = array("fn" => "DataBaseHD_DIY_DelPostByConLess_Post", "mod" => "Post", "name" => "删除没内容的文章");
  // 可注册多条，虽然 Post 之外的表可能还没封装 /doge
  // $fnList[] = array("fn" => "DataBaseHD_DIY_DelPostByConLess_Tag", "mod" => "Tag", "name" => "处理 Tag 表");
}

// 建议函数名 DataBaseHD_DIY_文件名_功能标识
// 与上边 array("fn" => "XXX", ……) 中的 XXX 匹配即可
function DataBaseHD_DIY_DelPostByConLess_Post(&$post)
{
  $tpl = "<p style='color:-color-;'>-id- 丨 -url- 丨 -title- | 删除： -del-</p>\n";

  $arrData = array();
  $arrData["-color-"] = "-black-";
  $arrData["-id-"] = $post->ID;
  $arrData["-url-"] = $post->Url;
  $arrData["-title-"] = $post->Title;
  $arrData["-del-"] = "No";

  $content = FormatString($post->Content, "[nohtml]");

  $len = mb_strlen($content, "utf-8");

  if ($len < 10) {
    $arrData["-color-"] = "red";
    $arrData["-del-"] = "Yes";
    $post->Del();
  }

  echo strtr($tpl, $arrData);
}
