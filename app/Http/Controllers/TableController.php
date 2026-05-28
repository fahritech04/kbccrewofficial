<?php

namespace App\Http\Controllers;

use App\Http\Resources\Competition\CompetitionStandingResource;
use App\Services\Table\TablePageContentService;
use Inertia\Inertia;
use Inertia\Response;

class TableController extends Controller
{
    public function index(TablePageContentService $tablePageContentService): Response
    {
        $content = $tablePageContentService->getContent();

        return Inertia::render('Table', [
            'standings' => CompetitionStandingResource::collection($content['standings'])->resolve(),
            'leader' => $content['leader']
                ? CompetitionStandingResource::make($content['leader'])->resolve()
                : null,
        ]);
    }
}
