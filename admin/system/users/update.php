<div class="content form_create">

    <article>

        <h1>Atualizar Usuário!</h1>

        <?php
        $ClienteData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $userId = filter_input(INPUT_GET, 'userid', FILTER_VALIDATE_INT);

        if ($ClienteData && $ClienteData['SendPostForm']):
            $ClienteData['user_cover'] = ( $_FILES['user_cover']['tmp_name'] ? $_FILES['user_cover'] : null );
            $url =  Check::Name($ClienteData['user_name']);
            $ClienteData['user_url'] = $url;

            unset($ClienteData['SendPostForm']);

            require('_models/AdminUser.class.php');
            $cadastra = new AdminUser;
            $cadastra->ExeUpdate($userId, $ClienteData);

            WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
        else:
            $ReadUser = new Read;
            $ReadUser->ExeRead("ws_users", "WHERE user_id = :userid", "userid={$userId}");
            if (!$ReadUser->getResult()):

            else:
                $ClienteData = $ReadUser->getResult()[0];
                unset($ClienteData['user_password']);
            endif;
        endif;

        $checkCreate = filter_input(INPUT_GET, 'create', FILTER_VALIDATE_BOOLEAN);
        if ($checkCreate && empty($cadastra)):
            WSErro("O usuário <b>{$ClienteData['user_name']}</b> foi cadastrado com sucesso no sistema!", WS_ACCEPT);
        endif;
        ?>

        <form action = "" method = "post" name = "UserCreateForm" enctype="multipart/form-data">
            <label class="label">
                <span class="field">Enviar Capa:</span>
                <input type="file" name="user_cover" />
            </label>
            
            <label class="label">
                <span class="field">Nome:</span>
                <input
                    type = "text"
                    name = "user_name"
                    value="<?php if (!empty($ClienteData['user_name'])) echo $ClienteData['user_name']; ?>"
                    title = "Informe seu primeiro nome"
                    required
                    />
            </label>

            <label class="label">
                <span class="field">E-mail:</span>
                <input
                    type = "email"
                    name = "user_email"
                    value="<?php if (!empty($ClienteData['user_email'])) echo $ClienteData['user_email']; ?>"
                    title = "Informe seu e-mail"
                    required
                    />
            </label>
            
             <label class="label">
                    <span class="field">Telefone:</span>
                    <input type = "tel" name = "user_telefone" value="<?php if (!empty($ClienteData['user_telefone'])) echo $ClienteData['user_telefone']; ?>" title = "Informe seu Telefone" required/>
             </label>
            
            <label class="label">
               <span class="field">Bairro:</span>
               <input type = "text" name = "user_bairro" value="<?php if (!empty($ClienteData['user_bairro'])) echo $ClienteData['user_bairro']; ?>" title = "Informe seu Bairro" required/>
            </label>
                
                
            <label class="label">
               <span class="field">Endereço:</span>
               <input type = "text" name = "user_endereco" value="<?php if (!empty($ClienteData['user_endereco'])) echo $ClienteData['user_endereco']; ?>" title = "Informe seu Endereço" required/>
            </label>

            <label class="label">
               <span class="field">Temas:</span>
               <input type = "text" name = "user_theme" value="<?php if (!empty($ClienteData['user_theme'])) echo $ClienteData['user_theme']; ?>" title = "Informe um tema" required/>
            </label>
            
            <label class="label">
               <span class="field">Url Mapa Google:</span>
               <input type = "text" name = "user_mapa" value="<?php if (!empty($ClienteData['user_mapa'])) echo $ClienteData['user_mapa']; ?>" title = "Informe o Url do mapa do google" required/>
            </label>
            
            <div class="label_line">
                <label class="label_medium">
                    <span class="field">Senha:</span>
                    <input
                        type = "password"
                        name = "user_password"
                        value="<?php if (!empty($ClienteData['user_password'])) echo $ClienteData['user_password']; ?>"
                        title = "Informe sua senha [ de 6 a 12 caracteres! ]"
                        pattern = ".{6,12}"
                        />
                </label>


                <label class="label_medium">
                    <span class="field">Nível:</span>
                    <select name = "user_level" title = "Selecione o nível de usuário" required >
                        <option value = "">Selecione o Nível</option>
                        <option value = "1" <?php if (isset($ClienteData['user_level']) && $ClienteData['user_level'] == 1) echo 'selected="selected"'; ?>>User</option>
                        <option value="2" <?php if (isset($ClienteData['user_level']) && $ClienteData['user_level'] == 2) echo 'selected="selected"'; ?>>Editor</option>
                        <option value="3" <?php if (isset($ClienteData['user_level']) && $ClienteData['user_level'] == 3) echo 'selected="selected"'; ?>>Admin</option>
                    </select>
                </label>
            </div><!-- LABEL LINE -->

            <input type="submit" name="SendPostForm" value="Atualizar Usuário" class="btn blue" />
        </form>

    </article>
    <div class="clear"></div>
</div> <!-- content home -->