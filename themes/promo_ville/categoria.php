<?php 

 if($Link->getData()):
    extract($Link->getData());
 else:
     header('Location:'. HOME .'/404.php');
 endif;
 
?>

<article class="categoria">
   <!--   ____________                Lê categorias no banco __________________        -->     
      <?php 
       $subCategory = new Read;
       $subCategory->ExeRead("ws_categories", "WHERE category_parent = {$category_id} ");

            if(!$subCategory->getResult()):
             
            else:   
                foreach (  $subCategory->getResult() as $subcat):
                    extract($subcat);
           ?>
 <!--      Lê Sub Categorias no banco         -->
 <div class="container cat_content">
       <h1 class="text-center"> Categoria <?= $category_title;?>:</h1>
     <ul>
        <?php 
           $sub = new Read;
           $sub->ExeRead("ws_posts", "WHERE post_category = {$category_id} ORDER BY post_preco");

                if(!$sub->getResult()):
                  
                else:   
                    foreach ($sub->getResult() as $s):
                        extract($s);
               ?>
            <li>
               <a title="<?=$post_title; ?>" href="<?=HOME.'/produto/'.$post_name; ?>">
                   <img alt="<?= $post_title;?>" tiltle="<?= $post_title;?>" src="<?= HOME.'/tim.php?src='.HOME.'/uploads/'.$post_cover.'&w=220&h=220&q=100'; ?>" class="img-responsive">
               </a>
                <div class="cat_title"><?= Check::Words($post_title,2)?></div> 
                <div class="cat_preco">R$ <?= number_format($post_preco,2,',','.')?></div> 
                <div class="rating">
                    <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span class="post_views">(<?= $post_views;?>)</span>
                </div>
            </li>
	   
                
        <?php 
              endforeach;
          endif;
        ?>
           
        </ul>  
 </div>   
       <?php 
          endforeach;
      endif;
       ?>

 

</article>