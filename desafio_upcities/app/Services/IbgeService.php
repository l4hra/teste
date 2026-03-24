<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class IbgeService
{
    public function getStates()
    {
        return Cache::remember('ibge_states', 86400, function () {
            try {
                $response = Http::timeout(5)->get('https://servicodados.ibge.gov.br/api/v1/localidades/estados');

                if ($response->successful()) {
                    return $response->json();
                }

                return [];
            } catch (\Exception $e) {
                Log::error('Erro ao buscar estados ' . $e->getMessage());
                return [];
            }
        });
    }

    public function getCitiesByState($uf)
    {
        return Cache::remember("ibge_cities_{$uf}", 86400, function () use ($uf) {
            try {
                $response = Http::timeout(5)->get("https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$uf}/municipios");

                return $response->successful() ? $response->json() : [];
            } catch (\Exception $e) {
                Log::error("Erro ao buscar cidades para UF {$uf}: " . $e->getMessage());
                return [];
            }
        });
    }
}
