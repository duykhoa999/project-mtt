<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class AppController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const BASE_URL = 'http://localhost:8088/api';

    public function __construct()
    {
        $this->controller_active = '';
    }

    public function call($url = null, $method = null, $param = null) {

        $client = new Client();
        try {
            if (!empty($param)) {
                $result = $client->request($method, self::BASE_URL . $url, ['form_params' => $param]);
            }
            else {
                $result = $client->request($method, self::BASE_URL . $url);
            }
        }
        catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
        if ($result->getStatusCode() == 200) {
            return $result->getBody()->getContents();
        }

        return false;

    }

    public function paginateData($data = [])
    {
        $page = !isset($_GET['page']) ? 1 : $_GET['page'];
        $limit = config('define.paginate'); // five rows per page
        $offset = ($page - 1) * $limit; // offset
        $total_items = count($data); // total items
        $total_pages = ceil($total_items / $limit);
        $final = array_splice($data, $offset, $limit); // splice them according to offset and limit

        return [
            'total_item' => $total_items ?? 0,
            'total_pages' => $total_pages ?? 0,
            'final' => $final,
            'page' => $page
        ];
    }
}
