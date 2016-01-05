<?php 
 if($Link->getData()):
    extract($Link->getData());
 
    $empresaInfo = new Read;
    $empresaInfo->ExeRead("ws_users","WHERE user_id = {$post_author}");
    if(!$empresaInfo->getResult()):
           WSErro("Erro",WS_ERROR);  
        else:
        foreach ($empresaInfo->getResult() as $empInfo):
         extract($empInfo);
         endforeach;
     endif; 
     
 else:
     header('Location:'. HOME .'/404.php');
 endif;
?>
<div class="container-fluid  empr_banner_theme_<?= $user_theme;?>">
    <article class="container">
        <div class="row cont_banner_theme">
            <div class="col-lg-6 banner_theme_logo">
               
                <img src="<?= HOME. '/tim.php?src='.HOME.'/uploads/'.$user_cover.'&w=150$h=150';?>" class="img-rounded">
                 <h1 class="text-center"><i class="fa fa-money"></i> <?= $user_name; ?></h1>
            </div>
            <div class="col-lg-6 contato_produto">
                <h3><i class="fa fa-phone"></i> Contato:</h3>
                 <ul> 
                <?php
                 $user_tel = explode(',', $user_telefone);

                 foreach ($user_tel as $tel):
                   echo '<li><i class="icon-hand-right"><strong></i> 55 -'.$tel.'</strong></li>';  
                 endforeach;
                ?>
                </ul>     
                     <p><i class="fa fa-envelope-o"></i> email:<?= $user_email; ?></p>
                 
            </div>
       </div>      
    </article>
   
</div>
<article class="container single" itemscope itemtype="http://schema.org/Product">
    
    <h1 class="fontZero"> ofertas <?= $user_name; ?></h1>
    <header class="row">
         
    </header>
    
    <section class="row">
        <br/>
        <div class="thumbnail  img-thumbnail col-lg-7">
            <h2 class="text-center"><mark itemprop="name"><?= $post_title ?></mark></h2> 
            <img rel="shadowbox" itemprop="image" title="<?= $post_title; ?>" alt="<?= $post_title; ?>" src="<?= HOME .'/tim.php?src='.HOME.'/uploads/'.$post_cover.'&w=350&h=300&q=100' ;?>" class="img-responsive"/>
            <ul>
            <?php 
            $readLogo = new Read;
            $readLogo->ExeRead("ws_posts_gallery", "WHERE post_id = :postid","postid={$post_id} LIMIT=5");
            if($readLogo->getResult()):
                $gbCont =0;
                foreach ($readLogo->getResult() as $logo):
                    extract($logo);
                    $gbCont +=1;
            ?>
                <li>
                    <a href="<?= HOME .'/uploads/'.$gallery_image;?>" rel="shadowbox[<?= $post_id?>]" title="<?=$post_title . ' '. $gbCont;?>">
                     <img title="<?= $post_title;?>" alt="<?= $post_title;?>" src="<?= HOME .'/tim.php?src='.HOME.'/uploads/'.$gallery_image.'&w=60&h=60&q=80' ;?>" class="img-responsive"/>  
                   </a>
              </li>
         <?php
            endforeach;
            endif;
         ?>   
            </ul>
             <label class="label label-primary price">
                   <span class="glyphicon glyphicon-tag"></span><sup>R$ </sup><span><?= number_format($post_preco,2,',','.'); ?></span>
             </label>
           <div class="caption" >
               <h3 class="fBlue" itemprop="description"><?= $post_content; ?></h3>
               <span itemprop="url" class="hidden"><?= HOME.'/produto/'.$post_cover;?></span>
                  <h3 class="fRed">Gostou dessa oferta ?<br/>
                  Compartilhe com seus amigos!</h3>
               <a  href="http://www.facebook.com/sharer.php?u=<?= HOME.'/'.$post_name.'&t='.$post_title ;?>" class="btn btn-primary">
                    <i class="fa fa-facebook-square"></i> Compartilhar oferta</a>
                 
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
       
        
    </section>
    <section class="row fgradientRoxo">
        <h1> <span class="glyphicon glyphicon-bullhorn bi" itemprop="headline"></span> Mais Ofertas <?= $user_name; ?></h1>
    <?php 
      $maisProdutos = new Read;
      $maisProdutos->ExeRead("ws_posts", "WHERE post_status = 1 AND post_author = :postAuthor AND post_id <> {$post_id} ORDER BY post_date DESC","postAuthor={$post_author}");
       if($maisProdutos->getResult()):
           
         foreach ($maisProdutos->getResult() as $produto):
           
         ?>
            <div class="col-lg-3 col-xs-12">
               <div class="thumbnail"> 
                   <h2 class="text-center"><mark itemprop="name"><?=$produto["post_title"]; ?></mark></h2>
                   <a itemprop="url" title="<?=$produto["post_title"]; ?>" href="<?=HOME.'/produto/'.$produto["post_name"]; ?>">
                      <img itemprop="image" title="<?=$produto["post_title"]; ?>" alt="<?=$produto["post_title"]; ?>" src="<?= HOME.'/tim.php?src='.HOME.'/uploads/'.$produto['post_cover'].'&w=350&h=300'; ?>" class="img-responsive">
                   </a>
           
                   <label class="label label-primary price">
                     <span class="glyphicon glyphicon-tag"></span><sup>R$</sup><span><?=$produto["post_preco"]; ?></span>
                    
                    </label>
            
                    <label class="preco">
                        <h6><sup>R$</sup><?=$produto["post_preco"]; ?></h6>
                    </label>
                    <div class="caption">
                        <h4 class="small fBlue" itemprop="description"><?=  Check::Words($produto["post_content"],4);?></h4>
                        <a itemprop="url" data-width="292" href="http://www.facebook.com/sharer.php?u=<?= HOME.'/'.$produto["post_name"].'&t='.$produto["post_title"] ;?>" class="btn btn-primary">
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
    </section>
 
    </article>

<footer class="container-fluid empr_banner_theme_<?= $user_theme;?>" itemscope itemtype="https://schema.org/Organization">
   
    <div class="col-lg-4"itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
            <h1 itemprop="name"><?= $user_name;?></h1>
            <h2>Endereço:</h2>
            <h3>Bairro: <?= $user_bairro; ?></h3>
            <h4 itemprop="streetAddress">Rua: <?= $user_endereco; ?></h4>
            <h5 itemprop="addressLocality">Joinville -sc </h5>
            
        </div>
        <div class="col-lg-4">
            <h1>Contato:</h1>
              <ul> 
                <?php
                 foreach ($user_tel as $tel):
                   echo '<li><strong itemprop="telephone">55 - '.$tel.'</strong></li>';  
                 endforeach;
                ?>
              </ul>   
             <h1>Email:</h1>
             <p itemprop="email"><?= $user_email;?></p>
             <p></p>
        </div>
      
        <div class="col-lg-4">
            
            localização empresa
            <p class="fontZero" itemprop="description">Descrição da empresa</p>
        </div>

    </footer>
