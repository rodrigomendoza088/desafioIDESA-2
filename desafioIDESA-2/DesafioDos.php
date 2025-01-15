<?php 
require_once 'Database.php';

class DesafioDos {

    public static function retriveLotes(string $loteID):void {

        Database::setDB(); 

        echo(json_encode(self::getLotes($loteID)));
    }

    private static function getLotes (string $loteID){
        $lotes = [];
        $cnx = Database::getConnection();
        $stmt = $cnx->query("SELECT * FROM debts WHERE lote='".$loteID."' ORDER BY id ASC"); //ordenar y comprar con string recibido
        while($rows = $stmt->fetchArray(SQLITE3_ASSOC)){
            $lotes[] = (object) $rows;
        }
        return $lotes;
    }
}

DesafioDos::retriveLotes('00148');