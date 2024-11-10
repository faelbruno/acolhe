# Acolhe

**Acolhe** é um sistema de registro de frequência e relatórios de alunos desenvolvido para a **Rede Cidadã de Mato Grosso**. O sistema facilita o gerenciamento de alunos, professores e oficinas em diferentes unidades, permitindo o acompanhamento das atividades e a emissão de relatórios de frequência de forma ágil e precisa.

## Sumário

- [Visão Geral](#visão-geral)
- [Funcionalidades Principais](#funcionalidades-principais)
- [Estrutura do Sistema](#estrutura-do-sistema)
- [Instalação](#instalação)
- [Configuração](#configuração)
- [Uso](#uso)
- [Contribuição](#contribuição)
- [Licença](#licença)

## Visão Geral

O sistema **Acolhe** foi desenvolvido para melhorar o gerenciamento da presença e do cadastro dos alunos nas oficinas promovidas pela Rede Cidadã de Mato Grosso. Com uma interface intuitiva, ele permite que coordenadores e professores registrem a frequência dos alunos e armazenem relatórios sobre o progresso e as atividades realizadas em cada unidade da Rede Cidadã.

## Funcionalidades Principais

- **Registro de Alunos**: Cadastro completo dos alunos com dados como CPF, data de nascimento, endereço, nome dos responsáveis, contato e unidade vinculada.
- **Cadastro de Professores e Oficinas**: Adição e gerenciamento de professores e oficinas, com vínculo específico entre unidades e atividades.
- **Registro de Presença**: Registro de frequência dos alunos nas oficinas, com data marcada pelo professor em um calendário específico.
- **Observações e Relatórios**: Adição de observações personalizadas sobre o desempenho e comportamento dos alunos, com acesso facilitado para relatórios de frequência.
- **Gerenciamento por Unidades**: Cada unidade pode ter seu próprio conjunto de oficinas e professores, com acesso restrito para garantir a segurança dos dados.
- **Upload de Fotos de Alunos**: Upload de imagens dos alunos para melhor identificação e acompanhamento visual.

## Estrutura do Sistema

O sistema é construído em PHP e utiliza **XAMPP** para ambiente local de desenvolvimento. As principais tabelas do banco de dados incluem:

- **usuarios**: Armazena informações dos usuários do sistema, como professores e coordenadores.
- **alunos**: Dados completos dos alunos registrados, incluindo informações pessoais e responsáveis.
- **oficinas**: Detalhes das oficinas disponíveis em cada unidade.
- **presencas**: Registro das presenças dos alunos nas atividades.
- **observacoes**: Tabela para armazenar anotações e comentários sobre o progresso dos alunos.

## Instalação

Para instalar o **Acolhe** localmente, siga os passos abaixo:

1. Clone o repositório do projeto:
    ```bash
    git clone https://github.com/faelbruno/acolhe.git
    ```
2. Coloque o projeto no diretório `htdocs` do XAMPP.
3. Importe o banco de dados `acolhe.sql` localizado na pasta `/database` para o MySQL.
4. Atualize as credenciais de banco de dados no arquivo `config.php` para corresponder ao seu ambiente.

## Configuração

Após a instalação, configure os seguintes itens:

1. Certifique-se de que o XAMPP esteja em execução e que o servidor MySQL e Apache estejam ativos.
2. No banco de dados, configure os usuários e as permissões conforme as unidades e oficinas.
3. Acesse a interface administrativa para criar as oficinas e vincular os professores e alunos aos cursos disponíveis.

## Uso

### Perfil Administrativo

O perfil administrativo é responsável pelo cadastro e gerenciamento de alunos, professores e oficinas, com acesso limitado à unidade em que o administrador está vinculado. Esse perfil também pode editar e excluir registros conforme necessário.

### Perfil do Professor

O perfil do professor permite o registro da presença dos alunos e o acesso ao histórico de frequência e observações. Cada professor é vinculado a uma ou mais oficinas dentro de uma unidade específica.

## Contribuição

Se você deseja contribuir com o desenvolvimento do **Acolhe**, siga estas etapas:

1. Faça um fork do repositório.
2. Crie uma nova branch:
    ```bash
    git checkout -b feature/nome-da-sua-feature
    ```
3. Faça suas alterações e commit:
    ```bash
    git commit -m "Adiciona nova funcionalidade"
    ```
4. Envie para o seu repositório:
    ```bash
    git push origin feature/nome-da-sua-feature
    ```
5. Abra um Pull Request no repositório principal.

## Licença

Este projeto está licenciado sob a licença MIT. Consulte o arquivo `LICENSE` para mais detalhes.
