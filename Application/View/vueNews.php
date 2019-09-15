<?php
        //echo ('<p>hello world<p>');
        /*
        foreach($news as $donnee)
        {
            
        foreach($donnee as $donnees => $value)
        {
            
           echo'<div class="news">
             <h3>'.$donnees.' : '.$value.'</h3></div>';
            
           //echo'<div class="news">
            //<h3>'.$donnees[''].' : '.$value.'</h3></div>';
        }
        }
        
        */

        foreach ($news as $news)
        {
          ?>
          <h2><a href="news-<?= $news['id'] ?>.html"><?= $news['titre'] ?></a></h2>
          <p><?= nl2br($news['contenu']) ?></p>
          <?php
        } 

        
        /*
        while ($donnees = $news)//$selection->fetch(PDO::FETCH_ASSOC))
        {
            echo'<div class="news">
                <h3>'.$donnees['titre'].'</h3>
                <h4>'.$donnees['auteur'].'</h4>
                le ',$donnees['dateAjout'].'<br />';
            
            echo($donnees['contenu']).'</div>';
        }
        */