<?php
namespace App;
use PDO;
class Consulta{
    // Campos da tabela "consulta"
    public $id;
    public $paciente_id;
    public $dentista_id;
    public $data_hora;
    public $valor_total;
    public $valor_pago;
    public $forma_pagamento;
    public $procedimentos_realizados;
    public $procedimentos_arealizar;
    public $descricao;
    public $medicacao;
   
    public function cadastrar(){
        $db = new DataBase('consulta');
        $this->id = $db->insert([
            'paciente_id' => $this->paciente_id,
            'dentista_id' => $this->dentista_id,
            'data_hora' => $this->data_hora,
            'valor_total' => $this->valor_total,
            'valor_pago' => $this->valor_pago,
            'forma_pagamento' => $this->forma_pagamento,
            'procedimentos_realizados' => $this->procedimentos_realizados,
            'procedimentos_arealizar' => $this->procedimentos_arealizar,
            'descricao' => $this->descricao,
            'medicacao' => $this->medicacao
        ]);
    }
    public function alterar(){
        return (new DataBase('consulta'))->update('id = '.(int)$this->id, [
            'paciente_id' => $this->paciente_id,
            'dentista_id' => $this->dentista_id,
            'data_hora' => $this->data_hora,
            'valor_total' => $this->valor_total,
            'valor_pago' => $this->valor_pago,
            'forma_pagamento' => $this->forma_pagamento,
            'procedimentos_realizados' => $this->procedimentos_realizados,
            'procedimentos_arealizar' => $this->procedimentos_arealizar,
            'descricao' => $this->descricao,
            'medicacao' => $this->medicacao
        ]);
    }
    public function excluir(){
        return (new DataBase('consulta'))->delete('id = '.(int)$this->id);
    }
    public static function listar($where = null, $order = null, $limit = null){
        $consultas = (new DataBase('consulta'))->select($where, $order, $limit);
        foreach($consultas as $consulta){
           $consulta->paciente = (new DataBase('paciente'))->select('id = '.$consulta->paciente_id)->fetchObject(PDO::FETCH_CLASS);
           $consulta->dentista = (new DataBase('dentista'))->select('id = '.$consulta->dentista_id)->fetchObject(PDO::FETCH_CLASS);
                
            return $consultas->fetchAll(PDO::FETCH_CLASS, self::class);
        }
    }
    public static function buscarPorId($id){
        return (new DataBase('consulta'))->select('id = '.(int)$id)->fetchObject(self::class);
    }
}
