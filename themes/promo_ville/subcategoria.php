 <?php 

 if($Link->getData()):
     extract($Link->getData());
 else:
     header('Location:'. HOME .'/404.php');
 endif;
 
?>
<article class="categoria">
  
  <div class="container cat_content">
      
      <h1 class="text-center">Sub Categoria:  <?= $category_title;?>:</h1>
       <ul>   
    <?php
     
       $getPage = (!empty($Link->getLocal()[2]) ? $Link->getLocal()[2] : 1);
       $Pager = new Pager(HOME.'/subcategoria/' .$category_name.'/');
       $Pager->ExePager($getPage, 10);
       
       //  ",}
       $subCat = new Read;
       $subCat->ExeRead("ws_posts","WHERE post_status = 1 AND post_category = {$category_id} LIMIT :limit OFFSET :offset","limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");    
       if(!$subCat->getResult()):
            $Pager->ReturnPage();
            echo"<p>não funcionu</p>";
       else:
       foreach ($subCat->getResult() as $mv):
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
      <nav class="paginator">
        <?php    
          $Pager->ExePaginator("ws_posts","WHERE  post_status = 1 AND post_category = {$category_id} ");    
          echo $Pager->getPaginator();  
        ?>
    </nav>    
   </div> 
   
</article>

