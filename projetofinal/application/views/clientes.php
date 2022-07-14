<body>
<div class = "container">
    <figure>
    <blockquote class="blockquote">
        <p>Sem dados você é apenas mais uma pessoa com uma opinião.</p>
    </blockquote>
    <figcaption class="blockquote-footer">
        W. Edwards Deming - <cite title="Source Title">Data Scientist</cite>
    </figcaption>
    </figure>
</div>
<div class="container-fluid" style="margin-top:30px">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url("dashboard"); ?>">Início</a>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Clientes</a>
        </ol>
    </nav>
    <div class="shadow-lg   p-3 mb-5 bg-body rounded">

        <h1 class="display-6">Lista de clientes</h1>

        <button type="button" style="margin-right:20px; margin-bottom:20px;" class="btn btn-primary float-end" 
            data-bs-toggle="modal" data-bs-target="#cadastro_modal">
            <i class="fa fa-plus"></i>
            Novo cliente
        </button>

        
        <?php 
            echo '<table class="table table-striped">'; 
                echo '<tr>';
                    echo '<th>CPF</th>';
                    echo '<th>Nome</th>';
                    echo '<th>Telefone</th>';
                    echo '<th>Login</th>';                
                echo '</tr>';
                foreach ($users as $user) {
                    echo '<tr>';
                        echo '<td>'.$user->cpf.'</td>';
                        echo '<td>'.$user->nome.'</td>';
                        echo '<td>'.$user->telefone.'</td>';
                        echo '<td>'.$user->login.'</td>';

                        echo '<td>';
                            echo '
                            <a href="#" data-bs-toggle="modal" data-bs-target="#visualizar_modal" data-bs-cpf="'.$user->cpf.'" data-bs-nome="'.$user->nome.'" 
                                data-bs-telefone="'.$user->telefone.'" data-bs-login="'.$user->login.'">
                                <i class="fa fa-eye text-primary"></i>
                            </a>';
                            echo '
                                <a href="#" data-bs-toggle="modal" data-bs-target="#editar_modal"data-bs-cpf="'.$user->cpf.'" data-bs-nome="'.$user->nome.'" data-bs-telefone="'.$user->telefone.'" data-bs-login="'.$user->login.'" 
                                    data-bs-id="'.$user->id.'">
                                    <i class="fa fa-edit text-primary""></i>
                                </a>';
                            echo '
                                <a href="'.base_url('clientes/apagarCliente/'.$user->id).'">
                                    <i class="fa fa-trash text-danger"></i>
                                </a>';
                        echo '</td>';
                    echo '</tr>';
                }
            echo '</table>';
        ?>
        

    </div>
</div>
<div class="modal fade" id="cadastro_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Novo cliente</h5>
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
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefone" value="&nbsp">
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
            alert('CPF inválido!');
        }

        
        var nome = document.getElementById('nome').value;
        var telefone = document.getElementById('telefone').value;
        var login = document.getElementById('login').value;
        var senha = document.getElementById('senha').value;
        

        
        $.post("<?php echo base_url("clientes/novocliente")?>",                
            {cpf:cpf, nome:nome, telefone:telefone, login:login, senha:senha}, 
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
        <h5 class="modal-title" id="staticBackdropLabel">Visualizar clientes</h5>
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
                <label for="v_telefone" class="form-label">Telefone</label>
                <input type="text" class="form-control" id="v_telefone" value="&nbsp" disabled>
            </div>
            <div class="mb-3">
                <label for="v_login" class="form-label">Login</label>
                <input type="text" class="form-control" id="v_login" value="&nbsp" disabled>
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
    var telefone = $(e.relatedTarget).data('bs-telefone');
    var login = $(e.relatedTarget).data('bs-login');
    
    document.getElementById('v_cpf').value = cpf;
    document.getElementById('v_nome').value = nome;
    document.getElementById('v_telefone').value = telefone;
    document.getElementById('v_login').value = login;
    
})
</script>
<div class="modal fade" id="editar_modal" data-bs-backdrop="static" data-bs-keyboard="false" 
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Editar cadastro de clientes</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form method="post" id="e_modal" action="#" autocomplete="off">

            <input type="text" style="display:none" id="e_id">
            <div class="mb-3">
                <label for="e_cpf" class="form-label">CPF</label>
                <input type="text" class="form-control" id="e_cpf" value="&nbsp">
            </div>
            <div class="mb-3">
                <label for="e_nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="e_nome" value="&nbsp">
            </div>
            <div class="mb-3">
                <label for="e_telefone" class="form-label">Telefone</label>
                <input type="text" class="form-control" id="e_telefone" value="&nbsp">
            </div>
            <div class="mb-3">
                <label for="e_login" class="form-label">Login</label>
                <input type="text" class="form-control" id="e_login" value="&nbsp">
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
    var telefone = $(e.relatedTarget).data('bs-telefone');
    var login = $(e.relatedTarget).data('bs-login');
    

    document.getElementById('e_cpf').value = cpf;
    document.getElementById('e_nome').value = nome;
    document.getElementById('e_telefone').value = telefone;
    document.getElementById('e_login').value = login;
    document.getElementById('e_id').value = id;

})

function editarCadastro(){
    var id = document.getElementById('e_id').value;
    var cpf = document.getElementById('e_cpf').value;
    var nome = document.getElementById('e_nome').value;
    var telefone = document.getElementById('e_telefone').value;
    var login = document.getElementById('e_login').value;
    
    $.post("<?php echo base_url("clientes/editarcliente") ?>",               
        {id:id, cpf:cpf, nome:nome, telefone:telefone, login:login}, 
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
