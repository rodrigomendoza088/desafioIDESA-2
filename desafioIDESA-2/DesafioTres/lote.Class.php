<?php
require_once ('Database.php');
class Lote{
	public static function get_lote($id){
		$lote = self::getLotes($id);
        if ($lote) {
	        echo(json_encode($lote));
            header('HTTP/1.1 200 Lote encontrado');
}else{
     header('HTTP/1.1 404 Lote NO encontrado');
}
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
?>