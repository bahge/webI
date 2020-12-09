<?php
echo (($this->data[0] == true) ? 'Tabela pessoas criada com sucesso<br>': 'Ocorreu um erro ao criar a tabela pessoas<br>' );
echo (($this->data[1] == true) ? 'Tabela usuários criada com sucesso<br>': 'Ocorreu um erro ao criar a tabela usuários<br>' );
echo (($this->data[2] == true) ? 'Tabela planos de ação criada com sucesso<br>': 'Ocorreu um erro ao criar a tabela planos de ação<br>' );
echo (($this->data[3] == true) ? 'Tabela setores criada com sucesso<br>': 'Ocorreu um erro ao criar a tabela setores<br>' );
echo (($this->data[4] == true) ? 'Tabela tarefas criada com sucesso<br>': 'Ocorreu um erro ao criar a tabela tarefas<br>' );
echo (($this->data[5] == true) ? 'Tabela estados de resolução criada com sucesso<br>': 'Ocorreu um erro ao criar a tabela estados de resolução<br>' );

?>
<br>
<br>
<h3>Clique "<a href="<?= getenv('URLBASE');?>/home/index">aqui</a>" para retornar e Be Harry!</h3>
