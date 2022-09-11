# estrutura do projeto codeignite

## user_guide
É toda documentação do codeignite que é carregada no seu projeto, muito útil numa situação em que você não tem internet, mas precisa dar andamento no seu projeto e precisa consultar a documentação do codeingite.

## system
É onde fica o core do codeignite, em outras palavras a gente não mexe!

## application
É onde ficará o nucleo do nosso projeto;

# criando arquivo .htaccess

Vamos criar um arquivo na raiz do projeto com o seguinte nome:

~~~
.htaccess
~~~

E dentro do arquivo digitaremos o seguinte código:

~~~php
RewriteEngine on
RewriteCond $1 !^(index\.php|resource|robots\.txt)
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d 
RewriteRule ^(.*)$ index.php/$1 [L,QSA]
~~~

Esse arquivo será responsavel por deixar nossa URL mais amigável ao usuário.

# padrão mvc

## controller
Um **controlador** é uma das camadas que é responsavel por carregar e tratar dados vindo da camada **model** e enviar para a camada **view**;

## views
Camada responsável por receber os dados da camada **controller** e exibir em tela para o clinte;

## models
Camada responsável pela comunicação com o Banco de Dados;

# criando um controlador e uma view

Primeiramente vamos na pasta **controllers** do nosso projeto, e vamos criar um arquivo com extensão .php e nomear de *Chamou* ou pode colocar o nome que desejar, lembrando de sempre nomear com a primeira letra *maiúscula*;

Após criar o arquivo, iremos realizar uma codificação de segurança, para que esse arquivo não seja acessado diretamente;

Nosso código inicial ficará assim:

~~~php
<?php
defined ('BASEPATH') OR exit ('Você não tem permissão para acessar esse arquivo!');
~~~

Agora iremos criar a função do nosso controller, que será feito através de uma classe vinda do Codeignite que é a classe *CI_Controller*, que devemos nomear igual ao nome do controller que estamos criando, inclusive começando com letra maiúscula;

Em seguida dentro da classe *Chamou* iremos criar uma função pública com o nome *index*, você pode nomear como desejar. E como parâmetros da função, iremos chamar a view *chamou*, que deve ser nomeada com todas as letras minúscula;

Nosso código ficará assim:

~~~php
<?php
defined ('BASEPATH') OR exit ('Você não tem permissão para acessar esse arquivo!');

class Chamou extends CI_Controller{

    public function index() {

        $this->load->view('chamou');

    }

}
~~~

Agora precisamos criar a nossa view;

Então vamos na pasta *views* no nosso projeto e vamos criar um arquivo com extensão .php e nomear conforme nome que definimos dentro do nosso controler na parte da função pública, que no caso é *chamou*;

Após criar podemos utilizar o HTML para desenhar nossa página com as informações que precisamos.No nosso caso de exemplo iremos apenas colocar um h1 com a frase: "Você realizou a chamada da view "chamou"";

Nosso arquivo *chamou.php* ficará com o seguinte código:

~~~php
<h1>"Você realizou a chamada da view "chamou""</h1>
~~~

E para testarmos nosso *controller* e nossa *view* devemos acessar a URL do nosso projeto no navegador;

No meu caso defini meu projeto na porta 3000, e o nome do meu projeto é **humble**, logo a URL ficará assim:

http://localhost:3000/humble/chamou

O resultado no navegador será:

<img src="img\controller_view.png">

# alterando meu controlador padrão/index 

Basta ir na pasta **config** e abrir o arquivo **routes.php**, que é o arquivo responsável por nossas rotas;

Você encontrará o arquivo com o seguinte código:

~~~php
<?php
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
~~~

Como pode ver é bem fácil identificar onde devemos modificar para alterar qual será o nosso controller padrão;

No nosso exemplo vamos colocar nosso controller padrão o **"hamou"**, então nosso código ficará assim:

~~~php
<?php
$route['default_controller'] = 'chamou';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
~~~

E se acessarmos nossa URL principal sem nenhum parâmetro de controller:

http://localhost:3000/humble/

Perceberemos que nosso controller padrão mudou;

O resultado no navegador será:

<img src="img\controllerpadrao.png">

# Adicionando o Plugin ION AUTH