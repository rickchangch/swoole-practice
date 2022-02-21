<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Controller;

use App\Model\Clients;
use App\Resource\JsonClientsResource as ClientsResources;
use Hyperf\DbConnection\Db;

class IndexController extends AbstractController
{
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        // return ClientResource::collection(Clients::all())->toResponse();
        return (new ClientsResources(Clients::paginate()))->toResponse();

        // // array -> stdClass obj
        // $clients = Db::select('SELECT * FROM `clients` WHERE name != ?', ['A']);

        // // Collection obj -> stdClass obj
        // // to Array(): array -> stdClass
        // $clients = Db::table('clients')->select('*')->get();

        // // Collection obj -> clients obj
        // // toArray(): array -> array
        // $clients = Clients::query()->get()->toArray();
        // print_r($clients);
        // exit;


        // $res = Db::table('clients')->where('name', '=', 'aaaa')->pluck('id');
        // // equal below
        // $clients = Db::table('clients')->select('*')->where('name', '=', 'aaaa')->get()->toArray();
        // $res = array_column($clients, 'id');


        // Db::enableQueryLog();
        // $a = Clients::query()->find(1)->toArray();
        // print_r($a);
        // var_dump(Arr::last(Db::getQueryLog()));
        // exit;

        Db::transaction(function () {

            $client = new Clients();
            $client->name = 'aaaa';
            $client->save();

            Clients::query()
                ->find(9)
                ->update(['name' => 'abab2']);

            $insertId = DB::table('clients')
                ->insertGetId(['name' => 'insert name']);

            Db::table('clients')
                ->where('id', '=', $insertId)
                ->update(['name' => 'update name']);
        });

        return [
            'method' => $method,
            'message' => "HelloLL {$user}.",
        ];
    }
}
