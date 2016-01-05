<?php
 $search = $Link->getLocal()[1];
 $count = $Link->getData()['count'] ? $Link->getData()['count'] : '0' ;
 
 ?>
<article class="categoria">
  
  <div class="container cat_content">
      
       <h1>Produto Pesquisado : <?= $search; ?></h1>
       <h2>Sua Pesquisa por  <strong><?= $search; ?> </strong>: Retornou  <?= $count; ?> Resultado(s).</h2>
       <ul>   
    <?php
     $getPager = (!empty($Link->getLocal()[2]) ? $Link->getLocal()[2] : 1);
     $Pager = new Pager(HOME .'/pesquisa/'.$search .'/');
     $Pager->ExePager($getPager, 10);
     
     $readPes = new Read();
     $readPes->ExeRead("ws_posts", "WHERE post_status = 1 AND (post_title LIKE '%' :link '%' OR post_content LIKE '%' :link '%')ORDER BY post_preco LIMIT :limit OFFSET :offset", "link={$search}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
    
     if(! $readPes->getResult()):
         
         $Pager->ReturnPage();
         echo'<p class="alert alert-info">Desculpe sua pesquisa não retornou Resultados!</p>';
      
     else:
         foreach ($readPes->getResult() as $pes):
             extract($pes);
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
      <nav class="paginator">
        <?php    
          $Pager->ExePaginator("ws_posts","WHERE post_status = 1 ORDER BY post_views");    
          echo $Pager->getPaginator();  
        ?>
    </nav>    
   </div> 
   
</article>

