<div class="container-fluid contem_contato">
    <section class="container contato">
        <h1 class="animated bounceInRight">Quer anunciar com a Promiville? <strong class="hvr-pulse-grow"><a href=""> É GRÁTIS </a></strong></h1>
        <div class="col-lg-8">
            
        </div>
        <div class="col-lg-4">
             <h2 class="animated bounceInLeft">
            <a href="https://www.facebook.com/promoville.joinville" rel="nofollow" target="blanck" title="promoville-joinville facebook"><span class="face hvr-bob"><i class="fa fa-facebook"></i> Promoville</span></a>
            </h2>
        </div>
       
    </section>
</div>
<section class="container-fluid topo">
    <div class="container topo_container">
        
         <h1 class="animated flip"><i class="fa fa-map-marker"></i> Deseja buscar ofertas em CIDADE ? Não! Busque outra cidade:</h1>
         
        <div class="col-lg-6">
           <div class="col-lg-6 col-sm-6 col-xs-12">
               <select class="form-control">
                 <option disabled="disabled" selected="selected">Um Estado</option>
                 <?php 
                   $estados = new Read;
                   $estados->ExeRead("ws_estados");
                    if(!$estados->getResult()):
                        echo 'Nada encotrado amigo!';
                    else:
                    foreach ($estados->getResult() as $es):
                     
                 ?>
                 <option><?= $es['nome']?></option>
                 
                 <?php
                     endforeach;
                    endif;
                 ?>
             </select>
           </div>  
           <div class="col-lg-6 col-sm-6 col-xs-12">
             <select class="form-control">
                <option disabled="disabled" selected="selected">Escolha Uma Cidade</option>
                <option>Monte Carmelo</option>
             </select>
          </div> 
        </div>   
        
         <div class="col-lg-6">
             <div class="input-group">
            <div class="input-group-btn">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-search"></i> <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="#"></a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
            </div><!-- /btn-group -->
            <input type="text" class="form-control" aria-label="...">
        </div><!-- /input-group -->
         </div>
 
    </div>
</section>
<div class="container">
    <article class="row contem_sl_es" id="tilp" itemscope itemtype="http://schema.org/Article">
        <h1 class="fontZero" itemprop="headline">Últimos produtos em Promoção em Joinville SC</h1>
        <div class="col-lg-5 slide">
            <h2>Ofertas recentes</h2>
            <div class="cycle-slideshow" data-cycle-fx="tileBlind" data-cycle-slides="> div" data-cycle-timeout="6000" data-cycle-tile-vertical=false>
                <span class="cycle-pager"></span>
                <?php
                $b = new Read;
                $b->ExeRead("ws_posts", "Where post_status=1 ORDER BY post_date LIMIT 10");
                if ($b->getResult()):
                    foreach ($b->getResult() as $slide):
                        extract($slide);
                        ?>
                        <div class="slide_contem">
                            <a title="<?= $post_title; ?>" href="<?= HOME . '/produto/' . $post_name; ?>" itemprop="alternativeHeadline">
                                <img itemprop="image" alt="<?= $post_title; ?>"  src="<?= HOME . '/tim.php?src=' . HOME . '/uploads/' . $post_cover . '&w=470&h=370'; ?>" class="img-responsive">
                                <div class="slide_legenda">
                                    <h4><sup>R$ </sup><?= number_format($post_preco, 2, ',', '.'); ?></h4>
                                    <span class="hidden" itemprop="description"> <?= $post_content ?> </h3>
                                        <meta itemprop="datePublished" content="<?= $post_date; ?>"/>
                                </div>
                                <div class="slide_hover">
                                    <span class="titulo animated jello"> <?= $post_title; ?> </span>
                                    <span class="preco animated zoomInUp">R$ <?= number_format($post_preco, 2, ',', '.'); ?></span>
                                </div>
                            </a>
                        </div>
                        <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
        <h1 class="titulo_especiais">Espaços Especiais</h1>
        <aside class="col-lg-7 home_aside hidden-xs">
            <ul>
                <li>
                    <div class="conteudo_caixa">
                        <div class="carta">
                            <div class="lado frente">
                                <img src="<?= HOME . '/tim.php?src=uploads/es_mulher_promoville.jpg&w=200&h=200&q=80&a=t'; ?>" class="img-circle">
                                <span>Espaço <br> Mulher</span>
                            </div>
                            <div class="lado atras bg-primary img-circle"></div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="conteudo_caixa">
                        <div class="carta">
                            <div class="lado frente">
                                <img src="<?= HOME . '/tim.php?src=uploads/es_crianca_promoville.jpg&w=200&h=200&q=80&a=t'; ?>" class="img-circle">
                                <span>Espaço <br> Criança</span>
                            </div>
                            <div class="lado atras img-circle">outro atras</div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="conteudo_caixa">
                        <div class="carta">
                            <div class="lado frente">
                                <img src="<?= HOME . '/tim.php?src=uploads/es_casa_promoville.jpg&w=200&h=200&q=80&a=t'; ?>" class="img-circle">
                                <span>Espaço <br> Casa</span>
                            </div>
                            <div class="lado atras img-circle">outro atras</div>
                        </div>
                    </div>
                </li>
            </ul>
        </aside>
    </article>
    <article class="container-fluid">
        <h1 class="confira">Confira agora mesmo o que está em oferta em Joinville!</h1>
        <?php
        $getPage = (!empty($Link->getLocal()[0]) ? $Link->getLocal()[0] : 1);
        $Pager = new Pager(HOME . '/index/');
        $Pager->ExePager($getPage, 10);

        $subCategory = new Read;
        $subCategory->FullRead("SELECT DISTINCT(c.category_id), c.category_title,category_name FROM ws_categories as c, ws_posts as p WHERE c.category_parent is NULL AND p.post_cat_parent = c.category_id ORDER BY category_views DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

        if (!$subCategory->getResult()):
        else:
            foreach ($subCategory->getResult() as $subcat):
                extract($subcat);
                ?>
                <article class="col-lg-6 col-xs-12 content_home_categoria">
                    <h1><?= $category_title; ?></h1>
                    <div class="home_car">
                        <div class="carrossel_home">
                            <ul>
                                <?php
                                $sub = new Read;
                                $sub->ExeRead("ws_posts", "WHERE post_cat_parent = {$category_id} AND post_status = 1 ORDER BY post_preco LIMIT 12");
                                if (!$sub->getResult()):
                                else:
                                    foreach ($sub->getResult() as $s):
                                        extract($s);
                                        ?>
                                        <li>
                                            <a title="<?= $post_title ?>" href="<?= HOME . '/produto/' . $post_name; ?>">
                                                <img src="<?= HOME . '/tim.php?src=uploads/' . $post_cover . '&w=170&h=220&q=80&a=t'; ?>">
                                                <div class="home_car_legenda">
                                                    <h3><?= Check::Words($post_title, 3) ?></h3>
                                                    <span> <sup> R$</sup><?= number_format($post_preco, 2, ',', '.'); ?></span>
                                                </div>
                                                <div class="home_car_hover">
                                                    <span class="animated swing"> Apenas</span>
                                                    <span class="animated bounceInRight"> R$<?= number_format($post_preco, 2, ',', '.'); ?></span>
                                                </div>
                                            </a>
                                        </li>
                                        <?php
                                    endforeach;
                                endif;
                                ?>
                            </ul>
                            <span class="prev"><i class="fa fa-angle-left"></i></span>
                            <span class="next"><i class="fa fa-angle-right"></i></span>
                        </div>
                    </div>
                </article>
                <?php
            endforeach;
        endif;
        ?>
    </article>
</div>
<div class="container contem_home_paginator">
    <nav class="paginator">
        <?php
        $Pager->ExePaginator("ws_posts", "WHERE post_status = 1");
        echo $Pager->getPaginator();
        ?>
    </nav>
</div>