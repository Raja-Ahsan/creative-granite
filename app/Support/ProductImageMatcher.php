<?php

namespace App\Support;

class ProductImageMatcher
{
    private const IMAGE_DIR = 'public/images/products';

    /** @var array<string, list<string>> */
    private const PREFIXES = [
        'ESI-QS1000' => ['1000 '],
        'ESI-QS5050' => ['1005 '],
        'ESI-QS6040' => ['6040 '],
        'ESI-QS2318' => ['2318 '],
        'ESI-FCMOD33' => ['FC-MOD-33-'],
        'ESI-FCCL332D' => ['FC-CL-332-DBL-', 'FC-CL-30-'],
        'ESI-FCMOD36' => ['FC-MOD-36-'],
        'ESI-FCMOD362D' => ['FC-MOD-362-DBL-'],
    ];

    /** @var array<string, string> */
    private const SINGLE = [
        'ESI-VC12' => 'VC12.png',
        'ESI-VC10' => 'VC10.png',
        'ESI-VCR50' => 'VC50.png',
        'ESI-VCR60' => 'VC60.png',
        'ESI-QS1618' => 'Apron 3320 Beige.png',
    ];

    /** @var array<string, int> */
    private const LABEL_ORDER = [
        'White' => 1,
        'Matte Charcoal' => 2,
        'Black' => 3,
        'Mocha' => 4,
        'Concrete' => 5,
        'Beige' => 6,
        'Standard' => 7,
    ];

    public static function primaryPath(string $model): ?string
    {
        $images = self::allImages($model);

        return $images[0]['path'] ?? null;
    }

    /**
     * @return list<array{path: string, label: string}>
     */
    public static function allImages(string $model): array
    {
        $model = strtoupper($model);
        $files = self::matchingFiles($model);

        $images = array_map(
            fn (string $file) => [
                'path' => '/images/products/'.$file,
                'label' => self::labelFromFilename($file),
            ],
            $files
        );

        usort($images, fn (array $a, array $b) => (self::LABEL_ORDER[$a['label']] ?? 99) <=> (self::LABEL_ORDER[$b['label']] ?? 99));

        $seen = [];
        $unique = [];
        foreach ($images as $image) {
            if (isset($seen[$image['label']])) {
                continue;
            }
            $seen[$image['label']] = true;
            $unique[] = $image;
        }

        return array_values($unique);
    }

    /** @return list<string> */
    public static function relatedPaths(string $model): array
    {
        $all = self::allImages($model);

        if ($all === []) {
            return [];
        }

        return array_values(array_map(fn (array $image) => $image['path'], array_slice($all, 1)));
    }

    /** @return list<string> */
    private static function matchingFiles(string $model): array
    {
        $matches = [];

        foreach (self::prefixesFor($model) as $prefix) {
            foreach (self::filesInDirectory() as $file) {
                if (str_starts_with($file, $prefix)) {
                    $matches[] = $file;
                }
            }
        }

        if ($matches !== []) {
            return array_values(array_unique($matches));
        }

        $single = self::SINGLE[$model] ?? null;

        if ($single && self::fileExists($single)) {
            return [$single];
        }

        return [];
    }

    private static function labelFromFilename(string $file): string
    {
        $base = pathinfo($file, PATHINFO_FILENAME);

        if (preg_match('/^\d+\s+(.+)$/', $base, $matches)) {
            return trim($matches[1]);
        }

        if (preg_match('/^Apron 3320\s+(.+)$/i', $base, $matches)) {
            return trim($matches[1]);
        }

        if (stripos($base, 'MATTEGRAY') !== false) {
            return 'Matte Charcoal';
        }

        if (stripos($base, 'WHITE') !== false) {
            return 'White';
        }

        if (preg_match('/^VC\d+$/i', $base)) {
            return 'Standard';
        }

        return 'Standard';
    }

    /** @return list<string> */
    private static function prefixesFor(string $model): array
    {
        return self::PREFIXES[$model] ?? [];
    }

    /** @return list<string> */
    private static function filesInDirectory(): array
    {
        static $files = null;

        if ($files !== null) {
            return $files;
        }

        $directory = base_path(self::IMAGE_DIR);

        if (! is_dir($directory)) {
            return $files = [];
        }

        $files = array_values(array_filter(
            scandir($directory) ?: [],
            fn (string $file) => ! in_array($file, ['.', '..'], true)
                && is_file($directory.DIRECTORY_SEPARATOR.$file)
        ));

        return $files;
    }

    private static function fileExists(string $file): bool
    {
        return is_file(base_path(self::IMAGE_DIR.DIRECTORY_SEPARATOR.$file));
    }
}
