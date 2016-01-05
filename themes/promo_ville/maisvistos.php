<?php 

 if($Link->getData()):
     extract($Link->getData());
 else:
     header('Location:'. HOME .'/404.php');
 endif;
 
?>
<article class="categoria">
  
  <div class="cat_content container">
      
      <h1 class="text-center">Essas são nossas ofertas mais visualizadas:</h1>
       <ul>   
    <?php
       $getPage = (!empty($Link->getLocal()[1]) ? $Link->getLocal()[1] : 1);
       $Pager = new Pager(HOME.'/maisvistos/');
       $Pager->ExePager($getPage, 10);

       $maisVistos = new Read;
       $maisVistos->ExeRead("ws_posts","WHERE post_status = 1 ORDER BY post_views DESC LIMIT :limit OFFSET :offset","limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");    
       if(!$maisVistos->getResult()):
            $Pager->ReturnPage();
            echo"<p>não funcionu</p>";
       else:
       foreach ($maisVistos->getResult() as $mv):
           extract($mv);
    ?>
        <li>
            <a title="<?=$post_title; ?>" href="<?=HOME.'/produto/'.$post_name; ?>">
                <img alt="<?= $post_title;?> "tiltle="<?= $post_title;?>" src="<?= HOME.'/tim.php?src='.HOME.'/uploads/'.$post_cover.'&w=220&h=220&q=100'; ?>" class="img-responsive">
            </a>
             <h2 class="cat_title"><?= Check::Words($post_title,2)?></h2> 
             <div class="cat_preco">R$ <?= number_format($post_preco,2,',','.')?></div> 
             <div class="rating">
                 <small>(<?= $post_views;?>)</small> <i class="fa fa-eye"></i><small> visualizações</small>
             </div>
        </li>
    <?php
         endforeach;
       endif;
    ?>
     </ul>
     
   </div> 
   
</article>
<div class="container">
 <nav class="paginator ">
        <?php    
          $Pager->ExePaginator("ws_posts","WHERE post_status = 1 ORDER BY post_views");    
          echo $Pager->getPaginator();  
        ?>
    </nav>    
</div>