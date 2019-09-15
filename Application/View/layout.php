<!DOCTYPE html>
<html>
  <head>
    <title>
      <?= 'De La Balle' ?>
    </title>
    
    <meta charset="utf-8" />
    
    <link rel="stylesheet" href="../Web/Css/Envision.css" type="text/css" />
  </head>
  
  <body>
    <div id="wrap">
      <header>
        <h1><a href="/">Cache en php</a></h1>
        <!-- <p>Comment ça, il n'y a presque rien ?</p> -->
      </header>
      
      <nav>
        <ul>
          <li><a href="/">Accueil</a></li>
          
        </ul>
      </nav>
      
      <div id="content-wrap">
        <section id="main">
          <!--?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?> -->
          
          <?= $content ?>
        </section>
      </div>
    
      <footer></footer>
    </div>
  </body>
</html>


