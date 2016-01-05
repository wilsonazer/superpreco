<div class="content form_create">

    <article>
        <header>
            <h1>Cadastrar Produto:</h1>
        </header>

          <?php
          
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($post) && $post['SendPostForm']):
            $post['post_status'] = ($post['SendPostForm'] == 'Cadastrar' ? '0' : '1' );
            $post['post_cover'] = ( $_FILES['post_cover']['tmp_name'] ? $_FILES['post_cover'] : null );
            //valida a duração do anuncio e cria a variavel para cadastrar no banco 
            $post['post_fim_an'] = Check::FomataDuracao($post['post_duracao'], $post['post_unidade']);
            unset($post['SendPostForm']);
            unset($post['post_duracao']);
            unset($post['post_unidade']);
          
            
            require('_models/AdminPost.class.php');
            $cadastra = new AdminPost;
            $cadastra->ExeCreate($post);

            if ($cadastra->getResult()):

                if (!empty($_FILES['gallery_covers']['tmp_name'])):
                    $sendGallery = new AdminPost;
                    $sendGallery->gbSend($_FILES['gallery_covers'], $cadastra->getResult());
                endif;

               // header('Location: painel.php?exe=posts/update&create=true&postid=' . $cadastra->getResult());
            else:
                WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
            endif;
        endif;
        ?>

      <?php
          if (!Check::VerificaPanoAnun($userlogin['user_id'],$userlogin['user_plano'])):
                 WSErro("Por Favor Atualize seu plano para cadastrar novas ofertas", WS_ALERT);
             else: 
                  
      ?>
        <form name="PostForm" action="" method="post" enctype="multipart/form-data">

            <label class="label">
                <span class="field">Enviar Capa:</span>
                <input type="file" name="post_cover" />
            </label>
            
            <label class="label">
                <span class="field">Titulo:</span>
                <input type="text" name="post_title" value="<?php if (isset($post['post_title'])) echo $post['post_title']; ?>" />
            </label>

            <label class="label">
                <span class="field">Conteúdo:</span>
                <textarea class="js_editor" name="post_content" rows="10"><?php if (isset($post['post_content'])) echo htmlspecialchars($post['post_content']); ?></textarea>
            </label>
            
            <label class="label">
                <span class="field">Preço:</span>
                <input type="text" name="post_preco" value="<?php if (isset($post['post_preco'])) echo $post['post_preco']; ?>" placeholder="ex: 1.99 nunca use virgula"/>
            </label>

           <div class="label_line" style="background-color: #ffccff">
            <label class="label_medium">
                <span class="field">Tempo de Duração do anúncio:</span>
                    <select name="post_duracao">
                     <?php 
                       for($i= 1; $i <= 12; $i++):
                     ?>
                        <option value="<?= $i?>"> <?= $i?></option>  
                     <?php 
                      endfor;
                     ?>   
                    </select>
            </label>
              <label class="label_medium">
                <span class="field">Unidade de Duração:</span>
                    <select name="post_unidade">
                        <option value="d"> dia</option>      
                        <option value="s"> semana</option>      
                        <option value="m" selected="selected"> mês</option>           
                    </select>
            </label>
            </div>     

            <div class="label_line">
                <label class="label_small">
                    <span class="field">Data:</span>
                    <input type="text" class="formDate center" name="post_date" value="<?php
                    if (isset($post['post_date'])): echo $post['post_date'];
                    else: echo date('d/m/Y H:i:s');
                    endif;
                    ?>" />
                </label>

                <label class="label_small">
                    <span class="field">Categoria:</span>
                    <select name="post_category">
                        <option value=""> Selecione a categoria: </option>                        
                        <?php
                        $readSes = new Read;
                        $readSes->ExeRead("ws_categories", "WHERE category_parent IS NULL ORDER BY category_title ASC");
                        if ($readSes->getRowCount() >= 1):
                            foreach ($readSes->getResult() as $ses):
                                echo "<option disabled=\"disabled\" value=\"\"> {$ses['category_title']} </option>";
                                $readCat = new Read;
                                $readCat->ExeRead("ws_categories", "WHERE category_parent = :parent ORDER BY category_title ASC", "parent={$ses['category_id']}");

                                if ($readCat->getRowCount() >= 1):
                                    foreach ($readCat->getResult() as $cat):
                                        echo "<option ";

                                        if ($post['post_category'] == $cat['category_id']):
                                            echo "selected=\"selected\" ";
                                        endif;

                                        echo "value=\"{$cat['category_id']}\"> &raquo;&raquo; {$cat['category_title']} </option>";
                                    endforeach;
                                endif;

                            endforeach;
                        endif;
                        ?>
                    </select>
                </label>

                <label class="label_small">
                    <span class="field">Empresa:</span>
                    <select name="post_author">
                        <option value="<?= $_SESSION['userlogin']['user_id']; ?>"> <?= "{$_SESSION['userlogin']['user_name']}"; ?> </option>
                    </select>
                </label>
            </div><!--div line-->
            
            <div class="label gbform">
                <label class="label">             
                    <span class="field">Enviar Galeria:</span>
                    <input type="file" multiple name="gallery_covers[]" />
                </label>             
            </div>

            <input type="submit" class="btn blue" value="Cadastrar" name="SendPostForm" />
            <input type="submit" class="btn green" value="Cadastrar & Publicar" name="SendPostForm" />

        </form>
      <?php 
          endif;
      ?>
    </article>

    <div class="clear"></div>
</div> <!-- content home -->