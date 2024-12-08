<?php
class PluginAutoclose extends CommonDBTM {
   static $rightname = 'config';
   
   static function getTypeName($nb = 0) {
      return __('AutoClose', 'autoclose');
   }
   
   function getTabNameForItem(CommonGLPI $item, $withtemplate = 0) {
      if ($item->getType() == 'Config') {
         return __('AutoClose', 'autoclose');
      }
      return '';
   }
   
   static function displayTabContentForItem(CommonGLPI $item, $tabnum = 1, $withtemplate = 0) {
      if ($item->getType() == 'Config') {
         self::showConfigForm();
      }
      return true;
   }
   
   static function showConfigForm() {
      global $CFG_GLPI;
      
      echo "<div class='center'>";
      echo "<form name='form' action='".Toolbox::getItemTypeFormURL(__CLASS__)."' method='post'>";
      echo "<table class='tab_cadre_fixe'>";
      echo "<tr><th colspan='4'>" . __('Configurações do AutoClose', 'autoclose') . "</th></tr>";
      
      // Aqui você pode adicionar campos de configuração se necessário
      
      echo "</table>";
      Html::closeForm();
      echo "</div>";
   }
}