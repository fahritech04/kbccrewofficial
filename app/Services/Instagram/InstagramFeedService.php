<?php

namespace App\Services\Instagram;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class InstagramFeedService
{
    private const DEFAULT_LIMIT = 9;

    private const DEFAULT_COMMENTS_LIMIT = 3;

    private const DEFAULT_USERNAME = 'kbccrewofficial';

    private const DEFAULT_GRAPH_VERSION = 'v23.0';

    private const PUBLIC_PROFILE_HEADERS = [
        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
        'X-IG-App-ID' => '936619743392459',
        'X-ASBD-ID' => '129477',
        'Accept' => 'application/json',
    ];

    /**
     * @return array<string, mixed>
     */
    public function getFeed(int $limit = self::DEFAULT_LIMIT): array
    {
        $config = config('services.instagram');
        $profile = $this->defaultProfile($config);
        $cacheKey = $this->cacheKey($config, $limit);
        $cacheMinutes = (int) ($config['cache_minutes'] ?? 5);

        return Cache::remember($cacheKey, now()->addMinutes($cacheMinutes), function () use ($config, $limit, $profile) {
            try {
                if ($this->isOfficialConfigured($config)) {
                    return $this->fetchOfficialGraphFeed($config, $limit, $profile);
                }

                return $this->fetchPublicProfileFeed($config, $limit, $profile);
            } catch (\Throwable $exception) {
                Log::warning('Instagram feed fallback', [
                    'message' => $exception->getMessage(),
                ]);

                return $this->unavailableFeed($profile);
            }
        });
    }

    /**
     * @param  array<string, mixed>  $config
     * @param  array<string, mixed>  $profile
     * @return array<string, mixed>
     */
    private function fetchOfficialGraphFeed(array $config, int $limit, array $profile): array
    {
        $version = $config['graph_version'] ?? self::DEFAULT_GRAPH_VERSION;
        $accessToken = $config['access_token'];
        $userId = $config['user_id'];

        $profileResponse = Http::timeout(15)->get(
            "https://graph.facebook.com/{$version}/{$userId}",
            [
                'fields' => 'id,username,followers_count,media_count,profile_picture_url',
                'access_token' => $accessToken,
            ],
        );

        $resolvedProfile = $profile;

        if ($profileResponse->successful()) {
            $resolvedProfile['username'] = data_get(
                $profileResponse->json(),
                'username',
                $resolvedProfile['username'],
            );
            $resolvedProfile['followers_count'] = data_get($profileResponse->json(), 'followers_count');
            $resolvedProfile['media_count'] = data_get($profileResponse->json(), 'media_count');
            $resolvedProfile['profile_picture_url'] = data_get($profileResponse->json(), 'profile_picture_url');
            $resolvedProfile['profile_url'] = 'https://www.instagram.com/'.$resolvedProfile['username'].'/';
        }

        $mediaResponse = Http::timeout(15)->get(
            "https://graph.facebook.com/{$version}/{$userId}/media",
            [
                'fields' => 'id,caption,comments_count,like_count,media_type,media_url,thumbnail_url,permalink,timestamp',
                'limit' => $limit,
                'access_token' => $accessToken,
            ],
        );

        if ($mediaResponse->failed()) {
            throw new \RuntimeException('Gagal mengambil data media Instagram.');
        }

        $posts = collect(data_get($mediaResponse->json(), 'data', []))
            ->map(fn (array $media) => $this->graphPostToArray($media, $version, $accessToken, $config))
            ->values()
            ->all();

        return [
            'is_live' => true,
            'profile' => $resolvedProfile,
            'posts' => $posts,
            'message' => null,
        ];
    }

    /**
     * @param  array<string, mixed>  $config
     * @param  array<string, mixed>  $profile
     * @return array<string, mixed>
     */
    private function fetchPublicProfileFeed(array $config, int $limit, array $profile): array
    {
        $username = $config['username'] ?? self::DEFAULT_USERNAME;

        $profileResponse = Http::withHeaders(self::PUBLIC_PROFILE_HEADERS)
            ->timeout(15)
            ->get("https://www.instagram.com/api/v1/users/web_profile_info/?username={$username}");

        if ($profileResponse->failed()) {
            throw new \RuntimeException('Gagal mengambil data profile Instagram publik.');
        }

        $user = data_get($profileResponse->json(), 'data.user');

        if (! is_array($user)) {
            throw new \RuntimeException('Respons profile Instagram publik tidak valid.');
        }

        $resolvedProfile = $profile;
        $resolvedProfile['username'] = data_get($user, 'username', $username);
        $resolvedProfile['followers_count'] = data_get($user, 'edge_followed_by.count');
        $resolvedProfile['media_count'] = data_get($user, 'edge_owner_to_timeline_media.count');
        $resolvedProfile['profile_picture_url'] = data_get($user, 'profile_pic_url_hd') ?? data_get($user, 'profile_pic_url');
        $resolvedProfile['profile_url'] = 'https://www.instagram.com/'.$resolvedProfile['username'].'/';

        $posts = collect(data_get($user, 'edge_owner_to_timeline_media.edges', []))
            ->take($limit)
            ->map(fn (array $edge) => $this->publicPostToArray(data_get($edge, 'node', [])))
            ->values()
            ->all();

        return [
            'is_live' => true,
            'profile' => $resolvedProfile,
            'posts' => $posts,
            'message' => 'Mode publik aktif: komentar detail memerlukan credential API resmi Instagram.',
        ];
    }

    /**
     * @param  array<string, mixed>  $config
     */
    private function defaultProfile(array $config): array
    {
        $username = $config['username'] ?? self::DEFAULT_USERNAME;

        return [
            'username' => $username,
            'profile_url' => 'https://www.instagram.com/'.$username.'/',
            'followers_count' => null,
            'media_count' => null,
            'profile_picture_url' => null,
        ];
    }

    /**
     * @param  array<string, mixed>  $config
     */
    private function cacheKey(array $config, int $limit): string
    {
        $cacheIdentity = $config['user_id'] ?: ($config['username'] ?? self::DEFAULT_USERNAME);

        return sprintf('instagram-feed:%s:%d', $cacheIdentity, $limit);
    }

    /**
     * @param  array<string, mixed>  $config
     */
    private function isOfficialConfigured(array $config): bool
    {
        return ! empty($config['user_id']) && ! empty($config['access_token']);
    }

    /**
     * @param  array<string, mixed>  $profile
     * @return array<string, mixed>
     */
    private function unavailableFeed(array $profile): array
    {
        return [
            'is_live' => false,
            'profile' => $profile,
            'posts' => [],
            'message' => 'Instagram feed belum tersedia saat ini. Coba isi credential API resmi atau refresh lagi beberapa saat.',
        ];
    }

    /**
     * @param  array<string, mixed>  $media
     * @param  array<string, mixed>  $config
     * @return array<string, mixed>
     */
    private function graphPostToArray(array $media, string $version, string $accessToken, array $config): array
    {
        $mediaId = data_get($media, 'id');
        $commentsLimit = (int) ($config['comments_limit'] ?? self::DEFAULT_COMMENTS_LIMIT);
        $comments = $this->graphComments($mediaId, (int) data_get($media, 'comments_count', 0), $version, $accessToken, $commentsLimit);

        return [
            'id' => $mediaId,
            'caption' => data_get($media, 'caption', ''),
            'comments_count' => (int) data_get($media, 'comments_count', 0),
            'like_count' => (int) data_get($media, 'like_count', 0),
            'media_type' => data_get($media, 'media_type'),
            'image_url' => data_get($media, 'media_url') ?? data_get($media, 'thumbnail_url'),
            'permalink' => data_get($media, 'permalink'),
            'timestamp' => data_get($media, 'timestamp'),
            'comments' => $comments,
        ];
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function graphComments(?string $mediaId, int $commentsCount, string $version, string $accessToken, int $commentsLimit): array
    {
        if (! $mediaId || $commentsCount <= 0) {
            return [];
        }

        $commentsResponse = Http::timeout(10)->get(
            "https://graph.facebook.com/{$version}/{$mediaId}/comments",
            [
                'fields' => 'id,text,username,timestamp,like_count',
                'limit' => $commentsLimit,
                'access_token' => $accessToken,
            ],
        );

        if ($commentsResponse->failed()) {
            return [];
        }

        return collect(data_get($commentsResponse->json(), 'data', []))
            ->map(fn (array $comment) => [
                'id' => data_get($comment, 'id'),
                'username' => data_get($comment, 'username'),
                'text' => data_get($comment, 'text'),
                'like_count' => (int) data_get($comment, 'like_count', 0),
                'timestamp' => data_get($comment, 'timestamp'),
            ])
            ->values()
            ->all();
    }

    /**
     * @param  array<string, mixed>  $node
     * @return array<string, mixed>
     */
    private function publicPostToArray(array $node): array
    {
        $shortcode = data_get($node, 'shortcode');
        $timestamp = data_get($node, 'taken_at_timestamp');

        return [
            'id' => data_get($node, 'id'),
            'caption' => data_get($node, 'edge_media_to_caption.edges.0.node.text', ''),
            'comments_count' => (int) data_get($node, 'edge_media_to_comment.count', 0),
            'like_count' => (int) data_get($node, 'edge_liked_by.count', 0),
            'media_type' => data_get($node, 'is_video') ? 'VIDEO' : 'IMAGE',
            'image_url' => data_get($node, 'display_url') ?? data_get($node, 'thumbnail_src'),
            'permalink' => $shortcode ? "https://www.instagram.com/p/{$shortcode}/" : null,
            'timestamp' => $timestamp ? Carbon::createFromTimestamp($timestamp)->toIso8601String() : null,
            'comments' => [],
        ];
    }
}
