<?php
// incluir a lib fo facebook
include_once 'fb/facebook.php';
 
// Cria a instancia da aplicacao, informando o appid e o secret
$facebook = new Facebook(array(
  'appId'  => '440982045925181',
  'secret' => 'b8716067e7df5173183aa5865b021657',
));
 
// habilita suporte para upload de arquivos
$facebook->setFileUploadSupport(true);
 
// obtem o id do usuario
$user = $facebook->getUser();
 
if ($user) { // usuario logado
        try {
                // verifica se o usuario permitiou o aplicativo publicar fotos em seu perfil
                $permissions = $facebook->api("/me/permissions");
                if(!array_key_exists('publish_stream', $permissions['data'][0])) {
                    header( "Location: " . $facebook->getLoginUrl(array("scope" => "publish_stream")) );
                    exit;
                }
 
                // dados para envio da publicacao da foto
                $post_data = array(
                        "message" => "teste_" . time(),
                        "image" => '@' . realpath($picture), // localizacao da foto
                );
 
                // publica foto na timeline
                $data['photo'] = $facebook->api("/me/photos", "post", $post_data);
                echo "Foto publicada com sucesso!";
 
        } catch (FacebookApiException $e) {
                // tratamento de excecao
                echo($e);
                $user = null;
        }
} else {
        // usuario nao logado, solicitar autenticacao
        $loginUrl = $facebook->getLoginUrl();
        echo "<a href=\"$loginUrl\">Facebook Login</a><br />";
        echo "<strong><em>Voc&ecirc; n&atilde;o esta conectado..</em></strong>";
}