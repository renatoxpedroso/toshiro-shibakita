<html>

  <head>
  <title>Exemplo PHP</title>
  </head>
  <body>

  <?php
  ini_set("display_errors", 1);
  header('Content-Type: text/html; charset=iso-8859-1');

  echo 'Versao Atual do PHP: ' . phpversion() . '<br>';

  $servername =  $_ENV["SERVER_NAME"];
  $username = $_ENV["MYSQL_USER"];
  $password = $_ENV["MYSQL_PASSWORD"];
  $database = $_ENV["MYSQL_DATABASE"];

  // Criar conexão
 // Função para conectar ao banco de dados
  function connectDatabase($servername, $username, $password, $database) {
    $link = new mysqli($servername, $username, $password, $database);
    if ($link->connect_error) {
        die("Connection failed: " . $link->connect_error);
    }
    $link->set_charset("utf8");
    return $link;
  }

  // Função para inserir dados na tabela
  function insertData($link, $alunoId, $nome, $sobrenome, $endereco, $cidade, $host) {
    $stmt = $link->prepare("INSERT INTO dados (AlunoID, Nome, Sobrenome, Endereco, Cidade, Host) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $alunoId, $nome, $sobrenome, $endereco, $cidade, $host);
    if ($stmt->execute()) {
        return "New record created successfully";
    } else {
        return "Error: " . $stmt->error;
    }
  }

  // Conexão com o banco de dados
  $link = connectDatabase($servername, $username, $password, $database);

  $valor_rand1 =  rand(1, 999);
  $valor_rand2 = strtoupper(substr(bin2hex(random_bytes(4)), 1));
  $host_name = gethostname();


  // Gerar valores aleatórios
  $valor_rand1 = rand(1, 999);
  $valor_rand2 = strtoupper(substr(bin2hex(random_bytes(4)), 1));
  $host_name = gethostname();

  // Inserir dados
  echo insertData($link, $valor_rand1, $valor_rand2, $valor_rand2, $valor_rand2, $valor_rand2, $host_name);

  // Fechar conexão
  $link->close();

  ?>
  </body>
</html>
