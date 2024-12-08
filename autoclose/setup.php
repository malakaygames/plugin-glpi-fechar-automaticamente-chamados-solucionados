<?php
define('AUTOCLOSE_VERSION', '1.0.0');

// Inicialização do plugin
function plugin_init_autoclose() {
   global $PLUGIN_HOOKS;
   
   $PLUGIN_HOOKS['csrf_compliant']['autoclose'] = true;
   $PLUGIN_HOOKS['item_update']['autoclose'] = [
      'Ticket' => 'plugin_autoclose_ticket_update'
   ];
}

// Informações do plugin
function plugin_version_autoclose() {
   return [
      'name' => 'AutoClose',
      'version' => AUTOCLOSE_VERSION,
      'author' => 'Adriano Marinho',
      'license' => 'GPLv3',
      'homepage' => 'https://github.com/malakaygames',
      'requirements' => [
         'glpi' => [
            'min' => '9.5',
            'max' => '10.1',
            'dev' => false
         ]
      ]
   ];
}

// Requisitos mínimos
function plugin_autoclose_check_prerequisites() {
   if (version_compare(GLPI_VERSION, '9.5', 'lt')) {
      echo "Este plugin requer GLPI >= 9.5";
      return false;
   }
   return true;
}

// Verificação de configurações
function plugin_autoclose_check_config($verbose = false) {
   if ($verbose) {
      echo 'Configuração OK'; 
   }
   return true;
}