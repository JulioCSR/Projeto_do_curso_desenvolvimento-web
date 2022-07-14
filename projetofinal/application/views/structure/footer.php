
<!--
    Rodapé da página.
    referência:https://getbootstrap.com/docs/5.1/examples/footers/
-->
<div class="container" style = "margin: auto;">
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <p class="col-md-4 mb-0 text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">© 2021 Company, Inc</font></font></p>

    <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
    </a>

    <ul class="nav col-md-8 justify-content-end" style = "margin-left: auto;">
      <li class="nav-item"><a href="<?php echo base_url('dashboard')?>" class="nav-link px-2 text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Dashboard</font></font></a></li>
      <li class="nav-item"><a href="<?php echo base_url('funcionarios')?>" class="nav-link px-2 text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Funcionários</font></font></a></li>
      <li class="nav-item"><a href="<?php echo base_url('clientes')?>" class="nav-link px-2 text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Clientes</font></font></a></li>
      <li class="nav-item"><a href="<?php echo base_url('medicamentos')?>" class="nav-link px-2 text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Medicamentos</font></font></a></li>
      <li class="nav-item"><a href="<?php echo base_url('dispensacao')?>" class="nav-link px-2 text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Dispensação de Remédio</font></font></a></li>
    </ul>
  </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>