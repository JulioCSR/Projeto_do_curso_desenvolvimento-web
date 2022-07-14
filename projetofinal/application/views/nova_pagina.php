
<!--
    Cartões para acessar as listas.
    referência:https://getbootstrap.com/docs/5.1/components/card/
-->
  <div class="shadow p-3 mb-5 bg-body rounded">
    <div class="row">
    <div class="col-sm-3">
        <div class="card text-white bg-primary">
        <div class="card-body">
            <h5 class="card-title">Funcionários</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="<?php echo base_url('funcionarios')?>" class="btn btn-dark">Abrir lista</a>
        </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card text-white bg-success">
        <div class="card-body">
            <h5 class="card-title">Clientes</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="<?php echo base_url('clientes')?>" class="btn btn-dark">Abrir lista</a>
        </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Medicamentos</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="<?php echo base_url('medicamentos')?>" class="btn btn-dark">Abrir Lista</a>
        </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card text-white bg-danger">
        <div class="card-body">
            <h5 class="card-title">Dispensação de Remédio</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="<?php echo base_url('dispensacao')?>" class="btn btn-dark">Abrir Lista</a>
        </div>
        </div>
    </div>
    </div>
</div>

    