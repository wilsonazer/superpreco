<?php 
ob_start();
require('./_app/Config.inc.php');
$Session = new Session;
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
       <meta charset="utf-8"/>
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <meta  name="robots" content="index, follow"/>
	   <link rel="shortcut icon" href="<?= HOME;?>'/uploads/promoville_ico.png'">
  
        <!--Meta Tags Dubli Core -->       
       <meta name="DC.Title" content="promoville joinville,promoções em joinville SC"/>
       <meta name="DC.Creator" content="join sistemas" />
       <meta name="DC.Subject" content="promoville joinville,promoções joinville,roupas,joias,mercado,bebidas,joias,brinquedos,carnes,maquiagens,roupas femininas,sapatos" />
       <meta name="DC.Description" content="promoville joinville as melhores pormoçoes, preços e descontos de joinville santa catarina,minhares de em produtos oferta" />
       <meta name="DC.Publisher" content="promoville joinville" />
       <meta name="DC.Contributor" content="join sistemas" />
       <meta name="DC.Date" content="2015<?= date('m')?>" />
       <meta name="DC.Type" content="Text" />
       <meta name="DC.Format" content="text/html" />
       <meta name="DC.Identifier" content=""/>
       <meta name="DC.Source" content="<?= HOME;?>" />
       <meta name="DC.Language" content="pt-br" />
       <meta name="DC.Relation" content="<?= HOME;?>" scheme="IsPartOf" />
       <meta name="DC.Coverage" content="Joinville,SC" />
       <meta name="DC.Rights" content="Copyleft 2015,Promoville joinville, Ltd. All rights reserved." />
        <?php 
           $Link = new Link;
           $Link->getTags();
         ?>
		 
		<meta name="alexaVerifyID" content="sjier3eVxj3qAj24y86mC4MpBz0"/>
		 
       <link rel="author" href="https://plus.google.com/106863818291324973616/posts"/>
       <link rel="publisher" href="https://plus.google.com/115769804640401638043"/>
       <link rel="canonical" href="<?= HOME ; ?>">
       <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-70684595-1', 'auto');
  ga('send', 'pageview');

</script>
    </head>
    <body>
        <?php
         Check::VerificaFimAnuncio();
        ?>
        <h1 class="hidden"> Promoville anuncio grátis, promoções e ofertas em Joinville SC</h1>
        
        <div class="navbar">
            <header class="navbar navbar-fixed-top">
                  <?php require './themes/promo_ville/inc/nav.php'; ?>
            </header>
        </div>
        
        <!-- Conteudo do site-->
           <?php  
      $Url[1] =  (empty($Url[1]) ? null : $Url[1]);
         if(file_exists(REQUIRE_PATH . DIRECTORY_SEPARATOR . $Url[0] .'.php')):
             require REQUIRE_PATH .DIRECTORY_SEPARATOR. $Url[0] .'.php';
        
           elseif(file_exists(REQUIRE_PATH .DIRECTORY_SEPARATOR. $Url[0].DIRECTORY_SEPARATOR. $Url[1])  ):
               require REQUIRE_PATH .DIRECTORY_SEPARATOR. $Url[0] .DIRECTORY_SEPARATOR. $Url[1].'.php';
           else:   
               require REQUIRE_PATH .DIRECTORY_SEPARATOR.'404.php';
         endif;  
      ?>
        <!-- fim conteudo site-->
        </div>
      
     <!--footer -->
           <?php require './themes/promo_ville/inc/footer.php'; ?>   
       <!--end footer -->
     <link rel="stylesheet" href="<?= HOME.'/css/bootstrap.css';?>"/>
     <link rel="stylesheet" href="<?= HOME.'/css/bootstrap-theme.min.css';?>">
     <link rel="stylesheet" href="<?= HOME.'/css/estilo.css';?>"> 
     <link rel="stylesheet" href="<?= HOME.'/css/animate.css';?>"/>
     <link rel="stylesheet" href="<?= HOME.'/css/hover-min.css';?>" media="all"/>
    <link rel="stylesheet" href="<?= HOME.'/_cdn/shadowbox/shadowbox.css';?>"/>
     
<!--   ********************  FONTES EXTERNAS  ******************** -->
      <link href='https://fonts.googleapis.com/css?family=Dancing+Script' rel='stylesheet' type='text/css'> 
      <link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
     
     <script src="<?= HOME.'/_cdn/jquery.js';?>"></script>
     <script src="<?= HOME.'/_cdn/bootstrap.min.js';?>"></script>
     <script src="<?= HOME.'/_cdn/shadowbox/shadowbox.js';?>"></script>
     <script src="<?= HOME.'/_cdn/index.js';?>"></script>
     <script src="<?= HOME.'/_cdn/cycle2.js';?>"></script>
     <script src="<?= HOME.'/_cdn/jquery.jcarousellite.min.js';?>"></script>
     <script src="<?= HOME.'/_cdn/jsCategoria.js';?>"></script>
     <script src="<?= HOME.'/_cdn/_plugins.conf.js';?>"></script>
     
  </body>
</html>
<?php
ob_end_flush();
?>