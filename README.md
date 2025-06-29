# 💫 Tech Stars – Plataforma de Educação Digital 
 O projeto Tech_Stars surgiu a partir da urgência em promover a inclusão e representatividade de meninas nas áreas STEAM (Ciência, Tecnologia, Engenharia, Artes e Matemática).

Seu principal objetivo é oferecer uma **plataforma digital gratuita e acessível**, com foco em atender meninas do ensino fundamental e médio, por meio da disponibilização de **cursos do nível básico ao avançado**, voltados às diversas áreas da tecnologia. A proposta é criar um ambiente acolhedor e inspirador, que incentive o aprendizado, a criatividade e a autoconfiança dessas jovens.

A plataforma contará com questionários e atividades interativas que ajudarão a identificar a afinidade de cada estudante com áreas específicas da tecnologia, como programação, design, robótica ou ciência de dados. Com base nesses resultados, o sistema indicará aulas e trilhas de aprendizado personalizadas, facilitando a jornada de descoberta e aprofundamento em temas com os quais a aluna mais se identifica.

O projeto foi inicialmente desenvolvido para atender à disciplina *"Certificadora da Competência 3", do curso de Engenharia da Computação da Universidade Tecnológica Federal do Paraná – campus Cornélio Procópio (UTFPR/CP)*, e visa ser implementado em conjunto com o projeto de extensão **_Meninas no Digital._** Este projeto de extensão é gerenciado por estudantes da UTFPR, que serão responsáveis por produzir e disponibilizar os cursos, aulas e atividades, com o intuito de difundir o conhecimento nas áreas STEAM entre meninas e mulheres de forma acessível, criativa e transformadora.

## 🚀 Missão 
Promover a inclusão e o empoderamento de meninas nas áreas STEAM (Ciência, Tecnologia, Engenharia, Artes e Matemática), por meio do acesso gratuito e direcionado ao conhecimento tecnológico.

## 🌟 Funcionalidades da Plataforma 
* Quiz interativo para descobrir áreas de afinidade tecnológica;

* Trilhas de aprendizado personalizadas com base nos resultados do quiz;

* Upload de vídeos e aulas por estudantes da UTFPR;

* Categorização de conteúdos por área (programação, design, robótica, etc.);

* Área do aluno com progresso e sugestões de cursos;

* Ambiente colaborativo e intuitivo.
## 🧑‍💻 Equipe de Desenvolvimento

- Aluno 1 – Éler Yudi Mitani Sotoma
- Aluno 2 – Guilherme Renato Terra De Macedo
- Aluno 3 – Leonardo Rodrigues
- Aluno 4 – Vanderson Augusto Ferreira da Rosa
---

## ✨ Funcionalidades Desenvolvidas até o momento

- Cadastro de novas usuárias
- Login com autenticação de senha criptografada
- Dashboard com botão "Descubra sua trilha"
- Quiz dinâmico com 10 perguntas e 8 áreas de afinidade
- Exibição da trilha ideal ao final do quiz
- Botões de “Refazer quiz” e “Ver minha trilha”

## 🛠 Tecnologias Utilizadas 
HTML, CSS, JavaScript, PHP, MySQL — além de ferramentas de apoio como Google Drive, Figma, GitHub e Jira, garantindo organização, versionamento e colaboração eficiente durante o desenvolvimento.

<p align="left">
  <img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" alt="HTML5" />
  <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" alt="CSS3" />
  <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript" />
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP" />
  <img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
  <img src="https://img.shields.io/badge/Figma-F24E1E?style=for-the-badge&logo=figma&logoColor=white" alt="Figma" />
  <img src="https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white" alt="GitHub" />
  <img src="https://img.shields.io/badge/Jira-0052CC?style=for-the-badge&logo=jira&logoColor=white" alt="Jira" />
</p>

## 📦 Como instalar e executar o sistema

### 📥 1. Pré-requisitos
Para executar o projeto, você precisará de um ambiente de servidor local que suporte PHP e MySQL. Recomendamos:
### XAMPP

- Baixe e instale o XAMPP a partir do site oficial: https://www.apachefriends.org/pt_br/index.html

## ⚙️ 2. Clonar repositório

1.  Clone este repositório para dentro da pasta raiz do seu servidor XAMPP. A pasta se chama htdocs.

2. Abra o terminal ou Git Bash.

3. Navegue até a pasta `htdocs` do XAMPP (geralmente `C:/xampp/htdocs`).

4. Execute o comando clone:
```bash
    -git clone https://github.com/seu-usuario/tech-stars.git
```
(Lembre-se de substituir `seu-usuario` pelo nome correto)

### ⚠️ Atenção: Configuração do Banco de Dados
Por padrão, o projeto está configurado para o ambiente XAMPP padrão, que utiliza as seguintes credenciais para o MySQL:

- Usuário: `root`
- Senha: `(vazia)`

Se o seu ambiente MySQL utiliza um usuário ou senha diferente, você precisará alterar as credenciais em dois arquivos antes de prosseguir:

1. No arquivo `setup.php` (para a instalação):


Abra o arquivo e altere as seguintes linhas no topo do código

```bash
// --- CONFIGURAÇÕES DO BANCO DE DADOS ---
$host = 'localhost';
$user = 'seu_usuario_aqui'; // Altere de 'root' para o seu usuário
$pass = 'sua_senha_aqui';   // Altere de '' para a sua senha
$db_name = 'tech_stars_db';
```
2. No arquivo `conexao.php` (para a aplicação):

Faça a mesma alteração neste arquivo para que a aplicação funcione após a instalação:

```bash
// Ajuste com seus dados de conexão
$host = 'localhost';
$db   = 'tech_stars_db';
$user = 'seu_usuario_aqui'; // Altere de 'root' para o seu usuário
$pass = 'sua_senha_aqui';   // Altere de '' para a sua senha
$charset = 'utf8mb4';
```
## ▶️ 3. Executar o Script de Instalação

1. Abra o Painel de Controle do XAMPP e inicie os módulos Apache e MySQL.

2. Abra seu navegador e acesse o script de instalação automática:

```bash
    http://localhost/tech-stars/setup.php
```
3. Siga as instruções na tela. O script irá criar o banco de dados, a tabela e um usuário de teste para você.

4. (Importante) Após a instalação bem-sucedida, apague o arquivo setup.php do seu projeto por segurança.

## 🧪 Acessar a Aplicação
Com a instalação concluída, acesse a página inicial do projeto:

`http://localhost/tech-stars/`

Você pode fazer login com o usuário de teste  ou registrar um novo usuário.

```bash
usuário de teste: teste@techstars.com
senha: 123456
```

