<?php
function plugin_autoclose_install() {
   global $DB;

   if (!$DB->tableExists("glpi_plugin_autoclose_config")) {
      $query = "CREATE TABLE `glpi_plugin_autoclose_config` (
         `id` int(11) NOT NULL AUTO_INCREMENT,
         `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
         `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
         PRIMARY KEY (`id`),
         KEY `name` (`name`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
      
      $DB->query($query) or die("Erro ao criar tabela de configuração " . $DB->error());
   }
   
   return true;
}

function plugin_autoclose_uninstall() {
   global $DB;
   
   $tables = [
      'glpi_plugin_autoclose_config'
   ];

   foreach($tables as $table) {
      $DB->query("DROP TABLE IF EXISTS `$table`");
   }
   
   return true;
}

function plugin_autoclose_ticket_update(CommonGLPI $item) {
    if ($item instanceof Ticket) {
        // Verifica se uma solução foi adicionada e o status está como solucionado
        if ($item->fields['status'] == CommonITILObject::SOLVED) {
            // Prepara o log
            $changes[0] = '0';
            $changes[1] = $item->fields['status'];
            $changes[2] = CommonITILObject::CLOSED;
            
            // Atualiza o status para fechado
            $input = [
                'id' => $item->fields['id'],
                'status' => CommonITILObject::CLOSED,
                '_auto_closed' => true
            ];
            
            // Adiciona entrada no histórico
            Log::history($item->fields['id'], 'Ticket', $changes, 'AutoClose', Log::HISTORY_UPDATE_SUBITEM);
            
            // Atualiza o ticket
            $item->update($input);
        }
    }
    return true;
}