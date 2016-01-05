<div class="content list_content">

    <section>

        <h1>Produtos Cadastrados por <span style="color: #990000;text-transform: uppercase"><?= $userlogin['user_name'] ;?></span> :</h1>

        <?php
        $empty = filter_input(INPUT_GET, 'empty', FILTER_VALIDATE_BOOLEAN);
        if ($empty):
            WSErro("Oppsss: Você tentou editar um post que não existe no sistema!", WS_INFOR);
        endif;


        $action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);
        if ($action):
            require ('_models/AdminPost2.class.php');

            $postAction = filter_input(INPUT_GET, 'post', FILTER_VALIDATE_INT);
            $postUpdate = new AdminPost;

            switch ($action):
                case 'active':
                    $postUpdate->ExeStatus($postAction, '1');
                    WSErro("O status do post foi atualizado para <b>ativo</b>. Post publicado!", WS_ACCEPT);
                    break;

                case 'inative':
                    $postUpdate->ExeStatus($postAction, '0');
                    WSErro("O status do post foi atualizado para <b>inativo</b>. Post agora é um rascunho!", WS_ALERT);
                    break;

                case 'delete':
                    $postUpdate->ExeDelete($postAction);
                    WSErro($postUpdate->getError()[0], $postUpdate->getError()[1]);
                    break;

                default :
                    WSErro("Ação não foi identifica pelo sistema, favor utilize os botões!", WS_ALERT);
            endswitch;
        endif;


        $posti = 0;
        $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
        $Pager = new Pager('painel.php?exe=posts/index&page=');
        $Pager->ExePager($getPage, 10);

        $readPosts = new Read;
        $readPosts->ExeRead("ws_posts", "WHERE post_author = :user_id ORDER BY post_status ASC, post_date DESC LIMIT :limit OFFSET :offset", "user_id={$userlogin['user_id']}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
        if ($readPosts->getResult()):
            foreach ($readPosts->getResult() as $post):
                $posti++;
                extract($post);
                $status = (!$post_status ? 'style="background: #fffed8"' : '');
                ?>
                <article<?php if ($posti % 2 == 0) echo ' class="right"'; ?> <?= $status; ?>>

                    <div class="img thumb_small">
                        <?= Check::Image('../uploads/' . $post_cover, $post_title, 120, 70); ?>
                    </div>

                    <h1><a target="_blank" href="../produto/<?= $post_name; ?>" title="Ver Post"><?= Check::Words($post_title, 10) ?></a></h1>
                    <ul class="info post_actions">
                        <li><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($post_date)); ?>Hs</li>
                        <li><a class="act_view" target="_blank" href="../produto/<?= $post_name; ?>" title="Ver no site">Ver no site</a></li>
                        <li><a class="act_edit" href="painel2.php?exe=posts/update2&postid=<?= $post_id; ?>" title="Editar">Editar</a></li>

                        <?php if (!$post_status): ?>
                            <li><a class="act_inative" href="painel2.php?exe=posts/index&post=<?= $post_id; ?>&action=active" title="Ativar">Ativar</a></li>
                        <?php else: ?>
                            <li><a class="act_ative" href="painel2.php?exe=posts/index&post=<?= $post_id; ?>&action=inative" title="Inativar">Inativar</a></li>
                        <?php endif; ?>

                        <li><a class="act_delete" href="painel2.php?exe=posts/index&post=<?= $post_id; ?>&action=delete" title="Excluir">Deletar</a></li>
                    </ul>

                </article>
                <?php
            endforeach;

        else:
            $Pager->ReturnPage();
            WSErro("Desculpe, ainda não existem posts cadastrados!", WS_INFOR);
        endif;
        ?>

        <div class="clear"></div>
    </section>

    <?php
    $Pager->ExePaginator("ws_posts");
    echo $Pager->getPaginator();
    ?>

    <div class="clear"></div>
</div> <!-- content home -->