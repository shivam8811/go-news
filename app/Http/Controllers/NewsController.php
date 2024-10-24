<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Language;
use App\Models\News;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Inertia\Response;

class NewsController extends Controller
{
    private const NEWS_COUNT = 12;

    /**
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('News/Index', [
            'newsData' => $this->getNewsDataFromDatabase(),
        ]);
    }

    public function fetchData()
    {
        $apiKey = config('services.news_api.key');
        $url =  'https://api.thenewsapi.com/v1/news/all';
        $newsData = null;
        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer $apiKey" // Adjust based on your API's requirements
            ])->get("$url?api_token=$apiKey&language=de");
            if ($response->successful()) {
                $data = $response->json();
                $newsData = $data['data'];
            }
        } catch (ConnectionException $e) {

        }

        return $newsData;
    }

    public function saveData($data): void
    {
        $languageMapping = [
            'en' => 'English',
            'de' => 'German',
        ];

        $languageCode = $data['language'];
        $languageName = $languageMapping[$languageCode] ?? null;

        if ($languageName) {
            // Check if the language exists, if not, create it
            $language = Language::firstOrCreate(
                ['name' => $languageName],
                ['code' => $languageCode]
            );
        } else {
//            Log::error('Unrecognized language code', ['code' => $languageCode]);
            return; // Early exit or continue based on your logic
        }

        $categoryIds = [];
        foreach ($data['categories'] as $categoryName) {
            $category = Category::firstOrCreate(
                ['name' => $categoryName]
            );

            $categoryIds[] = $category->id;
        }

        $newsItem = News::create([
            'uuid' => $data['uuid'],
            'title' => $data['title'],
            'description' => $data['description'],
            'url' => $data['url'],
            'image_url' => $data['image_url'],
            'published_at' => $data['published_at'],
            'source' => $data['source'],
            'language_id' => $language->id, // Save the language ID
        ]);

        $newsItem->categories()->attach($categoryIds);
    }

    /**
     * @param int $offset
     * @return Collection
     */
    public function getNewsDataFromDatabase(int $offset = 0): Collection
    {
        return News::query()
            ->select('id', 'title', 'description', 'url', 'image_url', 'published_at', 'source', 'language_id')
            ->with(['categories', 'language' => function ($query) {
                $query->select('id', 'name', 'code');
            }])
            ->orderBy('published_at', 'desc')
            ->skip($offset) // Skip the number of records based on the offset
            ->take(self::NEWS_COUNT) // Limit the number of records to return
            ->get();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getMoreData(Request $request): JsonResponse
    {
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * self::NEWS_COUNT; // Calculate the offset

        $newsItems = $this->getNewsDataFromDatabase($offset);

        $hasNoMoreData = $newsItems->count() < self::NEWS_COUNT;

        return response()->json([
            'newsData' => $newsItems,
            'hasNoMoreData' => $hasNoMoreData
        ]);
    }
}
