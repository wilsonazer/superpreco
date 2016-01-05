<?php 

 if($Link->getData()):
     extract($Link->getData());
 else:
     header('Location:'. HOME .'/404.php');
 endif;
 
?>
<nav class="container box_pes_empresa">
    <h1></h1>
    <?php 
    $pes_empresa = filter_input(INPUT_POST,'pesquisa_empresa', FILTER_DEFAULT);
    if(!empty($pes_empresa)):
      $pes_empresa = strip_tags(trim(urldecode($pes_empresa)));   
       header('Location:'.HOME.'/pesquisa_empresa/'.$pes_empresa);
      die;
    endif;
  ?>
    <form method="post" action="" class="navbar-form navbar-right" role="search">
        <div class="form-group">
            <input type="text" name="pesquisa_empresa" class="form-control" placeholder="Busque uma Empresa">
            <button type="submit" name="buscar" value="buscar" class="btn btn-primary">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </div><!-- Form group-->
   </form>
</nav>
<article class="categoria">

  <div class="container cat_content cat-con-empresas">
      
      <h1 class="text-center">Essas são todas as empresas cadastradas:</h1>
       <ul>   
    <?php
       $getPage = (!empty($Link->getLocal()[1]) ? $Link->getLocal()[1] : 1);
       $Pager = new Pager(HOME.'/empresas/');
       $Pager->ExePager($getPage, 16);

       $empresas = new Read;
       $empresas->ExeRead("ws_users","WHERE user_id != 1 ORDER BY user_name LIMIT :limit OFFSET :offset","limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");    
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
             <h2 class="cat_title"><i class="fa fa-flag-o"></i> <?= Check::Words($user_name,3)?></h2> 
        </li>
    <?php
         endforeach;
       endif;
    ?>
     </ul>
      <nav class="paginator">
          <h1 class="fontZero">paginadoer de resultados</h1>
        <?php    
          $Pager->ExePaginator("ws_users","WHERE user_id != 1");    
          echo $Pager->getPaginator();  
        ?>
    </nav>    
   </div> 
   
</article>

