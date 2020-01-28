<?php

/*

foreach ($news as $news)
        {
          ?>
          <h2><a href="news-<?= $news['id'] ?>.html"><?= $news['titre'] ?></a></h2>
          <p><?= nl2br($news['contenu']) ?></p>
          <?php
        }
*/

/*
foreach($news[] as $new => $value)
{
    //$test = $news->{$news}->$value;
    $new -> $value;
    
    return;
}
*/

foreach($news as $new)
{

    
    foreach($new as $content)
    {
        
        echo '<p>'.$content .'</p>';
        
    }
   
}


if($new instanceof NewsModel)
{
    echo 'c est juste';
}
else
{
    echo 'c est faux';
}