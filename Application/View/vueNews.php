<?php
        echo ('<p>hello world<p>');
        
        foreach($news as $donnee)
        {
            
        foreach($donnee as $donnees)
        {
            
           echo'<div class="news">
             <h3>'.$donnees.'</h3></div>';
            
           //echo'<div class="news">
            //<h3>'.$donnees[''].' : '.$value.'</h3></div>';
        }
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