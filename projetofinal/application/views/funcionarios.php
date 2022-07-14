<div class = "container">
    <blockquote class="blockquote text-right">
    <p class="mb-2">"Para pequenas criaturas como nós, a vastidão é suportável somente através do amor."</p>
    <footer class="blockquote-footer">Carl Sagan em <cite title="Source Title">Cosmos</cite></footer>
    </blockquote>
</div>
<div class="container-fluid" style="margin-top:30px">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url("dashboard"); ?>">Início</a>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Funcionários</a>
        </ol>
    </nav>
    <div class="shadow-lg   p-3 mb-5 bg-body rounded">

        <h1 class="display-6">Lista de funcionarios</h1>

        <button type="button" style="margin-right:20px; margin-bottom:20px;" class="btn btn-primary float-end" 
            data-bs-toggle="modal" data-bs-target="#cadastro_modal">
            <i class="fa fa-plus"></i>
            Novo funcionário
        </button>

        
        <?php 
            echo '<table class="table table-striped">'; 
                echo '<tr>';
                    echo '<th>CPF</th>';
                    echo '<th>Nome</th>';
                    echo '<th>Login</th>';
                    echo '<th>Papel</th>';
                    echo '<th>Status</th>';
                    echo '<th>Ações</th>';
                echo '</tr>';
                foreach ($users as $user) {
                    echo '<tr>';
                        echo '<td>'.$user->cpf.'</td>';
                        echo '<td>'.$user->nome.'</td>';
                        echo '<td>'.$user->login.'</td>';
                        echo '<td>'.$user->papel.'</td>';
                        if($user->status == 1){
                            echo '<td>ativo</td>';
                        }else{
                            echo '<td>inativo</td>';
                        }
                        echo '<td>';
                            echo '
                                <a href="#" data-bs-toggle="modal" data-bs-target="#visualizar_modal" data-bs-cpf="'.$user->cpf.'" data-bs-nome="'.$user->nome.'" data-bs-login="'.$user->login.'" 
                                    data-bs-papel="'.$user->papel.'" data-bs-status="'.$user->status.'">
                                    <i class="fa fa-eye text-primary"></i>
                                </a>';
                            echo '
                                <a href="#" data-bs-toggle="modal" data-bs-target="#editar_modal" data-bs-cpf="'.$user->cpf.'" data-bs-nome="'.$user->nome.'" data-bs-login="'.$user->login.'" 
                                    data-bs-papel="'.$user->papel.'" data-bs-status="'.$user->status.'" data-bs-id="'.$user->id.'">
                                    <i class="fa fa-edit text-primary""></i>
                                </a>';
                            echo '
                                <a href="'.base_url('funcionarios/apagarfuncionarios/'.$user->id).'">
                                    <i class="fa fa-trash text-danger"></i>
                                </a>';
                        echo '</td>';
                    echo '</tr>';
                }
            echo '</table>';
        ?>
       

    </div>
</div>

<!-- Modal e Formulário -->
<div class="modal fade" id="cadastro_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Novo funcionário</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form method="post" id="cadastro_form" action="#" autocomplete="off">
                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" class="form-control" id="cpf" value="" placeholder = "Somente número">
                </div>
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" value="&nbsp">
                </div>
                <div class="mb-3">
                    <label for="login" class="form-label">Login</label>
                    <input type="text" class="form-control" id="login" value="&nbsp">
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" aria-describedby="dicaPassword">
                    <div id="dicaPassword" class="form-text">Sua senha deve possuir 6 caracteres ou mais.</div>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select id="status" class="form-select">
                        <option value="1">Ativo</option>
                        <option value="0">Inativo</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="papel" class="form-label">Papel</label>
                    <select id="papel" class="form-select">
                        <option value="auxiliar">Auxiliar</option>
                        <option value="administrador">Administrador</option>
                    </select>
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
    //Função para validar CPF
    //http://www.receita.fazenda.gov.br/aplicacoes/atcta/cpf/funcoes.js
    function testaCPF(strCPF) {
            var Soma;
            var Resto;
        Soma = 0;
        if (strCPF == "00000000000") return false;

        for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
        Resto = (Soma * 10) % 11;

            if ((Resto == 10) || (Resto == 11))  Resto = 0;
            if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;

        Soma = 0;
            for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
            Resto = (Soma * 10) % 11;

            if ((Resto == 10) || (Resto == 11))  Resto = 0;
            if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
            return true;
    }

    function salvarCadastro(){

        var CPF = document.getElementById('cpf').value;

        if(testaCPF(CPF.toString().trim()) == true){
            var cpf = document.getElementById('cpf').value;
        }else{
            alert('CPF inválido!!!');
        }

        
        var nome = document.getElementById('nome').value;
        var login = document.getElementById('login').value;
        var senha = document.getElementById('senha').value;
        var status = document.getElementById('status').value;
        var papel = document.getElementById('papel').value;

        
        $.post("<?php echo base_url("funcionarios/novofuncionarios")?>",                
            {cpf:cpf, nome:nome, login:login, senha:senha, status:status, papel:papel}, 
            function(data) {                                                   
                if (data == 'true') {
                    Swal.fire({
                        title: 'Sucesso!',
                        text: 'O funcionário foi cadastrado com sucesso.',
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
        <h5 class="modal-title" id="staticBackdropLabel">Visualizar funcionário</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form method="post" id="visualizar_form" action="#" autocomplete="off">
            <div class="mb-3">
                <label for="v_cpf" class="form-label">CPF</label>
                <input type="text" class="form-control" id="v_cpf" value="&nbsp" disabled>
            </div>
            <div class="mb-3">
                <label for="v_nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="v_nome" value="&nbsp" disabled>
            </div>
            <div class="mb-3">
                <label for="v_login" class="form-label">Login</label>
                <input type="text" class="form-control" id="v_login" value="&nbsp" disabled>
            </div>
            <div class="mb-3">
                <label for="v_status" class="form-label">Status</label>
                <select id="v_status" class="form-select" disabled>
                    <option value="1">Ativo</option>
                    <option value="0">Inativo</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="v_papel" class="form-label">Papel</label>
                <select id="v_papel" class="form-select" disabled>
                    <option value="auxiliar">Auxiliar</option>
                    <option value="administrador">Administrador</option>
                </select>
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
    var cpf = $(e.relatedTarget).data('bs-cpf');
    var nome = $(e.relatedTarget).data('bs-nome');
    var login = $(e.relatedTarget).data('bs-login');
    var papel = $(e.relatedTarget).data('bs-papel');
    var status = $(e.relatedTarget).data('bs-status');

    document.getElementById('v_cpf').value = cpf;
    document.getElementById('v_nome').value = nome;
    document.getElementById('v_login').value = login;
    document.getElementById('v_status').value = status;
    document.getElementById('v_papel').value = papel;
})
</script>


<div class="modal fade" id="editar_modal" data-bs-backdrop="static" data-bs-keyboard="false" 
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Editar cadastro de funcionário</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form method="post" id="e_modal" action="#" autocomplete="off">

            <input type="text" style="display:none" id="e_id">
            <div class="mb-3">
                <label for="e_cpf" class="form-label">CPF</label>
                <input type="text" class="form-control" id="e_cpf" value="" placeholder = "Somente número">
            </div>
            <div class="mb-3">
                <label for="e_nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="e_nome" value="&nbsp">
            </div>
            <div class="mb-3">
                <label for="e_login" class="form-label">Login</label>
                <input type="text" class="form-control" id="e_login" value="&nbsp">
            </div>
            <div class="mb-3">
                <label for="e_status" class="form-label">Status</label>
                <select id="e_status" class="form-select">
                    <option value="1">Ativo</option>
                    <option value="0">Inativo</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="e_papel" class="form-label">Papel</label>
                <select id="e_papel" class="form-select">
                    <option value="auxiliar">Auxiliar</option>
                    <option value="administrador">Administrador</option>
                </select>
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
    var cpf = $(e.relatedTarget).data('bs-cpf');
    var nome = $(e.relatedTarget).data('bs-nome');
    var login = $(e.relatedTarget).data('bs-login');
    var papel = $(e.relatedTarget).data('bs-papel');
    var status = $(e.relatedTarget).data('bs-status');

    document.getElementById('e_cpf').value = cpf;
    document.getElementById('e_nome').value = nome;
    document.getElementById('e_login').value = login;
    document.getElementById('e_papel').value = papel;
    document.getElementById('e_status').value = status;
    document.getElementById('e_id').value = id;

})

function editarCadastro(){
    var id = document.getElementById('e_id').value;
    var cpf = document.getElementById('e_cpf').value;
    var nome = document.getElementById('e_nome').value;
    var login = document.getElementById('e_login').value;
    var papel = document.getElementById('e_papel').value;
    var status = document.getElementById('e_status').value;

    $.post("<?php echo base_url("funcionarios/editarfuncionarios") ?>",               
        {id:id, cpf:cpf, nome:nome, login:login, papel:papel, status:status}, 
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