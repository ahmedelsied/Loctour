<?php

namespace Loctour\API\V1\Support\Services\APIResponse;

use Illuminate\Http\JsonResponse;

class JsonResponder
{
    public function success($body, int $code = 200, array $extra = []): JsonResponse
    {
        return $this->base($body, $code, $extra);
    }

    public function error($body, int $code = 400, array $extra = []): JsonResponse
    {
        return $this->base($body, $code, $extra, false);
    }

    public function executed(): JsonResponse
    {
        return $this->success(__('Request executed successfully'));
    }

    public function failed(): JsonResponse
    {
        return $this->error(__('Request failed to be executed'));
    }

    /**
     * @param $body
     * @param  int  $code
     * @param  array  $extra
     * @param  boolean  $status
     * @return \Illuminate\Http\JsonResponse
     */
    private function base($body, int $code, array $extra, bool $status = true): JsonResponse
    {
        $bodyAttribute = $status ? 'data' : 'message';
        $response = [
            $bodyAttribute => $body
        ];

        if (count($extra) > 0) {
            $response['extra'] = $extra;
        }
        return response()->json(
            $response,
            $code
        );
    }
}
