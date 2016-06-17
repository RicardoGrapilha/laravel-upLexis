<?php namespace App\Repository;

use App\Repository\AbstractRepository;
use App\Repository\SintegraRepositoryInterface;

use App\Models\Sintegra;

class SintegraRepository extends AbstractRepository implements SintegraRepositoryInterface
{
    protected $model;

    public function __construct(Sintegra $model)
    {
        $this->model = $model;
    }

    /**
     * Inicia a consulta no site da Sintegra e faz o tratamento dos dados retornados.
     *
     * @param $cnpj
     * @return array
     */
    public function ConsultaSintegra($cnpj)
    {
        // O parametro "botão" é enviado pois sem ele a consulta não funciona
        $html = $this->WebService(['num_cnpj' => $cnpj, 'num_ie' => '', 'botao' => 'Consultar']);

        if ($html) {
            // Usando o DOM para facilitar o parse do HTML
            $dom = new \DOMDocument();
            $dom->loadHTML($html);
            $rows = $dom->getElementsByTagName('td');

            // Ignora informações desnecessarias
            $array_ignore_data = ['ENDEREÇO', 'INFORMAÇÕES COMPLEMENTARES'];

            $json_result = [];
            $get_next_value = false;
            $count = 0;

            foreach ($rows as $rws) {
                if ($count > 2) {
                    // Limpando o valores retornados
                    $nodeValue = trim($rws->nodeValue);
                    $nodeValue = preg_replace('/\s(?=\s)/', '', $nodeValue);
                    $nodeValue = preg_replace('/[\n\r\t]/', ' ', $nodeValue);
                    $nodeValue = str_replace([':'], '', $nodeValue);

                    if ($get_next_value) {
                        // Cria o indice com o nome do campo e valor
                        $json_result[strtolower($get_next_value)] = $nodeValue;
                        $get_next_value = false;
                    } else {
                        // Faz a verificação para saber se é necessario resgatar o valor do campo
                        if (!in_array($nodeValue, $array_ignore_data)
                            && strpos($nodeValue, 'OBSERVAÇÃO') === false
                            && strpos($nodeValue, 'Data da Consulta') === false
                        ) {
                            $get_next_value = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($nodeValue)));
                            $get_next_value = str_replace(" ", "_", $get_next_value);

                            // Tratando caracteres ocultos no HTML
                            if($get_next_value[0] == 'n'){
                                $get_next_value = substr($get_next_value, 1);
                            }

                            if($get_next_value[strlen($get_next_value)-1] == 'n'){
                                $get_next_value = substr($get_next_value, 0, (strlen($get_next_value) - 1));
                            }
                        }
                    }
                }
                ++$count;
            }

            // Salvando dados consultado
            if (count($json_result) == 18) {
                $data = [
                    'idusuario' => auth()->user()->id,
                    'cnpj' => $cnpj,
                    'resultado_json' => $json_result,
                ];

                // Verifica se já existe um CNPJ cadastrado para a conta
                $result = $this->findBy([
                    ['cnpj', '=', $cnpj],
                    ['idusuario', '=', auth()->user()->id]
                ])->first();

                if ($result) {
                    $this->update($data, $result->id);
                } else {
                    $this->create($data);
                }
            } else {
                // CNPJ não localizado
                $json_result = 400;
            }

            return $json_result;
        } else {
            return 404;
        }
    }

    /**
     * Usa o metodo CURL para fazer a busca no site da Sintegra e retorna o HTML
     *
     * @param $data
     * @return bool|string HTML
     */
    private function WebService($data)
    {
        $ws = 'http://www.sintegra.es.gov.br/resultado.php';
        $useragent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6';

        $data_string = '';
        foreach ($data as $k => $v) {
            $data_string .= $k . '=' . $v . '&';
        }
        $data_string = rtrim($data_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $ws);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FILETIME, true);
        curl_setopt($ch, CURLOPT_POST, count($data));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);

        $output = curl_exec($ch);
        $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        unset($ch);

        if ($response_code == '404') {
            return false;
        } else {
            return $output;
        }
    }
}
