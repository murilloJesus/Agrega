<div  id="<?php echo $key; ?>Message" class="alert alert-<?php echo !empty($params['class']) ? $params['class'] : 'default'; ?>">
    <?php echo $message; ?>

    <br>
    <?php if (!empty($params['dados'])) {
        $dados = $params['dados'];
        echo $dados['add_sucesso'] . " registro(s) inseridos.";
        echo "<br>";
        
        if ($dados['update_sucesso'] != 0) {
            echo $dados['update_sucesso'] . " registro(s) alterados.";
            echo "<br>";
        }
        
        if ($dados['add_falha'] != 0) {
            echo $dados['add_falha'] . " registro(s) com erro.";
            echo "<br>";
        }        
        
        if ($dados['update_falha'] != 0) {
            echo $dados['update_falha'] . " registro(s) com erro.";
            echo "<br>";
        }

        if (!empty($params['url_arquivo'])){
            $url_arquivo = $params['url_arquivo'];
            echo "<br><a class = 'btn btn-warning btn-sm' href = '{$this->base}/{$url_arquivo}'><i class='fa fa-download'></i> Baixar planilha com erros.</a>";

        }
        
    }
     ?>
</div>