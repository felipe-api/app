                <li class="categories">MENU</li>            
                <?php if($this->session->userdata('admin') == 1){ ?>
                <li><a href="/registrationuser">Cadastrar Funcionário</a></li>
                <?php } ?>
                <li><a href="/cadmarcas">Cadastrar Marca</a></li>
                <li><a href="/cadcarros">Cadastrar Modelo de Carro</a></li>
                <li><a href="/lista">Listar Carros</a></li>  
                <li><a href="/listacad">Listar Cadastros</a></li>
                <li><a href="/listalog">Listar Log's</a></li>
                <li><a href="/">Listagem Principal</a></li>                                 