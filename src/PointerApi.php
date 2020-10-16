<?php

namespace BfAtoms\Pointer;

use BfAtoms\Requester\Requester;

use Illuminate\Support\Facades\Cache;

abstract class PointerApi 
{
    public $requester;

    protected $route;

    protected $result;

    protected $queries = [];

    public function __construct()
    {
        $this->requester = new Requester();
    }

    public function getToken()
    {
        return Cache::get('token');
    }

    public function saveToken($token)
    {
        return Cache::put('token',$token);
    }

    public function route($route=null)
    {
        $this->route = str_replace(rtrim(config('pointer.api_url'),'/'). '/', '', $this->route);
        $route = $route ?? $this->route;       
        $this->route = rtrim(config('pointer.api_url'),'/') . '/'. ltrim($route,'/');
        return $this;
    }

    public function makeRoute($id = null, $body=false)
    {
        // dd($id);
        $route = rtrim(config('pointer.api_url'),'/') . '/'. ltrim($this->route,'/');

        if(!empty($id)){
            $route = $route.'/'.$id;
        }
        if($body == false){
            $query_string = http_build_query($this->queries);
            if(!empty($query_string)){
                $this->queries = [];
                return $route."?".$query_string;
            }
        }
        return $route;
    }

    public function addQuery($key, $value)
    {
        $this->queries[$key] = $value;
        return $this;
    }

    public function addQueries(array $data)
    {
        foreach($data as $key => $value){
            $this->addQuery($key, $value);
        }
        return $this;
    }

    public function post($url, $data=[], $header=[])
    {
        $this->result = json_decode($this->requester->post($url, $data, $header),true);
        $this->queries = [];
        return $this->result;
    }

    public function put($url, $data=[], $header=[])
    {
        $this->result = json_decode($this->requester->put($url, $data, $header),true);
        $this->queries = [];
        return $this->result;
    }

    public function get($url, $data=[], $header=[])
    {
        $data = array_merge($data, request()->all(), $this->queries);
        $this->queries = [];
        $this->result = $this->requester->get($url, $data, array_merge($header, $this->getDigest()));
        return json_decode($this->result, true);
    }

    public function getBearer()
    {
        return [
            'Authorization' => "Bearer ".$this->getToken()
        ];
    }

    public function getDigest()
    {
        return [
            'secret-key'=> config('pointer.api_key'),
            'secret-code'=> config('pointer.api_code'),
            'digest'=> config('pointer.api_digest')
        ];
    }

    public function getRoute()
    {
        return $this->makeRoute();
    }

    public function browse($url = null)
    {

        $url = $url ?? $this->makeRoute(null, true);
        return $this->get($url);
    }

    public function read($id, $url=null)
    {
        $url = $url ?? $this->makeRoute($id,true);
        return $this->get($url);
    }
    
    public function edit($id, $data = [], $url=null)
    {
        $url = $url ?? $this->makeRoute($id);
        return $this->put($url, array_merge(request()->all(), $data),$this->getDigest());
    }

    public function add($data=[], $url =null)
    {
        $url = $url ?? $this->makeRoute();
        return $this->post($url, array_merge(request()->all(),$data),$this->getDigest());
    }

    public function delete($id, $url=null)
    {
        $url = $url ?? $this->makeRoute($id);
        return $this->post($url, array_merge(request()->all()),$this->getDigest());
    }

    public function find($key=null, $value=null)
    {
        if(!empty($key)){
            $this->addQuery($key, $value);
        }
        return $this->browse();
    }

    public function searchMeta($key, $value)
    {
        return $this->addQuery('whereMeta', $key)
            ->addQuery('whereMetaValue', $value)
            ->addQuery('all','true')
            ->browse()['data'][0] ?? null;
    }

    public function searchField($key, $value, $operation='exact')
    {
        // find operation is like and exact
        return $this->addQuery('findColumn', $key)
            ->addQuery('findValue', $value)
            ->addQuery('findOperation', $operation)
            ->addQuery('all','true')
            ->browse()['data'][0] ?? null;
    }
    
    public function addJson($data = null, $url = null)
    {
        try {
            $url = $url ?? $this->makeRoute();
            return $this->json('POST', $url, array_merge($data, request()->all()), $this->getDigest());
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public function editJson($id, $data = [], $url = null)
    {
        try {
            $url = $url ?? $this->makeRoute($id);
            return $this->json('PUT', $url, array_merge($data, request()->all()), $this->getDigest());
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public function json($type, $url, $data, $header)
    {
        try {
            $this->result = $this->requester->json($type, $url, $data, $header);
            $this->queries = [];
            return $this->result;
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage() . "\n\n" . json_encode([
                'url'    => $url,
                'data'   => $data,
                'header' => $header
            ]));
        }
    }

}


