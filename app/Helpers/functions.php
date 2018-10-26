<?php

if (!function_exists('makeRequest')) {
    function makeRequest($url, $method = 'GET', $data = [])
    {
        $request = \Request::create($url, $method, $data);
        $response = \Route::dispatch($request);

        return $response;
    }
}

if (!function_exists('oauthLogin')) {
    function oauthLogin($username, $password)
    {
        $oauthPasswordClient = resolve('OAUTH_PASSWORD_CLIENT');

        return resolve('api')->post('/oauth/token', [
            'grant_type' => 'password',
            'client_id' => $oauthPasswordClient->id,
            'client_secret' => $oauthPasswordClient->secret,
            'username' => $username,
            'password' => $password,
            'scope' => '*'
        ]);
    }
}

if (!function_exists('refreshToken')) {
    function refreshToken($refreshToken)
    {
        $oauthPasswordClient = resolve('OAUTH_PASSWORD_CLIENT');

        return resolve('api')->post('/oauth/token', [
            'grant_type' => 'refresh_token',
            'client_id' => $oauthPasswordClient->id,
            'client_secret' => $oauthPasswordClient->secret,
            'refresh_token' => $refreshToken,
            'scope' => '*'
        ]);
    }
}

if (!function_exists('uploadFile')) {
    function uploadFile(\Illuminate\Http\UploadedFile $file, $path = '', $storage = 'public', $customName = null)
    {
        try {
            $fileName = $customName ? $customName : $file->hashName();
            $fileName = date('Y_m_d_H_i_s_') . $fileName;

            $filePath = $file->storePubliclyAs($path, $fileName, $storage);

            return $filePath;
        } catch (\Exception $exception) {
            return '';
        }
    }
}

if (!function_exists('sortedQuery')) {
    function sortedQuery($class, $request = null, $defaultOrder = 'id')
    {
        $request = $request ?? request();
        $sort = $request->get('sort', $defaultOrder . '|asc') ?? $defaultOrder . '|asc';
        [$orderBy, $orderDirection] = explode('|', $sort);
        $search = $request->get('search', null);
        $sortFields = method_exists($class, 'getSortFields') ? $class->getSortFields() : [];

        $query = $class
            ->newQuery()
            ->orderBy($orderBy, $orderDirection);

        if ($search) {
            $search = decodeUri($search);
            $query->where(function($q) use ($sortFields, $search) {
                foreach($sortFields as $field) {
                    $q->orWhere($field, 'like', "%$search%");
                }
            });
        }

        return $query;
    }
}

if (!function_exists('decodeUri')) {
    function decodeUri($string) {
        return rawurldecode(rawurldecode(rawurldecode($string)));
    }
}