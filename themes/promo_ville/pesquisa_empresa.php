<?php
 $search = $Link->getLocal()[1];
 $searchUrl = Check::Name($search);
?>
<article class="categoria">
  <div class="container cat_content">
      <h1 class="text-center">Sua pesquisa: <?= $search;?></h1>
       <ul>   
    <?php
       $getPage = (!empty($Link->getLocal()[2]) ? $Link->getLocal()[2] : 1);
       $Pager = new Pager(HOME.'/pesquisa_empresa/'.$searchUrl.'/');
       $Pager->ExePager($getPage,16);

       $empresas = new Read;
       $empresas->ExeRead("ws_users","WHERE user_id != 1 AND (user_name LIKE '%' :search '%') LIMIT :limit OFFSET :offset","search={$search}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}"); 
       if(!$empresas->getResult()):
            $Pager->ReturnPage();
            echo"<p>não funcionu</p>";
       else:
       foreach ($empresas->getResult() as $mv):
           extract($mv);
          $imagem  = (empty($user_cover) ? 'indisponivel.gif' : $user_cover);
    ?>
        <li>
            <a title="<?=$user_name; ?>" href="<?=HOME.'/empresa/'.$user_url; ?>">
                <img alt="<?= $user_name;?> "tiltle="<?= $user_name;?>" src="<?= HOME.'/tim.php?src='.HOME.'/uploads/'.$imagem.'&w=150&h=150&q=100'; ?>" class="img-responsive img-thumbnail">
            </a>
             <h2 class="cat_title"><?= Check::Words($user_name,3)?></h2> 
        </li>
    <?php
         endforeach;
       endif;
    ?>
     </ul>
      <nav class="paginator">
          <h1 class="fontZero">paginadoer de resultados</h1>
        <?php    
          $Pager->ExePaginator("ws_users","WHERE user_id != 1 AND (user_name LIKE '%' :search '%')","search={$search}");    
          echo $Pager->getPaginator();  
        ?>
    </nav>    
   </div> 
   
</article>
