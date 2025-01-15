<?php 

require_once 'Database.php';

class DesafioUno {


    public static function getClientDebt (int $clientID)
    {
        Database::setDB();

        $lotes = self::getLotes();
         
        $cobrar['status']            = false;
        $cobrar['message']           = 'No hay Lotes para cobrar';
        $cobrar['data']['total']     = 0;
        $cobrar['data']['detail']    = [];

        

        foreach($lotes as $lote){

        
            if($lote->vencimiento > date('Y-m-d') || $lote->vencimiento == null) continue; //fechas vencidas y no nulas


            if($lote->clientID != $clientID) continue;
            

            
            $cobrar['status']             = true; // true apra cobrar
            $cobrar['message']            = 'Tienes Lotes para cobrar';
            $cobrar['data']['total']     += $lote->precio;
            $cobrar['data']['detail'][]   = (array) $lote;
 
        }

        echo(json_encode($cobrar));
    }

    

    private static function getLotes() : array 
    {
        $lotes = [];
        $cnx = Database::getConnection();
        $stmt = $cnx->query("SELECT * FROM debts ORDER BY id ASC"); //ordenar segun id acsendente
        while($rows = $stmt->fetchArray(SQLITE3_ASSOC)){
            $rows['clientID'] = (string) $rows['clientID'];
            $lotes[] = (object) $rows;
        }
        $lotes = array_slice($lotes, -3, 3); //ultimos 3 registros

        return $lotes;
    }



}

DesafioUno::getClientDebt(123456);