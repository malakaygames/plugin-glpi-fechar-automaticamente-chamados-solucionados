<?php
include ("../../../inc/includes.php");

// Verifica os direitos de acesso
Session::checkRight("config", UPDATE);

// Cabeçalho da página
Html::header('AutoClose', $_SERVER['PHP_SELF'], "config", "plugins");

// Exibe o formulário de configuração
$plugin = new Plugin();

if ($plugin->isActivated("autoclose")) {
   echo "<div class='center'>";
   echo "<h2>" . __('Configurações do AutoClose', 'autoclose') . "</h2>";
   echo "<br>";
   
   // Aqui você pode adicionar campos de configuração se necessário
   
   echo "</div>";
} else {
   Html::displayRightError();
}

Html::footer();