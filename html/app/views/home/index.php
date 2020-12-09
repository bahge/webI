<div class="row">
    <div class="col-1">
        <h1>Sistema de controle de Planos de Ação</h1>
        <p>
            O sistema de controle de Plano de Ação, consiste em um banco de dados para armazenamento dos planos, separados por setores e tarefas.<br>
            Essas tarefas terão seu estados, alterados pelos usuários e os responsáveis pelas tarefas, poderão ser usuários do sistema ou pessoas cadastradas.<br>
            Essa abordagem foi usada, visando por exemplo, monitorar tarefas de terceiros.<br>
            <br>
            A aplicação foi desenvolvida para execução da avaliação da discliplina de SI - PROGRAMAÇÃO EM AMBIENTE WEB I, como havia uma série de requisitos, não está implementada na integra a solução.<br>
            Podendo ser usada para estudos em outras áreas e outras disciplinas.<br>
            Sua estrutura já está dockerizada desde a versão do commit inicial e seu código foi evoluindo com a participação dos alunos:<br>
            <ul>
                <li>Leandro Garcia</li>
                <li>Gilberty Albues</li>
                <li>Fábio Cançado</li>
            </ul>
        Mais informações podem ser encontradas no <a href="https://github.com/bahge/webI">github</a> do projeto.
        </p>
        <?php
        if (isset($this->data['OPA'])){
            echo '<h1 style="color: red">' . $this->data['OPA'] . '</h1><p>Clique "<a href="'.getenv('URLBASE').'/home/start">aqui</a>" e inicie a migration do Banco de dados!</p>';
        }
        ?>
    </div>
</div><!-- End row -->
