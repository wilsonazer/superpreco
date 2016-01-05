<footer class="container-fluid footer_site">
          <h1>Promoville</h1>
          <div class="row">
              <div class="col-lg-4 footer_face">
                   <script>(function(d, s, id) {
                      var js, fjs = d.getElementsByTagName(s)[0];
                      if (d.getElementById(id)) return;
                      js = d.createElement(s); js.id = id;
                      js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.5&appId=851882811569155";
                      fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
                    </script>
                  <div class="fb-page" data-href="https://www.facebook.com/promoville.joinville" data-small-header="false" 
                       data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false">
                      <div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/promoville.joinville">
                              <a href="https://www.facebook.com/promoville.joinville">Promoville</a></blockquote></div>
                  </div>    
              </div>
              
              <div class="col-lg-4 footer_categorias">
                     <div id="fb-root"></div>
                  <div id="fb-root"></div>
                  <h2><i class="fa fa-link"></i> Liks das Categorias</h2>
                   <ul>
                  <?php
                    //lê as categoria do banco de dados
                    $readCategoria = new Read;
                    $readCategoria->ExeRead("ws_categories", "WHERE category_parent is null ORDER BY category_title");

                    if($readCategoria->getResult()):
                      
                        foreach ($readCategoria->getResult() as $categoria):
                            extract($categoria)
                   ?>
                  
                      <li> <a title="<?= $category_name;?>" href="<?= HOME .'/categoria/'.$category_name; ?>"><i class="fa fa-sign-in"></i> <?= $category_title;?></a>
                    <?php
                    endforeach;
                    endif; 
                   
                    ?>
                  </ul>         
                  
              </div>
              <div class="col-lg-4 footer_info_promo">
                  sobre a empresa <br>
                  
                <h1><i class="fa fa-phone-square"></i> contatos promoville</h1>
                  <a title="login" target="_blank" href="<?= HOME.'/admin/index.php'; ?>"><i class="fa fa-user"></i> Login</a>    
              </div>
          </div>
          
 <?php
            // PING DO ARQUIVO SITE MAP E CRIA GZIP DO SITE ####################
function sitemapPing(){

    $sitemapPing = array();
    $sitemapPing['google'] = 'http://www.google.com/webmasters/sitemaps/ping?sitemap=' .HOME .'/sitemap.xml';
    $sitemapPing['bing'] = 'http://www.bing.com/webmaster/ping.aspx?siteMap='.HOME .'/sitemap.xml';
    
    foreach ($sitemapPing as $sitempUrl):
        $ch = curl_init($sitempUrl);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_exec($ch);
        curl_close($ch);
    endforeach;
    
    if(!file_exists('sitemap.xml.gz')):
        $gzip = gzopen('sitemap.xml.gz','w9');
        $gmap = file_get_contents('sitemap.xml');
        gzwrite($gzip, $gmap);
        gzclose($gzip);
        
        sitemapPing();
    endif;
}  

?>

      </footer> 