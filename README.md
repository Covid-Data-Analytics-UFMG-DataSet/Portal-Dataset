# Portal-Dataset

O Projeto COVID DATA ANALYTICS, idealizado no Departamento de Ciências da Computação da Universidade Federal de Minas Gerais (DCC/UFMG), tem como objetivo central entender os impactos da COVID-19 nos âmbitos da Saúde Pública e da Socioeconomia no Brasil. Como parte do projeto, um buscador de arquivos científicos relacionados ao tema foi desenvolvido dentro do website Wordpress da iniciativa.

# Objetivo

O objetivo do projeto é disponibilizar informações confiáveis para a população sobre a pandemia e as suas consequências para a socioeconomia e saúde pública do Brasil.

# Pré-requisitos

-Instalação de Wordpress, tema astrid
-Ter accesso no banco de dados do Wordpress
-Ter accesso a pasta de Wordpress
-Conhecer as credencias de acesso e senhas do banco de dados do Wordpress

- O tema pode ser outro diferente mas para o Portal será usado o astrid

# Passos de Instalação

### 1. Clonar os arquivos do repositório

Clone os repositórios usando a descarga direta do site de git hub ou usando o comando no terminal

```
git clone https://github.com/Covid-Data-Analytics-UFMG-DataSet/Portal_Dataset.git

```

- precisa ter instalado git instalado no seu computador

### 2. Copie arquivo buscador.php

Ingresse na pasta buscador do repositorios clonado e copie o arquivo 'buscador.php' no diretorio raiz onde seu wordpress foi instaldo.
![img](https://github.com/Covid-Data-Analytics-UFMG-DataSet/Portal_Dataset/blob/master/images/Captura%20de%20pantalla%20de%202020-10-16%2018-26-59.png?raw=true)

### 3. Altere o arquivo search.php

Ingresse na pasta buscador do repositorios clonado e copie o arquivo 'search.php', no diretório raiz do seu site Wordpress, vá para `wp-content/themes/astrid/search.php`, apague e cole o arquivo.
Ingresse no arquivo `wp-content/themes/astrid/search.php`usando o editor de texto e digite as credenciais do seu banco de dados nos campos indicados a continuação:

```
$host = "yourhost";
$user = "youruser";
$password = "yourpass";
$database = "yourdb";
```

### 3. Estruture o banco de dados

Dentro do editor do seu banco de dados, execute o código abaixo para criar a tabela `file_metadata` que será consumida pelo buscador

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

![img](https://github.com/Covid-Data-Analytics-UFMG-DataSet/Portal_Dataset/blob/master/images/DER.png?raw=true)

### 4. Ingresse os dados no banco de dados

Ingresse na pasta buscador do repositorios clonado e ubique o arquivo `datasetCDA.sql` ingresse no banco de dados e se ubique na tabela `file_metadata` se esta usando o visor de banco de dados ![img](https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.programaenlinea.net%2Fcomo-instalar-phpmyadmin-en-linux%2F&psig=AOvVaw0TCEI4fdJIUWjC3QRnTcB8&ust=1602974441187000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCKDFp6SXuuwCFQAAAAAdAAAAABAD) pode ingressar no menu de importação e anexar o arquivo, Wordpress ![img](https://github.com/Covid-Data-Analytics-UFMG-DataSet/Portal_Dataset/blob/master/images/banco-dados.png?raw=true) e depois oprimir continuar.

O banco de dados já esta com os dados prontos para ser usados. Ir diretamente para o passo (5. Insira o CSS customizado\_).

### 4.1 Atualize o banco de dados

Ingresse na pasta buscador do repositorios clonado e ubique o arquivo `datasetCDA.sql` Para atualizar o banco de dados, ingresse no gestor do banco de dados e apague a tabela `file_metadata` usando o comando `drop table file_metadata` Seguidamente realice os passos (3. Estruture o banco de dados e 4. Ingresse os dados no banco de dados) para este passo utilice o arquivo `update-datasetCDA.sql`.

### 4.2 alternativa XML para preencher o Banco de dados

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

### 5. Insira o CSS customizado

No painel de administrador do seu site Wordpress ingresse na seção Plugins procure e instale o plugin Simple Custom CSS. ![img](https://github.com/Covid-Data-Analytics-UFMG-DataSet/Portal_Dataset/blob/master/images/Simple%20Custom%20CSS.png?raw=true) Feito isso, acesse seus plugins e encontre o Simple Custom CSS. Nele, haverá duas opções: Ativar/Desativar e Adicionar CSS. Ative ele se estiver desativado e clique em Adicionar CSS. ![img](https://github.com/Covid-Data-Analytics-UFMG-DataSet/Portal_Dataset/blob/master/images/css-adicionar.png?raw=true) Agora, um editor de código CSS será aberto. Adicione nele o código CSS que pode ser encontrado no repositorio clonado na ubicação `buscador/custom-css.css` neste repositório.

Para verificar se o sistema está funcionando ingresse no endereço http://covid.dcc.ufmg.br/buscador.php e realize a busca covid. Deverão aparecer diferentes resutaldos.
![img](https://github.com/Covid-Data-Analytics-UFMG-DataSet/Portal_Dataset/blob/master/images/buscador.png?raw=true)

# Metodologia

O buscador proposto usa os arquivos coletados durante o desenvolvimento do projeto Covid Data Analitycs, os arquivos foram armazenados num repositorio em nuve tratados e transformado em um arquivo com uma estrutura XML.  
Para imprementação desse arquivo foram realizados os seguintes pasos:
No diretório raiz do Wordpress, o arquivo buscador.php foi criado, contendo um formulário de pesquisa HTML e código PHP para carregar o template e as configurações do Wordpress que estão sendo usados. Tal formulário contém o atributo action, que redireciona o usuário para a página onde aparecem os resultados, filtros de pesquisa que foram considerados interessantes para o tipo de busca executada, um campo de texto e dois campos do tipo 'hidden' (escondido), que não são visíveis para o usuário. Um deles tem o valor 'buscador' e serve como identificador e o outro é um campo padrão do Wordpress para formulários de pesquisa. Além disso, ainda no diretório raiz do Wordpress, em wp-content/themes/NOME_DO_SEU_TEMA, o arquivo search.php, cuja função é mostrar os resultados de pesquisa, foi alterado das seguintes formas: primeiramente, uma condição foi criada para averiguar se o formulário que foi enviado se trata do buscador ou de um formulário qualquer do Wordpress. Caso seja o buscador, uma conexão com o banco de dados que está sendo usado é criada por meio de uma instância da classe wpdb (conector a banco de dados do Wordpress), uma busca é executada usando o método get_results() do wpdb de acordo com os parâmetros enviados no formulário e os resultados são retornados como HTML. Contudo, para um formulário padrão do Wordpress, o comportamento usual é mantido.

Também foram criadas classes CSS para estilizar todo HTML gerado. O código CSS final, que pode ser encontrado neste repositório em buscador/custom-css.css, foi inserido no painel de administrador do Wordpress, utilizando o plugin Simple Custom CSS. O banco de dados consumido pelo buscador é relacional, utiliza MySQL e contém apenas uma tabela, cujo objetivo é referenciar os metadados de interesse dos arquivos reunidos pelo projeto. Para que o banco de dados fosse preenchido de maneira rápida e prática, o script que pode ser encontrado neste repositório em buscador/inserir_XML_bd.py foi criado. Ele percorre um arquivo XML com estrutura compatível com a do encontrado neste repositório em buscador/amostra_metadados.xml e insere um registro no banco de dados para cada tag ID_Arquivo presente no XML.
