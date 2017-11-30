<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa user o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */
// ** Configurações do MySQL - Você pode pegar estas informações
// com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */

define('DB_NAME', 'mlg_desenv');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'mlg_desenv');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'mLGdes@2017!@#');

/** Nome do host do MySQL */
define('DB_HOST', 'mlg_desenv.mysql.dbaas.com.br');
define('WPLANG', 'pt_BR');
/** Charset do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');


/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '|miZpT{s#[}A-N4+Q:(%03-sB!>-K03Q/mm ,x)-FndM<>]^y+L{^r;f4&-e`S/6');
define('SECURE_AUTH_KEY',  'bqA61-`$JaQiVh::+J?YkuTeBp=}-4aW;cF7Me)Le*@MG^W@hf/U#@_{X~Ouo_i)');
define('LOGGED_IN_KEY',    'U9Ty_y;@T|Y@1}ZJBlDrd:*`Vz]B=Nzl[yxI9RHgqw}1o;QpMev;GB9JxYz$^4D7');
define('NONCE_KEY',        ')|[9O~ MTIz5-qi3#fg0f:hT- jZd7qH~&.-few1+tDcVmb)_-E8dg5+ZnY5~g<x');
define('AUTH_SALT',        'NC;&.A%~>&-<+-WO=<x.H<dE6sk^?O)ivs2$?t%6<EAnc?+@-g1K}>!0X!!C#8G:');
define('SECURE_AUTH_SALT', '9*>3<)=JopNq_IX}s(6j#nV{?gIsJoQO7G50vw*R.`MDT W|$p.d|Qsv8!%8I^+O');
define('LOGGED_IN_SALT',   '4vEr}lOw)k|x`B7|B-l2g<z)sZF*Y.kHIP=Kj-PY??8P~U%LDZ_9u;=7Vh`-pXj9');
define('NONCE_SALT',       'Y(34_wDKy[rEyGJK^,L!`16c3hA3gNrv<F!nTlhs9@8}W&)Acb+_A`6=-;ABt^_6');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * para cada um um único prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';

/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
