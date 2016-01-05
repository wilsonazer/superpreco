 <?php 
 if($Link->getData()):
    extract($Link->getData());
 else:
     header('Location:'. HOME .'/404.php');
 endif;
?>
<div class="container-fluid  empr_banner_theme_<?= $user_theme;?>">
 
    <article class="container">
	    <h1 class="hidden"><?= $user_name;?> em Joinville no <?= $user_bairro;?> </h1>
        <div class="row cont_banner_theme">
            <div class="col-lg-6 banner_theme_logo">
               
                <img src="<?= HOME. '/tim.php?src='.HOME.'/uploads/'.$user_cover.'&w=150$h=150';?>" class="img-rounded">
                 <h1 class="text-center"><i class="fa fa-money"></i> <?= $user_name; ?></h1>
            </div>
            <div class="col-lg-6 ba-th-lo_contato">
                <h3><i class="fa fa-phone"></i> Contato:</h3>
                 <ul> 
                <?php
                 $user_tel = explode(',', $user_telefone);

                 foreach ($user_tel as $tel):
                   echo '<li><strong>55 - '.$tel.'</strong></li>';  
                 endforeach;
                ?>
                     <p><i class="fa fa-envelope-o"></i> email:<?= $user_email; ?></p>
               
            </div>
       </div>      
    </article>
   
</div>
<article class="container single" itemscope itemtype="http://schema.org/Product">
     <h1>Ofertas <span class="hidden">em joinville no bairro <?= $user_bairro;?></span> <?= $user_name; ?></h1>
    <div class="row fgradientRoxo">
       
    <?php 
      $maisProdutos = new Read;
      $maisProdutos->ExeRead("ws_posts", "WHERE post_status = 1 AND post_author = :postAuthor ORDER BY post_preco","postAuthor={$user_id}");
       if($maisProdutos->getResult()):
           
         foreach ($maisProdutos->getResult() as $produto):
           
         ?>
            <div class="col-lg-3 col-xs-12">
               <div class="thumbnail"> 
                   <h2 class="text-center"><mark itemprop="name"><span class="hidden"> Comprar <span><?=$produto["post_title"]; ?></mark></h2>
                   <a itemprop="url" title="<?=$produto["post_title"]; ?>" href="<?=HOME.'/produto/'.$produto["post_name"]; ?>">
                      <img itemprop="image" title="<?=$produto["post_title"]; ?>" alt="<?=$produto["post_title"]; ?>" src="<?= HOME.'/tim.php?src='.HOME.'/uploads/'.$produto['post_cover'].'&w=350&h=300'; ?>" class="img-responsive">
                   </a>
                    <label class="label label-primary price">
                        <span class="glyphicon glyphicon-tag"></span><sup>R$</sup><span><?=$produto["post_preco"]; ?></span>
                    </label>
                    <label class="preco" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
					    <meta itemprop="priceCurrency" content="BRL" />
                        <h6><sup>R$</sup><span itemprop="price"><?=$produto["post_preco"]; ?></span></h6>
					
                    </label>
                    <div class="caption">
                        <h4 class="small fBlue"><?=  Check::Words($produto["post_content"],3);?></h4>
						  <span class="hidden" itemprop="description"><?= $produto["post_content"];?></span>
						  
                        <a data-width="292" href="http://www.facebook.com/sharer.php?u=<?='http://www.promoville.com/produto/camisa-do-santos-futebol-clube' ;?>" class="btn btn-primary">
                    <i class="fa fa-facebook-square"></i> Compartilhar</a>
                 
                  <a href="#myModal" role="button" class="btn btn-success" data-toggle="modal"><i class="fa fa-whatsapp"></i> whatsapp</a>
                  <div class="modal fade" id="myModal">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button class="close" data-dismiss="modal">&times;</button>
                                  
                                  <h4 class="modal-title text-center">Envie essa promoção para um amigo:</h4>
                              </div>
                              <div class="modal-body">
                                  <h4>por favor informe o telefone de seu amigo</h4>
                                   texto
                              </div>
                          </div>
                      </div>
                  </div><!--Fim Div Modal-->
                    </div>
            </div>
        </div>
    <?php
         endforeach;
         endif;
    ?>
    </div>
 
    </article>

<footer class="container-fluid empr_banner_theme_<?= $user_theme;?>" itemscope itemtype="https://schema.org/Organization">
   
    <div class="col-lg-4 empresa_endereco"itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
            <h1 itemprop="name"><i class="fa fa-money"></i> <?= $user_name;?></h1>
            <h3>Bairro: <?= $user_bairro; ?></h3>
            <h4 itemprop="streetAddress">Rua: <?= $user_endereco; ?></h4>
            <h5 itemprop="addressLocality">Joinville -sc </h5>
            
        </div>
        <div class="col-lg-4 empresa_contato">
            <h1><i class="fa fa-phone"></i> Contato:</h1>
              <ul> 
                <?php
                 foreach ($user_tel as $tel):
                   echo '<li><strong itemprop="telephone">55 - '.$tel.'</strong></li>';  
                 endforeach;
                ?>
              </ul>   
             <h1><i class="fa fa-envelope"></i> Email:</h1>
             <p itemprop="email"><?= $user_email;?></p>
             <p></p>
        </div>
      
        <div class="col-lg-4 empresa_localizacao">
            
            <h1><i class="fa fa-street-view"></i> localização empresa:</h1>
          <iframe src="https://<?= $user_mapa;?>"
                  width="75%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>

    </footer>
