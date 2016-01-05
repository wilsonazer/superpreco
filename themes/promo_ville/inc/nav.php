 <nav id='cssmenu'>
        <h1 class="fontZero"><?='promoville '. $Link->getLocal()[0];?></h1>
    <div class="logo"><a href="<?= HOME;?>">Promoville</a></div>
    <div id="head-mobile"></div>
    <div class="button"></div>
    <ul>
    <li class='active'><a href='<?= HOME; ?>'>HOME</a></li>
    <li><a href='#'>CATEGORÌAS</a>
       <ul>
           <?php
        //lê as categoria do banco de dados
        $readCategoria = new Read;
        $readCategoria->ExeRead("ws_categories", "WHERE category_parent is null ORDER BY category_title");

        if(!$readCategoria->getResult()):
            echo'sem categorias aqui';
        else:   
            foreach ($readCategoria->getResult() as $categoria):
                extract($categoria)
       ?>
          <li><a title="" href="<?= HOME .'/categoria/'.$category_name; ?>"><?= $category_title;?></a>
                 <ul>
                    <?php
                     //lê as categoria do banco de dados
                     $readSubCat = new Read;
                    $readSubCat->ExeRead("ws_categories", "WHERE category_parent = {$category_id} ORDER BY category_title");
                     if(!$readSubCat->getResult()):
                         echo'Sem  Sub categorias aqui';
                     else:   
                         foreach ($readSubCat->getResult() as $sub):
                    ?>
                       <li><a title="" href="<?= HOME .'/subcategoria/'.$sub['category_name']; ?>"><?= $sub['category_title'];?></a></li>
                    <?php
                         endforeach;
                           endif;
                    ?>
                </ul>
          </li>
           <?php
                endforeach;
                  endif;
           ?>
   </ul>
</li>
 <li><a href="<?= HOME.'/maisvistos' ?>">MAIS VISTOS</a></li>
 <li><a href="<?= HOME.'/novas' ?>">NOVAS OFERTAS</a></li>
 <li><a href="<?= HOME.'/empresas' ?>">EMPRESAS</a></li>
<?php 
    $pesquisa = filter_input(INPUT_POST,'pesquisa', FILTER_DEFAULT);
    if(!empty($pesquisa)):
      $pesquisa = strip_tags(trim(urldecode($pesquisa)));    
      header('Location:'.HOME.'/pesquisa/'.$pesquisa);
      var_dump($pesquisa);
      die;
    endif;
  ?>
    <form method="post" action="" class="navbar-form navbar-right" role="search">
        <div class="form-group menu_principal">
            <input type="text" name="pesquisa" class="form-control" placeholder="Busque um Produto">
            <button type="submit" name="buscar" value="buscar" class="btn btn-primary">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </div><!-- Form group-->
   </form>
</ul>
</nav>