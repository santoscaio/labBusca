<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Config\Definition\Exception\Exception;

class VagaController extends Controller {

    public function select($keyword = null, $order = null, $city = 'all') {
        $filename = 'vagas.json';
        try {
            if (!is_null($keyword)) {

                $path = storage_path() . '/database/' . $filename;
                $jsonFile = file_get_contents($path);

                if ($this->jsonValidate($jsonFile)) {

                    $jsonData = json_decode($jsonFile, true);
                    
                    if (is_array($jsonData)) {
                        
                        $busca = $this->jsonFinder($jsonData['docs'], $keyword, 
                            $city);

                        if ($busca['total'] == 0) {
                            $msg = json_encode('Não foi encontrado resultado.');
                            return response($msg, 404);
                        }
                        
                        $vagas['docs'] = $this->arrayOrder($busca['itens'], 
                            $order);
                        
                        return response()->json($vagas);
                    } else {
                        $msg = json_encode('Array Inválido.');
                        return response($msg, 416);
                    }
                } else {
                    $msg = json_encode('JSON Inválido.');
                    return response($msg, 415);
                }
            } else {
                $msg = json_encode('Keyword Inválida.');
                return response($msg, 412);
            }
        } catch (Exception $e) {
            abort('404');
        }
    }

    /**
     * Verifica se JSON é valido
     * @param string $jsonFile Dados do arquivo do Json
     * @return boolean Retorna se arquivo é um JSON valido
     */
    public function jsonValidate($jsonFile) {
        $jsonData = json_decode($jsonFile, true);
        $jsonStatus = !empty($jsonFile) 
            && is_string($jsonFile) 
            && is_array($jsonData) 
            && !empty($jsonData) 
            && json_last_error() == 0;
        return $jsonStatus;
    }

    /**
     * Efetua a busca no JSON
     * @param string $jsonData Dados do arquivo de JSON
     * @param string $keyword Palavra para filtro
     * @param string $city Cidade para filtro
     * @return array Retorna array com itens encontrados conforme filtro de 
     * palavra e cidade
     */
    public function jsonFinder($jsonData, $keyword, $city) {

        $keyword = urldecode($keyword);
        $city = urldecode($city);
        $itens = 0;

        foreach ($jsonData as $idVaga => $vaga) {

            if ((stristr($vaga['title'], $keyword)) 
                || (stristr($vaga['description'], $keyword))) {

                if ($city == 'all' || (stristr($vaga['cidade'][0], $city))) {

                    $valor = $vaga['salario'];
                    $vagas['itens'][$valor][] = $vaga;
                    $itens++;
                }
            }
        }
        
        $vagas['total'] = $itens;
        
        return $vagas;
    }
    
    /**
     * Ordenador do array conforme filtro enviado
     * @param array $array Array contendo os itens após filtro
     * @param string $order Tipo de filtro aplicado
     * @return array Retorna array ordenado conforme filtro
     */
    public function arrayOrder($array, $order = null) {
        if ($order == 'asc') {
            
            $arrayOrder = ksort($array);
            foreach ($array as $valor) {
                $newArray[] = $valor;
            }
            return $newArray;
        } else if ($order == 'desc') {
            
            $arrayOrder = krsort($array);
            foreach ($array as $vagas) {
                foreach ($vagas as $vaga) {
                    $newArray[] = $vaga;
                }
            }
            return $newArray;
        }
        
        foreach ($array as $valor) {
            $newArray[] = $valor;
        }
        return $newArray;
    }

}
