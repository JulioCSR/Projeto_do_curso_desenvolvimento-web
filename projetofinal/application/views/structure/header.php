<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <title>
        Farmácia.
    </title>

    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- FontAwesome ícones -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">

    <!-- Jquery - Fazer POST http -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Sweet Alert - Mensagens Animadas -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
<!--
    cabeçalho.
    referência:https://getbootstrap.com/docs/5.1/examples/headers/
-->
<div class="container" style = "margin: 50px auto;">
    <header class="d-flex justify-content-center py-3">
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="<?php echo base_url('dashboard')?>" class="nav-link active" aria-current="page"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Dashboard</font></font></a></li>
        <li class="nav-item"><a href="<?php echo base_url('funcionarios')?>" class="nav-link"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Funcionários</font></font></a></li>
        <li class="nav-item"><a href="<?php echo base_url('clientes')?>" class="nav-link"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Clientes</font></font></a></li>
        <li class="nav-item"><a href="<?php echo base_url('medicamentos')?>" class="nav-link"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Medicamentos</font></font></a></li>
        <li class="nav-item"><a href="<?php echo base_url('dispensacao')?>" class="nav-link"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Dispensação de Remédio</font></font></a></li>
      </ul>
    </header>

  </div>