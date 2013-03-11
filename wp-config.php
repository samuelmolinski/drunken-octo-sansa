<?php
/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'vfgv2013clone');

/** Usuário do banco de dados MySQL */
//define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
//define('DB_PASSWORD', '123!!@qwe');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'Admin');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '1234');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

//define('FORCE_SSL_LOGIN', true);
//define('FORCE_SSL_ADMIN', true);
/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'NL[@@hCA?CcrLbE45 E~JIbZ_^.vqD4;P,]wqH@/{@23BN[wCn:31+-X?RiZ1LI8');
define('SECURE_AUTH_KEY',  '/:#x6VsiUq~Fa#[nS/vN%JR3+ed5 ]6NBY}W]GE`/R0YQ7xC*0F1DrG69 ]4QU~1');
define('LOGGED_IN_KEY',    'U6F9v3GS10+=|7s~}Zc6M}GnDDY(3(.jO&b>O#b#zT;=*g[`+soT|-E=b;t$7r(y');
define('NONCE_KEY',        'Q Z *I4Yg$fMnL@C[ZnYCOe~|QS.9ObL3c3[-[iQ&Q&=KihUG`G[}Fk:8q]C+E j');
define('AUTH_SALT',        '`dq?EBoLt!01X:<-.{+Tt+c-0CRSYf$.)%0.$v*Q_$m3;j@jL+i<`-aQ+bk@eXB=');
define('SECURE_AUTH_SALT', '?/YZ%/P^La/3Wry-?2pky@RuC^v=!6lkw|oYL(/Lj8_?U$+> %uW^e*tC0*5NxXm');
define('LOGGED_IN_SALT',   'zS|$d`3-RfR:!dh-|7ojY5Q-$hK){o{wmsr;rf.k3x9+a4@f[;|i,r>0}Cne:Fo-');
define('NONCE_SALT',       'vz8mxgg xfc<4N]m%=GK-K%OYO:|R=_$yuhKM2x9ZKR B|fYgz+GM/]|5q0e8D]*');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';

/**
 * O idioma localizado do WordPress é o inglês por padrão.
 *
 * Altere esta definição para localizar o WordPress. Um arquivo MO correspondente ao
 * idioma escolhido deve ser instalado em wp-content/languages. Por exemplo, instale
 * pt_BR.mo em wp-content/languages e altere WPLANG para 'pt_BR' para habilitar o suporte
 * ao português do Brasil.
 */
define('WPLANG', 'pt_BR');

/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
