<body>
<div class = "container">
    <figure>
    <blockquote class="blockquote">
        <p>"O universo não parece ser nem benevolente nem hostil, apenas indiferente."</p>
    </blockquote>
    <figcaption class="blockquote-footer">
        Carl Sagan em <cite title="Source Title">Cosmos</cite>
    </figcaption>
    </figure>
</div>

<div class="container-fluid" style="margin-top:30px">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url("dashboard"); ?>">Início</a>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Medicamentos</a>
        </ol>
    </nav>
    <div class="shadow-lg   p-3 mb-5 bg-body rounded">

        <h1 class="display-6">Lista de medicamentos</h1>

        <button type="button" style="margin-right:20px; margin-bottom:20px;" class="btn btn-primary float-end" 
            data-bs-toggle="modal" data-bs-target="#cadastro_modal">
            <i class="fa fa-plus"></i>
            Novo Medicamento
        </button>
        <!-- Início do código PHP -->
        <?php 
            echo '<table class="table">'; 
                echo '<tr>';
                    echo '<th>Nome comercial</th>';
                    echo '<th>Principio ativo</th>';
                    echo '<th>Quantidade</th>';
                    echo '<th>Preço</th>';                
                echo '</tr>';
                foreach ($users as $user) {
                    echo '<tr>';
                        echo '<td>'.$user->nome_comercial.'</td>';
                        echo '<td>'.$user->principio_ativo.'</td>';
                        echo '<td>'.$user->quantidade.'</td>';
                        echo '<td>'.$user->preco.'</td>';

                        echo '<td>';
                            echo '
                            <a href="#" data-bs-toggle="modal" data-bs-target="#visualizar_modal" data-bs-nome_comercial="'.$user->nome_comercial.'" data-bs-principio_ativo="'.$user->principio_ativo.'" 
                                data-bs-quantidade="'.$user->quantidade.'" data-bs-preco="'.$user->preco.'">
                                <i class="fa fa-eye text-primary"></i>
                            </a>';
                            echo '
                                <a href="#" data-bs-toggle="modal" data-bs-target="#editar_modal"data-bs-nome_comercial="'.$user->nome_comercial.'" data-bs-principio_ativo="'.$user->principio_ativo.'" data-bs-quantidade="'.$user->quantidade.'" data-bs-preco="'.$user->preco.'" 
                                    data-bs-id="'.$user->id.'">
                                    <i class="fa fa-edit text-primary""></i>
                                </a>';
                            echo '
                                <a href="'.base_url('medicamentos/apagarMedicamento/'.$user->id).'">
                                    <i class="fa fa-trash text-danger"></i>
                                </a>';
                        echo '</td>';
                    echo '</tr>';
                }
            echo '</table>';
        ?>
        <!-- Fim do código PHP --> 

    </div>
</div>

<div class="modal fade" id="cadastro_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Novo medicamento</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form method="post" id="cadastro_form" action="#" autocomplete="off">
                <div class="mb-3">
                    <label for="nome_comercial" class="form-label">Nome Comercial</label>
                    <input type="text" class="form-control" id="nome_comercial" value="&nbsp">
                </div>
                <div class="mb-3">
                    <label for="principio_ativo" class="form-label">Principio Ativo</label>
                    <input type="text" class="form-control" id="principio_ativo" value="&nbsp">
                </div>
                <div class="mb-3">
                    <label for="quantidade" class="form-label">Quantidade</label>
                    <input type="number" class="form-control" id="quantidade" value="&nbsp">
                </div>
                <div class="mb-3">
                    <label for="preco" class="form-label">Preço</label>
                    <input type="number" class="form-control" id="preco" value="&nbsp">
                </div>
                               
            </form>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" id="enviar" class="btn btn-primary" onclick="salvarCadastro()">Salvar</button>
        </div>
        </div>
    </div>
</div>

<script>

function salvarCadastro(){

    var nome_comercial = document.getElementById('nome_comercial').value;
    var principio_ativo = document.getElementById('principio_ativo').value;
    var quantidade = document.getElementById('quantidade').value;
    var preco = document.getElementById('preco').value;
     

    /* 
        $.post é uma função do JQuery que auxilia no envio de dados da nossa view para nosso controller backend php 
        $post(url, dados que serão enviados, função retorno);
    */
    $.post("<?php echo base_url("medicamentos/novomedicamento")?>",               
        {nome_comercial:nome_comercial, principio_ativo:principio_ativo, quantidade:quantidade, preco:preco},
        function(data) {                                                   
            if (data == 'true') {
                Swal.fire({
                    title: 'Sucesso!',
                    text: 'O Medicamento foi cadastrado com sucesso.',
                    icon: 'success',
                    confirmButtonText: 'Ok!',
                }).then(function(){ 
                    location.reload();
                });
            } else {
                Swal.fire({
                    title: 'Erro!',
                    text: 'Contate o administrador do sistema e informe o código: 1000',
                    icon: 'error',
                    confirmButtonText: 'Ok!',
                }).then(function(){ 
                    location.reload();
                });
            }
        }
    );
}

</script>

<div class="modal fade" id="visualizar_modal" data-bs-backdrop="static" data-bs-keyboard="false" 
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Visualizar Medicamentos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form method="post" id="visualizar_form" action="#" autocomplete="off">
            <div class="mb-3">
                <label for="v_nome_comercial" class="form-label">Nome Comercial</label>
                <input type="text" class="form-control" id="v_nome_comercial" value="&nbsp" disabled>
            </div>
            <div class="mb-3">
                <label for="v_principio_ativo" class="form-label">Principio Ativo</label>
                <input type="text" class="form-control" id="v_principio_ativo" value="&nbsp" disabled>
            </div>
            <div class="mb-3">
                <label for="v_quantidade" class="form-label">Quantidade</label>
                <input type="text" class="form-control" id="v_quantidade" value="&nbsp" disabled>
            </div>
            <div class="mb-3">
                <label for="v_preco" class="form-label">Preço</label>
                <input type="text" class="form-control" id="v_preco" value="&nbsp" disabled>
            </div>
            
        </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<script>
$('#visualizar_modal').on('show.bs.modal', function(e) {
    var nome_comercial = $(e.relatedTarget).data('bs-nome_comercial');
    var principio_ativo = $(e.relatedTarget).data('bs-principio_ativo');
    var quantidade = $(e.relatedTarget).data('bs-quantidade');
    var preco = $(e.relatedTarget).data('bs-preco');
    
    document.getElementById('v_nome_comercial').value = nome_comercial;
    document.getElementById('v_principio_ativo').value = principio_ativo;
    document.getElementById('v_quantidade').value = quantidade;
    document.getElementById('v_preco').value = preco;
    
})
</script>

<div class="modal fade" id="editar_modal" data-bs-backdrop="static" data-bs-keyboard="false" 
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Editar cadastro de medicamentos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form method="post" id="e_modal" action="#" autocomplete="off">

            <input type="text" style="display:none" id="e_id">
            <div class="mb-3">
                <label for="e_nome_comercial" class="form-label">Nome Comercial</label>
                <input type="text" class="form-control" id="e_nome_comercial" value="&nbsp">
            </div>
            <div class="mb-3">
                <label for="e_principio_ativo" class="form-label">Principio Ativo</label>
                <input type="text" class="form-control" id="e_principio_ativo" value="&nbsp">
            </div>
            <div class="mb-3">
                <label for="e_quantidade" class="form-label">Quantidade</label>
                <input type="text" class="form-control" id="e_quantidade" value="&nbsp">
            </div>
            <div class="mb-3">
                <label for="e_preco" class="form-label">Preço</label>
                <input type="text" class="form-control" id="e_preco" value="&nbsp">
            </div>
            
        </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" onclick="editarCadastro()">Salvar</button>
      </div>
    </div>
  </div>
</div>

<script>
$('#editar_modal').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('bs-id');
    var nome_comercial = $(e.relatedTarget).data('bs-nome_comercial');
    var principio_ativo = $(e.relatedTarget).data('bs-principio_ativo');
    var quantidade = $(e.relatedTarget).data('bs-quantidade');
    var preco = $(e.relatedTarget).data('bs-preco');
    

    document.getElementById('e_nome_comercial').value = nome_comercial;
    document.getElementById('e_principio_ativo').value = principio_ativo;
    document.getElementById('e_quantidade').value = quantidade;
    document.getElementById('e_preco').value = preco;
    document.getElementById('e_id').value = id;

})

function editarCadastro(){
    var id = document.getElementById('e_id').value;
    var nome_comercial = document.getElementById('e_nome_comercial').value;
    var principio_ativo = document.getElementById('e_principio_ativo').value;
    var quantidade = document.getElementById('e_quantidade').value;
    var preco = document.getElementById('e_preco').value;
    
    $.post("<?php echo base_url("medicamentos/editarmedicamento") ?>",               
        {id:id, nome_comercial:nome_comercial, principio_ativo:principio_ativo, quantidade:quantidade, preco:preco}, 
        function(data) {                                                   
            if (data == 'true') {
                Swal.fire({
                    title: 'Sucesso!',
                    text: 'O cadastro foi alterado com sucesso.',
                    icon: 'success',
                    confirmButtonText: 'Ok!',
                }).then(function(){ 
                    location.reload();
                });
            } else {
                Swal.fire({
                    title: 'Erro!',
                    text: 'Contate o administrador do sistema e informe o código: 1000',
                    icon: 'error',
                    confirmButtonText: 'Ok!',
                }).then(function(){ 
                    location.reload();
                });
            }
        }
    );

}
</script>
