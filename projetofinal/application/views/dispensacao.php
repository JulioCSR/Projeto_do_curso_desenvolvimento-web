<div class = "container">
    <blockquote class="blockquote text-right">
    <p class="mb-2">"Uma coisa é necessário ter: um espírito leve por natureza ou um espírito tornado leve pela arte e pela ciência."</p>
    <footer class="blockquote-footer">Friedrich Nietzsche em <cite title="Source Title">Humano Demasiado Humano I</cite></footer>
    </blockquote>
</div>
<div class="container-fluid" style="margin-top:30px">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url("dashboard"); ?>">Início</a>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Dispensação</a>
        </ol>
    </nav>
    <div class="shadow-lg   p-3 mb-5 bg-body rounded">

        <h1 class="display-6">Lista de Dispensação de Remédios</h1>

        <button type="button" style="margin-right:20px; margin-bottom:20px;" class="btn btn-primary float-end" 
            data-bs-toggle="modal" data-bs-target="#cadastro_modal">
            <i class="fa fa-plus"></i>
            Nova Dispensação
        </button>
        <!-- construindo tabela -->
        <?php 
            echo '<table class="table table-striped">'; 
                echo '<tr>';
                    echo '<th>Data</th>';
                    echo '<th>Nome</th>';
                    echo '<th>Papel</th>';
                    echo '<th>Medicamento</th>';
                    echo '<th>Quantidade</th>';
                    echo '<th>Preço</th>';
                    
                echo '</tr>';
                $total = 0;
                $valor = 0;
                foreach ($users as $user) {
                    $total += ($user->preco)*($user->quantidade);
                    $valor += ($user ->quantidade);
                    
                    
                    echo '<tr>';
                        echo '<td>'.$user->data.'</td>';
                        echo '<td>'.$user->nome.'</td>';                        
                        echo '<td>'.$user->papel.'</td>';
                        echo '<td>'.$user->medicamentos.'</td>';
                        echo '<td>'.$user->quantidade.'</td>';
                        echo '<td>'.$user->preco.'</td>';
                        
                        echo '<td>';
                            echo '
                                <a href="#" data-bs-toggle="modal" data-bs-target="#visualizar_modal" data-bs-data="'.$user->data.'" data-bs-nome="'.$user->nome.'" 
                                    data-bs-medicamentos="'.$user->medicamentos.'" data-bs-papel="'.$user->papel.'"data-bs-quantidade="'.$user->quantidade.'"data-bs-preco="'.$user->preco.'">
                                    <i class="fa fa-eye text-primary"></i>
                                </a>';
                            echo '
                                <a href="#" data-bs-toggle="modal" data-bs-target="#editar_modal" data-bs-data="'.$user->data.'" data-bs-nome="'.$user->nome.'" 
                                    data-bs-medicamentos="'.$user->medicamentos.'" data-bs-papel="'.$user->papel.'"data-bs-quantidade="'.$user->quantidade.'"data-bs-preco="'.$user->preco.'" data-bs-id="'.$user->id.'">
                                    <i class="fa fa-edit text-primary""></i>
                                </a>';
                            echo '
                                <a href="'.base_url('dispensacao/apagardispensacao/'.$user->id).'">
                                    <i class="fa fa-trash text-danger"></i>
                                </a>';
                        echo '</td>';

                        
                }
                
                              
                echo '<tfoot class = "table-secondary">';
                    echo '<tr>';
                        echo '<th> Valor Total: </th>';
                        echo '<td>    --   </td>';
                        echo '<td>    --   </td>';
                        echo '<td>    --   </td>';
                        echo '<td>'.$valor.'</td>';                        
                        echo '<td>'.$total.'</td>';                                           
                    echo '</tr>';
                echo '</tfoot>';
                
               
                                                
            echo '</table>';        
        ?>
       
    </div>
</div>

<!-- 
    Modal e Formulário
-->
<div class="modal fade" id="cadastro_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Nova Dispensação</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form method="post" id="cadastro_form" action="#" autocomplete="off">
                <div class="mb-3">
                    <label for="data" class="form-label">Data</label>
                    <input type="date" class="form-control" id="data" value="&nbsp">
                </div>
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" value="&nbsp">
                </div>
                <div class="mb-3">
                    <label for="medicamentos" class="form-label">Medicamento</label>
                    <input type="text" class="form-control" id="medicamentos" value="&nbsp">
                </div>
                <div class="mb-3">
                    <label for="papel" class="form-label">Papel</label>
                    <select id="papel" class="form-select">
                        <option value="cliente">Cliente</option>
                        <option value="funcionario">Funcionário</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="quantidade" class="form-label">Quantidade</label>
                    <input type="number" class="form-control" id="quantidade" value="&nbsp">
                </div>
                <div class="mb-3">
                    <label for="preco" class="form-label">Preco</label>
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

        var data = document.getElementById('data').value;
        var nome = document.getElementById('nome').value;
        var papel = document.getElementById('papel').value;
        var medicamentos = document.getElementById('medicamentos').value;
        var quantidade = document.getElementById('quantidade').value;
        var preco = document.getElementById('preco').value;
        
        
        $.post("<?php echo base_url("dispensacao/novodispensacao")?>",              
            {data:data, nome:nome, papel:papel, medicamentos:medicamentos, quantidade:quantidade, preco:preco}, //dados que serão enviados
            function(data) {                                                  
                if (data == 'true') {
                    Swal.fire({
                        title: 'Sucesso!',
                        text: 'Dispensação do remédio com sucesso.',
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
        <h5 class="modal-title" id="staticBackdropLabel">Visualizar Dispensação</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form method="post" id="visualizar_form" action="#" autocomplete="off">
            <div class="mb-3">
                <label for="v_data" class="form-label">Data</label>
                <input type="date" class="form-control" id="v_data" value="&nbsp" disabled>
            </div>
            <div class="mb-3">
                <label for="v_nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="v_nome" value="&nbsp" disabled>
            </div>
            <div class="mb-3">
                <label for="v_papel" class="form-label">Papel</label>
                <select id="v_papel" class="form-select" disabled>
                    <option value="cliente">Cliente</option>
                    <option value="funcionario">Funcionário</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="v_medicamentos" class="form-label">Medicamento</label>
                <input type="text" class="form-control" id="v_medicamentos" value="&nbsp" disabled>
            </div>
            <div class="mb-3">
                <label for="v_quantidade" class="form-label">Quantidade</label>
                <input type="number" class="form-control" id="v_quantidade" value="&nbsp" disabled>
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
        var data = $(e.relatedTarget).data('bs-data');
        var nome = $(e.relatedTarget).data('bs-nome');
        var papel = $(e.relatedTarget).data('bs-papel');
        var medicamentos = $(e.relatedTarget).data('bs-medicamentos');
        var quantidade = $(e.relatedTarget).data('bs-quantidade');
        var preco = $(e.relatedTarget).data('bs-preco');    
        
        document.getElementById('v_data').value = data;
        document.getElementById('v_nome').value = nome;
        document.getElementById('v_papel').value = papel;
        document.getElementById('v_medicamentos').value = medicamentos;
        document.getElementById('v_quantidade').value = quantidade;
        document.getElementById('v_preco').value = preco;
        
    })
</script>


<div class="modal fade" id="editar_modal" data-bs-backdrop="static" data-bs-keyboard="false" 
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Editar cadastro de dispensação</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form method="post" id="e_modal" action="#" autocomplete="off">

            <input type="text" style="display:none" id="e_id">
            <div class="mb-3">
                <label for="e_data" class="form-label">Data</label>
                <input type="date" class="form-control" id="e_data" value="&nbsp">
            </div>
            <div class="mb-3">
                <label for="e_nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="e_nome" value="&nbsp">
            </div>
            <div class="mb-3">
                <label for="e_papel" class="form-label">Papel</label>
                <select id="e_papel" class="form-select">
                    <option value="cliente">Cleinte</option>
                    <option value="funcionario">Funcionário</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="e_medicamentos" class="form-label">Medicamento</label>
                <input type="text" class="form-control" id="e_medicamentos" value="&nbsp">
            </div>
            <div class="mb-3">
                <label for="e_quantidade" class="form-label">Quantidade</label>
                <input type="number" class="form-control" id="e_quantidade" value="&nbsp">
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
        var data = $(e.relatedTarget).data('bs-data');
        var nome = $(e.relatedTarget).data('bs-nome');
        var papel = $(e.relatedTarget).data('bs-papel');
        var medicamentos = $(e.relatedTarget).data('bs-medicamentos');
        var quantidade = $(e.relatedTarget).data('bs-quantidade');
        var preco = $(e.relatedTarget).data('bs-preco');

        document.getElementById('e_data').value = data;
        document.getElementById('e_nome').value = nome;
        document.getElementById('e_papel').value = papel;
        document.getElementById('e_medicamentos').value = medicamentos;
        document.getElementById('e_quantidade').value = quantidade;
        document.getElementById('e_preco').value = preco;
        document.getElementById('e_id').value = id;

    })

    function editarCadastro(){
        var id = document.getElementById('e_id').value;
        var data = document.getElementById('e_data').value;
        var nome = document.getElementById('e_nome').value;
        var papel = document.getElementById('e_papel').value;
        var medicamentos = document.getElementById('e_medicamentos').value;
        var quantidade = document.getElementById('e_quantidade').value;
        var preco = document.getElementById('e_preco').value;

        $.post("<?php echo base_url("dispensacao/editardispensacao") ?>",               
            {id:id, data:data, nome:nome, papel:papel, medicamentos:medicamentos, quantidade:quantidade, preco:preco}, 
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