# Portal-Dataset

O Projeto COVID DATA ANALYTICS, idealizado no Departamento de Ciências da Computação da Universidade Federal de Minas Gerais (DCC/UFMG), tem como objetivo central entender os impactos da COVID-19 nos âmbitos da Saúde Pública e da Socioeconomia no Brasil. Como parte do projeto, um buscador de arquivos científicos relacionados ao tema foi desenvolvido dentro do website Wordpress da iniciativa.

# Objetivo

O objetivo do projeto é disponibilizar informações confiáveis para a população sobre a pandemia e as suas consequências para a socioeconomia e saúde pública do Brasil.

# Passos de Instalação

### 1. Crie o arquivo do buscador

No diretório raiz do seu site Wordpress, crie um arquivo buscador.php. Lá, cole o código que está em buscador/buscador.php neste repositório.

### 2. Altere o arquivo search.php

No diretório raiz do seu site Wordpress, vá para wp-content/themes/NOME_DO_TEMA_QUE_VOCÊ_ESTÁ_USANDO/search.php, apague todo código lá e cole o código que está em buscador/search.php neste repositório.

Nele, insira o nome do tema que você está usando em NOME_DO_SEU_TEMA:

```

<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package NOME_DO_SEU_TEMA
 */

get_header(); ?>
```

E as credenciais do seu banco de dados:

```

$host = "yourhost";
$user = "youruser";
$password = "yourpass";
$database = "yourdb";
```

### 3. Estruture o banco de dados

Dentro do editor do seu banco de dados, execute o código abaixo para criar a tabela file_metadata, que está sendo consumida pelo buscador

```

CREATE TABLE file_metadata (
	  file_id int not null auto_increment primary key,
    file_name varchar(255) not null,
    file_type varchar(255) not null,
    file_description text not null,
    file_keywords text not null,
    file_theme varchar(255) not null,
    file_publisher varchar(255) not null,
    file_creator varchar(255) not null,
    file_team varchar(255) not null,
    file_team_members text not null,
    file_issued date not null,
    file_modified date not null,
    file_collection_date date not null,
    file_start_date date not null,
    file_end_date date not null,
    file_spatial varchar(255) not null,
    file_source varchar(255) not null,
    file_language varchar(255) not null,
    file_url varchar(255) unique key not null
);
```

Essa tabela tem a seguinte estrutura:

![DER](https://github.com/Covid-Data-Analytics-UFMG-DataSet/Portal_Dataset/tree/master/images/DER.png)

Caso queira preencher o banco por meio de um arquivo XML, é possível fazê-lo por meio do script neste repositório em buscador/inserir_XML_bd.py. Apenas substitua 'CAMINHO_PARA_ARQUIVO' pelo caminho, a partir da pasta raíz do seu computador, até o seu arquivo XML:

```
arquivo = 'CAMINHO_PARA_ARQUIVO/metadados.xml'
inserir_XML(arquivo)
```

E insira as credencias do seu banco de dados:

```
mydb = mysql.connector.connect(
    host="yourhost",
    user="youruser",
    password="yourpassword",
    database="yourdatabase"
)
```

Para rodar o script, baixe ele em seu computador, abra um terminal, substitua 'CAMINHO PARA ARQUIVO' no comando abaixo pelo caminho até o script desde a pasta raíz e execute:

```
py CAMINHO_PARA_ARQUIVO/inserir_XML_bd.py
```

Contudo, para que funcione, a estrutura do XML deve ser compatível com o exemplo em buscador/amostra_metadados.xml.

### 4. Insira o CSS customizado

No painel de administrador do seu site, instale o plugin Simple Custom CSS. Feito isso, acesse seus plugins e encontre o Simple Custom CSS. Nele, haverá duas opções: Ativar/Desativar e Adicionar CSS. Ative ele se estiver desativado e clique em Adicionar CSS. Agora, um editor de código CSS será aberto. Adicione nele o código CSS que pode ser encontrado em buscador/custom-css.css neste repositório.

# Metodologia

No diretório raiz do Wordpress, o arquivo buscador.php foi criado, contendo um formulário de pesquisa HTML e código PHP para carregar o template e as configurações do Wordpress que estão sendo usados. Tal formulário contém o atributo action, que redireciona o usuário para a página onde aparecem os resultados, campos de pesquisa que foram considerados interessantes para o tipo de busca executada e um campo do tipo 'hidden' (escondido), que não é visível para o usuário, tem o valor 'buscador' e serve como identificador. Além disso, ainda no diretório raiz do Wordpress, em wp-content/themes/NOME_DO_SEU_TEMA, o arquivo search.php, cuja função é mostrar os resultados de pesquisa, foi alterado das seguintes formas: primeiramente, uma condição foi criada para averiguar se o formulário que foi enviado se trata do buscador ou de um formulário qualquer do Wordpress. Caso seja o buscador, uma conexão com o banco de dados que está sendo usado é criada por meio de uma instância da classe wpdb (conector a banco de dados do Wordpress), uma busca é executada usando o método get_results() do wpdb de acordo com os parâmetros enviados no formulário e os resultados são retornados como HTML. Contudo, para um formulário padrão do Wordpress, o comportamento usual é mantido. Também foram criadas classes CSS para estilizar todo HTML gerado. O código CSS final, que pode ser encontrado neste repositório em buscador/custom-css.css, foi inserido no painel de administrador do Wordpress, utilizando o plugin Simple Custom CSS. O banco de dados consumido pelo buscador é relacional, utiliza MySQL e contém apenas uma tabela, cujo objetivo é referenciar os metadados de interesse dos arquivos reunidos pelo projeto. Para que o banco de dados fosse preenchido de maneira rápida e prática, o script que pode ser encontrado neste repositório em buscador/inserir_XML_bd.py foi criado. Ele percorre um arquivo XML com estrutura compatível com a do encontrado neste repositório em buscador/amostra_metadados.xml e insere um registro no banco de dados para cada tag ID_Arquivo presente no XML.
