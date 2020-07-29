<?php
function getPattern($option = ''){
  return '{' . $option .  preg_quote(config('app.url')) . '[-\w./?%&=;]*}';
}


function innerLink($content){
  $pattern = getPattern();

  $inner_link =  preg_replace_callback(
    $pattern,
    function($matches){
      return '<a href="' . $matches[0] . '">' . $matches[0] . '</a>';
    },
    $content
  );

  return $inner_link;
}

function str_limit_plus($str, $limit = 100, $end = '...'){
  $pattern = getPattern();

  if( mb_strlen($str) <= $limit){
    return innerLink($str);
  }else{
    return rtrim(mb_substr($str, 0, $limit)) . $end;
  }
}

function str_limit_mail($str, $limit = 100, $end = '...'){
  $pattern = getPattern('^');

  if( mb_strlen($str) >= $limit ){
    if(!preg_match($pattern, $str, $matches)){
      $str = str_ireplace('http', 'h ttp', rtrim(mb_substr($str, 0, $limit)));
    }elseif(mb_strlen($matches[0]) < mb_strlen($str)){
      $str = $matches[0];
    }

    $str .= $end;
  }

  return $str;
}
